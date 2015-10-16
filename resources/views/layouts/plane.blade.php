<!DOCTYPE html>
<html>
@include('partials.htmlheader')
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
    {{{ $user = '' }}}
    @if(!isset($user) && Sentinel::check() )
        {{{ $user = Sentinel::getUser() }}}
    @endif
    <body class="skin-blue sidebar-mini">
        <div class=" {{ (Sentinel::check() && $user = Sentinel::getUser(true)) ? 'wrapper':'' }}">
            @include('partials.header',['user' => $user])

            @if(Sentinel::check() && $user = Sentinel::getUser(true))
                <!-- Left side column. contains the logo and sidebar -->
                @include('partials.sidebar',['user'=>$user])
            @endif
            <!-- Content Wrapper. Contains page content -->
            <div class="{{ (Sentinel::check() && $user = Sentinel::getUser(true)) ? 'content-wrapper':'' }}">

            @if(Sentinel::check() && $user = Sentinel::getUser(true))
                <!-- Content Header (Page header) -->
                @include('partials.contentheader')
            @endif
                <!-- Main content -->
                <section class="content clearfix">
                    <div class="row">
                        <div class="col-md-12">
                    @yield('main-content')
                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->


            @include('partials.footer')
        </div><!-- ./wrapper -->
    @if(Sentinel::check() && $user = Sentinel::getUser(true))
        @include('partials.controlsidebar')
    @endif
    @include('partials.htmlfooter')
