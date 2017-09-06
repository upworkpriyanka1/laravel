<!-- <pre><?php print_r($users) ?></pre> -->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">

                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a class="btn sbold green" href="<?= base_url($this->uri->segment(1).'/users-add');?>">
                                    <?= lang('add-new');?> <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover  order-column" id="users">
                    <thead>
                        <tr>
                            <th><?= $this->common_lib->showListHeaderItem ( '/super/users-view', $page_parameters_without_sort, lang('user'), "users.username", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/super/users-view', $page_parameters_without_sort, lang('job-title'), "type_description", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/super/users-view', $page_parameters_without_sort, lang('phone'), "phone", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/super/users-view', $page_parameters_without_sort, lang('status'), "uc_active_status", $sort_direction, $sort ) ?></th>
                            <th><i class="fa fa-pencil"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($users) && count($users)>0){
                		    foreach($users as $row){ ?>
                        <tr>

                            <td><?php echo $row->username;?></td>
                            <td><?php echo $row->type_description;?></td>
                            <td> <?php echo $row->phone;?>  </td>
                            <td> <?php echo /*$row->uc_active_status .' : '.*/$this->clients_mdl->getClientStatusLabel($row->uc_active_status) ?>  </td>

                            <td><a class="btn btn-sm blue" href="<?= base_url($this->uri->segment(1).'/users-edit/'.$row->UserID);?>">
                                <i class="fa fa-pencil"></i>
                            </a></td>
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