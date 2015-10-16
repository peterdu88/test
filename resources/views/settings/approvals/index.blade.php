@extends('layouts.plane')

@section('panel_name',trans('default.approval'))
@section('page_second_title', Lang::get('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li>{!! trans('default.settings') !!}</li>
    <li class="active">{!! trans('default.approval') !!}</li>
@stop

{{-- Page content --}}
@section('main-content')
    <div class="page-header">
        <h1>{!! trans('default.approval') !!}</h1>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="clearfix"><p class="pull-right"><a href="{!! URL::route('admin.settings.approval.create') !!}" class="btn btn-success">{!! trans('default.create') !!}</a></p></div>
        @include('partials.error_status')
        <div class="box box-success">
            <div class="box-body">
                <div class="responsive">
                    @if ($approvals->count())
                        Page {!! $approvals->CurrentPage() !!} of {!! $approvals->LastPage() !!}
                        <div class="pull-right">
                            {!! $approvals->render() !!}
                        </div>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead>
                            <th class="col-lg-6">{!! trans('default.name') !!}</th>
                            <th class="col-lg-4">{!! trans('default.status') !!}</th>
                            <th class="col-lg-2">{!! trans('default.action') !!}</th>
                            </thead>
                            <tbody>
                            @foreach ($approvals as $approval)
                                <tr>
                                    <td>{!! $approval->name !!}</td>

                                    <td>{!! $approval->status ? trans('default.activated') : trans('default.deactivated') !!}</td>
                                    <td>

                                        <a class="btn btn-warning" href="{!! URL::route('admin.settings.approval.edit',[$approval->id]) !!}">{!! trans('default.edit') !!}</a>
                                            <a class="btn btn-danger" href="">{!! trans('default.delete') !!}</a>

                                        {!! Form::open(array(
                                                'url' => route('admin.settings.approval.destroy',array($approval->id)),
                                                'method' => 'delete',
                                                'style' => 'display:none',
                                                'id' => 'frmDelete-' . $approval->id
                                            ))
                                        !!}
                                        {!! Form::submit('Submit') !!}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! trans('default.page') !!} {!! $approvals->CurrentPage() !!} of {!! $approvals->LastPage() !!}

                        <div class="pull-right">
                            {!! $approvals->render() !!}
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
