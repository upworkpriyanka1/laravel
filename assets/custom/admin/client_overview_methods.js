function onuserModalEditorSubmit() {
    // alert( "javascript:onuserModalEditorSubmit::"+111 )
    var theForm = $("#form_user_modal_editor");
    theForm.submit();
}

$(function() {
    setClientUserValidationRules()
    loadClientRelatedUsers(1)
});

/**********************
 * List of related users reloading
 * access public
 * params : page_number - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function loadClientRelatedUsers(page) {
    var href= "/sys-admin/load_client_related_users/filter_client_id/"+$("#form_user_modal_editor_client_id").val()+"/page/"+page
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                $('#div_load_client_related_users').html(result.html)
            }
        }
    });
}

function setClientUserValidationRules() {
    $( "#form_user_modal_editor" ).validate({
        submitHandler: function(form) {
            var href= "/sys-admin/save_client_related_user"
            $.ajax({
                url: href,
                type: 'POST',
                dataType: 'json',
                data: {   'client_id' : $("#form_user_modal_editor_client_id").val(),    'username' : $("#form_user_modal_editor_username").val(),  'first_name' : $("#form_user_modal_editor_first_name").val(),    'last_name' : $("#form_user_modal_editor_last_name").val(),    'phone' : $("#form_user_modal_editor_phone").val(),    'email' : $("#form_user_modal_editor_email").val(),    'user_group_id' : $("#form_user_modal_editor_title").val(),   },
                success: function(result) {
                    if (result.ErrorCode == 0) {
                        loadClientRelatedUsers(1)
                        $("#form_user_modal_editor_username").val("");
                        $("#form_user_modal_editor_first_name").val("");
                        $("#form_user_modal_editor_last_name").val("");
                        $("#form_user_modal_editor_phone").val("");
                        $("#form_user_modal_editor_email").val("");
                        $("#form_user_modal_editor_email1").val("");
                        $("#form_user_modal_editor_title").val("");
                        $('#client_new_user_dialog').modal('hide');
                        Materialize.toast('New user was created !', 4000)
                    }
                }
            });

        }
    });

    $("#form_user_modal_editor_username").rules("add", {
        required: true,
        minlength: 5
        // specialChrs: true
        // regex: /[A-Za-z]+/
        // regex: /^[a-zA-Z\s]+$/
    });
    $("#form_user_modal_editor_phone").rules("add", {
        required: true,
        phoneUS: true
    });
    $("#form_user_modal_editor_email1").rules("add", {
        equalTo: "#form_user_modal_editor_email"
    });
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
