@extends('layouts.plane')
@section('panel_name','dashboard')
@section('page_second_title', Lang::get('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li class="active">{{ trans('default.user') }}</li>
    <li class="active">{{ $mode == 'create' ? trans('default.user_create') : trans('default.user_update') }}</li>
@stop
{{-- Page content --}}
@section('main-content')
    <div class="page-header">
        {!! $mode == 'create' ? trans('default.user_create') : trans('default.user_update') !!}
    </div>

    <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-xs-10 col-sm-10 col-md-10 col-lg-10">
    @include('partials.error_status')
        @if($mode === 'update')
            {!! Form::model($user,['url' => route('admin.users.update',['id' => $user->id]),'autocomplete' => 'off','class'=>'form-horizontal','role'=>'form', 'method' => 'PUT']) !!}
        @else
            {!! Form::model($user = new App\Models\User(), ['url' => route('admin.users.update'),'autocomplete' => 'off','class'=>'form-horizontal','role'=>'form', 'method' => 'POST']) !!}
        @endif
        <div class="box box-success">
            @if($mode == 'update')
            <div class="box-header">
                <h3 class="box-title">
                {!! trans('default.user_update') !!} [{!! ($user->first_name =='' || $user->last_name =='') ? $user->first_name ." " . $user->last_name : $user->email !!}]
                </h3>
            </div>
            @endif


            <div class="box-body">
                <legend>{{ trans('default.user_basicinfo') }}</legend>
                <div class="form-group  required  {!! $errors->first('first_name', ' has-error') !!}">
                    {!! Form::label('first_name', trans('default.first_name'),array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::input('text','first_name',Input::old('first_name', $user->first_name) ,['id'=>'first_name','class'=>'form-control','placeholder'=>'Enter the user first name']) !!}
                        <span class="help-block">{!! $errors->first('first_name', ':message') !!}</span>
                    </div>

                </div>
                <div class="form-group  required  {!! $errors->first('last_name', ' has-error') !!}">
                    {!! Form::label('last_name', trans('default.last_name'),['id'=>'last_name', 'class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::input('text','last_name',Input::old('last_name', $user->last_name) ,['id'=>'last_name','class'=>'form-control','placeholder'=>'Enter the user last name']) !!}
                    <span class="help-block">{!! $errors->first('last_name', ':message') !!}</span>
                    </div>
                </div>
                <div class="form-group  required  {!! $errors->first('email', ' has-error') !!}">
                    {!! Form::label('email', trans('default.email'),array('id'=>'email', 'class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                    {!! Form::input('email','email',Input::old('email', $user->email) ,['id'=>'email','class'=>'form-control','placeholder'=>'Enter the user email']) !!}
                    <span class="help-block">{!! $errors->first('email', ':message') !!}</span>
                    </div>
                </div>
                <div class="form-group  required  {!! $errors->first('role', ' has-error') !!}">
                    {!! Form::label('role_list', trans('default.role'),['id'=>'email', 'class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">

                    {!! Form::select('role_list[]',$role_list,$userRole,['class'=>'select2 form-control','multiple']) !!}
                    <span class="help-block">{!! $errors->first('role', ':message') !!}</span>
                    </div>
                </div>

                <legend>Security</legend>
                <div class="form-group  required  {!! $errors->first('password', ' has-error') !!}">
                    {!! Form::label('password', trans('default.password'),array('id'=>'email', 'class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                    {!! Form::password('password',["class"=>"form-control", "id"=>"password", "placeholder"=>"Enter the user password (only if you want to modify it)."]) !!}
                    <span class="help-block">{!! $errors->first('password', ':message') !!}</span>
                    </div>
                </div>
                <div class="form-group  required  {!! $errors->first('password_confirm', ' has-error') !!}">
                    {!! Form::label('password_confirm', 'Conformation Password',array('id'=>'email', 'class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                    {!! Form::password('password_confirmed',["class"=>"form-control", "id"=>"password_confirmed", "placeholder"=>"Enter the user Comfirmation password."]) !!}
                    <span class="help-block">{!! $errors->first('password_confirm', ':message') !!}</span>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                @if($mode == 'update')
                    @if($user->activations->first()->completed)
                        <a href="{!! url('/admin/users/'.$user->id.'/deactivate') !!}" class="btn btn-md btn-warning pull-right"><i class="fa fa-eye"></i> {!! trans('default.deactivate') !!} </a>
                    @else
                        <a href="{!! url('/admin/users/'.$user->id.'/activate') !!}" class="btn btn-md btn-success pull-right"><i class="fa fa-eye"></i> {!! trans('default.activate') !!} </a>

                    @endif
                @endif
              <button type="submit" class="btn btn-primary col-sm-offset-2"><i class="fa fa-save"> {{ trans('default.submit') }}</i></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

