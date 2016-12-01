$(document).ready(function ($) {
    load_related_users(1)
    tabInit()
    paginationLinksInit()
});

/**********************
 * In pagination by click on item link to hook the event and run js reloading of users
 * access public
 * params : none, all param of Page # is rid from linked url
 * return none
 *********************************/
function paginationLinksInit() {
    $(document).on('click', "div.table_pagination a",function(){  // LOAD ON PAGE LOAD AND ON CLICK
        var urls = $(this).attr("href");
        if ( urls== "#" ) {
            load_related_users(1)
            return;
        }
        var value_arr = urls.split( '/page_number/' );
        if ( value_arr.length == 2 ) { // we have page number
            load_related_users(value_arr[1])
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
 * params : page_number - witch page must be loaded, the rest of parameters are read from inputs.
 * return none
 *********************************/
function load_related_users(page_number) {
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
    var href= base_url+"sys-admin/clients_edit_load_related_users/filter_client_id/"+client_id+"/filter_related_users_type/"+related_users_type+"/sort/"+sort_field_name+"/sort_direction/"+sort_direction+select_user_active_status + "/page_number/" + page_number + "/filter_related_users_filter/"+related_users_filter
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
 * params : page_number - witch page must be loaded, the rest of parameters are read from inputs.
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
