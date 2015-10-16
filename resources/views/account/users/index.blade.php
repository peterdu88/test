@extends('layouts.plane')
@section('panel_name',trans('default.users'))
@section('page_second_title', trans('default.control_panel'))

@section('dashboard_breadcrumb')
    @parent
    <li class="active">{{ trans('default.categories') }}</li>
@stop
{{-- Page content --}}
@section('main-content')

    <div class="page-header">
        <h1>Users <span class="pull-right"><a href="{!! URL::to('admin/users/create') !!}" class="btn btn-warning">Create</a></span></h1>
    </div>
    @include('partials.error_status')
    <div class="responsive">

    @if ($users->count())
        Page {!! $users->CurrentPage() !!} of {!! $users->LastPage() !!}

        <div class="pull-right">
            {!! $users->render() !!}
        </div>        <br><br>
        <table class="table table-bordered table-condensed table-hover table-striped">
            <thead>
            <th class="col-lg-6">{!! trans('default.name') !!}</th>
            <th class="col-lg-4">{!! trans('default.email') !!}</th>
            <th class="col-lg-2">{!! trans('default.action') !!}</th>
            <th class="col-lg-2">{!! trans('default.role') !!}</th>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{!! $user->first_name !!} {!! $user->last_name !!}
                    @if($user->inRole('adminRoles'))
                    <span class="label label-success">{{ 'Admin' }}</span>
                    @elseif($user->inRole('managerRoles'))
                    <span class="label label-success">{{ 'Manager' }}</span>
                    @endif
                    </td>
                    <td>{!! $user->email !!}</td>
                    <td>{!! $user->email !!}</td>
                    <td>
                    <td class="text-center">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-fire"></i> {!! trans('default.action') !!} <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                                <!-- View -->
                                <li>
                                    <a href="{!! url('/admin/users/'.$user->id) !!}"><i class="fa fa-eye"></i> {!! trans('default.view') !!} </a>
                                </li>
                                <li>
                                    <a class="" href="{!! url('/admin/users/'.$user->id.'/edit') !!}">
                                        <i class="fa fa-pencil"></i> {!! trans('default.edit') !!}</a>
                                </li>

                                <li class="formConfirm" data-form="#frmDelete-{!!$user->id!!}" data-title="{!! trans('default.delete') .trans('default.user') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" >
                                    <a href=""> <i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                                </li>
                                {!! Form::open(array(
                                        'url' => URL::to("admin/users/{$user->id}/delete"),
                                        'method' => 'delete',
                                        'style' => 'display:none',
                                        'id' => 'frmDelete-' . $user->id
                                    ))
                                !!}

                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        Page {!! $users->CurrentPage() !!} of {!! $users->LastPage() !!}

        <div class="pull-right">
            {!! $users->render() !!}
        </div>

        @include('partials.modal_dialog')
    @else
        <div class="well">

            Nothing to show here.

        </div>
    @endif
    </div>
@stop
