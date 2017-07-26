
// jQuery(document).ready(function ($) {
//     alert("users.jsbase_ur"+base_ur )
// });

$('[data-toggle="tooltip"]').tooltip()

/**********************
 * clear all inputs on form with editable_field class
 * access public
 * return none
 *********************************/
function clearAllData() {
    $('.editable_field').each(function () {
        var type = this.type || this.tagName.toLowerCase();
        var className= $(this).attr('class')
        var is_datepicker= $(this).hasClass("datepicker")
        var is_chosen_select= $(this).hasClass("chosen-select")
        if ( type == "text" ) {
            if ( is_datepicker ) {
                $(this).val("").datepicker('update')
            } else {
                $(this).val("")
            }
        }
        if ( type == "select-one" ) {
            $(this).val("")
        }
        if ( type == "file" ) {
            $(this).val("")
        }
        if ( type == "textarea" ) {
            $(this).html("");
        }
        if ( type == "checkbox" ) {
            $(this).prop('checked', false);
        }
        if ( type == "radio" ) {
            $(this).prop('checked', false);
        }
        if ( type == "select-multiple" && is_chosen_select ) {
            $(this).val("Select");
            $(this).trigger("chosen:updated");
        }
    });
}

/**********************
 * clicking on "Filter" button in users View page filters popup dialog is opened and inputs are filled from "hidden_" hidden inputs of form and date initialization
 * access public
 * return none
 *********************************/
function usersListFilterApplied( ) {
    alert( "javascript:usersListFilterApplied();::"+var_dump(1) )
    //$('.tooltip-inner').css('display', 'none');

    $( "#users_list_dialog_filter" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    }  );
    $("#filter_username").val( jQuery.trim($("#hidden_filter_username").val()) )
    $("#filter_user_status").val( jQuery.trim($("#hidden_filter_user_status").val()) )
    $("#filter_zip").val( jQuery.trim($("#hidden_filter_zip").val()) )
    $("#filter_user_group_id").val( jQuery.trim($("#hidden_filter_user_group_id").val()) )

    $("#filter_created_at_from").css("display", "block")
    $("#filter_created_at_till").css("display", "block")

    $("#filter_created_at_from").val($("#hidden_filter_created_at_from_formatted").val())
    $("#filter_created_at_till").val($("#hidden_filter_created_at_till_formatted").val())


    $('#filter_created_at_from').pickadate( { // http://amsul.ca/pickadate.js/date/  lib is used, which is very good in different devices
        formatSubmit: 'yyyy-mm-dd',
        format: 'd mmmm, yyyy',
        hiddenName: true,
    })
    $('#filter_created_at_till').pickadate( {
        formatSubmit: 'yyyy-mm-dd',
        format: 'd mmmm, yyyy',
        hiddenName: true
    })
}


/**********************
 * In filters popup dialog clicking on "submit " button entered values are written into "hidden_" hidden inputs of form and the form is submitted reropened with filters applied
 * access public
 * return none
 *********************************/
function usersListMakeFilterDialogSubmit() {
    $("#hidden_filter_username").val( jQuery.trim($("#filter_username").val()) )
    $("#hidden_filter_user_status").val( jQuery.trim($("#filter_user_status").val()) )
    $("#hidden_filter_zip").val( jQuery.trim($("#filter_zip").val()) )
    $("#hidden_filter_user_group_id").val( jQuery.trim($("#filter_user_group_id").val()) )

    var from_root_obj= $("#filter_created_at_from_root")
    var till_root_obj= $("#filter_created_at_till_root")


    var from_formatted_hidden= from_root_obj.next();
    if ( (typeof from_formatted_hidden != "object") ) {
        alert( "Invalid From Date ! " )
        return;
    }

    var till_formatted_hidden= till_root_obj.next();
    if ( (typeof till_formatted_hidden != "object") ) {
        alert( "Invalid Till Date ! " )
        return;
    }
    $("#hidden_filter_created_at_from").val( from_formatted_hidden.val() )
    $("#hidden_filter_created_at_till").val( till_formatted_hidden.val() )

    $("#page_number").val(1)
    var theForm = document.getElementById("form_users");
    theForm.submit();
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
	var searchFields = [];
	var url = base_url+"sys-admin/users/getAutocompleteNames";

	$.ajax({
		url: url, 
		success: function(result){
			var data = JSON.parse(result);
			for(var i=0; i < data.length; i++){
				if(data[i].first_name){
					searchFields.push(data[i].first_name);
				}
				if(data[i].last_name){
					searchFields.push(data[i].last_name);
				}
				if(data[i].username){
					var str = data[i].username;
					searchFields.push(str.trim());
				}
				if(data[i].email){
					searchFields.push(data[i].email);
				}
				
			}
			
		}
	});
	
	$("#autocomplete").autocomplete({ source: searchFields });