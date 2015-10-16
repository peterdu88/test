
<div class="box-body">
    <div class="form-group required {!! $errors->first('name', ' has-error') !!}">
        {!! Form::label(trans('default.name'),trans('default.name'),array('for' => 'name','class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::input('text','name',null, array('class' => 'form-control','id' => 'name','placeholder'=>trans('default.name'))) !!}
            <span class="help-block">{!! $errors->first('name', ':message') !!}</span>
        </div>

    </div>
    <div class="form-group {!! $errors->first('description', ' has-error') !!}">
        {!! Form::label(trans('default.description'),trans('default.description'),array('for' => 'description','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::textarea('description',null,array('class'=>'form-control', 'id'=>"description", 'placeholder'=> "Enter the payment description.")) !!}
            <span class="help-block">{!! $errors->first('description', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group  required {!! $errors->first('status', ' has-error') !!}">
        {!! Form::label(trans('default.status'),trans('default.status'),array('for' => 'slug','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::select('status',array_flip(Config::get('fzbconfig.status')),null,['class' => 'form-control']) !!}
            <span class="help-block">{!! $errors->first('status', ':message') !!}</span>
        </div>
    </div>
</div>

<div class="box-footer text-center">
    <a class="btn btn-default" href="{!! url('admin/settings/payment')  !!}">{!! trans('default.cancel') !!}</a>
    {!! Form::submit($submitButtonText, array('class'=>'btn btn-primary btn-flat')) !!}
</div>