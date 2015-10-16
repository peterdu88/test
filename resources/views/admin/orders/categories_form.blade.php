@extends('layouts.dashboard')
@section('panel_name',trans('default.categories'))
@section('page_second_title', trans('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li>{{ trans('default.categories') }}</li>
    <li class="active">{{ ($mode === 'update' ? trans('default.category_update') : trans('default.category_create')) }} </li>
@stop
{{-- Page content --}}
@section('main-content')
    <div class="page-header">
        {!! (isset($category->name) && $mode ==='update' ) ? trans('default.category_update') ." <small style='display:inline;'>[". $category->name ."]</small>" :  trans('default.category_create') !!}
    </div>
    <div class="col-sm-offset-1 col-md-offset-1 col-slg-offset-3 col-xs-10 col-sm-10 col-md-10 col-lg-8">
    @include('partials.error_status')
        <div class="box box-info">
            @if($mode ==='create')
                {!! Form::open(array( 'action' => 'Admin\CategoriesController@store', 'class'=>'form-horizontal','role'=>'form','autocomplete' => 'off')) !!}
            @else
                {!! Form::open(array( 'method'=>'patch', 'action' => array('Admin\CategoriesController@update',$category->id), 'class'=>'form-horizontal','role'=>'form','autocomplete' => 'off')) !!}
            @endif
            <div class="box-body">
                <div class="form-group  required {!! $errors->first('name', ' has-error') !!}">
                    {!! Form::label('name', trans('default.category'),array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::input('text','name',Input::old('name', $category->name) ,array('id'=>'name','class'=>'form-control','placeholder'=>'Enter category name')) !!}
                        <span class="help-block">{!! $errors->first('name', ':message') !!}</span>
                    </div>
                </div>

                <div class="form-group{!! $errors->first('description', ' has-error') !!}">
                    {!! Form::label('description', trans('default.description'),array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">

                    {!! Form::textarea('description',Input::old('description', $category->description) ,array('id'=>'description','class'=>'form-control','placeholder'=>'Enter the description')) !!}
                    <span class="help-block">{!! $errors->first('description', ':message') !!}</span>
                        </div>
                </div>
            </div>
            <div class="box-footer">
                @if($mode == 'update')
                    {!! link_to_action('Admin\CategoriesController@destroy',trans('default.delete'),'',array('class'=>'btn btn-danger btn-sm')) !!}
                @endif
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
