jQuery(document).ready(function ($) {
    set_error_keypress()
    $("#vn_name").focus();
    // alert( "is_insert::"+is_insert )
});

function onSubmit() {
    var theForm = $("#form_user_edit");
    theForm.submit();
}

function set_error_keypress() {
    $(".has-error").bind('change keypress', function () {
        $(this).removeClass("has-error");
    });
}
