<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthorizedController;
use App\Http\Requests;
use App\Models\Categories;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Validator;
use Sentinel;
use Input;
use Redirect;



class CategoriesController extends AuthorizedController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    protected $CreateRules = ['name' => 'required|min:3|unique:categories'];
    protected $UpdateRules = ['name' => 'required|min:3'];
    protected $user;

    public function __construct(){
        $this->user = Sentinel::getUser();
    }

    /**
     * @return \Illuminate\View\View
     */
	public function index()
	{
        $categories = Categories::paginate(15);
        return view('admin.orders.categories',array('categories' => $categories, 'user' => $this->user));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $mode = "create";
        return $this->showForm('create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validation = Validator::make(Input::all(),$this->CreateRules);

        if($validation->fails()){
            if ($categoryFind = Categories::where('name', '=', Input::get('name'))->count()) {

                return Redirect::back()
                    ->withErrors($validation)
                    ->withInput();
            }
            return Redirect::back()
                ->withErrors($validation)
                ->withInput();
        }

        if($validation->passes()){

            $category = new Categories();
            $category->name = Input::get('name');

            if($category->save()){

                return Redirect::intended('admin/categories')
                    ->with('message', sprintf( trans ('message.msg_category_create_success'),$category->name));

            }

            return Redirect::intended('admin/categories')
                ->withErrors(array('errors' => sprintf( trans ('message.msg_category_update_fail'),Input::get('name'))));
        }

        return Redirect::back()
            ->with('warning',trans('message.msg_category_input_error'))
            ->withErrors($validation)
            ->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $category = Categories::find($id);
        $user = $this->user;
		return view('admin.orders.category_show',compact('category','user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return $this->showForm('update',$id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validation = Validator::make(Input::all(),$this->UpdateRules);

        if($validation->fails()){

                return redirect()->to('/admin/categories/'. $id .'/edit')
                    ->with('warning',trans('message.msg_category_update_fail'))
                    ->withErrors($validation)
                    ->withInput();
        }

        if($validation->passes()){

            if( $id ){
                $category = Categories::find($id);
            }

            $category->name = Input::get('name');
            $category->description = Input::get('description');

            if($category->save()){

                    return Redirect::intended('admin/categories')
                        ->with('message', sprintf( trans ('message.msg_category_update_success'),$category->name));
            }
            else{
                    return Redirect::intended('admin/categories')
                        ->withErrors(array('errors' => sprintf( trans ('message.msg_category_update_fail'),$category->name)));
            }
        }

        return Redirect::back()
            ->with('warning',trans('message.msg_category_input_error'))
            ->withErrors($validation)
            ->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Sentinel::check()) {
            if($id) {
                $category = Categories::find($id);
                $OrderItemshasCat = OrderItems::where('category_id', $category->id)->count();
                if (!$OrderItemshasCat) {
                    if ($category->delete()) {
                        return Redirect::to('admin/categories')->with('message', sprintf(trans('message.msg_category_delete_success'), $category->name));
                    }
                }
            }
        }
        else{
            return redirect('login');
        }

        return Redirect::to('admin/categories')->withErrors(array('errors' => trans('message.msg_category_delete_fail')));

    }

    /**
     * @param $mode
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    protected function showForm( $mode, $id=null ){

        $user = $this->user;
        if($mode === 'update') {
            if (!$id || !($category = Categories::find($id))) {
                return Redirect::back()->with('message',trans('message.msg_category_notfound'))->withInput();
            }
        }
        else{
            $category = new Categories();
        }

        return view('admin.orders.categories_form', compact('mode', 'user','category'));
    }

}
