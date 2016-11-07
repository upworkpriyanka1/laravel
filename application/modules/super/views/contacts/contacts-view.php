<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">

                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a class="btn sbold green" href="<?= base_url($this->uri->segment(1).'/contacts-add');?>">
                                    <?= lang('add-new');?> <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover  order-column" id="contacts">
                    <thead>
                        <tr>

                            <th> <?= lang('name');?> </th>
                            <th> <?= lang('email');?> </th>
                            <th> <?= lang('phone');?> </th>
                            <th> <?= lang('contact-type');?> </th>
                            <th><i class="fa fa-pencil"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($contacts) && count($contacts)>0){
                		    foreach($contacts as $row){?>
                        <tr>

                            <td><?php echo $row->contact_name;?></td>
                            <td>
                                <a href="mailto:<?php echo $row->contact_email;?>"> <?php echo $row->contact_email;?> </a>
                            </td>
                            <td> <?php echo $row->contact_phone;?>  </td>
                            <td><?php echo $row->con_type_name;?></td>
                            <td><a class="btn btn-sm blue" href="<?= base_url($this->uri->segment(1).'/contacts-edit/'.$row->contact_id);?>">
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