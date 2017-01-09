<?php $ci = &get_instance();
echo link_tag('assets/global/plugins/picker/classic.css');
echo link_tag('assets/global/plugins/picker/classic.date.css');
?>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-body">

                <?= $this->common_lib->show_info($editor_message) ?>

				<div class="clear">&nbsp;</div>
				<?php if ( count($vendor_types) == 0 ) : ?>
					<div class="row">
						<button type="button" class="btn btn-error btn-lg btn-block"><?= lang('table_no_data') ?></button>
					</div>
				<?php endif; ?>

				<div class="table-toolbar table_info">
					<?php if ( count($vendor_types) != 0 ) { ?>
						<?= count($vendor_types); ?>&nbsp;Row<?php if ( count($vendor_types) > 1 ) { ?>s<?php } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)&nbsp;
					<?php } ?>
					<button type="button" class="btn sbold blue waves-effect waves-light btn-sm pull_right_only_on_xs padding_right_sm tooltipped" onclick="javascript:vendorTypesListFilterApplied();" data-position="top" data-tooltip="Open dialog window to set filter for vendor types. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?>" data-original-title="Open dialog window to set filter for vendor types. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?>"><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
					<button type="button" class="btn sbold blue waves-effect waves-light btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/vendors/vendor-types-edit/new<?=$page_parameters_with_sort ?>'" >ADD</button>
				</div>
				<div class="clear">&nbsp;</div>
				<?php if ( count($vendor_types) > 0 ) : ?>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover  order-column" id="vendor_types_listing">
							<thead>
							<tr>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendor-types-view', $page_parameters_without_sort, lang('vt_name'), "vt_name", $sort_direction, $sort ) ?></th>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/vendors/vendor-types-view', $page_parameters_without_sort, lang('created_at'), "created_at", $sort_direction, $sort ) ?></th>
								<th><i class="fa fa-pencil"></i></th>
								<th><i class="fa fa-remove"></i></th>
							</tr>
							</thead>
							<tbody>
							<?php if (isset($vendor_types) && count($vendor_types)>0){
								foreach($vendor_types as $row){?>
									<tr>

										<td>
											<?php echo $row->vt_name;?>
											<?php if (!empty($row->vendors_count) ) :  ?>
												<span class="details_info">, used by <?php echo $row->vendors_count ?> <a class="a_link" href=" <?= base_url() ?>/sys-admin/vendors/vendors-view/page_number/1/filter_vendor_type_id/<?php echo $row->vt_id?>">vendor(s)</a></span>
											<?php endif ?>
										</td>
										<td><?php echo $ci->common_lib->format_datetime( $row->created_at) ?></td>
										<td>
											<a class="btn blue waves-effect waves-light" href="<?= base_url($this->uri->segment(1).'/vendors/vendor-types-edit/'.$row->vt_id);?><?= $page_parameters_with_sort ?>">
												<i class="fa fa-pencil"></i>
											</a>
										</td>
										<td>
											<?php if (empty($row->vendors_count) ) :  ?>
												<a class="btn btn-sm blue" class="a_link" onclick="javascript:vendor_typeRemove(<?php echo $row->vt_id?>, '<?php echo $row->vt_name ?>' )" ><i class="fa fa-remove"></i>
												</a>
											<?php endif ?>
										</td>
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