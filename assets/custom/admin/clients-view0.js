var TableDatatablesManaged = function () {

    var initTable1 = function () {

        var table = $('#clients');

        // begin first table
        table.dataTable({
            //ajax: '<?php echo current_url();?>',
            "sRowSelect": "multi",
            dom : 'Bflrtip',
            buttons : [
            { extend: 'print', className: 'btn dark btn-outline' }, //0
            {extend: 'print', //1
                text: 'PDF selected',
                className: 'hidden',
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        selected: true
                    }
                }
            },
            { extend: 'copy', className: 'btn red btn-outline' },//2
            { extend: 'pdf', className: 'btn green btn-outline' },//3
            {extend: 'pdf', //4
                text: 'PDF selected',
                className: 'hidden',
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        selected: true
                    }
                }
            },
            { extend: 'excel', className: 'btn yellow btn-outline ' },//5
            {extend: 'excelHtml5', //6
                text: 'Excel selected',
                className: 'hidden',
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        selected: true
                    }
                }
            },
            { extend: 'csv', className: 'btn purple btn-outline ' },//7
            { extend: 'colvis', className: 'test', text: 'Columns'}
            //'colvis'

            
        ],
        
            select: true,
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            "fnStateSave": function(oSettings, oData) { save_dt_view(oSettings, oData); },
            "fnStateLoad": function(oSettings) { return load_dt_view(oSettings); },

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            //"pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
            
        }); //end datatable
        function save_dt_view (oSettings, oData) {
localStorage.setItem( 'DataTables_'+window.location.pathname, JSON.stringify(oData) );
}
function load_dt_view (oSettings) {
return JSON.parse( localStorage.getItem('DataTables_'+window.location.pathname) );
}
function reset_dt_view() {
localStorage.removeItem('DataTables_'+window.location.pathname);
}
        var tableWrapper = jQuery('#clients_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                    $(this).parents('tr').indeterminate = true;
                    //var oTT = TableTools.fnGetInstance( 'companies' );
                    //$(this).parents('tr').raddClass('selected');
                    //$(nodes[i]).addClass('DTTT_selected');
                    //TableTools.fnGetInstance('oTable').s.select.selected.push(nodes[i]);
                    //oTT.fnSelect( $('#companies tbody tr').$(this).parents('tr') );
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
        $('#selected_actions > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            table.DataTable().button(action).trigger();

            
        });
    }//end init



    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();


        }

    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
}
