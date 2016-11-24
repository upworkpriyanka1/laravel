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

function clientsListFilterApplied() {
    alert( "clientsListFilterApplied 1::"+var_dump(1) )
}

function onSubmit(IsReopen) {
    var theForm = $("#form_category_edit");
    alert( "onSubmit theForm::"+var_dump(theForm) )
    $("#is_reopen").val(IsReopen)
    theForm.submit();
}

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip()
    // init_clientsTable();
});


function clearAllData() {
    $('.editable_field').each(function () {
        var type = this.type || this.tagName.toLowerCase();
        var className= $(this).attr('class')
        var is_datepicker= $(this).hasClass("datepicker")
        var is_chosen_select= $(this).hasClass("chosen-select")
        //alert( "this ::"+(typeof this)+"  type::"+type + " id:"+ $(this).id + " ??? className:"+ className + " !  type:"+ $(this).attr("type")  + " ++Type:"+ $(this).attr('type') +" value::"+ $(this).val() +"  :  "+ var_dump($(this)))
        //alert( "is_datepicker::"+is_datepicker + "  is_chosen_select::"+is_chosen_select)
        //alert( "context::"+var_dump($(this.context)) )

        // className:datepicker form-control editable_field
        // className:form-control chosen-select editable_field
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
            //alert( "select-multiple this::"+var_dump(this) )
            $(this).val("Select");
            $(this).trigger("chosen:updated");
        }
    });
    // $('#datepicker').val('').datepicker('update');
}

function clientsListMakeFilterDialogSubmit() {
    $("#hidden_filter_client_name").val( jQuery.trim($("#filter_client_name").val()) )
    $("#hidden_filter_client_is_active").val( $("#filter_client_is_active").val() )
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

function clientsListFilterApplied( ) {
    $('.tooltip-inner').css('display', 'none');

    $( "#clients_list_dialog_filter" ).modal(  {
        "backdrop": "static",
        "keyboard": true,
        "show": true
    }  );
    // $('#clients_list_dialog_filter').on('hidden.bs.modal', function () {
    //     $(".datepicker").css('display', 'none');
    //     $(".datepicker-days").css('display', 'none');
    // })
    $("#filter_client_name").val( jQuery.trim($("#hidden_filter_client_name").val()) )
    $("#filter_client_type").val( jQuery.trim($("#hidden_filter_client_type").val()) )
    $("#filter_client_is_active").val( jQuery.trim($("#hidden_filter_client_is_active").val()) )
    $("#filter_client_zip").val( jQuery.trim($("#hidden_filter_client_zip").val()) )

    $("#filter_created_at_from").css("display", "block")
    $("#filter_created_at_till").css("display", "block")

    $("#filter_created_at_from").val($("#hidden_filter_created_at_from_formatted").val())
    $("#filter_created_at_till").val($("#hidden_filter_created_at_till_formatted").val())


    $('#filter_created_at_from').pickadate( {
        formatSubmit: 'yyyy-mm-dd',
        format: 'd mmmm, yyyy',
        hiddenName: true,
    })       // http://amsul.ca/pickadate.js/date/
    $('#filter_created_at_till').pickadate( {
        formatSubmit: 'yyyy-mm-dd',
        format: 'd mmmm, yyyy',
        hiddenName: true
    })
}


function deleteClient( base_url, id, client_name, PageParametersWithSort ) {

    $.confirm({
        icon: 'glyphicon glyphicon-signal',
        title: 'Confirm!',
        content: "Do you want to delete '" + client_name + "' client with all related data ?",
        confirmButton: 'YES',
        cancelButton: 'Cancel',
        confirmButtonClass: 'btn-info',
        cancelButtonClass: 'btn-danger',
        keyboardEnabled: true,
        confirm: function(){
            document.location = base_url+"admin/client/delete/" + id + PageParametersWithSort
        }
    });
}



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
