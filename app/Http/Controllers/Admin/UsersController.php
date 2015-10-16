<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthorizedController;
//use App\Models\Roles;
use App\Models\User;
use Cartalyst\Sentinel\Users\EloquentUser;
use Validator;
use Redirect;
use Input;
use Sentinel;
use Request;
use Activation;

class UsersController extends AuthorizedController {

    /**
     * Holds the Sentinel Users repository.
     *
     * @var \Cartalyst\Sentinel\Users\EloquentUser
     */
    protected $users,$roles;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        parent::__construct();
        $this->users = $users;
        $this->roles = Sentinel::getRoleRepository();
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.users.index', [
                'users' => User::with('roles','activations')->paginate(\Config::get('fzbconfig.order_paginate')),
                'adminRoles' => $this->roles->findById(1),
                'managerRoles' => $this->roles->findById(2)
            ]
        );
    }

    /**
     * Display a user with Permission and Role.
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $mode = 'show';

        if ($id){
            if ($user = $this->users->with('roles','activations')->find($id)) {

                $role = Sentinel::findRoleById($id);

                return view('admin.users.detail', compact('mode', 'role', 'user'));
            }
        }

        return Redirect::to('admin/users')->withErrors('The user is not existed');
    }
    /**
     * Show the form for creating new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->showForm('create');
    }

    /**
     * Handle posting of the form for creating new user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        return $this->processForm('create');
    }

    /**
     * Show the form for updating user.
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->showForm('update', $id);
    }

    /**
     * Handle posting of the form for updating user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        return $this->processForm('update', $id);
    }

    /**
     *  activate user from backend
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function activate($id){

        if (($user = $this->users->find($id))) {

            if (Activation::completed($user)) {
                return Redirect::back()->with('message', 'This user has been activated. it does not need to be activated again.');
            }

            if (!$activation = Activation::exists($user)) {
                $activation = Activation::create($user);
            }

            if (isset($activation->code)) {
                if (Activation::complete($user, $activation->code)) {
                    return Redirect::back()->withMessage("The user [". $user->first_name." ".$user->last_name."] was activated successfully!");
                }
                return Redirect::back()->withMessage("The user [".$user->first_name." ".$user->last_name."]  was activated fail!");
                return Redirect::back()->with('message', 'The user was activated fail!');
            }
        }
        return Redirect::back()->withMessage('The user <b>'.$user->first_name.' </b> was activated fail!');
    }

    /**
     * Deactivate user
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function deactivate($id){

        if (! $user = $this->users->find($id)) {
            $user = Sentinel::findById($id);
        }

        Activation::removeExpired();
        if(Activation::remove($user)){
            return Redirect::back()->withWarning("The user [".$user->first_name." ".$user->last_name."] was deactivated!");
        }

        return Redirect::back()->withErrors("The user [".$user->first_name." ".$user->last_name."] was deactivated fail!");
    }
    /**
     * Remove the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($user = $this->users->find($id))
        {
            if($user->inRole('admin')) {
                return Redirect::back()->withErrors('You Can not delete this user who has administrator privilege.');
            }
            else{
                $user->delete();
                return Redirect::to('admin/users')->with('warning','You Can not delete this user who has administrator privilege.');
            }
        }
        else{
            return Redirect::back()->withErrors('no user was found.');
        }
    }

    /**
     * Shows the form.
     *
     * @param  string  $mode
     * @param  int     $id
     * @return mixed
     */
    protected function showForm($mode, $id = null)
    {

        if (!$id) {
            $user = $this->users;
        }
        else{
            if ( ! $user = $this->users->find($id))
            {
                return Redirect::back();
            }
        }

        //$userRole = [3]; // default is member.

        $userRole = $user->roles()->lists('id');

        $role_list = [];
        $role_list = $this->roles->lists('name','id');

        return view('admin.users.form', compact('mode', 'user','userRole','role_list'));
    }

    /**
     * Processes the form. save or update user information
     *
     * @param  string  $mode
     * @param  int     $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function processForm($mode, $id = null)
    {
        $input = array_filter(Input::all());


        $currentUser = Sentinel::getUser();
        //check current user id is the same assigned id.
        //1. has permission to modify user information
        //2. update self information.

        if(! $currentUser->hasAccess( 'admin' ) ){
            return Redirect::back()->withErrors('You do not have permission to modify ');
        }

        $validator = Validator::make( $input, $this->rules($id));

        if( $validator->fails()){
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput(Input::except('password','password_confirmed'));
        }

        $RoleIds = Input::get('role_list');

        if ($newUser = $this->users->find($id)){
            //update user
            $newUser->update($input);

            //update role user table.
            //1. sync all of the role from user.
            $newUser->roles()->sync($RoleIds);

            return Redirect::to('admin/users')->withMessage('the account updated successfully!');
        }
        else
        {
            $newUser = Sentinel::create($input);
            $newUser->roles()->attach($RoleIds);
            $code = Activation::create($newUser);
            dd($newUser);
            if(Activation::complete($newUser, $code)) {
                return Redirect::to('admin/users')->withMessage('the account created successfully!');
            }

            return Redirect::to('admin/users')->withErrors('the account activate fail!');
        }

        return Redirect::back()
                ->withErrors('Can not process your operation now, try it later.')
                ->withInput();
    }

    /**
     * @param string $id
     * @return array
     */
    public function rules($id=''){

        if($id){
            $user = \Sentinel::findById($id);
        }
        else{
            $user = Sentinel::getUser();
        }
        switch(Request::method() ){
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email'     => 'required|email|unique:users',
//                'role_list' => 'required|array',
                'password' => 'required|confirm|min:6',
                'password_confirmed' => 'required|same:password'
                ];

                return $rules;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users,id,' . $user->getUserId(),
//                    'role_list' => 'required|array',
                ];

                if(Request::has('password')) {
                    array_merge($rules,['password' => 'required|confirm|min:6',
                        'password_confirmed' => 'required|same:password'
                    ]);
                }

            return $rules;

            default:
                break;
        }
    }
}
