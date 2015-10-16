<?php
/**
 * Created by PhpStorm.
 * User: FZB
 * Date: 9/18/2015
 * Time: 11:40 AM
 */
?>
<style type="text/css">
    span.addvendor.btn,
    span.addcategory.btn{
        background-color:#3C8DBC;
        border-color:#008D4C;
        color:#fff;
    }
    span.addvendor.btn:hover,
    span.addcategory.btn:hover{
        background-color: #00A65A;
        border-color:#008D4C;
        color:#fff;
    }
    .page-body{
        background: #fff;
        padding:0;
    }
</style>
<div class="orderitem-section orderitems-{{ $id }}">
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group required {!! $errors->first('orderitems['. $id .'][category]', ' has-error') !!}">
                    {!! Form::label('orderitems['. $id .'][category]', trans('default.category')) !!}
                    <!-- categories listing -->
                    <div class="input-group">
                        {!! Form::select('orderitems['. $id .'][category]',$allCategories,null,array('class' =>'form-control select2')) !!} <span class="input-group-addon addcategory btn btn-primary"><i class="fa fa-plus"></i></span><span class="help-block">{!! $errors->first('orderitems['. $id .'][category]', ':message') !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group required {!! $errors->first('orderitems['. $id .'][vendor]', ' has-error') !!}">
                    {!! Form::label('orderitems['. $id .'][vendor]', trans('default.vendor')) !!}
                        <!-- categories listing -->
                    <div class="input-group">
                        {!! Form::select('orderitems['. $id .'][vendor]',$allVendors,null,array('class' =>'form-control select2')) !!} <span class="input-group-addon addvendor btn btn-primary"><i class="fa fa-plus"></i></span><span class="help-block">{!! $errors->first('orderitems['. $id .'][vendor]', ':message') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- orderitems name description -->
    <div class="box-body">
        <div class="form-group required {!! $errors->first('orderitems['. $id .'][name]', ' has-error') !!}">
            {!! Form::label('orderitems['. $id .'][name]','Name') !!}
            {!! Form::text('orderitems['. $id .'][name]','',array( 'id' => 'ckeditorEditor', 'class'=>'form-control', 'placeholder'=>'Place Name here')) !!}

            <span class="help-block">{!! $errors->first('orderitems['. $id .'][description]', ':message') !!}</span>
        </div>
    </div>

    <!-- orderitems name description -->
    <div class="box-body">
        <div class="form-group {!! $errors->first('orderitems['. $id .'][description]', ' has-error') !!}">
            {!! Form::label('orderitems['. $id .'][description]','Description') !!}
            {!! Form::textarea('orderitems['. $id .'][description]','',array( 'id' => 'ckeditorEditor', 'class'=>'form-control', 'placeholder'=>'Place Descripiton here','size' => '30x5')) !!}

            <span class="help-block">{!! $errors->first('orderitems['. $id .'][description]', ':message') !!}</span>
        </div>
    </div>

    <!-- orderitems estmiated price by unit -->
    <div class="divider" style="color:red"></div>
    <div class="box-body">
        <div class="row orderitem">
            <!-- orderitems quantity -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="box box-success">
                    <div class="box-header ui-sortable-handle">
                        <i class="fa fa-paperclip"></i><h3 class="box-title">{{ trans('default.quantity') }}</h3>
                    </div>
                    <div clas="box-body">
                        <div class="form-group required {!! $errors->first('orderitems['. $id .'][quantity]', ' has-error') !!}">
                            {!! Form::label('quantity', trans('default.quantity')) !!}
                            {!! Form::number('orderitems['. $id .'][quantity]','1',array('class'=>'quantity form-control','placeholder'=> trans('message.placeholder_product_quantity'))) !!}
                            <span class="help-block">{!! $errors->first('orderitems['. $id .'][quantity]', ':message') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{--  estimated Price   --}}
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="box box-info">
                    <div class="box-header ui-sortable-handle">
                        <i class="fa fa-paperclip required"></i><h3 class="box-title">{{ trans('default.estimated').' '.trans('default.price')  }}</h3>
                    </div>
                    <div clas="box-body">
                        <div class="col-xs-12 col-md-6 form-group required {!! $errors->first('orderitems['. $id .'][estimatedtotal]', ' has-error') !!}">
                            {!! Form::label('orderitems['. $id .'][estimatedprice]',trans('default.unit_price')) !!}
                            {!! Form::text('orderitems['. $id .'][estimatedprice]',null, ['class'=>'estimatedprice form-control', 'data-mask'=>'','data-inputmask' => "'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0.00'"]) !!}
                        </div>
                        <!-- orderitems estimated price by unit -->
                        <div class="col-xs-12 col-md-6 form-group required {!! $errors->first('orderitems['. $id .'][estimatedtotal]', ' has-error') !!}">
                            {!! Form::label('orderitems['. $id .'][estimatedtotal]',trans('default.subtotal') ,array()) !!}
                            {!! Form::text('orderitems['. $id .'][estimatedtotal]',null, ['id' => 'orderitems['. $id .'][estimatedtotal]', 'class'=>'form-control estimatedtotal','readonly'=>'readonly', 'data-mask'=>'', 'data-inputmask' => "'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false,  'placeholder': '0'"]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                {{--  Final Price   --}}
                <div class="box box-info">
                    <div class="box-header ui-sortable-handle">
                        <i class="fa fa-paper-plane-o"></i><h3 class="box-title">{{ trans('default.final').' '.trans('default.price')  }}</h3>
                    </div>
                    <div clas="box-body">
                        <div class="col-xs-12 col-md-6 form-group {!! $errors->first('orderitems['. $id .'][finalprice]', ' has-error') !!}">
                            {!! Form::label('orderitems['. $id .'][finalprice]', trans('default.unit_price')) !!}
                                {!! Form::text('orderitems['. $id .'][finalprice]',null,array('class'=>'form-control finalprice', 'data-mask'=>'','data-inputmask' => "'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'")) !!}
                        </div>
                        <!-- orderitems estimated price by unit -->
                        <div class="col-xs-12 col-md-6 form-group {!! $errors->first('orderitems['. $id .'][finaltotal]', ' has-error') !!}">

                            {!! Form::label('orderitems['. $id .'][estimatedtotal]',trans('default.subtotal')) !!}
                            {!! Form::text('orderitems['. $id .'][finaltotal]',null,array('id' => 'orderitems['. $id .'][finaltotal]', 'class'=>'form-control finaltotal','readonly'=>'readonly', 'data-mask'=>'','data-inputmask' => "'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'")) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){

        function getSetTotal($element){

            // init value as 0
            var $estimateUnitPrice = 0;
            var $finalUnitPrice = 0;
            var $quantity = 0;

            //get the final and estimate field object
            var $estimatedTotalObj = $element.closest('.orderitem').find('input.estimatedtotal');
            var $finalTotalObj = $element.closest('.orderitem').find('input.finaltotal');

            //get value from input
            $estimateUnitPrice = $element.closest('.orderitem').find('input.estimatedprice').val().replace(/[^\d\.]/g, '');
            $finalUnitPrice = $element.closest('.orderitem').find('input.finalprice').val().replace(/[^\d\.]/g, '');
            $quantity = parseInt($element.closest('.orderitem').find('input.quantity').val());
            $estimatedTotalObj.val($quantity * $estimateUnitPrice);
            $finalTotalObj.val($quantity * $finalUnitPrice);
        }

        function initialDOM() {
            var $quantity = $('input.quantity');

            $quantity.each(function () {
                getSetTotal($(this));
            });
        }

        initialDOM();

        $.each(['input.quantity','input.finalprice','input.estimatedprice'],function(index,element){
            $(element).each(function () {
                $(this).on('change',function(e){
                    e.preventDefault();
                    getSetTotal($(this));
                });

            })
        });
    });
</script>