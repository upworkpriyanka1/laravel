var init_clientsTable = function () {

    var table = $('#clients');

    // begin first table
    table.dataTable({
        //ajax: '<?php echo current_url();?>',
        dom : 'Bflrtip',
        buttons : [
        { extend: 'print', className: 'btn dark btn-outline', text: table_print }, //0
        { extend: 'copy', className: 'btn red btn-outline', text: table_copy },//2
        { extend: 'pdf', className: 'btn green btn-outline', text: table_pdf },//3
        { extend: 'excel', className: 'btn yellow btn-outline', text: table_excel },//5
        { extend: 'csv', className: 'btn purple btn-outline', text: table_csv }
        //'colvis'


    ],

    // Translations
    "language": {
        // buttons: {
        //     copyTitle: 'Ajouté au presse-papiers',
        //     copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les données du tableau à votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
        //     copySuccess: {
        //         _: 'Copiés %d rangs',
        //         1: 'Copié 1 rang'
        //     }
        // },
        "emptyTable": table_no_data,
        "info": table_showing_x_records,
        "infoEmpty": table_no_records,
        "infoFiltered": table_filtered_from_x_records,
        "lengthMenu": table_show_menu,
        "search": table_search,
        "zeroRecords": table_no_result,
        "paginate": {
            "previous": table_prev,
            "next": table_next,
            "last": table_last,
            "first": table_first,
        }//end paginate
    }, //end langauge
"autoWidth": false,
        // Or you can use remote translation file
        //"language": {
        //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
        //},

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
        // So when dropdowns used the scrollable div should be removed.
        //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.



        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,
        "columnDefs": [{  // set default column settings
            'orderable': false,
            'targets': [4]
        }, {
            "searchable": false,
            "targets": [4]
        }],
        "order": [
            [1, "asc"]
        ] // set first column as a default sort by asc

    }); //end datatable

}//end init


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

function dialogAddNewClient() {
    $( "#create-contact" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    } );
}
/**********************
 * clicking on "Filter" button in clients View page filters popup dialog is opened and inputs are filled from "hidden_" hidden inputs of form and date initialization
 * access public
 * return none
 *********************************/
function clientsListFilterApplied( ) {
    //$('.tooltip-inner').css('display', 'none');

    $( "#clients_list_dialog_filter" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    } );
    $("#filter_client_name").val( jQuery.trim($("#hidden_filter_client_name").val()) )
    $("#filter_client_type").val( jQuery.trim($("#hidden_filter_client_type").val()) )
    $("#filter_client_active_status").val( jQuery.trim($("#hidden_filter_client_active_status").val()) )
    $("#filter_client_zip").val( jQuery.trim($("#hidden_filter_client_zip").val()) )

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
function clientsListMakeFilterDialogSubmit() {
    $("#hidden_filter_client_name").val( jQuery.trim($("#filter_client_name").val()) )
    $("#hidden_filter_client_active_status").val( $("#filter_client_active_status").val() )
    $("#hidden_filter_client_type").val( jQuery.trim($("#filter_client_type").val()) )
    $("#hidden_filter_client_zip").val( jQuery.trim($("#filter_client_zip").val()) )

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
    var theForm = document.getElementById("form_clients");
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
