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
					<h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('users') ?></center></h3>
					<?= $this->common_lib->show_info($editor_message) ?>
				</div>

				<div class="portlet-body">
					<!-- BEGIN FORM-->
					<form action="<?php echo base_url() ;?>sys-admin/users/users-edit/<?= ( $is_insert ? "new" : $user_id ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_user_edit" name="form_user_edit" class="form-horizontal">
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

							<?php if ( $is_insert ) : ?>
								<div class="row">
									<!-- client Name -->
									<div class="col-md-6">
										<div class="form-group <?= $this->common_lib->set_field_error_tag("data[password]", ' has-error ')?> ">
											<label class="control-label col-md-4"><?php echo lang('password') ?>
											</label>
											<div class="col-md-7">
												<input type="password" name="data[password]" data-required="1" id="password" class="form-control" />
												<span class="help-block"> <?= lang('min-5-chars'); ?></span>
											</div><!-- ./col -->
										</div><!-- ./form-group -->
									</div><!-- ./col -->

									<div class="col-md-6">
										<div class="form-group <?= $this->common_lib->set_field_error_tag("data[password_confirm]", ' has-error ')?>">
											<label class="control-label col-md-4"><?php echo lang('password_confirm') ?>
											</label>
											<div class="col-md-7">
												<input type="password" name="data[password_confirm]" data-required="1" id="password_confirm" class="form-control" />
												<span class="help-block"> <?= lang('min-5-chars'); ?></span>

											</div><!-- ./col -->
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

								<!-- user user_group_id -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[user_group_id]", ' has-error ')?>">
										<label class="col-md-4 control-label" for="user_group_id">User Group</label>
										<div class="col-md-7">
											<select id="user_group_id" name="data[user_group_id]"  class="form-control editable_field">
												<option value="">  -Select User Group-  </option>
												<?php foreach( $user_GroupsSelectionList as $next_key=>$next_User_Type ) { ?>
													<option value="<?= $next_User_Type['key'] ?>" <?= ( !empty($editable_user->user_group_id) and $editable_user->user_group_id == $next_User_Type['key'] ) ? "selected" : "" ?> ><?= $next_User_Type['value'] ?></option>
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
								<!-- user has job titles -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("user_has_jobs_label", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('user_has_jobs_label') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<?php foreach( $jobsSelectionList as $next_key=>$next_job ) { ?>
												<div class="text-left" style="padding: 10px;">
													<input type="checkbox" value="1" id="cbx_user_has_jobs_<?=$next_job['key'] ?>" name="cbx_user_has_jobs_<?=$next_job['key'] ?>" <?= ( !empty($next_job['checked']) ? "checked" : "") ?> >
													<?=$next_job['value'] ?>&nbsp;
												</div>
											<?php }  ?>


										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div> <!-- ./row -->


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
									<div class="col-md-4  ">
										On Update&nbsp;
										<select id="select_on_update" name="select_on_update">
											<option value="reopen_editor" <?= ( $select_on_update == "reopen_editor" ? "selected" : "") ?> >Reopen editor</option>
											<option value="open_editor_for_new" <?= ( $select_on_update == "open_editor_for_new" ? "selected" : "") ?> >Open editor for new</option>
											<option value="reopen_listing" <?= ( $select_on_update == "reopen_listing" ? "selected" : "") ?> >Reopen listing</option>
										</select>
									</div>
									<div class="col-md-4 ">
										<button type="button" class="btn btn-primary" onclick="javascript:onSubmit();" >Submit</button>
									</div>
									<div class="col-md-2 pull-left ">
										<button type="reset" class="btn btn-cancel-action" onclick="javascript:document.location='<?=base_url()?>sys-admin/users/users-view<?=$page_parameters_with_sort?>'" >Cancel</button>
									</div>
									<div class="col-md-2 ">
									</div>
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