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
            //alert( "  result::"+var_dump(result) )
            if (result.ErrorCode != 0) {
                alert( result.ErrorMessage )
            }
        }
    });

}

function userRemove( id, username, logged_user_id ) {
    if ( logged_user_id == id ) {
        alert( "You can not remove user under which you are logged !" )
        return;
    }
    if ( confirm( "Do you want to remove '"+username+"' user with all related data ? ") ) {
        document.location = "/sys-admin/users/remove_user/id/" + id;
    }
}


/**********************
 * Debugging function of different scalar/object value
 * params : oElem - scalar/object value. When oElem is too big(say in alert function) number values for from_line and till_line could be given to show big value by parts
 * access public
 * return none
 *********************************/
function var_dump(oElem, from_line, till_line) {
    var sStr = '';
    if (typeof(oElem) == 'string' || typeof(oElem) == 'number')     {
        sStr = oElem;
    } else {
        var sValue = '';
        for (var oItem in oElem) {
            sValue = oElem[oItem];
            if (typeof(oElem) == 'innerHTML' || typeof(oElem) == 'outerHTML') {
                sValue = sValue.replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }
            sStr += 'obj.' + oItem + ' = ' + sValue + '\n';
        }
    }
    //alert( "from_line::"+(typeof from_line) )
    if ( typeof from_line == "number" && typeof till_line == "number" ) {
        return sStr.substr( from_line, till_line );
    }
    if ( typeof from_line == "number" ) {
        return sStr.substr( from_line );
    }
    return sStr;
}
