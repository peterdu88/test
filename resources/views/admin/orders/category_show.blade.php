@extends('layouts.plane')
@section('panel_name','Category')
@section('page_second_title', Lang::get('default.control_panel'))

@section('dashboard_breadcrumb')
    @parent
    <li class="active">{{ trans('default.categories') }}</li>
@stop

@section('main-content')
    <div class="page-header">
        {!!  trans('default.category_view') ." <small style='display:inline;'>[". $category->name ."]</small>"  !!}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-info">
            <div class="box-header">
                <h2 class="panel-title">{!! trans('default.category') ." [ ". $category->name ."]" !!}</h2>
            </div>
            <div class="box-body">
                    <table class="table table-bordered table-condensed table-hover table-responsive table-striped">

                        <tbody>
                            <tr>
                                <td>{!! Form::label(trans('default.name'),trans('default.name'),['for'=>"name"]) !!}</td>
                                <td>{!! $category->name !!}</td>
                            </tr>
                            <tr>
                                <td>{!! Form::label(trans('default.description'),trans('default.description'),['for'=>"description"]) !!}                                <td>{!! $category->description !!}</td>

                            </tr>
                        </tbody>
                        <tfoot>
                        <td colspan="2">
                            <div class="row">
                                <p class="col-md-offset-2 col-md-3">
                        <a href=" {!! url('admin/categories/'.$category->id .'/edit' ) !!}" class = 'btn btn-primary'> <i class="fa fa-pencil"></i>{!! trans('default.edit') !!}</a>
                        @if(!$user->inRole('admin'))
                            <a href='#' data-form= "#frmDelete-{!! $category->id !!}" data-title="{!! trans('default.delete') .trans('default.category') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" class="btn btn-danger formConfirm pull-right"><i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                            {!! Form::open(array(
                                    'url' => route('admin.categories.destroy',array($category->id)),
                                    'method' => 'delete',
                                    'style' => 'display:none',
                                    'id' => 'frmDelete-' . $category->id
                                ))
                            !!}
                            {!! Form::submit('Submit') !!}
                            {!! Form::close() !!}
                        @endif
                                </p>
                            </div>
                            </td>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
    @include('partials.modal_dialog')
@stop
