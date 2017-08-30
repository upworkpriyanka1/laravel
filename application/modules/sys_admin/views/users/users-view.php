<?php $ci = &get_instance();
echo link_tag('assets/global/plugins/picker/classic.css');
echo link_tag('assets/global/plugins/picker/classic.date.css');

?>
<script type="text/javascript">
	/*<![CDATA[*/

	var base_url= '<?= base_url() ?>'

	/*]]>*/
	
	
</script>


<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-body">
				
				<div class="page-bar">
					<!--<h3 class="page-title"><?=lang('users-view')?></h3>-->
					<?= $this->common_lib->show_info($editor_message) ?>
				</div>

				<? if ( count($users) == 0 ) : ?>
					<div class="row" style="margin: 5px 0 5px 0;">
						<button type="button" class="btn btn-error btn-lg btn-block"><?= lang('table_no_data') ?></button>
					</div>
				<? endif; ?>

				<div class="table-toolbar table_info">
					<? if ( count($users) > 0 ) { ?>
						<?= count($users); ?>&nbsp;Row<? if ( count($users) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
					<? } ?>

					<button type="button" class="btn btn-filter btn-default btn-sm pull_right_only_on_xs padding_right_sm" onclick="javascript:usersListFilterApplied();" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Open dialog window to set filter for Users. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
					<span><button type="button" class="btn btn-plus sbold btn-sm pull-right" onclick="javascript:document.location='<?= base_url() ?>sys-admin/users/users-edit/new<?=$page_parameters_with_sort ?>'" ><i class="glyphicon glyphicon-plus"></i></button>
                    
                    <form method="get" action=""><input type="text" placeholder="Enter text to search" name="search" id="autocomplete" /></form>
                     </span>
				</div>

				<? if ( count($users) > 0 ) : ?>
					<div class="table-responsive">

						<table class="table table-striped table-bordered table-hover  order-column" id="users_listing">
							<thead>
							<tr>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('user'), "username", $sort_direction, $sort ) ?></th>
								<th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('client(s)'), "client_name", $sort_direction, $sort ) ?></th>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('status'), "user_status", $sort_direction, $sort ) ?></th>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('title'), "user_group_description", $sort_direction, $sort ) ?></th>
                                <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('created'), "users.created_at", $sort_direction, $sort ) ?></th>
<!--                                <th>--><?//= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('phone'), "phone", $sort_direction, $sort ) ?><!--</th>-->
<!--								<th>--><?//= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('job'), "job_name", $sort_direction, $sort ) ?><!--</th>-->
<!--								<th>--><?//= $this->common_lib->showListHeaderItem ( '/sys-admin/users/users-view', $page_parameters_without_sort, lang('zip'), "zip", $sort_direction, $sort ) ?><!--</th>-->

							</tr>
							</thead>
							<tbody>
							<?php if (isset($users) && count($users)>0){
									$userName = "";
								foreach($users as $row){?>
									<tr>
										
										<td>
                                        	<?php if($userName != $row->username){ ?>
											<a class="a_link" href="<?= base_url($this->uri->segment(1).'/users/users-overview/'.$row->id);?><?= $page_parameters_with_sort ?>">
												<?php echo $row->username;?>
											</a>
                                            <?php $userName = $row->username; ?>
                                            <?php } ?>
										</td>
										<td>
											<?php echo $this->common_lib->groupItems($row->client_name,',', 'client(s)');?></a>
										</td>
                                        <td><?php echo $this->common_lib->get_user_status_label( $row->user_status ) ?></td>
                                        <td><?php echo $row->user_group_description;?></td>
                                        <td><?php echo $ci->common_lib->format_datetime( $row->created_at) ?></td>
<!--                                        <td>--><?php //echo $row->phone;?><!--</td>-->
<!--										<td>--><?php //echo $row->job_name;?><!--</td>-->
<!--										<td>--><?php //echo $row->zip;?><!--</td>-->

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
<div class="modal fade" id="users_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="padding-right: 20px;">
			<section class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<div class="modal-title">Users&nbsp;Filter&nbsp;Setup</div>
			</section>


			<section class="modal-body">
				<form role="form" class="form-horizontal" id="form_users" name="form_users" method="post"  enctype="multipart/form-data" >

					<input type="hidden" id="page_number" name="page_number" value="1">
					<input type="hidden" id="hidden_filter_username" name="filter_username" value="<?= $filter_username ?>">
					<input type="hidden" id="hidden_filter_user_status" name="filter_user_status" value="<?= $filter_user_status ?>">
					<input type="hidden" id="hidden_filter_zip" name="filter_zip" value="<?= $filter_zip ?>">
					<input type="hidden" id="hidden_filter_user_group_id" name="filter_user_group_id" value="<?= $filter_user_group_id ?>">
					<input type="hidden" id="hidden_filter_created_at_from" name="filter_created_at_from" value="<?= $filter_created_at_from ?>">
					<input type="hidden" id="hidden_filter_created_at_till" name="filter_created_at_till" value="<?= $filter_created_at_till ?>">
					<input type="hidden" id="hidden_filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?= $filter_created_at_from_formatted ?>">
					<input type="hidden" id="hidden_filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?= $filter_created_at_till_formatted ?>">

					<div class="row">
						<div class="form-group" >
							<label class="col-xs-12 col-sm-4 control-label" for="filter_username"><?php echo lang('user')?></label>
							<div class="col-xs-12 col-sm-8">
								<input class="form-control editable_field" value="" id="filter_username" type="text" size="20" maxlength="100">
							</div>
						</div>
					</div>


					<div class="row">
						<div class="form-group" >
							<label class="col-xs-12 col-sm-4 control-label" for="filter_user_group_id">User Group</label>
							<div class="col-xs-12 col-sm-8">
								<select id="filter_user_group_id"  class="form-control editable_field">
									<option value="">  -Select All-  </option>
									<?php foreach( $user_GroupsSelectionList as $next_key=>$next_User_Type ) { ?>
										<option value="<?= $next_User_Type['key'] ?>" ><?= $next_User_Type['value'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group" >
							<label class="col-xs-12 col-sm-4 control-label" for="filter_user_status">User Status</label>
							<div class="col-xs-12 col-sm-8">
								<select id="filter_user_status"  class="form-control editable_field">
									<option value="">  -Select All-  </option>
									<?php foreach( $userStatusValueArray as $next_key=>$next_User_Active ) { ?>
										<option value="<?= $next_User_Active['key'] ?>" ><?= $next_User_Active['value'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group" >
							<label class="col-xs-12 col-sm-4 control-label" for="filter_zip">Client zip</label>
							<div class="col-xs-12 col-sm-8">
								<input class="form-control editable_field" value="" id="filter_zip" type="text" size="20" maxlength="100">
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
					<button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:usersListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
					<button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
					&nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
						<i class=" 	fa fa-square-o"></i>
					</a>
				</div>
			</section>
		</div>
	</div>
</div>