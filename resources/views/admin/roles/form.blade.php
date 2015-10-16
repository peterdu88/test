@extends('layouts.plane')
@section('panel_name',trans('default.role'))
@section('page_second_title', trans('default.control_panel'))
@section('dashboard_breadcrumb')
        @parent
        <li class="active">{{ trans('default.roles') }}</li>
@stop

    {{-- Page content --}}
@section('main-content')

    <div class="page-header">
        <h3>{{ trans('default.role') }} </h3>
    </div>
    @include('partials.error_status')
    <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-6">
        <div class="clearfix"><p class="pull-right"><a href="{!! URL::to('admin/roles/create') !!}" class="btn btn-success">{{ trans('default.role_create') }}</a></p></div>
        <div class="box box-success">
            <div class="box-body">
                @if($mode == 'update')
                    {!! Form::model($role,['url' => route('admin.roles.update',['id'=>$role->id]),'class'=>'form-horizontal','method'=>'put']) !!}
                @else

                    {!! Form::model( $role = new \Cartalyst\Sentinel\Roles\EloquentRole(),['url'=> route('admin.roles.store'),'class'=>'form-horizontal']) !!}
                @endif
                <div class="form-group  required {!! $errors->first('name', ' has-error') !!}">
                    {!! Form::label(trans('default.name'),trans('default.name'), ["class"=>"control-label col-md-2",'for' => 'name']) !!}
                    <div class="col-md-10">
                    {!! Form::input('text','name',null, array('class' => 'form-control','id' => 'name','placeholder'=>Lang::get('default.enterrolename'))) !!}
                    <span class="help-block">{!! $errors->first('name', ':message') !!}</span>
                    </div>

                </div>

                <div class="form-group  required {!! $errors->first('slug', ' has-error') !!}">
                    {!! Form::label(trans('default.slug'),trans('default.slug'),['for' => 'slug','class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::text('slug',null,array('class'=>'form-control', 'id'=>"slug", 'placeholder'=> "Enter the role slug.")) !!}
                        <span class="help-block">{!! $errors->first('slug', ':message') !!}</span>
                    </div>

                </div>
                    <div class="form-group  required {!! $errors->first('permissions_list', ' has-error') !!}">
                        {!! Form::label(trans('default.permission'),trans('default.permission'),['for' => 'slug','class' => 'control-label col-md-2'], 'required') !!}
                        <div class="col-md-10">
                            @if(isset($roles->permissions))
                                @foreach($roles->permissions as $permission)

                                @endforeach
                            @endif
                            {!! Form::select('permissions_list[]',array(),null, ['multiple','class'=>'form-control select2withadd', 'id'=>"slug", 'placeholder'=> "Enter the role permissions."])  !!}

                            <span class="help-block">{!! $errors->first('permissions_list[]', ':message') !!}</span>
                        </div>

                    </div>
            </div>
            <div class="box-footer">
                <a class="btn btn-default" href="{!! url('admin/roles')  !!}">{!! Lang::get('default.cancel') !!}</a>
                @if($mode == 'update' )
                    {!! Form::submit(Lang::get('default.update'), array('class'=>'btn btn-primary btn-flat')) !!}
                @else
                {!! Form::submit(Lang::get('default.submit'), array('class'=>'btn btn-primary btn-flat')) !!}
                @endif
            </div>
            {!! Form::close() !!}
            </div>
@stop
