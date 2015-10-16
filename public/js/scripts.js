(function ($) {
    $('.formConfirm').on('click', function(e) {
        e.preventDefault();
        var el = $(this);
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');

        $('#formConfirm')
            .find('#frm_body').html(msg)
            .end().find('#frm_title').html(title)
            .end().modal('show');

        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
    });

    $('#frm_submit').on('click', function(e) {
        var id = $(this).attr('data-form');
        $(id).submit();
    });


})(jQuery);


jQuery(document).ready(function(){

    $('input#selectall').change(function(e){
        e.preventDefault();
        isChecked = $(this).is(':checked');

        console.log(isChecked);
        if(isChecked){

            $('input#multiplechecked').check();
        }
        else{
            $('input#multiplechecked').onUncheck();
        }
    });

    function checkboxStates(){

    }

/*    $('div.box-header').click(function(e){
        e.preventDefault();
        console.log($(this));

        $(this).find('fa').toggleClass(function(){
            if($(this).hasClass('fa-caret-down')){
                $(this).removeClass('fa-caret-down').addClass('fa-caret-right');
            }
            else if($(this).hasClass('fa-caret-down')){
                $(this).removeClass('fa-caret-right').addClass('fa-caret-down');
            }
        });
        $(this).next('.box-body').toggle('slow');
    });*/

    $('.select2').select2();

    $('.select2Withadd').select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
    $("[data-mask]").inputmask();

    CKEDITOR.replaceAll();


});
/*
$(function() {
    $('.required-icon').tooltip({
        placement: 'left',
        title: 'Required field'
    });
});*/
