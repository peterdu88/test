<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Routing\Controller;
use Request;
use Sentinel;
use Input;
use Validator;
use Redirect;
use App\Models\Categories;
use App\Models\Approvals;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Comments;
use App\Models\Vendors;
use App\Models\SpecialInstruction;
use App\Models\User;
use App\Http\Controllers\AuthorizedController;
use DB;

class OrdersController extends AuthorizedController {

    /**
     * loading the current user information, check the user permission and
     */

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $orders = Orders::paginate(\Config::get('fzbconfig.order_paginate'));
        return view('admin.orders.order_index',array('user' => Sentinel::getUser(),'orders' => $orders));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//build up create order form.
        return view('admin.orders.order_create', [
            'order' => new Orders(),
            'allCategories' => Categories::lists('name','id'),
            'allVendors' => Vendors::lists('name','id'),
            'approvalPermissionUsers' => $this->getApprovalPermmissionUsers()
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $createanotherone = Input::only(['createanother']);
        //2. validate order fields
        $orderInput = Input::only(['specialinstruction','approval']);
        $orderValidator = Validator::make($orderInput, $this->rules());

        $errors = [];
        if ($orderValidator->fails()) // $orderItemsValidator->fails())
        {
            $errors[] = $orderValidator->errors();
        }

        //order Items
        $orderitemRules = $this->orderitemrules();
        $orderItems = Input::get('orderitems');

        //1. validate order items information
        foreach($orderItems as $item) {
            $item['estimatedprice'] =(preg_replace("/[^0-9\.]/", "",$item['estimatedprice']));
            $item['estimatedtotal'] = (preg_replace("/[^0-9\.]/", "",$item['estimatedtotal']));
            $item['finalprice'] = (preg_replace("/[^0-9\.]/", "",$item['finalprice']));
            $item['finaltotal'] = (preg_replace("/[^0-9\.]/", "",$item['finaltotal']));

            $orderItemValidator = Validator::make($item, $orderitemRules);
            if ($orderItemValidator->fails()) {
                $errors[] = $orderItemValidator->errors();
            }
        }

        if(count($errors)){
            dd($errors);
            return Redirect::back()
                ->withInput()
                ->withErrors($errors);
        }


        //save order
        $newOrder = new Orders();
        $newOrder->user_id = $this->user->id;
        $newOrder->specialinstruction = $orderInput['specialinstruction'];
        $newOrder->status   = 1;
        $newOrder->save();

        $error = 0;


        // save order items
        foreach($orderItems as $item){

            $orderItemObj = new OrderItems([
                'category_id' => $item['category'],
                'vendor_id'  =>$item['vendor'],
                'order_id'  => $newOrder->id,
                'name' => $item['name'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'estimatedprice' => preg_replace("/[^0-9\.]/", "",$item['estimatedprice']),
                'estimatedtotal' => preg_replace("/[^0-9\.]/", "",$item['estimatedtotal']),
                'fixedprice' => preg_replace("/[^0-9\.]/", "",$item['finalprice']),
                'fixedtotal' => preg_replace("/[^0-9\.]/", "",$item['finaltotal']),
                'status'     => 1
            ]);


            if(! $newOrder->orderitems()->save($orderItemObj)){
                $error ++;
            }

            $approval = Approvals::find(5);

            dd($approval->orderItems()->attach($orderItemObj->id));

            if($orderItemObj->approval()->create([
                    'orderitem_id' => $orderItemObj->id,
                    'approval_id'  => 5, //new
                    'approval_user_id' => Input::get('approval')
                    ])
                ->save()){
                $error ++;
            }
            //save the approval
        }

        if($error){
            //remove the order
            $newOrder->orderItems()->delete();
            $newOrder->delete();

            return Redirect::to('admin/orders')->withErrors(trans('message.msg_order_create_fail'));
        }

        if($createanotherone)
            return Redirect::to('admin/orders/create')->withSuccess(trans('message.msg_order_create_success'));


        return Redirect::to('admin/orders')->withSuccess(trans('message.msg_order_create_success'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $order = Orders::find($id);
        return view('admin.orders.order_show',compact('order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order = Orders::find($id);

        return view('admin.orders.order_edit',[
            'order' => $order,
            'allCategories' => Categories::lists('name','id'),
            'allVendors' => Vendors::lists('name','id'),
            'approvalPermissionUsers' => User::findAllWithAccess(['admin,approval.*'])
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $order = Orders::find($id);

        //specialinstruction
        SpecialInstruction::find($order->specialInstruction_id)->delete();
        // delete items item payment, shipping, approval, user_order
        if(isset($order->OrderItems) && count($order->OrderItems)){
            foreach($order->OrderItems as $item){
                $item->delete();
            }
        }

        if ($order->delete()) {
            return \Redirect::to('admin/orders')->with('success', trans('message.msg_delete_success'));
        }
        return \Redirect::back()->withErrors(trans('message.msg_delete_fail'));
	}

    /**
     * Description: grasp the users has approval permissions
     * @return array
     */
    public function getApprovalPermmissionUsers()
    {
        return User::with('roles')->get()->filter(function ($user) {
            return $user->hasAccess('approval.*');
        })->lists('userfullname', 'id');
    }

    /**
     * retriew Validator rules for the order form.
     * @param string $id
     * @return array
     */
    public function rules($id = '')
    {
        $method = \Request::method();

        switch($method){
            case 'GET':
                return [];
            case 'POST':
                return [
                    'specialinstruction' => 'string',
                    'approval'           => 'required|integer',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'specialinstruction' => 'string',
                    'approval'           => 'required|integer',
                ];
            case 'DELETE':
            default:
                break;
        }
    }

    public function orderitemrules(){
        $method = \Request::method();

        switch($method){
            case 'GET':
                return [];
            case 'POST':
            case 'PUT':
            case 'PATCH':
                return [
                    'category'          => 'required|integer',
                    'vendor'            => 'required|integer',
                    'name'              => 'required|string',
                    'description'       => 'string',
                    'quantity'          => 'required|integer',
                    'estimatedprice'    => 'required|numeric',
                    'estimatedtotal'    => 'required|numeric',
                    'finalprice'        => 'numeric',
                    'finaltotal'        => 'numeric',
                    'url'               => 'active_url'
                ];
            case 'DELETE':
            default:
                break;
        }
    }

    public function sendemail($order_id){
        $orderData = Orders::find($order_id);

        Mail::queue('emails.welcome', $orderData, function($message)
        {
            $message->to('foo@example.com', 'John Smith')->subject('Welcome!');
        });
    }
}
