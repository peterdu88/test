@extends('auth.auth')

@section('htmlheader_title')
    {!! Lang::get('default.password_reset') !!}
@endsection
@section('class','login')
@section('main-content')

            <p class="login-box-msg">{!! Lang::get('default.password_reset') !!}</p>
            {!! Form::open( ['url' => url('/password/reset')]) !!}
                <div class="form-group has-feedback">
                    {!! Form::input('email','email',old('email'),array('placeholder' => 'Email','class' => 'form-control')) !!}
                    <span class="fa fa-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    {!! Form::input('password','password','',array('class'=>'form-control','placeholder' => 'Password')) !!}
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    {!! Form::input('password','password_confirmation','',array('class'=>'form-control','placeholder'=> 'Password')) !!}
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                    <div class="col-xs-8">
                        {!! Form::submit(Lang::get('default.password_reset'),array('class'=>'btn btn-primary btn-block btn-flat')) !!}
                    </div><!-- /.col -->
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                </div>
            {!! Form::close() !!}

            <p><br><br><a href="{!! url('/login') !!}">Log in</a><br></p>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
