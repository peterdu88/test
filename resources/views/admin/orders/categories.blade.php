@extends('layouts.plane')
@section('panel_name',trans('default.categories'))
@section('page_second_title', trans('default.control_panel'))
@section('dashboard_breadcrumb')
    @parent
    <li class="active">{{ trans('default.categories') }}</li>
@stop

    {{-- Page content --}}
@section('main-content')

    <div class="page-header">
        {{ trans('default.category') }}
    </div>
    @include('partials.error_status')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="clearfix"> <p class="pull-right"><a href="{!! URL::to('admin/categories/create') !!}" class="btn btn-warning">{{ trans('default.create') }}</a></p></div>
        <div class="box box-info">
            <div class="box_header"></div>
            <div class="box-body">
                <div class="responsive">
                    @if ($categories->count())
                        {{ trans('default.page') }} {!! $categories->CurrentPage() !!} of {!! $categories->LastPage() !!}

                        <div class="pull-right">
                            {!! $categories->render() !!}
                        </div>        <br><br>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead>
                            <th class="col-lg-1 text-center">{{ trans('default.id') }}</th>
                            <th class="col-lg-4 text-center">{{ trans('default.category') }}</th>
                            <th class="col-lg-5 text-center">{{ trans('default.description') }}</th>
                            <th class="col-lg-2 text-center">{!! trans('default.action') !!}</th>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">{!! $category->id !!}</td>
                                    <td  class="text-center">{!! $category->name !!}</td>
                                    <td  class="text-center">{{ substr($category->description,0,100) }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-fire"></i> {!! trans('default.action') !!} <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">

                                                <li>
                                                    <a href="{!! url('/admin/categories/'.$category->id) !!}"><i class="fa fa-eye"></i> {!! trans('default.view') !!} </a>
                                                </li>
                                                <li>
                                                    <a class="" href="{!! url('/admin/categories/'.$category->id.'/edit') !!}">
                                                        <i class="fa fa-pencil"></i> {!! trans('default.edit') !!}</a>
                                                </li>

                                                @if(!$user->inRole('admin'))
                                                    <li class="formConfirm" data-form="#frmDelete-{!! $category->id !!}" data-title="{!! trans('default.delete') .trans('default.category') !!}" data-message="{!! trans('default.deleted_confirmation') !!}" >
                                                        <a href=""> <i class='fa fa-trash-o'></i> {!! trans('default.delete') !!}</a>
                                                    </li>
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
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        Page {!! $categories->CurrentPage() !!} of {!! $categories->LastPage() !!}

                        <div class="pull-right">
                            {!! $categories->render() !!}
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


