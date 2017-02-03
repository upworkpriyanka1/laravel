$(document).ready(function ($) {
    // alert( "is_insert::"+is_insert )
    set_error_keypress()
    tabInit()
    paginationLinksInit()
    if (is_insert == '') {
        load_related_users(1)
        load_provides_vendors(1) // div_load_provides_vendors
    }
});

function showEditMode(cid, is_insert) {
    // alert( "showEditMode cid::"+cid + "  is_insert::"+is_insert )
    $("#div_editor_buttons").css("display","block")
    $("#div_view_buttons").css("display","none")

    $("#div_client_address1_btn").css("display","none")
    $("#div_client_address1_input").css("display","block")
    $("#div_client_address1_view").css("display","none")

    $("#div_client_address2_btn").css("display","none")
    $("#div_client_address2_input").css("display","block")
    $("#div_client_address2_view").css("display","none")

    $("#div_client_active_status_btn").css("display","none")
    $("#div_client_active_status_input").css("display","block")
    $("#div_client_active_status_view").css("display","none")

    $("#div_client_owner_btn").css("display","none")
    $("#div_client_owner_input").css("display","block")
    $("#div_client_owner_view").css("display","none")

    $("#div_client_city_btn").css("display","none")
    $("#div_client_city_input").css("display","block")
    $("#div_client_city_view").css("display","none")

    $("#div_client_state_btn").css("display","none")
    $("#div_client_state_input").css("display","block")
    $("#div_client_state_view").css("display","none")

    $("#div_client_zip_btn").css("display","none")
    $("#div_client_zip_input").css("display","block")
    $("#div_client_zip_view").css("display","none")

    $("#div_client_fax_btn").css("display","none")
    $("#div_client_fax_input").css("display","block")
    $("#div_client_fax_view").css("display","none")

    $("#div_client_email_btn").css("display","none")
    $("#div_client_email_input").css("display","block")
    $("#div_client_email_view").css("display","none")

    $("#div_client_website_btn").css("display","none")
    $("#div_client_website_input").css("display","block")
    $("#div_client_website_view").css("display","none")

    $("#div_clients_types_id_btn").css("display","none")
    $("#div_clients_types_id_input").css("display","block")
    $("#div_clients_types_id_view").css("display","none")

    $("#div_color_scheme_btn").css("display","none")
    $("#div_color_scheme_input").css("display","block")
    $("#div_color_scheme_view").css("display","none")

    $("#div_client_img_btn").css("display","none")  /// !
    $("#div_client_img_input").css("display","block")


/*    $("#div_color_scheme_btn").css("display","none")
    $("#div_color_scheme_input").css("display","block")
    $("#div_color_scheme_view").css("display","none")

    $("#div_color_scheme_btn").css("display","none")
    $("#div_color_scheme_input").css("display","block")
    $("#div_color_scheme_view").css("display","none")

    $("#div_color_scheme_btn").css("display","none")
    $("#div_color_scheme_input").css("display","block")
    $("#div_color_scheme_view").css("display","none")  */

    // $("#div_client_img_view").css("display","none")

}

function switchFieldName(field_name, switcher) {
    if ( switcher ) {
        $("#div_"+field_name+"_btn").css("display", "none")
        $("#div_"+field_name+"_input").css("display", "block")
        $("#"+field_name+"").focus()
    // } else {
    //     $("#div_client_name_btn").css("display", "block")
    //     $("#div_client_name_input").css("display", "none")
    }
}
/*
function switchClientName(switcher) {
    if ( switcher ) {
        $("#div_client_name_btn").css("display", "none")
        $("#div_client_name_input").css("display", "block")
        $("#client_name").focus()
    } else {
        $("#div_client_name_btn").css("display", "block")
        $("#div_client_name_input").css("display", "none")
    }
}

function switchClientOwner(switcher) {
    if ( switcher ) {
        $("#div_client_owner_btn").css("display", "none")
        $("#div_client_owner_input").css("display", "block")
        $("#client_owner").focus()
    } else {
        $("#div_client_owner_btn").css("display", "block")
        $("#div_client_owner_input").css("display", "none")
    }
}
*/

