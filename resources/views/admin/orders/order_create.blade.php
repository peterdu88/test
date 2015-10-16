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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('partials.error_status')
            <div class="box box-info">
                {!! Form::model($order, array('url' => route('admin.orders.store'),'id'=> 'create_order_form','role'=>"form", 'autocomplete' => 'off')) !!}
                    @include('admin.orders.order_form')
                <div class="box-footer">
                    <div class="form-group text-center">
                        <div class="col-sm-12">
                            {!! link_to('admin/orders',trans('default.cancel'),array('class' => 'btn btn-default')) !!}
                            {!! Form::submit(trans('default.submit'),array('class' => 'btn btn-primary')) !!}

                            {!! Form::button(trans('default.submitandcreateanother'),array('class' => 'btn btn-success','id' => 'submitandcreateanother')) !!}
                            {!! Form::hidden('createanother',0, array('type' => 'checkbox')) !!}
                    	</div>
                    </div>
                </div>
                {!! Form::close() !!}
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        $('#submitandcreateanother').click(function(e){
                            e.preventDefault();
                            $("input[name='createanother']").val(1);
                            $('form#create_order_form').submit();

                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection