@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        {!! Lang::get('default.login_wrong_alert') !!}
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif