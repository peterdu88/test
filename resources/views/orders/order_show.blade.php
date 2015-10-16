<?php
/**
 * Created by PhpStorm.
 * Project: FZBInternalOrderRequest
 * User: FZB
 * Author: Peter Du<'peter.du@fzbtechnology.com'>
 * Version: v1.0
 * Date: 10/5/2015
 * Time: 4:28 PM
 * Update: 
 *      initial -- 10/5/2015 4:28 PM
 *          create struct
 */

@extends('layouts.plane')
@section('page_main_title', Lang::get('orders.order'))
@section('panel_name',Lang::get('orders.order'))
@section('page_second_title', Lang::get('default.control_panel'))

    {{-- Page content --}}
@section('main-content')

    <div class="page-header">
        <h1>{{ trans('default.orders') }} <span class="pull-right"><a href="{!! URL::to('admin/orders/create') !!}" class="btn btn-warning">{{ trans('default.create')." ".trans('default.order') }}</a></span></h1>
    </div>
    <div class="box box-info">
        <div class="box-header">

        </div>
        <div class="box-body">

        </div>
        <div class="foot"></div>
    </div>