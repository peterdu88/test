@extends('layouts.plane')
@section('panel_name',trans('default.users'))
@section('page_second_title', trans('default.control_panel'))

@section('dashboard_breadcrumb')
    @parent
    <li class="active">{{ trans('default.users') }}</li>
@stop

{{-- Page content --}}
@section('main-content')
    <div class="page-header">
        <h1>{{ trans('default.users') }}</h1>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        @include('partials.error_status')

        <div class="clearfix"><p class="pull-right"><a href="{!! URL::to('admin/users/create') !!}" class="btn btn-success">{{ trans('default.create') }}</a></p></div>
        <div class="box box-success">
            <div class="box-body">
                <div class="responsive">
                @if ($users->count())
                    {{ trans('default.page') }}{!! $users->CurrentPage() !!} of {!! $users->LastPage() !!}

                    <div class="pull-right">
                        {!! $users->render() !!}
                    </div>        <br><br>
                    <table class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <th class="col-sm-4">{!! trans('default.name') !!}</th>
                        <th class="col-sm-4">{!! trans('default.email') !!}</th>
                        <th class="col-sm-2">{!! trans('default.role') !!}</th>
                        <th class="col-sm-2"><span class="pull-right">{!! trans('default.action') !!}</span></th>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>


                                <td>
                                    <a href="{!! url('/admin/users/'.$user->id) !!}">
                                    {!! $user->first_name !!} {!! $user->last_name !!}

                                    @if($user->inRole('administrator'))
                                    <span class="label label-success">{!! 'Admin' !!}</span>
                                    @elseif($user->inRole('manager'))
                                    <span class="label label-success">{!! 'Manager' !!}</span>
                                    @endif
                                    @if(!(isset($user->activations->first()->completed) && $user->activations->first()->completed))
                                        <span class="label label-warning">{!! trans('default.deactivate') !!}</span>
                                    @endif
                                    </a>
                                </td>
                                <td>{!! $user->email !!}</td>
                                <td>
                                    @if(isset($user->roles) && count($user->roles))
                                        @foreach($user->roles as $role )
                                            {!! $role ->name !!}
                                            <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-fire"></i> {!! trans('default.action') !!} <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <!-- View -->
                                            @if(Sentinel::getUser()->hasAccess('admin') && ($user->id != Sentinel::getUser()->id))
                                                <li>
                                                    @if(isset($user->activations->first()->completed) && $user->activations->first()->completed)
                                                        <a href="{!! url('/admin/users/'.$user->id.'/deactivate') !!}"><i class="fa fa-eye"></i> {!! trans('default.deactivate') !!} </a>
                                                    @else
                                                        <a href="{!! url('/admin/users/'.$user->id.'/activate') !!}"><i class="fa fa-eye"></i> {!! trans('default.activate') !!} </a>
                                                    @endif
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{!! url('/admin/users/'.$user->id) !!}"><i class="fa fa-eye"></i> {!! trans('default.view') !!} </a>
                                            </li>
                                            <li>
                                                <a class="" href="{!! url('/admin/users/'.$user->id.'/edit') !!}">
                                                    <i class="fa fa-pencil"></i> {!! trans('default.edit') !!}</a>
                                            </li>

                                            @if(Sentinel::getUser()->hasAccess('admin') && ($user->id != Sentinel::getUser()->id))
                                            <li class="formConfirm" data-form="#frmDelete-{!!$user->id!!}" data-title="{!! trans('default.delete') .trans('default.user') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" >
                                                <a href=""> <i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                                            </li>
                                            {!! Form::open(array(
                                                    'url' => URL::to("admin/users/{$user->id}"),
                                                    'method' => 'delete',
                                                    'style' => 'display:none',
                                                    'id' => 'frmDelete-' . $user->id
                                                ))
                                            !!}
                                                {!! Form::submit('Submit') !!}
                                                {!! Form::close() !!}
                                                @include('partials.modal_dialog')
                                            @endif
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


