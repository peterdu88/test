@extends('auth.auth')
@section('htmlheader_title', Lang::get('default.login') )
@section('class',"login")
@section('box_message', Lang::get('default.login_box_msg') )
@section('pagescripts')
    <!-- jQuery 2.1.4 -->
    {!! HTML::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
    <!-- Bootstrap 3.3.2 JS -->
    {!! HTML::script('js/bootstrap.min.js') !!}
    <!-- iCheck -->
    {!! HTML::script('plugins/iCheck/icheck.min.js') !!}

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@stop

@section('main-content')
    {!! Form::open(array('url' => url('login') )) !!}
    <div class="form-group has-feedback">
        {!! Form::input('email','email',null,array('class' => 'form-control','placeholder' => 'Email')) !!}
        <span class="fa fa-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        {!! Form::input('password','password',null,array('class'=> 'form-control','placeholder'=>'Password')) !!}
        <span class="fa fa-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox"> {!! Lang::get('default.remmeber_me') !!}
                </label>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
            {!! Form::submit(Lang::get('default.signin'), array('class'=>'btn btn-primary btn-block btn-flat')) !!}
        </div><!-- /.col -->
    </div>
    {!! Form::close() !!}

    <a href="{!! url('/password') !!}">{!! Lang::get('default.forgot_password') !!}</a><br>
@endsection
