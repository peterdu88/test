@extends('layouts.plane')
@section('page_second_title', trans('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li>{!! trans('default.settings') !!}</li>
    <li>{!! trans('default.vendor') !!}</li>
    <li class="active">{!! trans('default.vendor_update') !!}</li>
@stop

{{-- Page content --}}
@section('main-content')

    <div class="page-header">
        <h3>{!! trans('default.vendor') !!}</h3>
    </div>
    <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-6">
        <div class="clearfix"><p class="pull-right"><a href="{!! route('admin.settings.vendor.create') !!}" class="btn btn-success">{!! trans('default.vendor_create') !!}</a></p></div>
        <div class="box box-success">
            <div><h3 class="box-header">Edit vendor Information</h3></div>
            {!! Form::model($vendor, ['class'=>'form-horizontal','method' => 'PATCH','action' => ['Settings\VendorController@update' , $vendor->id]]) !!}
            @include('settings.vendors.form',['submitButtonText' => trans('default.update')])
            {!! Form::close() !!}
        </div>
    </div>
@stop
