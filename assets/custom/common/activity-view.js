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

        "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.



        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 20,
        "columnDefs": [{  // set default column settings
            'orderable': false,
            'targets': [4]
        }, {
            "searchable": false,
            "targets": [4]
        }],
        "order": [
            [0, "desc"]
        ] // set first column as a default sort by asc

    }); //end datatable

}//end init

$(document).ready(function() {
    init_clientsTable();
});

