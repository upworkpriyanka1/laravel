jQuery(document).ready(function ($) {
    set_error_keypress()
    $("#vn_name").focus();
    // alert( "is_insert::"+is_insert )
    if (is_insert == '') {
        load_vendor_contacts()
    }
});

/**********************
 * List of related users reloading
 * access public
 * params : page_number - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function load_vendor_contacts() {
    var href= base_url+"sys-admin/vendors/load_vendor_contacts/vendor_id/"+vn_id
    // alert(  href )
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            // alert( "result::"+var_dump(result) )
            if (result.ErrorCode == 0) {
                $('#div_load_vendor_contacts').html(result.html)
            }
        }
    });
}


function onSubmit() {
    var theForm = $("#form_vendor_edit");
    theForm.submit();
}

function set_error_keypress() {
    $(".has-error").bind('change keypress', function () {
        $(this).removeClass("has-error");
    });
}



function editRelatedVendorContact( vc_person_name, vc_person_description, vc_phone, vc_phone_description, vc_person_email, vc_id ) {
    $("#popup_vc_person_name").val(vc_person_name)
    $("#popup_vc_person_description").val(vc_person_description)
    $("#popup_vc_phone").val(vc_phone)
    $("#popup_vc_phone_description").val(vc_phone_description)
    $("#popup_vc_person_email").val(vc_person_email)
    $("#popup_vc_id").val(vc_id)

    $('.tooltip-inner').css('display', 'none');
    $( "#vendor_related_contact_dialog" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    }  );

}

function saveRelatedVendorContact() {
    var vc_person_name = jQuery.trim(  $("#popup_vc_person_name").val()  )
    var vc_person_description= jQuery.trim(  $("#popup_vc_person_description").val()  )
    var vc_phone= jQuery.trim(  $("#popup_vc_phone").val()  )
    var vc_phone_description= jQuery.trim(  $("#popup_vc_phone_description").val()  )
    var vc_person_email= jQuery.trim(  $("#popup_vc_person_email").val()  )
    var vc_id= jQuery.trim(  $("#popup_vc_id").val()  )

    if ( vc_person_name == '' ) {
        alert( "Enter person name !" )
        $("#popup_vc_person_name").focus()
        return;
    }
    if ( vc_person_description == '' ) {
        alert( "Enter person description !" )
        $("#popup_vc_person_description").focus()
        return;
    }
    if ( vc_phone == '' ) {
        alert( "Enter phone !" )
        $("#popup_vc_phone").focus()
        return;
    }
    if ( vc_phone_description == '' ) {
        alert( "Enter phone description !" )
        $("#popup_vc_phone_description").focus()
        return;
    }
    if ( vc_person_email == '' ) {
        alert( "Enter person email !" )
        $("#popup_vc_person_email").focus()
        return;
    }

    var href= base_url+"sys-admin/vendors/save_related_vendor_contact"
    $.ajax({
        url: href,
        type: 'POST',
        dataType: 'json',
        data: { 'vc_person_name' : vc_person_name, 'vc_person_description' : vc_person_description, 'vc_phone' : vc_phone, 'vc_phone_description' : vc_phone_description, vc_person_email : vc_person_email, vc_id : vc_id, 'vc_vendor_id' : vn_id },
        success: function(result) {
            if (result.ErrorCode == 0) {
                $('#vendor_related_contact_dialog').modal('hide');
                load_vendor_contacts()
            }
        }
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