/*
function onBlur(field_name) {
    var field_value= jQuery.trim( $("#"+field_name).val() )
    alert( "onBlur  field_name::"+field_name + "field_value::"+field_value)
    if (field_value=="") {

    }
 onblur="onBlur('client_name')"
}

*/
function AddPhone() {

    var client_phone = jQuery.trim( $("#client_phone").val() )
    var client_phone_2 = jQuery.trim( $("#client_phone_2").val() )
    var client_phone_3 = jQuery.trim( $("#client_phone_3").val() )
    var client_phone_4 = jQuery.trim( $("#client_phone_4").val() )

    // alert( "AddPhone()  client_phone::"+client_phone + "  client_phone_2::" + client_phone_2  + "  client_phone_3::" + client_phone_3  + "  client_phone_4::" + client_phone_4 )

    if (client_phone=="") {
        $("#client_phone").focus()
        return;
    }

    if (client_phone_2=="") {
        $("#div_phone_2").css("display","block")
        $("#client_phone_2").focus()
        // checkPhonesVisibilty()
        return;
    }

    if (client_phone_3=="") {
        $("#div_phone_3").css("display","block")
        $("#client_phone_3").focus()
        // checkPhonesVisibilty()
        return;
    }

    if (client_phone_4=="") {
        $("#div_phone_4").css("display","block")
        $("#client_phone_4").focus()
        // checkPhonesVisibilty()
        return;
    }


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

function onSubmit() {
    var client_phone_type= $("#client_phone_type").val()
    var new_client_phone_type= jQuery.trim(  $("#new_client_phone_type").val()  )
    if ( client_phone_type == "-add_new-" && new_client_phone_type != "" ) {
        AddDDLBItem( "client_phone_type", new_client_phone_type, new_client_phone_type)
        SetDDLBActiveItem( "client_phone_type", new_client_phone_type)
    }

    var theForm = $("#form_client_edit");
    theForm.submit();
}

function set_error_keypress() {
    $(".has-error").bind('change keypress', function () {
        $(this).removeClass("has-error");
    });
}

/**********************
 * In pagination by click on item link to hook the event and run js reloading of users
 * access public
 * params : none, all param of Page # is rid from linked url
 * return none
 *********************************/
function paginationLinksInit() {
    $(document).on('click', "div.table_pagination a",function(){  // LOAD ON PAGE LOAD AND ON CLICK
        var urls = $(this).attr("href");
         // alert( "paginationLinksInit urls::"+var_dump(urls) )
        if ( urls== "#" ) {
            load_provides_vendors(1)
            load_related_users(1)
        }
        var arr = urls.split( '/clients_edit_load_provides_vendors/' );
        if (arr.length >= 2) {
            if ( urls== "#" ) {
                load_provides_vendors(1)
                return;
            }
            var value_arr = urls.split( '/page/' );
            if ( value_arr.length == 2 ) { // we have page number
                load_provides_vendors(value_arr[1])
            }
        }


        var arr = urls.split( '/clients_edit_load_related_users/' );
        if (arr.length >= 2) {
            if (urls == "#") {
                load_related_users(1)
                return;
            }
            var value_arr = urls.split('/page/');
            if (value_arr.length == 2) { // we have page number
                load_related_users(value_arr[1])
            }
        }

        return false;
    });
}

function run_related_users_filter() {
    load_related_users(1)
}

/**********************
 * In pagination by click on item on header link to sort listing by clicked column
 * access public
 * params : field name to sort, sort direction
 * return none
 *********************************/
function relatedUserSortingClick(field_title, sort_field_name, sort_direction) {
    var current_sort_field_name= $("#sort_field_name").val()
    var current_sort_direction= $("#sort_direction").val()

    if ( current_sort_field_name == sort_field_name ) {
        if ( current_sort_direction == 'asc' ) {
            sort_direction = 'desc'
        }
        if ( current_sort_direction == 'desc' ) {
            sort_direction = 'asc'
        }
    }

    $("#sort_field_name").val(sort_field_name)
    if ( typeof sort_direction == "undefined" ) {
        sort_direction = 'asc'
    }

    $("#sort_direction").val(sort_direction)
    load_related_users(1)
}

/**********************
 * List of related users reloading
 * access public
 * params : page - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function load_related_users(page) {
    page= parseInt(page)
    // alert( "load_related_users  page::"+page )
    var sort_field_name= jQuery.trim( $("#sort_field_name").val() )
    if (sort_field_name == "") sort_field_name= 'username'
    var sort_direction = jQuery.trim( $("#sort_direction").val() )
    if (sort_direction == "") sort_direction= 'desc'

    var related_users_type= $("#select_related_users_type").val()
    var related_users_filter= $("#input_related_users_filter").val()
    var select_user_active_status= $("#select_user_active_status").val()
    if (select_user_active_status!= "") {
        select_user_active_status= "/user_active_status/"+select_user_active_status
    }
    var href= base_url+"sys-admin/clients_edit_load_related_users/filter_client_id/"+client_id+"/filter_related_users_type/"+related_users_type+"/sort/"+sort_field_name+"/sort_direction/"+sort_direction+select_user_active_status + "/page/" + page + "/filter_related_users_filter/"+related_users_filter
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                $('#div_load_related_users').html(result.html)
            }
        }
    });


}

/**********************
 * List of related users reloading
 * access public
 * params : page - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function setRelatedUserEnabled( related_user_username, related_user_active_status_label, related_user_email, related_user_phone, uc_active_status, uc_active_status_label, related_user_id ) {

    $('.tooltip-inner').css('display', 'none');

    $( "#related_user_enabled_dialog" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    }  );
    var current_client_name = $("#client_name").val()
    $("#span_client_name").html( current_client_name )
    $("#span_related_user_username").html( related_user_username )
    $("#span_related_user_active_status_label").html( related_user_active_status_label )
    $("#span_related_user_email").html( related_user_email )
    $("#span_related_user_phone").html( related_user_phone )
    $("#span_uc_active_status").html( uc_active_status )

    $("#span_uc_active_status_label").html( uc_active_status_label )
    $("#hidden_related_user_id").val( related_user_id )


    if ( uc_active_status == "E" ) {
        $("#div_set_status_employee").css("display","none")
        $("#div_set_status_out_of_staff").css("display","block")
        $("#div_set_status_not_related").css("display","block")
    } // current status is Employee

    if ( uc_active_status == "O" ) {
        $("#div_set_status_employee").css("display","block")
        $("#div_set_status_out_of_staff").css("display","none")
        $("#div_set_status_not_related").css("display","block")
    } // current status is Out Of Staff

    if ( uc_active_status == "N" ) {
        $("#div_set_status_employee").css("display","block")
        $("#div_set_status_out_of_staff").css("display","block")
        $("#div_set_status_not_related").css("display","none")

    } // current status is Not Related

}

function setRelatedUserStatus(new_status) {
    var related_user_id= $("#hidden_related_user_id").val()
    var href= base_url+"sys-admin/clients_set_related_user_status/client_id/"+client_id+"/related_user_id/"+related_user_id+"/new_status/"+new_status
    $.ajax({
        url: href,
        type: 'POST',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                $('#related_user_enabled_dialog').modal('hide');
                load_related_users(1)
            }
        }
    });
}


function tabInit() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) { // http://getbootstrap.com/javascript/#tabs
    })
}



/*  PROVIDED VENDORS BLOCK START  */
/**********************
 * List of provided vendors reloading
 * access public
 * params : page - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function load_provides_vendors(page) {
    page= parseInt(page)
    // alert( "load_provides_vendors page::"+page )
    var provides_vendors_sort_field_name= jQuery.trim( $("#provides_vendors_sort_field_name").val() )
    if (provides_vendors_sort_field_name == "") provides_vendors_sort_field_name= 'username'
    var load_provided_sort_direction = jQuery.trim( $("#load_provided_sort_direction").val() )
    if (load_provided_sort_direction == "") load_provided_sort_direction= 'desc'

    var provides_vendors_type= $("#select_provides_vendors_type").val()
    var provides_vendors_filter= $("#input_provides_vendors_filter").val()
    // var select_user_active_status= $("#select_user_active_status").val()
    // if (select_user_active_status!= "") {
    //     select_user_active_status= "/user_active_status/"+select_user_active_status
    // }
    var href= base_url+"sys-admin/clients_edit_load_provides_vendors/filter_client_id/"+client_id+"/filter_provides_vendors_type/"+provides_vendors_type+"/sort/"+provides_vendors_sort_field_name+"/sort_direction/"+load_provided_sort_direction/*+select_user_active_status */ + "/page/" + page + "/filter_provides_vendors_filter/"+provides_vendors_filter
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                $('#div_load_provides_vendors').html(result.html)
            }
        }
    });


}

