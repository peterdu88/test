@extends('layouts.plane')

@section('box_name','User')
@section('page_second_title', Lang::get('default.control_box'))
@section('dashboard_breadcrumb')
    @parent
    <li class="active">{{ trans('default.users') }}</li>
    <li class="active">{{ trans('default.user_profile') }}</li>
@stop


@section('main-content')
    <div class="page-header">
        {!!  trans('default.user_profile') !!} <small style='display:inline;'>[{!! ($user->first_name =='' || $user->last_name =='')? $user->email : $user->first_name ." ". $user->last_name !!}]</small>
    </div>
    <div class="col-sm-offset-1 col-md-offset-1 col-slg-offset-1 col-xs-10 col-sm-10 col-md-10 col-lg-10">
        <div class="clearfix"><p class="pull-right"><a href="{!! URL::to('admin/users/create') !!}" class="btn btn-success">{{ Lang::get('default.create') }}</a></p></div>

        <div class="box box-info">
            <div class="box-heading">
                <h2 class="box-title">{!! ($user->first_name =='' || $user->last_name =='')? $user->email : $user->first_name ." ". $user->last_name !!}</h2>
            </div>

            <div class="box-body">
                <legend>{!! trans('default.user_basicinfo') !!}</legend>
                <div class="row">
                        <label class="col-md-2" for="first_name">{!! trans('default.first_name') !!}:</label>
                        <div class="col-md-10">{!! $user->first_name !!}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2" for="last_name">{!! trans('default.last_name') !!}:</label>
                        <div class="col-md-10">{!! $user->last_name !!}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2" for="email">{!! trans('default.email') !!}:</label>
                        <div class="col-md-10">{!! $user->email !!}</div>
                    </div>
                    <br>
                    <legend>{!! trans('default.role') !!}</legend>
                    <div class="row">
                        <label class="col-md-2" for="email">{!! trans('default.role') !!}:</label>
                        <div class="col-md-10">

                            @if($user->roles)

                            <p>
                                @foreach($user->roles as $key => $role )
                                    <span>[{!! $role ->slug !!}] </span>
                                @endforeach
                            </p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <a href=" {!! url('admin/users/'.$user->id .'/edit' ) !!}" class = 'btn btn-primary'> <i class="fa fa-pencil"> </i>{!! trans('default.edit') !!}</a>
            @if(Sentinel::getUser()->hasAccess('admin') && $user->hash != Sentinel::getUser()->hash)
                <a href='#' data-form= "#frmDelete-{!! $user->id !!}" data-title="{!! trans('default.delete') .trans('default.user') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" class="btn btn-danger formConfirm"><i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                {!! Form::open(array(
                        'url' => URL::to("admin/users/{$user->id}/delete"),
                        'method' => 'delete',
                        'style' => 'display:none',
                        'id' => 'frmDelete-' . $user->id
                    ))
                !!}
                {!! Form::submit('Submit') !!}
                {!! Form::close() !!}
            @include('partials.modal_dialog')
            @endif
            </div>
        </div>
    </div>


@stop
