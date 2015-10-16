@extends('layouts.plane')
@section('page_second_title', trans('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li class="">{{ trans('default.settings') }}</li>
    <li class="active">{{ trans('default.vendor') }}</li>
    <li class="active">{{ trans('default.vendor_create') }}</li>
@stop

{{-- Page content --}}
@section('main-content')

    <div class="page-header">
        <h3>{{ trans('default.vendor_create') }}</h3>
    </div>
    <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-6">
        <div class="box box-success">
            <div><h3 class="box-header">New vendor Information</h3></div>
            {!! Form::model(new App\Models\vendors(),array( 'action' => 'Settings\VendorController@store', 'class'=>'form-horizontal','role'=>'form','autocomplete' => 'off')) !!}
                @include('settings.vendors.form',['submitButtonText' => trans('default.submit')])
            {!! Form::close() !!}
        </div>
    </div>
@stop
