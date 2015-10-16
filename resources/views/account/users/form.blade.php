@extends('layouts.plane')
@section('page_main_title', $mode == 'create' ? 'Create User' : 'Update User')
@section('panel_name','dashboard')
@section('page_second_title', Lang::get('default.control_panel'))

@section('main-content')
    <div class="page-header">
        <h1>{!! (isset($user->first_name) && isset($user->last_name)) ? $user->first_name ." " . $user->last_name : $user->email !!}</h1>
    </div>
    <div class="col-sm-offset-1 col-md-offset-1 col-slg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-6">
        <div class="panel panel-default">
            {!! Form::open(array('autocomplete' => 'off')) !!}
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="active tab-pane fade in" id="tab1">
                            <h2>{{ trans('default.profile') }}</h2>
                            <br />
                            <div class="form-group{!! $errors->first('first_name', ' has-error') !!}">
                                <label for="first_name">{!! trans('default.first_name') !!}</label>
                                {!! Form::input('text','first_name',Input::old('first_name', $user->first_name) ,array('id'=>'first_name','class'=>'form-control','placeholder'=>'Enter the user first name')) !!}
                                <span class="help-block">{!! $errors->first('first_name', ':message') !!}</span>
                            </div>

                            <div class="form-group{!! $errors->first('last_name', ' has-error') !!}">
                                <label for="last_name">{{ trans('default.last_name')  }}</label>
                                {!! Form::input('text','last_name',Input::old('last_name', $user->last_name) ,array('id'=>'last_name','class'=>'form-control','placeholder'=>'Enter the user last name')) !!}
                                <span class="help-block">{!! $errors->first('last_name', ':message') !!}</span>
                            </div>

                            <div class="form-group{!! $errors->first('email', ' has-error') !!}">
                                <label for="email">{{ trans('default.email')  }}</label>
                                {!! Form::input('email','email',Input::old('email', $user->email) ,array('id'=>'email','class'=>'form-control','placeholder'=>'Enter the user email')) !!}
                                <span class="help-block">{!! $errors->first('email', ':message') !!}</span>
                            </div>
                            <div class="form-group{!! $errors->first('role', ' has-error') !!}">
                                <label for="email">{{ trans('default.role') }}</label>
                                {!! Form::select('role[]',['administrator','manager','member'],['administrator,manager,member'],['multiple'=>'multiple','class'=>'form-control']) !!}
                                <span class="help-block">{!! $errors->first('role', ':message') !!}</span>
                            </div>

                            <h2>{{ trans('default.security') }}</h2>
                            <div class="form-group{!! $errors->first('password', ' has-error') !!}">
                                <label for="password">Password</label>
                                {!! Form::password('password',["class"=>"form-control", "id"=>"password", "placeholder"=>"Enter the user password (only if you want to modify it)."]) !!}
                                <span class="help-block">{!! $errors->first('password', ':message') !!}</span>

                            </div>

                            <div class="form-group{!! $errors->first('password', ' has-error') !!}">
                                <label for="password">Conformation Password</label>
                                {!! Form::password('confirmation_password',["class"=>"form-control", "id"=>"password", "placeholder"=>"reEnter the user password (only if you want to modify it)."]) !!}
                                <span class="help-block">{!! $errors->first('password', ':message') !!}</span>

                            </div>

                    </div>
                    </div>
                </div>
                <div class="panel-footer">
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
