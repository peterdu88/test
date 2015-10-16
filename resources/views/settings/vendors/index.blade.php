@extends('layouts.plane')

@section('page_second_title', trans('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li>{!! trans('default.settings') !!}</li>
    <li class="active">{!! trans('default.vendor') !!}</li>
@stop

{{-- Page content --}}
@section('main-content')

    <div class="page-header">
        {!! trans('default.vendor') !!}
    </div>
    @include('partials.error_status')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="clearfix"> <p class="pull-right"><a href="{!! URL::to('admin/settings/vendor/create') !!}" class="btn btn-success">{!! trans('default.create') !!}</a></p></div>
        <div class="box box-info">
            <div class="box_header"></div>
            <div class="box-body">
                <div class="responsive">
                    @if ($vendors->count())
                        {!! trans('default.page') !!} {!! $vendors->CurrentPage() !!} of {!! $vendors->LastPage() !!}

                        <div class="pull-right">
                            {!! $vendors->render() !!}
                        </div>        <br><br>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead>
                            <th class="col-sm-1">
                            	<label>{!! Form::checkbox('selectall',null,null,array('id'=> "selectall")) !!} Select All</label>
                                <!-- todo checkall -->
                            </th>
                            <th class="col-sm-2">{!! trans('default.vendor') !!}</th>
                            <th class="col-sm-2">{!! trans('default.contact') !!}</th>
                            <th class="col-sm-1">{!! trans('default.phone') !!}</th>
                            <th class="col-sm-1">{!! trans('default.email') !!}</th>
                            <th class="col-sm-1">{!! trans('default.fax') !!}</th>
                            <th class="col-sm-2 hidden-sm">{!! trans('default.address') !!}</th>

                            <th class="col-sm-1 hidden-sm">{!! trans('default.city') !!}</th>
                            <th class="col-sm-1 hidden-sm">{!! trans('default.state') !!}</th>
                            <th class="col-sm-1  hidden-sm">{!! trans('default.country') !!}</th>
                            <th class="col-sm-1 hidden-sm">{!! trans('default.zipcode') !!}</th>
                            <th class="col-sm-2 text-right">{!! trans('default.action') !!}</th>
                            </thead>
                            <tbody>
                            @foreach ($vendors as $vendor)
                                <tr>
                                    <td>
                                        {!! Form::checkbox('multiplechecked[]',null,null,array('id'=>'multiplechecked')) !!}</td>
                                    <td>{!! $vendor->name !!}</td>
                                    <td>{!! $vendor->contact !!}</td>
                                    <td>{!! $vendor->phone !!}</td>
                                    <td>{!! $vendor->email !!}</td>
                                    <td>{!! $vendor->fax !!}</td>
                                    <td class="hidden-sm">{!! $vendor->address !!}</td>
                                    <td class="hidden-sm">{!! $vendor->city !!}</td>
                                    <td class="hidden-sm">{!! $vendor->state !!}</td>
                                    <td class="hidden-sm">{{ isset($vendor->country_id) ? $vendor->countries->name : '' }}</td>
                                    <td class="hidden-sm">{!! $vendor->zipcode !!}</td>

                                    <td class="text-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-fire"></i> {!! trans('default.action') !!} <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="" href="{!! url('/admin/settings/vendor/'.$vendor->id.'/edit') !!}">
                                                        <i class="fa fa-pencil"></i> {!! trans('default.edit') !!}</a>
                                                </li>

                                                @if(!$user->inRole('admin'))
                                                    <li class="formConfirm" data-form="#frmDelete-{!! $vendor->id !!}" data-title="{!! trans('default.delete') .trans('default.vendor') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" >
                                                        <a href=""> <i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                                                    </li>
                                                    {!! Form::open(array(
                                                            'url' => route('admin.settings.vendor.destroy',array($vendor->id)),
                                                            'method' => 'delete',
                                                            'style' => 'display:none',
                                                            'id' => 'frmDelete-' . $vendor->id
                                                        ))
                                                    !!}
                                                    {!! Form::submit('Submit') !!}
                                                    {!! Form::close() !!}
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        Page {!! $vendors->CurrentPage() !!} of {!! $vendors->LastPage() !!}

                        <div class="pull-right">
                            {!! $vendors->render() !!}
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


