@extends('auth.auth')

@section('htmlheader_title')
    {{ Lang::get('default.password_reset') }}
@endsection
@section('class','login')
@section('main-content')
            <h3 class="login-box-msg">{{ Lang::get('default.password_reset') }}</h3>
            {!! Form::open(array('url'=> url('reset_password'))) !!}
                <div class="form-group has-feedback">
                    {!! Form::input('email','email',old('email'),array('class'=>'form-control','placeholder'=>'Email')) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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

            <a href="{{ url('/login') }}">{{ Lang::get('default.login') }}</a><br>

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
