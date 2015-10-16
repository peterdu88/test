@extends('layouts.plane')

@section('panel_name',trans('default.roles'))
@section('page_second_title', Lang::get('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li class="active">{{ trans('default.role') }}</li>
@stop


{{-- Page content --}}
@section('main-content')
    <div class="page-header">
        <h1>{{ trans('default.role') }}</h1>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-lg-offset-1">
        @include('partials.error_status')
        <div class="clearfix"><p class="pull-right"><a href="{!! URL::to('admin/roles/create') !!}" class="btn btn-success">{{ Lang::get('default.create') }}</a></p></div>
    <div class="box box-success">
        <div class="box-body">
            <div class="responsive">

            @if ($roles->count())
                    {{ printf( trans('default.pageof'), $roles->CurrentPage(), $roles->LastPage()) }}
                <div class="pull-right">
                    {!! $roles->render() !!}
                </div>

                <br><br>

                    <table class="table table-bordered table-condensed table-hover table-striped">
                    <thead>
                    <th class="col-lg-6">Name</th>
                    <th class="col-lg-4">Slug</th>
                    <th class="col-lg-2"><span class="pull-right">Actions</span></th>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{!! $role->name !!}</td>
                            <td>{!! $role->slug !!}</td>
                            <td>


                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-fire"></i> {!! trans('default.action') !!} <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <!-- View -->
                                        <li>
                                            <a class="" href="{!! url('/admin/roles/'.$role->id.'/edit') !!}">
                                                <i class="fa fa-pencil"></i> {!! trans('default.edit') !!}</a>
                                        </li>
                                        @if(Sentinel::getUser()->inRole($adminRoles))
                                            <li class="formConfirm" data-form="#frmDelete-{!!$role->id!!}" data-title="{!! trans('default.delete') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" >
                                                <a href=""> <i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                                            </li>
                                        {!! Form::open([
                                                'url' => route('admin.roles.destroy',['id' => $role->id]),
                                                'method' => 'delete',
                                                'style' => 'display:none',
                                                'id' => 'frmDelete-' . $role->id
                                            ])
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

                {{ printf( trans('default.pageof'), $roles->CurrentPage(), $roles->LastPage()) }}

                <div class="pull-right">
                    {!! $roles->render() !!}
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
