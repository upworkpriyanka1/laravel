<?php $ci = &get_instance();
echo link_tag('assets/global/plugins/picker/classic.css');
echo link_tag('assets/global/plugins/picker/classic.date.css');

?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">

                <div class="page-bar">
                    <!--<h3 class="page-title"><?=lang('clients-view')?></h3>-->
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <div class="table-toolbar table_info">
                    <? if ( count($clients) > 0 ) { ?>
                        <?= count($clients); ?>&nbsp;Row<? if ( count($clients) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
                    <? } ?>

                    <button type="button" class="btn btn-filter btn-default btn-sm pull_right_only_on_xs padding_right_sm " onclick="javascript:clientsListFilterApplied();" data-target="#clients_list_dialog_filter"  data-delay="50" data-toggle="modal" title="" data-original-title="Open dialog window to set filter for Clients. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
	                <button type="button" class="btn btn-plus sbold btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/clients-edit/new<?=$page_parameters_with_sort ?>'" ><i class="glyphicon glyphicon-plus"></i></button>

                </div>

                <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover  order-column" id="clients_listing">
                    <thead>
                        <tr>

                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('client_name'), "client_name", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('client_owner'), "client_owner", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('client_active_status'), "client_active_status", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('phone'), "client_phone", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('clients-type'), "type_description", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('created_at'), "created_at", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('updated_at'), "updated_at", $sort_direction, $sort ) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($clients) && count($clients)>0){
                		    foreach($clients as $row){?>
                        <tr>


                            <td>
                                <a class="a_link" href="<?= base_url($this->uri->segment(1).'/clients-edit/'.$row->cid);?>/<?= $page_parameters_with_sort ?>">
                                    <?php echo $row->client_name;?>
                                </a>
                            </td>
                            <td>
                                <a href="mailto:<?php echo $row->client_email;?>"> <?php echo $row->client_owner;?> </a>
                            </td>
                            <td><?php echo $this->common_lib->get_client_active_status_label($row->client_active_status);?>  </td>
                            <td><?php echo $row->client_phone;?>  </td>
                            <td><?php echo $row->type_description;?></td>
                            <td><?php echo $ci->common_lib->format_datetime( $row->created_at) ?></td>
                            <td><?php echo $ci->common_lib->format_datetime( $row->updated_at ) ?></td>
                        </tr>
                        <?php
                            }//end foreach
                        }//end isset
                        ?>


                    </tbody>
                </table>
                </div>

                <div class="table_pagination">
                <?= $pagination_links;?>
                </div>

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

<!-- Popup dialog for filtering set -->
<div class="modal fade" id="clients_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Clients&nbsp;Filter&nbsp;Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_clients" name="form_clients" method="post"  enctype="multipart/form-data" >

                    <input type="hidden" id="page_number" name="page_number" value="1">
                    <input type="hidden" id="hidden_filter_client_name" name="filter_client_name" value="<?= $filter_client_name ?>">
                    <input type="hidden" id="hidden_filter_client_active_status" name="filter_client_active_status" value="<?= $filter_client_active_status ?>">
                    <input type="hidden" id="hidden_filter_client_type" name="filter_client_type" value="<?= $filter_client_type ?>">
                    <input type="hidden" id="hidden_filter_client_zip" name="filter_client_zip" value="<?= $filter_client_zip ?>">
                    <input type="hidden" id="hidden_filter_created_at_from" name="filter_created_at_from" value="<?= $filter_created_at_from ?>">
                    <input type="hidden" id="hidden_filter_created_at_till" name="filter_created_at_till" value="<?= $filter_created_at_till ?>">
                    <input type="hidden" id="hidden_filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?= $filter_created_at_from_formatted ?>">
                    <input type="hidden" id="hidden_filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?= $filter_created_at_till_formatted ?>">

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_name">Client name</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_client_name" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_active_status">Client Active Status</label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_client_active_status"  class="form-control editable_field">
                                    <option value="">  -Select All-  </option>
                                    <?php foreach( $client_ActiveStatusList as $next_key=>$next_Client_ActiveStatus ) { ?>
                                        <option value="<?= $next_Client_ActiveStatus['key'] ?>" ><?= $next_Client_ActiveStatus['value'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_type">Client Type</label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_client_type"  class="form-control editable_field">
                                    <option value="">  -Select All-  </option>
                                    <?php foreach( $client_TypesSelectionList as $next_key=>$next_Client_Type ) { ?>
                                        <option value="<?= $next_Client_Type['key'] ?>" ><?= $next_Client_Type['value'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_zip">Client zip</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_client_zip" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_created_at_from">Created at from</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field datepicker_input" value="" id="filter_created_at_from" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_created_at_till">Created at till</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field datepicker_input" value="" id="filter_created_at_till" type="text">
                            </div>
                        </div>
                    </div>


                </form>
            </section>

            <section class="modal-footer ">
                <div class="btn-group  pull-right editor_btn_group " role="group" aria-label="group button">
                    <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:clientsListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
                    &nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
                        <i class=" 	fa fa-square-o"></i>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>