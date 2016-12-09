// alert( "assets/custom/admin/vendor-types-edit.jsbase_url::"+ base_url + "  vt_id::"+vt_id)

jQuery(document).ready(function ($) {
    set_error_keypress()
    $("#vt_name").focus();
});

function onSubmit() {
    var theForm = $("#form_vendor_types_edit");
    theForm.submit();
}

function set_error_keypress() {
    $(".has-error").bind('change keypress', function () {
        $(this).removeClass("has-error");
    });
}
