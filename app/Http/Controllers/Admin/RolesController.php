<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthorizedController;
use Cartalyst\Sentinel\Roles\EloquentRole as Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Input;
use Validator;
use Redirect;
use App\Models\User;
use Request;

class RolesController extends AuthorizedController {

    /**
     * Holds the Sentinel Roles repository.
     *
     * @var \Cartalyst\Sentinel\Roles\EloquentRole
     */
    protected $roles;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->roles = Sentinel::getRoleRepository();
    }

    /**
     * Display a listing of roles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $adminRoles = $this->roles->findById(1);
        $managerRoles = $this->roles->findById(2);

        $roles = $this->roles->paginate();
        $user = Sentinel::getUser();

        return view('admin.roles.index', compact('roles','user','adminRoles','managerRoles'));
    }

    /**
     * Show the form for creating new role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->showForm('create');
    }

    /**
     * Handle posting of the form for creating new role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        return $this->processForm('create');
    }

    /**
     * Show Roles detail information.
     * @param $id
     */
    public function show($id){
        return $this->showForm('update', $id);
    }


    /**
     * Show the form for updating role.
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->showForm('update', $id);
    }

    /**
     * Handle posting of the form for updating role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        return $this->processForm('update', $id);
    }

    /**
     * Remove the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = $this->roles->find($id);

        if ($role != null)
        {
            if($role->delete()) {
                return Redirect::to('admin/roles')
                    ->with('warning', sprintf(trans('message.msg_delete_success'), trans('default.role'), $role->name,false));
            }
        }

        return Redirect::to('admin/roles')
            ->with('errors',printf(trans('message.msg_not_found')));
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
        if ($id)
        {
            if ( ! $role = $this->roles->find($id))
            {
                return Redirect::to('admin/roles');
            }
        }
        else
        {
            $role = $this->roles->createModel();
        }
        return view('admin.roles.form', compact('mode', 'role'));
    }

    /**
     * Processes the form.
     *
     * @param  string  $mode
     * @param  int     $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function processForm($mode, $id = null)
    {

        $input = Input::only('name','slug');

        $rules =$this->rules($id);

        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }

        //process permissions input
        if($validator->passes()) {
            //save the role information
            $role = $this->roles->findOrNew($id);

            $input['permissions'] =Input::get('permissions_list');
            $permissions = [];

/*            if (Request::has('permisstions_list')){
                foreach (Input::get('permissions_list') as $permission) {
                    $input['permissions'][$permission] = true;
                }
            }*/


            $role->fill($input)->save();

            if($mode == 'create')
                return Redirect::route('admin.roles.index')->with('message',sprintf(trans('message.msg_create_success'),trans('default.role'),$role->name));
            else
                return Redirect::route('admin.roles.index')->with('message',sprintf(trans('message.msg_update_success'),trans('default.role'),$role->name));

        }


        return Redirect::back()->withInput()->withErrors($validator);
    }

    public function rules($id=''){

        switch(Request::method() ){
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return
                    $rules = [
                        'name' => 'required|unique:roles',
                        'slug' => 'required|unique:roles',
                       'permissions_list' => 'required|array'
                    ];
            case 'PUT':
            case 'PATCH':
                $role = $this->roles->find($id);

                return
                    $rules = [
                        'name' => 'required|unique:roles,id,' .$role->id,
                        'slug' => 'required|unique:roles,id,' .$role->id,
                       'permissions_list' => 'required|array'
                    ];
            default:
                break;
        }
    }
}
