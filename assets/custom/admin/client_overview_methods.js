function onuserModalEditorSubmit() {
    var theForm = $("#form_user_modal_editor");
    theForm.submit();
}

function onuserModalEditorChecking() {
    var theForm = $("#form_user_modal_editor_checking");
    theForm.submit();
}

$(function() {
    loadClientInfo()
    setClientUserValidationRulesChecking()
    loadClientRelatedUsers(1)
});

/**********************
 * load Client Info and show fields in overview page
 * access public
 * params : page_number - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function loadClientInfo() {
    var href= "sys-admin/get_client_info/client_id/"+client_id
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            // alert( "result::"+var_dump(result.client) )
            if (result.ErrorCode == 0) {
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

function setClientUserValidationRulesChecking() {
	/* ======= BBITS DEV START : 30/06/2017 ======= */
	//alert('here');
	/* ======= BBITS DEV END ======= */
    $( "#form_user_modal_editor_checking" ).validate({
        submitHandler: function(form) { // valid email was entered
            var entered_email= $("#form_user_modal_editor_checking_email1").val()
            var selected_title= $("#form_user_modal_editor_checking_title").val()
            var selected_title_label= $("#form_user_modal_editor_checking_title option:selected").text() ;
            if ( entered_email!= "" && selected_title!= "" && selected_title_label!= "" ) {
                var href= "/sys-admin/add_client_user_relation"
                $.ajax({
                    url: href,
                    type: 'POST',
                    dataType: 'json',
                    data: {   'client_id' : $("#form_user_modal_editor_client_id").val(),  'group_id' : selected_title ,  'user_id' : selected_user_id  },
                    success: function(result) {
                        // alert( "add_client_user_relation  result::"+var_dump(result) )
                        if (result.ErrorCode == 0) {
                            $("#form_user_modal_editor_checking_email").val("")
                            $("#form_user_modal_editor_checking_email1").val("")
                            $("#form_user_modal_editor_checking_title").val("")
                            $("#span_message").html("")
                            $("#div_form_user_modal_editor_checking_title").css("display","none")
                            loadClientRelatedUsers(1)
                            Materialize.toast('New user relation was created !', 4000)
                        }
                    }
                });
                $( '#client_new_user_dialog_checking' ).modal('hide');
                return;
            }

            var href= "/sys-admin/get_user_info_by_email/client_id/" + $("#form_user_modal_editor_client_id").val() + "/email/"+encodeURIComponent(entered_email)
            $.ajax({
                url: href,
                type: 'GET',
                dataType: 'json',
                success: function(result) {
					/* ======= BBITS DEV START : 30/06/2017 ======= */
                     //alert( "get_user_info_by_email  result::"+var_dump(result) )
					 /* ======= BBITS DEV END ======= */
                    if (result.ErrorCode == 0) {      // FOUND USER WITH given email
                        selected_user_id= result.user.id
                        var message= selected_user_id+" = "+result.user.first_name+' '+result.user.last_name + ( jQuery.trim(result.user.phone) != "" ? ' at ' : '' ) + result.user.phone
                        $("#span_message").html(message)
                        $("#div_form_user_modal_editor_checking_title").css("display","block")
                        clearDDLBItems("form_user_modal_editor_checking_title", false )
                        var l= result.groups_length
                        for ( i= 0; i< l; i++ ) {
                            if ( typeof result.groupsList[i] != "undefined" ) {
                                AddDDLBItem("form_user_modal_editor_checking_title", result.groupsList[i].key, result.groupsList[i].value)
                            }
                        }
                    } // if (result.ErrorCode == 0) {      // FOUND USER WITH given email

                    if (result.ErrorCode == 1) {      // NOT FOUND USER WITH given email - open other dialog for creating of new user
                        $( '#client_new_user_dialog_checking' ).modal('hide');
                        $("#form_user_modal_editor_email").val(entered_email)
                        $("#form_user_modal_editor_email").focus()
                        clearDDLBItems("form_user_modal_editor_title", false )
                        var l= result.groups_length
                        for ( i= 0; i< l; i++ ) {
                            if ( typeof result.groupsList[i] != "undefined" ) {
                                AddDDLBItem("form_user_modal_editor_title", result.groupsList[i].key, result.groupsList[i].value)
                            }
                        }
                        $( '#client_new_user_dialog' ).modal('show');
                        $( "#form_user_modal_editor_username" ).focus()
                        setClientUserValidationRules()
                    }
                }
            });

        }
    });

    $("#form_user_modal_editor_checking_email1").rules("add", {
        equalTo: "#form_user_modal_editor_checking_email"
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
                    // alert( "result::"+var_dump(result) )
                    if (result.ErrorCode == 0) {
                        loadClientRelatedUsers(1)
                        $("#form_user_modal_editor_username").val("");
                        $("#form_user_modal_editor_first_name").val("");
                        $("#form_user_modal_editor_last_name").val("");
                        $("#form_user_modal_editor_phone").val("");
                        $("#form_user_modal_editor_email").val("");
                        $("#form_user_modal_editor_title").val("");
                        $('#client_new_user_dialog').modal('hide');

                        $("#form_user_modal_editor_checking_email").val("")
                        $("#form_user_modal_editor_checking_email1").val("")
                        $("#form_user_modal_editor_checking_title").val("")
                        $("#span_message").html("")
                        $("#div_form_user_modal_editor_checking_title").css("display","none")
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
    // $("#form_user_modal_editor_email1").rules("add", {
    //     equalTo: "#form_user_modal_editor_email"
    // });
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