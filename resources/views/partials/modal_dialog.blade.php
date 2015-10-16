<div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="z-index: 9999;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('default.close') }}</span></button>
                <h4 class="modal-title" id="frm_title">{{ trans('default.delete') }}</h4>
            </div>
            <div class="modal-body" id="frm_body"></div>
            <div class="modal-footer">
                <button style='margin-left:10px;' type="button" class="btn btn-danger col-sm-2 pull-right" id="frm_submit">{{ trans('default.yes') }}</button>
                <button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">{{ trans('default.no') }}</button>
            </div>
        </div>
    </div>
</div>