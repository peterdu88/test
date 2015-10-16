@extends('layouts.plane')

@section('panel_name',trans('default.payment'))
@section('page_second_title', Lang::get('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li>{{ trans('default.settings') }}</li>
    <li class="active">{{ trans('default.payment') }}</li>
@stop


{{-- Page content --}}
@section('main-content')
    <div class="page-header">
        <h1>{{ trans('default.payment') }}</h1>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="clearfix"><p class="pull-right"><a href="{!! URL::route('admin.settings.payment.create') !!}" class="btn btn-success">{{ Lang::get('default.create') }}</a></p></div>
        <div class="box box-success">
            <div class="box-body">
                <div class="responsive">
                    @if ($payments->count())
                        Page {!! $payments->CurrentPage() !!} of {!! $payments->LastPage() !!}
                        <div class="pull-right">
                            {!! $payments->render() !!}
                        </div>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead>
                                <th class="col-lg-2">{{ trans('default.name') }}</th>
                                <th class="col-lg-4">{{ trans('default.description') }}</th>
                                <th class="col-lg-3">{{ trans('default.status') }}</th>
                                <th class="col-lg-3">{{ trans('default.action') }}</th>
                            </thead>
                            <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{!! $payment->name !!}</td>
                                    <td>{!! $payment->description !!}</td>
                                    <td>{!! $payment->status ? trans('default.activated') : trans('default.deactivated') !!}</td>
                                    <td>

                                        <a class="btn btn-warning" href="{!! URL::route('admin.settings.payment.edit',[$payment->id]) !!}"><i class='fa fa-edit'></i>{{ trans('default.edit') }}</a>

                                        <span class="formConfirm" data-form="#frmDelete-{!! $payment->id !!}" data-title="{!! trans('default.delete') .trans('default.payment') !!}" data-message="{!! trans('default.deleted_confirmation') !!}">
                                            <a class="btn btn-danger" href="#"><i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                                        </span>
                                        {!! Form::open(array(
                                                'url' => route('admin.settings.payment.destroy',array($payment->id)),
                                                'method' => 'delete',
                                                'style' => 'display:none',
                                                'id' => 'frmDelete-' . $payment->id
                                            ))
                                        !!}
                                        {!! Form::submit('Submit') !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ trans('default.page') }} {!! $payments->CurrentPage() !!} of {!! $payments->LastPage() !!}

                        <div class="pull-right">
                            {!! $payments->render() !!}
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
