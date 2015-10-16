<?php namespace App\Http\Controllers\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Webpatser\Countries\Countries;
use Request;
use Input;
use Redirect;
use Validator;
use App\Models\Vendors;

class VendorController extends Controller {

    protected $table = 'vendors';
    protected $fillable = ['name','contact','email','phone','fax','address','city','state','country','zipcode'];

    protected $user;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct(){
        $this->user = \Sentinel::getUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('settings.Vendors.index',[
                    'user' => $this->user,
                    'vendors' => Vendors::with('countries')->paginate(\Config::get('fzbconfig.paginate'))
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.Vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = \Input::all();
        $validator = \Validator::make($input,$this->rules());

        if($validator->fails()){
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendor = new Vendors();
        $vendor->fill($input)->save();

        return \Redirect::to('admin/settings/vendor')
            ->withSuccess(printf(trans('message.msg_update_success'),$vendor->name,''));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $vendor = Vendors::find($id);
        return view('settings.Vendors.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = \Input::all();

        $validator = \Validator::make($input,$this->rules($id));

        if($validator->fails()){
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendor = Vendors::find($id);
        $vendor->update($input);

        return \Redirect::to('admin/settings/vendor')
            ->withSuccess(sprintf(trans('message.msg_update_success'),$vendor->name,''));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $vendor = Vendors::find($id);

        if($vendor) {
            if ($vendor->delete()) {
                return \Redirect::to('admin/settings/vendor')
                    ->withSuccess(printf(trans('message.msg_delete_success'),$vendor->name,''));
            }
        }
    }

    public function rules($id=''){

        switch(Request::method() ){
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return
                    $rules = [
                        'name' => 'required|unique:Vendors',
                    ];
            case 'PUT':
            case 'PATCH':
                $vendor = Vendors::find($id);
                return
                    $rules = [
                        'name' => 'required|unique:Vendors,id,'. $vendor->id,
                    ];
            default:
                break;
        }
    }
}
