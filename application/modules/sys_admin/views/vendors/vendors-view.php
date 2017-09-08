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
					<?= $this->common_lib->show_info($editor_message) ?>
				</div>
	            <?php if ( count($vendors) == 0 ) : ?>
                    <div class="row">
                        <button type="button" class="btn btn-error btn-lg btn-block"><?= lang('table_no_data') ?></button>
                    </div>
                <?php endif; ?>

				<?php $this->load->view('../modules/sys_admin/views/table_header'); ?>
                <?php /*?><div class="table-toolbar table_info" >
                	<h4>
	                <?php if ( count($vendors) > 0 ) { ?>
		                <span> <?= count($vendors); ?>&nbsp;Row<?php if ( count($vendors) > 1 ) { ?>s<?php } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)</span>
		            <?php } ?>
                    </h4>
<!--	                <button type="button" class="btn sbold green waves-effect tooltipped waves-light btn-sm pull_right_only_on_xs padding_right_sm" onclick="javascript:vendorsListFilterApplied();" data-position="top" data-tooltip="Open dialog window to set filter for Vendors. --><?//= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?><!-- "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>-->
                    <button type="button" class="btn btn-filter btn-default btn-sm pull_right_only_on_xs padding_right_sm" onclick="javascript:vendorsListFilterApplied();" data-toggle="tooltip" data-html="true" data-position="top" title="" data-original-title="Open dialog window to set filter for Vendors. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>


                    <!--<button type="button" class="btn sbold green waves-effect waves-light btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/vendors/vendors-edit/new<?=$page_parameters_with_sort ?>'" ><i class="glyphicon glyphicon-plus"></i></button> -->
                    <button type="button" class="btn btn-plus sbold btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/vendors/vendors-edit/new<?=$page_parameters_with_sort ?>'" ><i class="glyphicon glyphicon-plus"></i></button>
                </div><?php */?>

	            
                <?php if ( count($vendors) > 0 ) : ?>
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover  order-column" id="vendors_listing">
                        <thead>
                        <tr>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendors-view', $page_parameters_without_sort, lang('vn_name'), "vn_name", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendors-view', $page_parameters_without_sort, lang('vn_email'), "vn_email", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendors-view', $page_parameters_without_sort, lang('vn_description'), "vn_description", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendors-view', $page_parameters_without_sort, lang('created_at'), "created_at", $sort_direction, $sort ) ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($vendors) && count($vendors)>0){
                            foreach($vendors as $row){?>
                                <tr>

                                    <td>
                                        <a class="a_link" href="<?= base_url($this->uri->segment(1).'/vendors/vendors-edit/'.$row->vn_id);?><?= $page_parameters_with_sort ?>">
                                            <?php echo $row->vn_name;?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="mailto:<?php echo $row->vn_email;?>"><?php echo $row->vn_email;?></a>
                                    </td>
                                    <td><?php echo $row->vn_description;?></td>
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
                <?php endif; ?>

            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>


<!-- Popup dialog for filtering set -->
<div class="modal fade" id="vendors_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Vendors&nbsp;Filter&nbsp;Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_vendors" name="form_vendors" method="post"  enctype="multipart/form-data" >

                    <input type="hidden" id="page_number" name="page_number" value="1">
                    <input type="hidden" id="hidden_filter_vn_name" name="filter_vn_name" value="<?= $filter_vn_name ?>">
                    <input type="hidden" id="hidden_filter_vendor_type_id" name="filter_vendor_type_id" value="<?= $filter_vendor_type_id ?>">
                    <input type="hidden" id="hidden_filter_created_at_from" name="filter_created_at_from" value="<?= $filter_created_at_from ?>">
                    <input type="hidden" id="hidden_filter_created_at_till" name="filter_created_at_till" value="<?= $filter_created_at_till ?>">
                    <input type="hidden" id="hidden_filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?= $filter_created_at_from_formatted ?>">
                    <input type="hidden" id="hidden_filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?= $filter_created_at_till_formatted ?>">

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_vn_name">Vendor name</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_vn_name" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_vendor_type_id">Vendor Type</label>
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
                    <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:vendorsListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
                    &nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
                        <i class=" 	fa fa-square-o"></i>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>