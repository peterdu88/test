
<div class="box box-info">
    <div class="box-header with-border"><h3 class="box-title text-info">{{ trans('default.specialinstruction') }} </h3> <i class="fa fa-caret-down pull-right"></i></div>
    <div class="box-body">
        {{-- special instruction for order --}}
        <div class="form-group">

            {!! Form::textarea('specialinstruction',null,['class'=>'form-control','size' => '30x5','placeholder' => 'Fill Special Instruction for this order']) !!}
            <div class="help-block"></div>
        </div>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header with-border"><h3 class="box-title text-primary">{!! trans('default.orderitems') !!}</h3> <i class="fa fa-caret-down pull-right"></i></div>
    <div class="box-body orderitems-section">
        @if($order->count())
            @foreach( $order->orderitems() as $orderitem )
                @include('partials.orderitem',array('allCategories' => $allCategories ,'orderitem' => $orderitem,'id' => $orderitem->id))
            @endforeach
        @else
            @include('partials.orderitem',array('allCategories' => $allCategories ,'id' => 0 ))
        @endif
    </div>
</div>
<div class="box box-success">
    <div class="box-header with-border"><h3 class="box-title text-success">{{ trans('default.approvalby') }}</h3> <i class="fa fa-caret-down pull-right"></i></div>
    <div class="box-body">
    <div class="form-group required {!! $errors->first('approval', ' has-error') !!}">
        {!! Form::label(trans('default.approvalby'),trans('default.approvalby'),['class' => 'col-sm-2 control-label','for' => 'approval']) !!}
        <div class="col-sm-10">
            {!! Form::select('approval',$approvalPermissionUsers,null,array('class' => 'select2 form-control')) !!}
        </div>
        <div class="help-block">Note: Select the your manager or CEO for approvement.</div>
    </div>
    </div>
</div>
<div class="box-footer">
    {!! Form::submit($submitButtonText,array('class' => 'btn btn-sm btn-primary')) !!}
</div>
{!! Form::close() !!}



