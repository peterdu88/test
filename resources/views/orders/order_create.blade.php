@extends('layouts.plane')
@section('panel_name',trans('default.order_create'))
@section('page_second_title', Lang::get('default.control_panel'))

@section('dashboard_breadcrumb')
    @parent
    <li class="">{{ trans('default.order') }}</li>
    <li class="active">{{ trans('default.order_create') }}</li>
@stop

@section('main-content')
    <div class="page-header">
        <h1>{{ trans('default.order_create') }}</h1>
    </div>
    <div class="page-body">
        <div class="col-sm-offset-1 col-md-offset-1 col-slg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-8">
            @include('partials.error_status')
            <div class="box box-info">
                {!! Form::model($order = new App\Models\Orders(), array('url' => route('admin.orders.store'),'role'=>"form", 'autocomplete' => 'off')) !!}
                    @include('admin.orders.order_form',['submitButtonText' => trans('default.submit')])
                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection