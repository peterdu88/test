<?php namespace App\Http\Controllers\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;

use App\Models\Payments;
use Sentinel;
use Redirect;
use Input;
use Validator;
use Request;

class PaymentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $allpayments = Payments::paginate(15);
        return view('settings.payments.index', array('user' => \Sentinel::getUser(), 'payments' => $allpayments));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = \Input::all();
        $validator = \Validator::make($input, $this->rules());

        if ($validator->fails()) {
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment = new Payments();
        $payment->fill($input)->save();

        return Redirect::to('admin/settings/payment')
            ->withSuccess(printf(trans('message.msg_update_success'), $payment->name,''));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $mode = 'update';
        $payment = Payments::findOrFail($id);

        return view('settings.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();

        $validator = Validator::make($input, $this->rules($id));

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment = Payments::find($id);

        $payment->fill($input)->save();

        return Redirect::to('admin/settings/payment')
            ->withSuccess(printf(trans('message.msg_update_success'), trans('default.payment'), $payment->name));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $payment = Payments::find($id);

        if ($payment) {
            if ($payment->delete()) {
                return Redirect::to('admin/settings/payment')
                    ->withSuccess(printf(trans('message.msg_delete_success'), $payment->name,''));
            }
        }
    }

    /**
     * Get the validator rules by path
     *
     * @param string $id
     * @return array
     */

    public function rules($id = '')
    {

        switch (Request::method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return
                    $rules = [
                        'name' => 'required|unique:payments',
                        'status' => 'required|boolean'
                    ];
            case 'PUT':
            case 'PATCH':
                $payment = Payments::find($id);
                return
                    $rules = [
                        'name' => 'required|unique:payments,id,' . $payment->id,
                        'status' => 'required|boolean'
                    ];
            default:
                break;
        }
    }

}
