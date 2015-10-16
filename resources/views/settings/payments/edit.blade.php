@extends('layouts.plane')
@section('page_second_title', trans('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li class="">{{ trans('default.settings') }}</li>
    <li class="active">{{ trans('default.payment') }}</li>
    <li class="active">{{ trans('default.payment_update') }}</li>
@stop

{{-- Page content --}}
@section('main-content')

    <div class="page-header">
        <h3>{{ trans('default.payment') }}</h3>
    </div>
    <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-6">
        <div class="clearfix"><p class="pull-right"><a href="{!! route('admin.settings.payment.create') !!}" class="btn btn-success">{{ trans('default.payment_create') }}</a></p></div>
        <div class="box box-success">
            <div><h3 class="box-header">Edit payment Information</h3></div>
            {!! Form::model($payment, ['class'=>'form-horizontal','method' => 'put','action' => ['Settings\PaymentController@update', $payment->id]]) !!}
            @include('settings.payments.form',['submitButtonText' => trans('default.update')])
            {!! Form::close() !!}
        </div>
    </div>
@stop

