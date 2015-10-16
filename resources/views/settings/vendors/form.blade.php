
<div class="box-body">
    <div class="form-group required {!! $errors->first('name', ' has-error') !!}">
        {!! Form::label(trans('default.name'),trans('default.name'),array('for' => 'name','class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            {!! Form::input('text','name',null, array('class' => 'form-control','id' => 'name','placeholder'=>trans('default.name'))) !!}
            <span class="help-block">{!! $errors->first('name', ':message') !!}</span>
        </div>

    </div>
    <div class="form-group {!! $errors->first('contact', ' has-error') !!}">
        {!! Form::label(trans('default.contact'),trans('default.contact'),array('for' => 'slug','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::text('contact',null,array('class'=>'form-control', 'id'=>"contact", 'placeholder'=> "Enter the vendor contact.")) !!}
            <span class="help-block">{!! $errors->first('contact', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('phone', ' has-error') !!}">
        {!! Form::label(trans('default.phone'),trans('default.phone'),array('for' => 'slug','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </div>
                {!! Form::text('phone',null,array('class'=>'form-control', 'id'=>"phone", 'placeholder'=> "Enter the vendor phone.",
                'data-inputmask'=>'"mask": "(999) 999-9999"', 'data-mask'=>'')) !!}
            </div><!-- /.input group -->
            <span class="help-block">{!! $errors->first('phone', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('email', ' has-error') !!}">
        {!! Form::label(trans('default.email'),trans('default.email'),array('for' => 'slug','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                </div>
                {!! Form::text('email',null,array('class'=>'form-control', 'id'=>"email", 'placeholder'=> "Enter the vendor email.")) !!}
            </div>
            <span class="help-block">{!! $errors->first('email', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('fax', ' has-error') !!}">
        {!! Form::label(trans('default.fax'),trans('default.fax'),array('for' => 'fax','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </div>
            {!! Form::text('fax',null,array('class'=>'form-control', 'id'=>"fax", 'placeholder'=> "Enter the vendor fax." ,'placeholder'=> "Enter the vendor phone.", 'data-inputmask'=>'"mask": "(999) 999-9999"', 'data-mask'=>'')) !!}
            </div>
            <span class="help-block">{!! $errors->first('fax', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('address', ' has-error') !!}">
        {!! Form::label(trans('default.address'),trans('default.address'),array('for' => 'address','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::text('address',null,array('class'=>'form-control', 'id'=>"address", 'placeholder'=> "Enter the vendor address.")) !!}
            <span class="help-block">{!! $errors->first('address', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('city', ' has-error') !!}">
        {!! Form::label(trans('default.city'),trans('default.city'),array('for' => 'city','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::text('city',null,array('class'=>'form-control', 'id'=>"city", 'placeholder'=> "Enter the vendor city.")) !!}
            <span class="help-block">{!! $errors->first('city', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('state', ' has-error') !!}">
        {!! Form::label(trans('default.state'),trans('default.state'),array('for' => 'state','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::text('state',null,array('class'=>'form-control', 'id'=>"state", 'placeholder'=> "Enter the vendor state.")) !!}
            <span class="help-block">{!! $errors->first('state', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('country', ' has-error') !!}">
        {!! Form::label(trans('default.country'),trans('default.country'),array('for' => 'slug','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::select('country',Countries::lists('name','id'),(isset($vendor->country) ? null :'840'),array('class'=>'select2 form-control', 'id'=>"country", 'placeholder'=> "Enter the vendor country.")) !!}
            <span class="help-block">{!! $errors->first('country', ':message') !!}</span>
        </div>
    </div>
    <div class="form-group {!! $errors->first('zipcode', ' has-error') !!}">
        {!! Form::label(trans('default.zipcode'),trans('default.zipcode'),array('for' => 'slug','class' => 'control-label col-sm-2')) !!}
        <div class="col-sm-10">
            {!! Form::text('zipcode',null,array('class'=>'form-control', 'id'=>"zipcode", 'placeholder'=> "Enter the vendor zipcode.")) !!}
            <span class="help-block">{!! $errors->first('zipcode', ':message') !!}</span>
        </div>
    </div>
</div>

<div class="box-footer text-center">
    <a class="btn btn-default" href="{!! url('admin/settings/vendor')  !!}">{!! trans('default.cancel') !!}</a>
    {!! Form::submit($submitButtonText, array('class'=>'btn btn-primary btn-flat')) !!}
</div>