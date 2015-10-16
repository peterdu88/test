@extends('layouts.plane')
@section('panel_name',trans('default.order_edit'))
@section('page_second_title', Lang::get('default.control_panel'))

@section('dashboard_breadcrumb')
    @parent
    <li class="">{{ trans('default.order') }}</li>
    <li class="active">{{ trans('default.order_edit') }}</li>
@stop

@section('main-content')

    <div class="page-header">
        <h1>{{ trans('default.order_edit') }}</h1>
    </div>
    <div class="page-body">
        <div class="col-sm-offset-1 col-md-offset-1 col-slg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-8">
            @include('partials.error_status')
            {!! Form::model($order, array('role'=>"form", 'autocomplete' => 'off')) !!}
            @include('admin.orders.order_form')
            {!! Form::submit(trans('default.update'),array('class' => 'btn btn-sm btn-primary')) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection