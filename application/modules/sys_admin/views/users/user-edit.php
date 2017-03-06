<?php $ci = &get_instance();  ?>

<script type="text/javascript">
	/*<![CDATA[*/
	var user_id= '<?= $user_id ?>'
	var is_insert= '<?= $is_insert ?>'
	var base_url= '<?= base_url() ?>'

	/*]]>*/
</script>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit portlet-form bordered">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet light portlet-fit portlet-form bordered">


				<div class="page-bar padding_lg">
					<!--<h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('users') ?></center></h3>-->
					<?= $this->common_lib->show_info($editor_message) ?>
				</div>

				<div class="portlet-body">
					<!-- BEGIN FORM-->
					<form action="<?php echo base_url() ;?>sys-admin/users/users-edit/<?= ( $is_insert ? "new" : $user_id ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_user_edit" name="form_user_edit" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

						<input type="hidden" id="filter_username" name="filter_username" value="<?=$filter_username?>">
						<input type="hidden" id="filter_user_active_status" name="filter_user_active_status" value="<?=$filter_user_active_status?>">
						<input type="hidden" id="filter_zip" name="filter_zip" value="<?=$filter_zip?>">
						<input type="hidden" id="filter_user_group_id" name="filter_user_group_id" value="<?=$filter_user_group_id?>">
						<input type="hidden" id="filter_created_at_from" name="filter_created_at_from" value="<?=$filter_created_at_from?>">
						<input type="hidden" id="filter_created_at_till" name="filter_created_at_till" value="<?=$filter_created_at_till?>">

						<div class="form-body">
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button> <?= lang('form_error');?>
							</div>
							<div class="alert alert-success display-hide">
								<button class="close" data-close="alert"></button> <?= lang('form_updated');?>
							</div>

							<?php if ( $validation_errors_text != "" ) : ?>
								<div class="row error" style="padding: 5px; margin: 5px;" >
									<?= $validation_errors_text ?>
								</div>
							<? endif; ?>

							<?php if ( !$is_insert ) : ?>
								<div class="row">
									<!-- User Types user_id -->
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4"><?php echo lang('user_id');?>
											</label>
											<div class="col-md-7">
												<input type="text" name="data[id]" id="id" value="<?= (!empty($editable_user->id) ? $editable_user->id:''); ?>" class="form-control" readonly />
											</div><!-- ./col -->
										</div><!-- ./form-group -->
									</div><!-- ./col -->
								</div>
							<?php endif; ?>

							<div class="row">
								<!-- User Types username -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[username]", ' has-error ')?> ">
										<label class="control-label col-md-4"><?php echo lang('username') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[username]" id="username" value="<?= ( !empty($editable_user->username) ? $editable_user->username : '' ); ?>" class="form-control" maxlength="100" <?php echo !$is_insert ? " readonly " : "" ?> />

										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- user email -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[email]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('email') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[email]" id="email" value="<?= ( !empty($editable_user->email) ? $editable_user->email : '' ); ?>" class="form-control" maxlength="100" <?php echo !$is_insert ? " readonly " : "" ?> />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>

							<?php if ( !$is_insert ) : ?>
							<div class="row">
								<!-- user_active_status -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[user_active_status]", ' has-error ')?>">

										<label class="col-md-4 control-label" for="user_active_status">New Password</label>
										<div class="col-md-7">
											<button type="button" class="btn btn-primary" onclick="javascript:generateNewPassword(<?php echo $editable_user->id ?>);" >Generate</button>
										</div>

									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>
							<?php endif; ?>

							<div class="row">
								<!-- user_active_status -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[user_active_status]", ' has-error ')?>">

										<label class="col-md-4 control-label" for="user_active_status">User Status</label>
										<div class="col-md-7">
											<select id="user_active_status" name="data[user_active_status]"  class="form-control editable_field">
												<option value="">  -Select User Status-  </option>
												<?php foreach( $userActiveStatusValueArray as $next_key=>$next_User_Status ) { ?>
													<option value="<?= $next_User_Status['key'] ?>" <?= ( !empty($editable_user->user_active_status) and $editable_user->user_active_status == $next_User_Status['key'] ) ? "selected" : "" ?> ><?= $next_User_Status['value'] ?></option>
												<?php } ?>
											</select>
										</div>

									</div><!-- ./form-group -->
								</div><!-- ./col -->

							</div>




							<div class="row">
								<!-- User Types first_name -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[first_name]", ' has-error ')?> ">
										<label class="control-label col-md-4"><?php echo lang('first_name') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[first_name]" id="first_name" value="<?= ( !empty($editable_user->first_name) ? $editable_user->first_name : '' ); ?>" class="form-control" maxlength="50" />

										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- user last_name -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[last_name]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('last_name') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[last_name]" id="last_name" value="<?= ( !empty($editable_user->last_name) ? $editable_user->last_name : '' ); ?>" class="form-control" maxlength="50" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>



							<div class="row">
								<!-- user address1 -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[address1]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('address1') ?>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[address1]" id="address1" value="<?= ( !empty($editable_user->address1) ? $editable_user->address1 : '' ); ?>" class="form-control" maxlength="100" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- user address2 -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[address2]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('address2') ?>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[address2]" id="address2" value="<?= ( !empty($editable_user->address2) ? $editable_user->address2 : '' ); ?>"  class="form-control" maxlength="100" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>


							<div class="row">
								<!-- user city/state/zip -->
								<div class="col-md-12">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[state]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[city]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[zip]", ' has-error ')?> ">
										<label class="control-label col-md-2"><?php echo lang('city') ?>/<?php echo lang('state') ?>/<?php echo lang('zip') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-1">
											<input type="text" name="data[city]" value="<?= ( !empty($editable_user->city) ? $editable_user->city : '' );?>" data-required="1" class="form-control" maxlength="100" />
										</div><!-- ./col -->
										<div class="col-md-1">
											<input type="text" name="data[state]" value="<?= ( !empty($editable_user->state) ? $editable_user->state : '' )?>" data-required="1"  class="form-control" maxlength="50" />
										</div><!-- ./col -->
										<div class="col-md-1">
											<input type="text" name="data[zip]" value="<?= ( !empty($editable_user->zip) ? $editable_user->zip : '' ) ;?>" data-required="1" class="form-control" maxlength="50" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- user state -->

							</div> <!-- ./row -->



							<div class="row">
								<!-- user mobile -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[mobile]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('mobile') ?>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[mobile]" id="mobile" value="<?= ( !empty($editable_user->mobile) ? $editable_user->mobile : '' ); ?>" class="form-control" maxlength="50" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- user mobile -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[phone]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('phone') ?>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[phone]" id="phone" value="<?= ( !empty($editable_user->phone) ? $editable_user->phone : '' ); ?>"  class="form-control" maxlength="20" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>


							<div class="row">
								<!-- user has group titles -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("user_has_groups_label", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('user_has_groups_label') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<?php foreach( $groupsSelectionList as $next_key=>$next_group ) { ?>
												<div class="text-left" style="padding: 10px;">
													<input type="checkbox" value="1" id="cbx_user_has_groups_<?=$next_group['key'] ?>" name="cbx_user_has_groups_<?=$next_group['key'] ?>" <?= ( !empty($next_group['checked']) ? "checked" : "") ?> >
													<?=$next_group['value'] ?>&nbsp;
												</div>
											<?php }  ?>


										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div> <!-- ./row -->


							<div class="row" >
								<div class="col-md-6 ">
									<div class="form-group padding_lg <?= $this->common_lib->set_field_error_tag("data[avatar]", ' has-error ')?>">

										<label class="control-label col-md-4">Image</label>
										<input type="hidden" name="data[avatar]" id="avatar" value="<?= ( !empty($editable_user->avatar) ? $editable_user->avatar : '' ); ?>" >


										<?php if ( !empty($editable_user->avatar) and !empty($editable_user->image_url) ) : ?>
											<div >
												<img src="<?php echo $editable_user->image_url ?> " style="width: <?=$editable_user->image_path_width ?>px;height: <?=$editable_user->image_path_height ?>px" >
											</div>
										<?php endif ?>

										<?php if ( !empty($editable_user->file_info) ) : ?>
											<div class="padding_sm">
												<table>
													<tr>
														<td width="95%">
															<input type="text" name="avatar_info" id="avatar_info" class="form-control editable_field " value="<?php echo $editable_user->file_info ?>" readonly size="30" maxlength="100" >
														</td>
														<td width="5%" >
															<div data-toggle="buttons" class=" ">
																<!--																<label class="btn btn-primary btn-sm padding_sm" >-->
																<input class="only_checkbox" value="1" autocomplete="off" id="cbx_clear_image" name="cbx_clear_image" type="checkbox">
																<!-- <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>-->Clear
																<!--																</label>-->
															</div>
														</td>
													</tr>
												</table>
											</div>
										<?php endif ?>

										<input type="file" name="data[avatar_file_upload]" id="avatar_file_upload" class="form-control editable_field " >
										<p class="help-block">Select image for CMS Item.</p>

									</div>
								</div>
							</div>


							<?php if ( !$is_insert ) : ?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4"><?php echo lang('created_at') ?>
											</label>
											<div class="col-md-7">
												<input type="text" value="<?= ( !empty($editable_user->created_at) ? $ci->common_lib->format_datetime( $editable_user->created_at ) : '' ) ?>" class="form-control" disabled />
											</div><!-- ./col -->
										</div><!-- ./form-group -->
									</div><!-- ./col -->
								</div><!-- ./col -->

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-4"><?php echo lang('updated_at') ?>
											</label>
											<div class="col-md-7">
												<input type="text" value="<?= ( !empty($editable_user->updated_at) ? $ci->common_lib->format_datetime( $editable_user->updated_at ) : '' ) ?>" class="form-control" disabled />
											</div><!-- ./col -->
										</div><!-- ./form-group -->
									</div><!-- ./col -->
								</div><!-- ./col -->
							<?php endif; ?>

							<section class="row ">
								<div class=" btn-group pull-right editor_btn_group " >
									<div class="col-sm-3 col-xs-12">
										On Update&nbsp;
										<select id="select_on_update" name="select_on_update">
											<option value="reopen_editor" <?= ( $select_on_update == "reopen_editor" ? "selected" : "") ?> >Reopen editor</option>
											<option value="open_editor_for_new" <?= ( $select_on_update == "open_editor_for_new" ? "selected" : "") ?> >Open editor for new</option>
											<option value="reopen_listing" <?= ( $select_on_update == "reopen_listing" ? "selected" : "") ?> >Reopen listing</option>
										</select>
									</div>
									<div class="col-sm-3 col-xs-12 ">
										<button type="button" class="btn btn-primary" onclick="javascript:onSubmit();" >Submit</button>
									</div>
									<div class="col-sm-2 col-xs-12 pull-left ">
										<button type="reset" class="btn btn-cancel-action" onclick="javascript:document.location='<?=base_url()?>sys-admin/users/users-view<?=$page_parameters_with_sort?>'" >Cancel</button>
									</div>
									<?php if ( !$is_insert ) : ?>
									<div class="col-sm-4 col-xs-12 pull-right ">
										<button type="reset" class="btn btn-delete-action" onclick="javascript:userRemove(<?php echo $editable_user->id?>, '<?php echo addslashes($editable_user->username) ?>') " >
											<div class="fa fa-remove" style = "font-size: xx-large; padding-bottom: 5px;" ></div>&nbsp;
										</button>
									</div>
									<?php endif; ?>
									<?php if ( $is_insert ) : ?>
									<div class="col-md-2 ">
									</div>
									<?php endif; ?>
								</div>
							</section>

						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
			<!-- END VALIDATION STATES-->

		</div>

	</div>

</div><!-- ./row -->