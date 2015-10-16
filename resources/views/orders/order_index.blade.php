@extends('layouts.plane')
@section('panel_name',Lang::get('orders.order'))
@section('page_second_title', Lang::get('default.control_panel'))

@section('dashboard_breadcrumb')
    @parent
    <li class="">{{ trans('default.orders') }}</li>
@stop

    {{-- Page content --}}
@section('main-content')

    <div class="page-header">
        <h1>{{ trans('default.orders') }} <span class="pull-right"><a href="{!! URL::to('admin/orders/create') !!}" class="btn btn-success">{{ trans('default.create')." ".trans('default.order') }}</a></span></h1>
    </div>
    <div class="page-body">
        @include('partials.error_status')
        <div class="box box-info">
            <div class="box-head"></div>
            <div class="box-body">
                <div class="responsive">
                    @if ($orders->count())
                        {{ trans('default.page') }} {!! $orders->CurrentPage() !!} of {!! $orders->LastPage() !!}
                        <div class="pull-right">
                            {!! $orders->render() !!}
                        </div>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead>
                            <th class="col-lg-6">{{ trans('default.order') }}</th>
                            <th class="col-lg-4">{{ trans('default.applicant') }}</th>
                            <th class="col-lg-2">{{ trans('default.time_create') }}</th>
                            <th class="col-lg-2">{{ trans('default.time_update') }}</th>
                            <th class="col-lg-2">{{ trans('default.approvalby') }}</th>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}
                                        @if($order->status == APPROVAL )
                                            <span class="label label-success">{{ trans('default.approved') }}</span>
                                        @elseif($order->status == WAITING)
                                            <span class="label label-primary">{{ trans('default.waiting') }}</span>
                                        @elseif($order->status == DECLINED)
                                            <span class="label label-danger">{{ trans('default.denied') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->user->name }}</td>
                                    <td> {{ $order->create_at }}</td>
                                    <td> {{ $order->update_at }}</td>
                                    <td> {{ $order->approval->user->name }}</td>
                                    <td>
                                    <td class="text-center">
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-fire"></i> {{ trans('default.action') }} <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <!-- View -->
                                                <li>
                                                    <a href="{!! url('/admin/orders/'.$order->id) !!}"><i class="fa fa-eye"></i> {!! trans('default.view') !!} </a>
                                                </li>
                                                <li>
                                                    <a class="" href="{!! url('/admin/orders/'.$order->id.'/edit') !!}">
                                                        <i class="fa fa-pencil"></i> {!! trans('default.edit') !!}</a>
                                                </li>


                                                <li class="formConfirm" data-form="#frmDelete-{!!$order->id!!}" data-title="{!! trans('default.delete') .trans('default.order') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" >
                                                    <a href=""> <i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                                                </li>
                                                {!! Form::open(array(
                                                        'url' => URL::to("admin/orders/{$order->id}/delete"),
                                                        'method' => 'delete',
                                                        'style' => 'display:none',
                                                        'id' => 'frmDelete-' . $order->id
                                                    ))
                                                !!}
                                                {!! Form::submit('Submit') !!}
                                                {!! Form::close() !!}
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ trans('default.page') }} {!! $orders->CurrentPage() !!} of {!! $orders->LastPage() !!}

                        <div class="pull-right">
                            {!! $orders->render() !!}
                        </div>

                        @include('partials.modal_dialog')
                    @else
                        <div class="well">

                            Nothing to show here.

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop