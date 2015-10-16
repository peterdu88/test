<?php namespace App\Http\Controllers\Accounts;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthorizedController;
use Sentinel;
use Input;
use Validator;
use Redirect;

class AccountsController extends AuthorizedController {

    protected $users;

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct(){

        parent::__construct();

        $this->users = Sentinel::getUserRepository();
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $mode = 'show';

        if ($id){
            if ($user = $this->users->createModel()->find($id)) {

                $role = Sentinel::findRoleById($id);

                return view('account.users.detail', compact('mode', 'role', 'user'));
            }
        }

        return Redirect::to('account');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return $this->showForm( $id, 'update' );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        return $this->processForm( $id, 'update' );
	}



    /**
     * Shows the form.
     *
     * @param  string  $mode
     * @param  int     $id
     * @return mixed
     */
    protected function showForm( $id = null, $mode)
    {
        if ($id)
        {
            if ( ! $user = $this->users->createModel()->find($id))
            {
                return Redirect::back()->withErrors(array('Can not process the next step.'));
            }
        }
        else
        {
            $user = $this->users->createModel();
        }

        $role = \Sentinel::getRoleRepository()->findById($id);

        return view('account.users.form', compact('mode', 'user','role'));
    }

    /**
     * Processes the form.
     *
     * @param  string  $mode
     * @param  int     $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function processForm( $id = null ,$mode)
    {
        $input = array_filter(Input::all());

        dd($input);
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users'
        ];

        if ($id)
        {
            $user = $this->users->createModel()->find($id);

            $rules['email'] .= ",email,{$user->email},email";

            $messages = $this->validateUser($input, $rules);

            if ($messages->isEmpty())
            {
                $this->users->update($user, $input);
            }
        }
        else
        {
            $messages = $this->validateUser($input, $rules);

            if ($messages->isEmpty())
            {
                $user = $this->users->create($input);

                $code = Activation::create($user);

                Activation::complete($user, $code);
            }
        }

        if ($messages->isEmpty())
        {
            return Redirect::to('account');
        }

        return Redirect::back()->withInput()->withErrors($messages);
    }

    /**
     * Validates a user.
     *
     * @param  array  $data
     * @param  mixed  $id
     * @return \Illuminate\Support\MessageBag
     */
    protected function validateUser($data, $rules)
    {
        $validator = Validator::make($data, $rules);

        $validator->passes();

        return $validator->errors();
    }

}