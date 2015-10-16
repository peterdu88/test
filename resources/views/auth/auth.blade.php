<!DOCTYPE html>
<html>
    @include('partials.htmlheader')
    <body class="@yield('class','login')-page">
        <div class="@yield('class','login')-box">
            <div class="@yield('class','login')-logo">
                {!! HTML::image('img/fzblogo150x151.png','',['style'=>'width:60px;height:auto;text-align:ceneter;']) !!}
                <a href="{!! url('/home') !!}">{!! Lang::get('default.admin_panel_title') !!}</a>
            </div><!-- /.login-logo -->
            @include('partials.error_status',array('errors',$errors))
            <div class="@yield('class','login')-box-body">
                <p class="@yield('class','login')-box-msg">@yield('box_message')</p>
                @yield('main-content')
            </div><!-- /.@yield('class','login')-box-body -->
        </div><!-- /.@yield('class','login')-box -->
        @include('partials.footer_auth')
        @yield('pagescripts')
    </body>
</html>
