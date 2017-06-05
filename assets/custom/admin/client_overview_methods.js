/*
function editClientData(cid) {
    var href= "/sys-admin/get_client_info/client_id/"+cid
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            // alert( "result::"+var_dump(result.client) )
            if (result.ErrorCode == 0) {
                $('#form_client_data_modal_editor_client_owner').val(result.client.client_owner)
                $('#form_client_data_modal_editor_client_name').val(result.client.client_name)
                $('#form_client_data_modal_editor_client_address1').val(result.client.client_address1)
                $('#form_client_data_modal_editor_client_address2').val(result.client.client_address2)
                $('#form_client_data_modal_editor_client_city').val(result.client.client_city)
                $('#form_client_data_modal_editor_client_state').val(result.client.client_state)
                $('#form_client_data_modal_editor_client_zip').val(result.client.client_zip)
                $('#form_client_data_modal_editor_client_phone').val(result.client.client_phone)
                $('#form_client_data_modal_editor_client_phone_2').val(result.client.client_phone_2)
                $('#form_client_data_modal_editor_client_phone_3').val(result.client.client_phone_3)
            }
        }
    });
    $( "#client_edit_client_dialog" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    }  );

    //$('#client_edit_client_dialog').modal('hide');

}
*/

/*
function onclient_edit_client_dialogSubmit() {
    alert( "onclient_edit_client_dialogSubmit::"+var_dump(1) )
    // $( "#form_client_data_modal_editor" ).validate({
    //     submitHandler: function(form) {
            alert( "form_client_data_modal_editor submitHandler 11::"+var_dump(111) )
            var href= "/sys-admin/save_client_info"
            $.ajax({
                url: href,
                type: 'POST',
                dataType: 'json',        
                data: {   'client_id' : client_id,
                    "client_owner" : $("#form_client_data_modal_editor_client_owner").val(),
                    'client_name' : $("#form_client_data_modal_editor_client_name").val(),
                    'client_address1' : $("#form_client_data_modal_editor_client_address1").val(),
                    'client_address2' : $("#form_client_data_modal_editor_client_address2").val(),
                    'client_city' : $("#form_client_data_modal_editor_client_city").val(),
                    'client_state' : $("#form_client_data_modal_editor_client_state").val(),
                    'client_zip' : $("#form_client_data_modal_editor_client_zip").val(),
                    'client_phone' : $("#form_client_data_modal_editor_client_phone").val(),
                    'client_phone_2' : $("#form_client_data_modal_editor_client_phone_2").val(),
                    'client_phone_3' : $("#form_client_data_modal_editor_client_phone_3").val(),   },
                success: function(result) {
                    alert( "onclient_edit_client_dialogSubmit result::"+var_dump(result) )
                    if (result.ErrorCode == 0) {
                        // loadClientRelatedUsers(1)
                        $("#form_client_data_modal_editor_client_owner").val("")
                        $("#form_client_data_modal_editor_client_name").val("")
                        $("#form_client_data_modal_editor_client_address1").val("")
                        $("#form_client_data_modal_editor_client_address2").val("")
                        $("#form_client_data_modal_editor_client_city").val("")
                        $("#form_client_data_modal_editor_client_state").val("")
                        $("#form_client_data_modal_editor_client_zip").val("")
                        $("#form_client_data_modal_editor_client_phone").val("")
                        $("#form_client_data_modal_editor_client_phone_2").val("")
                        $("#form_client_data_modal_editor_client_phone_3").val("")
                        $('#client_new_user_dialog').modal( 'hide' );
                        Materialize.toast('Clieant was modified !', 4000)
                    }
                }
            });

    //     }
    // });

    alert( "SET VALIDATE::"+var_dump() )
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
*/
function onuserModalEditorSubmit() {
    // alert( "javascript:onuserModalEditorSubmit::"+111 )
    var theForm = $("#form_user_modal_editor");
    theForm.submit();
}

$(function() {
    loadClientInfo()
    setClientUserValidationRules()
    loadClientRelatedUsers(1)
});

/**********************
 * load Client Info and show fields in overview page
 * access public
 * params : page_number - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function loadClientInfo() {
    var href= "/sys-admin/get_client_info/client_id/"+client_id
    // alert( "href::"+var_dump(href) )
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            // alert( "result::"+var_dump(result.client) )
            if (result.ErrorCode == 0) {
                // $('#client_edit_client_dialog_client_id').val(client_id)

                $('#span_client_client_name_logo_first').html(result.client.formatted_client_logo_first);
                $('#span_client_client_name').html(result.client.client_name);

                if ( result.client.client_owner == "" ) {
                    $('#div_client_client_owner').css("display", "none");
                } else {
                    $('#div_client_client_owner').css("display", "block");
                    $('#span_client_client_owner').html(result.client.client_owner)
                }

                if ( result.client.client_email == "" ) {
                    $('#div_client_client_email').css("display", "none");
                } else {
                    $('#div_client_client_email').css("display", "block");
                    $('#span_client_client_email').html(result.client.client_email)
                }

                if ( result.client.formatted_client_city == "" ) {
                    $('#div_client_client_city').css("display", "none");
                } else {
                    $('#div_client_client_city').css("display", "block");
                    $('#span_client_client_city').html(result.client.formatted_client_city)
                }

                if ( result.client.formatted_client_type_label == "" ) {
                    $('#div_client_client_type_label').css("display", "none");
                } else {
                    $('#div_client_client_type_label').css("display", "block");
                    $('#span_client_client_type_label').html(result.client.formatted_client_type_label)
                }

                if ( result.client.formatted_client_address == "" ) {
                    $('#div_client_client_address1').css("display", "none");
                } else {
                    $('#div_client_client_address1').css("display", "block");
                    $('#span_client_client_address1').html(result.client.formatted_client_address)
                }
                if ( result.client.formatted_client_phone == "" ) {
                    $('#div_client_client_phone').css("display", "none");
                } else {
                    $('#div_client_client_phone').css("display", "block");
                    $('#span_client_client_phone').html(result.client.formatted_client_phone)
                }
            }
        }
    });
}

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

function checkPhonesVisibilty() {
    // alert( " heckPhonesVisibilty ::"+var_dump(1) )
    var client_phone = jQuery.trim( $("#client_phone").val() )
    var client_phone_2 = jQuery.trim( $("#client_phone_2").val() )
    var client_phone_3 = jQuery.trim( $("#client_phone_3").val() )
    var client_phone_4 = jQuery.trim( $("#client_phone_4").val() )

    // alert( " checkPhonesVisibilty  client_phone::"+client_phone + "  client_phone_2::" + client_phone_2  + "  client_phone_3::" + client_phone_3  + "  client_phone_4::" + client_phone_4 )

    if ( client_phone != "" && client_phone_2 != "" && client_phone_3 != "" &&  client_phone_4 != "") {
        $("#btn_add_phone").css("display","none")
    } else{
        $("#btn_add_phone").css("display","block")
    }
}
