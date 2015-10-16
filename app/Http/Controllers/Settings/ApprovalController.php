<?php namespace App\Http\Controllers\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Approvals;

//use Illuminate\Http\Request;
use Request;
use Redirect;
use Input;

class ApprovalController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $allApproval = Approvals::paginate(15);
        return view('settings.approvals.index',array('user' =>\Sentinel::getUser(),'approvals' => $allApproval));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('settings.approvals.create');
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

        $approval = new Approvals();
        $approval->fill($input)->save();

        return \Redirect::to('admin/settings/approval')
            ->withSuccess(printf(trans('message.msg_update_success'),$approval->name,''));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $mode = 'update';
        $approval = Approvals::findOrFail($id);

        return view('settings.approvals.edit',compact('mode','approval'));
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

        $approval = Approvals::find($id);
        $approval->update($input);

        return \Redirect::to('admin/settings/approval')
                ->withSuccess(sprintf(trans('message.msg_update_success'),$approval->name,''));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$approval = Approvals::find($id);

        if($approval) {
            if ($approval->delete()) {
                return \Redirect::to('admin.settings.approval')
                    ->withSuccess(printf(trans('message.msg_delete_success'),$approval->name,''));
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
                        'name' => 'required|unique:approvals',
                        'status' => 'required|int'
                    ];
            case 'PUT':
            case 'PATCH':
                $approval = Approvals::find($id);
                return
                    $rules = [
                        'name' => 'required|unique:approvals,id,'. $approval->id,
                        'status' => 'required:string'
                    ];
            default:
                break;
        }
    }
}
