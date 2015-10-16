@extends('layouts.plane')
@section('page_main_title', $mode == 'show' ? 'View User' : 'Update User')
@section('panel_name','User')
@section('page_second_title', Lang::get('default.control_panel'))

@section('main-content')
    <div class="col-sm-offset-2 col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="panel panel-default">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">{!! $mode === 'show' ? $user->first_name ." " . $user->last_name : $user->email !!}</h2>
            </div>
            <div class="panel-body">
                    <h2>{!! trans('users/user.profile') !!}</h2>

                    <div class="row">
                        <label class="col-md-2" for="first_name">{!! trans('users/user.first_name') !!}:</label>
                        <div class="col-md-10">{!! $user->first_name !!}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2" for="last_name">{!! trans('users/user.last_name') !!}:</label>
                        <div class="col-md-10">{!! $user->last_name !!}</div>
                    </div>
                    <div class="row">
                        <label class="col-md-2" for="email">{!! trans('users/user.email') !!}:</label>
                        <div class="col-md-10">{!! $user->email !!}</div>
                    </div>
                    <br>
                    <h3>{!! trans('default.role') !!}</h3>
                    <div class="row">
                        <label class="col-md-2" for="email">{!! trans('default.role') !!}:</label>
                        <div class="col-md-10">
                            @if(isset($user->roles) && count($user->roles))
                                @foreach($user->roles as $role )
                                    {!! $role ->slug !!}
                                    <br>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a href=" {!! url('account/profile/'.$user->id .'/edit' ) !!}" class = 'btn btn-primary'> <i class="fa fa-pencil"> </i> {!! trans('users/user.edit') !!}</a>
            </div>
        </div>
    </div>
@stop
