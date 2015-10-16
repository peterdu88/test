
<head>
    <meta charset="UTF-8">
    <title> FZB - @yield('htmlheader_title', 'Internal Order System') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.4 -->
    {!! HTML::style('css/bootstrap.css') !!}
    {!! HTML::style('css/bootstrapValidator.min.css') !!}

    {!! HTML::style('/plugins/iCheck/square/blue.css') !!}
    <!-- iCheck -->
    {!! HTML::style("/plugins/iCheck/flat/blue.css" ) !!}
    <!-- Morris chart -->
    {!! HTML::style("/plugins/morris/morris.css" ) !!}
    <!-- jvectormap -->
    {!! HTML::style("/plugins/jvectormap/jquery-jvectormap-1.2.2.css" ) !!}
    <!-- Date Picker -->
    {!! HTML::style("/plugins/datepicker/datepicker3.css" ) !!}
    <!-- Daterange picker -->
    {!! HTML::style("plugins/daterangepicker/daterangepicker-bs3.css" ) !!}
    <!-- bootstrap wysihtml5 - text editor -->
    {!! HTML::style("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" ) !!}
    {!! HTML::style("css/select2.min.css",["rel" => "stylesheet"] ) !!}

    <!-- Font Awesome Icons -->
    {!! HTML::style('css/font-awesome.min.css') !!}
    <!-- Ionicons -->
   {!! HTML::style('css/ionicons.min.css') !!}

    <!-- Theme style -->
    {!! HTML::style('css/AdminLTE.css') !!}

    {!! HTML::style('css/skins/_all-skins.min.css') !!}

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    {!! HTML::style('/css/skins/skin-blue.css') !!}
    <!-- iCheck -->


    {!! HTML::style("css/fzb.css" ) !!}

    <!-- jQuery 2.1.4 -->
    {!! HTML::script('/plugins/jQuery/jQuery-2.1.4.min.js') !!}

    {!! HTML::script('plugins/jQueryUI/jQuery-ui.min.js') !!}
    <!-- Bootstrap 3.3.2 JS -->
    {!!  HTML::script('/js/bootstrap.min.js') !!}
    {!!  HTML::script('/js/bootstrapValidator.min.js') !!}


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {!! HTML::script('js/IE.min.js') !!}
    <![endif]-->

</head>
