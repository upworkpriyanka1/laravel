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
				<?php if ( count($cms_items) == 0 ) : ?>
					<div class="row">
						<button type="button" class="btn btn-error btn-lg btn-block"><?= lang('table_no_data') ?></button>
					</div>
				<?php endif; ?>

				<div class="table-toolbar table_info">
					<?php if ( count($cms_items) > 0 ) { ?>
						<?= count($cms_items); ?>&nbsp;Row<?php if ( count($cms_items) > 1 ) { ?>s<?php } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
					<?php } ?>
					<button type="button" class="btn sbold green waves-effect tooltipped waves-light btn-sm pull_right_only_on_xs padding_right_sm" onclick="javascript:cms_itemsListFilterApplied();" data-position="top" data-tooltip="Open dialog window to set filter for Cms_items. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
					<button type="button" class="btn sbold green waves-effect waves-light btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/cms_items/cms_items-edit/new<?=$page_parameters_with_sort ?>'" ><i class="glyphicon glyphicon-plus"></i></button>
				</div>

				<div class="clear">&nbsp;</div>
				<?php if ( count($cms_items) > 0 ) : ?>
					<div class="table-responsive">

						<table class="table table-striped table-bordered table-hover  order-column" id="cms_items_listing">
							<thead>
							<tr>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/cms_items/cms_items-view', $page_parameters_without_sort, lang('ci_title'), "ci_title", $sort_direction, $sort ) ?></th>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/cms_items/cms_items-view', $page_parameters_without_sort, lang('ci_alias'), "ci_alias", $sort_direction, $sort ) ?></th>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/cms_items/cms_items-view', $page_parameters_without_sort, lang('ci_page_type'), "ci_page_type", $sort_direction, $sort ) ?></th>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/cms_items/cms_items-view', $page_parameters_without_sort, lang('ci_published'), "ci_published", $sort_direction, $sort ) ?></th>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/cms_items/cms_items-view', $page_parameters_without_sort, lang('ci_created_at'), "ci_created_at", $sort_direction, $sort ) ?></th>
							</tr>
							</thead>
							<tbody>
							<?php if (isset($cms_items) && count($cms_items)>0){
								foreach($cms_items as $row){?>
									<tr>
										<td>
											<a class="a_link" href="<?= base_url($this->uri->segment(1).'/cms_items/cms_items-edit/'.$row->ci_id);?><?= $page_parameters_with_sort ?>">
												<?php echo $row->ci_title;?>
											</a>
										</td>
										<td><?php echo $row->ci_alias;?></td>
										<td><?php echo $ci->common_lib->get_cms_items_page_type_label($row->ci_page_type);?></td>
										<td><?php echo $ci->common_lib->get_cms_items_ci_published_label($row->ci_published);?></td>
										<td><?php echo $ci->common_lib->format_datetime( $row->ci_created_at) ?></td>

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
<div class="modal fade" id="cms_items_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="padding-right: 20px;">
			<section class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<div class="modal-title">Cms_items&nbsp;Filter&nbsp;Setup</div>
			</section>

			<section class="modal-body">
				<form role="form" class="form-horizontal" id="form_cms_items" name="form_cms_items" method="post"  enctype="multipart/form-data" >

					<input type="hidden" id="page_number" name="page_number" value="1">
					<input type="hidden" id="hidden_filter_vn_name" name="filter_vn_name" value="<?= $filter_vn_name ?>">
					<input type="hidden" id="hidden_filter_cms_item_type_id" name="filter_cms_item_type_id" value="<?= $filter_cms_item_type_id ?>">
					<input type="hidden" id="hidden_filter_created_at_from" name="filter_created_at_from" value="<?= $filter_created_at_from ?>">
					<input type="hidden" id="hidden_filter_created_at_till" name="filter_created_at_till" value="<?= $filter_created_at_till ?>">
					<input type="hidden" id="hidden_filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?= $filter_created_at_from_formatted ?>">
					<input type="hidden" id="hidden_filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?= $filter_created_at_till_formatted ?>">

					<div class="row">
						<div class="form-group" >
							<label class="col-xs-12 col-sm-4 control-label" for="filter_vn_name">Cms_item name</label>
							<div class="col-xs-12 col-sm-8">
								<input class="form-control editable_field" value="" id="filter_vn_name" type="text" size="20" maxlength="100">
							</div>
						</div>
					</div>


					<div class="row">
						<div class="form-group" >
							<label class="col-xs-12 col-sm-4 control-label" for="filter_cms_item_type_id">Cms_item Type</label>
							<div class="col-xs-12 col-sm-8">
								<select id="filter_cms_item_type_id"  class="form-control editable_field">
									<option value="">  -Select All-  </option>
									<?php foreach( $cms_item_TypesSelectionList as $next_key=>$next_Cms_item_Type ) { ?>
										<option value="<?= $next_Cms_item_Type['key'] ?>" ><?= $next_Cms_item_Type['value'] ?></option>
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
					<button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:cms_itemsListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
					<button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
					&nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
						<i class=" 	fa fa-square-o"></i>
					</a>
				</div>
			</section>
		</div>
	</div>
</div>