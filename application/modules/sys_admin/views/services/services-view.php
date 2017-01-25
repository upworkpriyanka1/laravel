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
                    <!--<h3 class="page-title"><?=lang('services-view')?></h3>-->
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <? if ( count($services) == 0 ) : ?>
                    <div class="row" style="margin: 5px 0 5px 0;">
                        <button type="button" class="btn btn-error btn-lg btn-block"><?= lang('table_no_data') ?></button>
                    </div>
                <? endif; ?>

                <div class="table-toolbar table_info">
                    <? if ( count($services) > 0 ) { ?>
                        <?= count($services); ?>&nbsp;Row<? if ( count($services) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
                    <? } ?>

                    <button type="button" class="btn sbold green btn-sm pull_right_only_on_xs padding_right_sm" onclick="javascript:servicesListFilterApplied();" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Open dialog window to set filter for Services. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
                    <button type="button" class="btn sbold green  btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/services/services-edit/new<?=$page_parameters_with_sort ?>'" ><i class="glyphicon glyphicon-plus"></i></button>
                </div>

                <? if ( count($services) > 0 ) : ?>
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover  order-column" id="services_listing">
                            <thead>
                            <tr>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/services/services-view', $page_parameters_without_sort, lang('sv_title'), "sv_title", $sort_direction, $sort ) ?></th>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/services/services-view', $page_parameters_without_sort, lang('sv_active_status'), "sv_active_status", $sort_direction, $sort ) ?></th>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/services/services-view', $page_parameters_without_sort, lang('vt_name'), "vt_name", $sort_direction, $sort ) ?></th>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/services/services-view', $page_parameters_without_sort, lang('sv_description'), "sv_description", $sort_direction, $sort ) ?></th>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/services/services-view', $page_parameters_without_sort, lang('created_at'), "created_at", $sort_direction, $sort ) ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($services) && count($services)>0){
                                foreach($services as $row){?>
                                    <tr>

                                        <td>
                                            <a class="a_link" href="<?= base_url($this->uri->segment(1).'/services/services-edit/'.$row->sv_id);?><?= $page_parameters_with_sort ?>">
                                                <?php echo $row->sv_title;?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $this->common_lib->get_service_active_status_label($row->sv_active_status); ?>
                                        </td>
                                        <td><?php echo $row->vt_name ?></td>
                                        <td><?php echo $this->common_lib->concatStr($row->sv_description); ?></td>
                                        <td><?php echo $ci->common_lib->format_datetime( $row->created_at) ?></td>
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
                <? endif; ?>

            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>


<!-- Popup dialog for filtering set -->
<div class="modal fade" id="services_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Services&nbsp;Filter&nbsp;Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_services" name="form_services" method="post"  enctype="multipart/form-data" >

                    <input type="hidden" id="page_number" name="page_number" value="1">
                    <input type="hidden" id="hidden_filter_sv_title" name="filter_sv_title" value="<?= $filter_sv_title ?>">
                    <input type="hidden" id="hidden_filter_vendor_type_id" name="filter_vendor_type_id" value="<?= $filter_vendor_type_id ?>">
                    <input type="hidden" id="hidden_filter_active_status" name="filter_active_status" value="<?= $filter_active_status ?>">
                    <input type="hidden" id="hidden_filter_created_at_from" name="filter_created_at_from" value="<?= $filter_created_at_from ?>">
                    <input type="hidden" id="hidden_filter_created_at_till" name="filter_created_at_till" value="<?= $filter_created_at_till ?>">
                    <input type="hidden" id="hidden_filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?= $filter_created_at_from_formatted ?>">
                    <input type="hidden" id="hidden_filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?= $filter_created_at_till_formatted ?>">

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_sv_title">Service name</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_sv_title" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_vendor_type_id"><?=lang('vendor-types')?></label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_vendor_type_id"  class="form-control editable_field">
                                    <option value="">  -Select All-  </option>
                                    <?php foreach( $vendor_TypesSelectionList as $next_key=>$next_Vendor_Type ) { ?>
                                        <option value="<?= $next_Vendor_Type['key'] ?>" ><?= $next_Vendor_Type['value'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_active_status"><?=lang('sv_active_status')?></label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_active_status"  class="form-control editable_field">
                                    <option value="">  -Select All-  </option>
                                    <?php foreach( $service_ActiveStatusList as $next_key=>$next_Service_Active_Status ) { ?>
                                        <option value="<?= $next_Service_Active_Status['key'] ?>" ><?= $next_Service_Active_Status['value'] ?></option>
                                    <?php } ?>
                                </select>
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
                    <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:servicesListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
                    &nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
                        <i class=" 	fa fa-square-o"></i>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>