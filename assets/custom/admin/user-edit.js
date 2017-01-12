jQuery(document).ready(function ($) {
    set_error_keypress()
    $("#vn_name").focus();
    // alert( "is_insert::"+is_insert + "  base_url::"+base_url )
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

function generateNewPassword(user_id) {
    if ( !confirm("Do you want to generate new password and send it to this user ?") ) return;

    jQuery.ajax({
        url: base_url +"/sys-admin/users/generate_new_password/user_id/" + user_id,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            alert( "  result::"+var_dump(result) )
            if (result.ErrorCode != 0) {
                alert( result.ErrorMessage )
            }
            if (result.ErrorCode == 0) {
                if ( parseInt(result.total_items) == 0 ) {
                    $("#span_cart_info").html("Empty")
                } else {
                    $("#span_cart_info").html(result.total + "/" + result.total_items)
                }
            }
        }
    });

}