function run_provides_vendors_filter() {
    load_provides_vendors(1)
}

/**********************
 * List of related users reloading
 * access public
 * params : page - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
// <a class="btn btn-sm blue" onclick="javascript:setProvidesVendorsEnabled( '<?= addslashes($next_provides_vendor->vn_name) ?>', '<?= $this->clients_mdl->getClientsVendorsActiveStatusLabel( $cv_active_status ) ?>', '<?= $cv_active_status ?>', <?= $next_provides_vendor->cv_id ?>//)">

function setProvidesVendorsEnabled( current_vendor_name, vendor_email, vendor_website, provides_vendors_cv_active_status_label, provides_vendors_cv_active_status, related_vendor_id ) {
    // alert( "setProvidesVendorsEnabled current_vendor_name::"+current_vendor_name +"  vendor_email::"+vendor_email+"  vendor_website::"+vendor_website+ "  provides_vendors_cv_active_status_label::" +provides_vendors_cv_active_status_label + "  related_vendor_id::"+related_vendor_id )
    $('.tooltip-inner').css('display', 'none');

    $( "#provides_vendor_enabled_dialog" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    }  );
    var current_client_name = $("#client_name").val()
     $("#span_provides_vendors_client_name").html( current_client_name )
    $("#span_vendor_name").html( current_vendor_name )
    $("#span_related_vendor_email").html( vendor_email )
    $("#span_related_vendor_website").html( vendor_website )
    $("#span_provides_vendors_cv_active_status_label").html( provides_vendors_cv_active_status_label )
    $("#span_provides_vendors_cv_active_status").html( provides_vendors_cv_active_status )

    // $("#span_provides_vendors_active_status_label").html( provides_vendors_active_status_label )
    $("#hidden_related_vendor_id").val( related_vendor_id )


    if ( provides_vendors_cv_active_status == "P" ) {          // -- P-Provides; N-Does Not Provides
        $("#div_set_vendors_status_provides").css("display","none")
        $("#div_set_vendors_status_not_provides").css("display","block")
    }

    if ( provides_vendors_cv_active_status == "N" ) {
        $("#div_set_vendors_status_provides").css("display","block")
        $("#div_set_vendors_status_not_provides").css("display","none")
    }

}

function setProvidesVendorStatus(new_status) {
    var provides_vendor_id= $("#hidden_related_vendor_id").val()
    var href= base_url+"sys-admin/clients_set_vendors_status_status/client_id/"+client_id+"/provides_vendor_id/"+provides_vendor_id+"/new_status/"+new_status
    $.ajax({
        url: href,
        type: 'POST',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                $('#provides_vendor_enabled_dialog').modal('hide');
                load_provides_vendors(1)
            }
        }
    });
}


/**********************
 * In pagination by click on item on header link to sort listing by clicked column
 * access public
 * params : field name to sort, sort direction
 * return none
 *********************************/
