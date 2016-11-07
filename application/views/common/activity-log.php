<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">

    
                <table class="table table-striped table-bordered table-hover  order-column" id="clients">
                    <thead>
                        <tr>
                            <th> <?= lang('date-time');?> </th>
                            <th> <?= lang('username');?> </th>
                            <th> <?= lang('section');?> </th>
                            <th> <?= lang('action');?> </th>

                            <th> <?= lang('url');?> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($activity) && count($activity)>0){
                		    foreach($activity as $row){?>
                        <tr>
                           <td><?php echo date('Y-d-m H:i:s',$row->activity_time);?></td>
                            <td><?php echo $row->username;?></td>

                            <td> <?php echo $row->section;?>  </td>
                            <td><?php echo $row->action;?></td>

                            <td> <?php echo $row->uri;?>  </td>
                        </tr>
                        <?php
                            }//end foreach
                        }//end isset
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<script>
var table_no_data                   = "<?= lang('table_no_data');?>";
var table_showing_x_records         = "<?= lang('table_showing_x_records');?>";
var table_no_records                = "<?= lang('table_no_records');?>";
var table_filtered_from_x_records   = "<?= lang('table_filtered_from_x_records');?>";
var table_show_menu         = "<?= lang('table_show_menu');?>";
var table_search            = "<?= lang('table_search');?>";
var table_no_result         = "<?= lang('table_no_result');?>";
var table_prev              = "<?= lang('table_prev');?>";
var table_next              = "<?= lang('table_next');?>";
var table_last              = "<?= lang('table_last');?>";
var table_first             = "<?= lang('table_first');?>";

var table_print             = "<?= lang('table_print');?>";
var table_copy              = "<?= lang('table_copy');?>";
var table_pdf               = "<?= lang('table_pdf');?>";
var table_excel             = "<?= lang('table_excel');?>";
var table_csv               = "<?= lang('table_csv');?>";
</script>