$(function(){
    $('.js-user-type [type="radio"]').change(function(){

        if( $(this).val() == "1" ) {
            $('.field-users-company').show();

            if( $(".field-users-company").hasClass("has-success") ) {
                $("form").yiiActiveForm("validateAttribute", "users-company");
            }

        } else {
            $('.field-users-company').hide();
        }

        if( $(".field-users-inn").hasClass("has-error") ) {
            $("form").yiiActiveForm("validateAttribute", "users-inn");
        }

        if( $(".field-users-inn").hasClass("has-success") ) {
            $("form").yiiActiveForm("validateAttribute", "users-inn");
        }

    });
});