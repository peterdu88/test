<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('page_main_title','Dashboard')
        <small>@yield('page_second_title','Control Panel')</small>
    </h1>
    <ol class="breadcrumb">
        @section('dashboard_breadcrumb')
            <li><a href="#"><i class="fa fa@yield('panel_name','dashboard')"></i> Home</a></li>
        @show
    </ol>
</section>