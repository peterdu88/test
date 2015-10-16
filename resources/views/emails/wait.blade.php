@extends('auth.auth')

@section('htmlheader_title')
    {!! Lang::get('default.wait') !!}
@endsection
@section('class','login')
@section('main-content')
    <div class="">

        <div class="page-header">
            <h1>{{ Lang::get('default.wait') }}</h1>
        </div>

        <p>
        {{ Lang::get('default.wait_page_message') }}
        </p>

    </div>

@stop