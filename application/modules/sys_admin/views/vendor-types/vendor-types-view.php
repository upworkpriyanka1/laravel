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
                    <h3 class="page-title"><?=lang('vendor-types-view')?></h3>
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <? if ( count($vendor_types) == 0 ) : ?>
                    <div class="row" style="margin: 5px 0 5px 0;">
                        <button type="button" class="btn btn-error btn-lg btn-block"><?= lang('table_no_data') ?></button>
                    </div>
                <? endif; ?>

                <div class="table-toolbar table_info">
                    <? if ( count($vendor_types) > 0 ) { ?>
                        <?= count($vendor_types); ?>&nbsp;Row<? if ( count($vendor_types) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
                    <? } ?>

                    <button type="button" class="btn sbold green btn-sm pull_right_only_on_xs padding_right_sm" onclick="javascript:vendorTypesListFilterApplied();" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Open dialog window to set filter for vendor types. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
                    <button type="button" class="btn sbold green btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/vendors/vendor-types-edit/new<?=$page_parameters_with_sort ?>'" ><i class="glyphicon glyphicon-plus"></i></button>

                </div>

                <? if ( count($vendor_types) > 0 ) : ?>
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover  order-column" id="vendor_types_listing">
                        <thead>
                        <tr>

                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendor-types-view', $page_parameters_without_sort, lang('vt_name'), "vt_name", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendor-types-view', $page_parameters_without_sort, lang('created_at'), "created_at", $sort_direction, $sort ) ?></th>
                            <th><i class="fa fa-pencil"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($vendor_types) && count($vendor_types)>0){
                            foreach($vendor_types as $row){?>
                                <tr>

                                    <td><?php echo $row->vt_name;?></td>
                                    <td><?php echo $ci->common_lib->format_datetime( $row->created_at) ?></td>
                                    <td><a class="btn btn-sm blue" href="<?= base_url($this->uri->segment(1).'/vendors/vendor-types-edit/'.$row->vt_id);?><?= $page_parameters_with_sort ?>">
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
<div class="modal fade" id="vendor_types_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Vendor Types&nbsp;Filter&nbsp;Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_vendor_types" name="form_vendor_types" method="post"  enctype="multipart/form-data" >

                    <input type="hidden" id="page_number" name="page_number" value="1">
                    <input type="hidden" id="hidden_filter_vt_name" name="filter_vt_name" value="<?= $filter_vt_name ?>">
                    <input type="hidden" id="hidden_filter_created_at_from" name="filter_created_at_from" value="<?= $filter_created_at_from ?>">
                    <input type="hidden" id="hidden_filter_created_at_till" name="filter_created_at_till" value="<?= $filter_created_at_till ?>">
                    <input type="hidden" id="hidden_filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?= $filter_created_at_from_formatted ?>">
                    <input type="hidden" id="hidden_filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?= $filter_created_at_till_formatted ?>">

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_vt_name">Vendor Type</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_vt_name" type="text" size="20" maxlength="100">
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
                    <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:vendorTypesListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
                    &nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
                        <i class=" 	fa fa-square-o"></i>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>