function providesVendorsSortingClick(field_title, sort_field_name, sort_direction) {
    alert( "providesVendorsSortingClick field_title::"+var_dump(field_title) )
    var current_sort_field_name= $("#provides_vendors_sort_field_name").val()
    var current_sort_direction= $("#provides_vendors_sort_direction").val()

    if ( current_sort_field_name == sort_field_name ) {
        if ( current_sort_direction == 'asc' ) {
            sort_direction = 'desc'
        }
        if ( current_sort_direction == 'desc' ) {
            sort_direction = 'asc'
        }
    }

    $("#provides_vendors_sort_field_name").val(sort_field_name)
    if ( typeof sort_direction == "undefined" ) {
        sort_direction = 'asc'
    }

    $("#provides_vendors_sort_direction").val(sort_direction)
    load_related_users(1)
}

/*  PROVIDED VENDORS BLOCK END */

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

function client_phone_typeOnChange() {
    var client_phone_type= $("#client_phone_type").val()
    // alert( "client_phone_typeOnChange::" + client_phone_type )
    if ( client_phone_type == "-add_new-" ) {
        $("#span_new_client_phone_type").css("display", "inline")
    } else {
        $("#span_new_client_phone_type").css("display", "none")
    }
    $("#new_client_phone_type").focus()
}

function AddDDLBItem( FieldName, id, text) {
    var ddlbObj= document.getElementById(FieldName);
    var OptObj = document.createElement("OPTION");
    OptObj.value= id;
    OptObj.text= text;
    ddlbObj.options.add(OptObj);
    return OptObj;
}

function SetDDLBActiveItem( FieldName, Value) {
    var ddlbObj= document.getElementById(FieldName);
    if ( !ddlbObj ) alert("Error::"+FieldName )
    for(var I=0;I<ddlbObj.options.length;I++) {
        //alert( ddlbObj.options[I].value+"::"+Value )
        if ( ddlbObj.options[I].value == Value ) {
            //alert("INSIDE: "+I)
            ddlbObj.options[I].selected = true;
            return;
        }
    }
}
