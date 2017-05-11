<div class="row">

	<div class="col-md-12">

		<div class="portlet light portlet-fit portlet-form bordered">

			<!-- BEGIN VALIDATION STATES-->

			<div class="portlet light portlet-fit portlet-form bordered">



				<div class="portlet-body">



					<div class="padding_lg">


						<!--Code for new user information start-->
                       <form action="<?php echo base_url() ;?>sys-admin/main/AddNewUserDetails/<?= $id; ?>" method="post" id="form_user_edit" name="form_user_edit" class="form-horizontal" >
                       
                       		<?php /*?><input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" /><?php */?>
                            <input type="hidden" id="user_id" name="user_id" value="<?= $id; ?>">
                            <?php if ( $validation_errors_text != "" ) : ?>

								<div class="row error" style="padding: 5px; margin: 5px;" >

									<?= $validation_errors_text ?>

								</div>

							<? endif; ?>
                            
                            <?php if ( $this->session->flashdata( 'validation_errors_text' ) ) : ?>
                                    <div class="alert alert-danger"><?php echo $this->session->flashdata( 'validation_errors_text' ); ?></div>
                            <?php endif; ?>

                           	<div class="row">
								<!-- User Types username -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[username]", ' has-error ')?> ">
										<label class="control-label col-md-4"><?php echo lang('username') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[username]" id="username" value="<?= ( !empty($username) ? $username : '' ); ?>" class="form-control" maxlength="100" />

										</div><!-- ./col -->
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
											<input type="text" name="data[first_name]" id="first_name" value="<?= ( !empty($first_name) ? $first_name : '' ); ?>" class="form-control" maxlength="50" />

										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>
                            
                            <div class="row">
								<!-- user mid name -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[last_name]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('mid_name') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[middle_name]" id="middle_name" value="<?= ( !empty($middle_name) ? $middle_name : '' ); ?>" class="form-control" maxlength="50" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>
                            
                            <div class="row">
								<!-- user last_name -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[last_name]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('last_name') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[last_name]" id="last_name" value="<?= ( !empty($last_name) ? $last_name : '' ); ?>" class="form-control" maxlength="50" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>
                            
                            <div class="row">
								<!-- user email -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[email]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('email') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[email]" id="email" value="<?= ( !empty($email) ? $email : '' ); ?>" class="form-control" maxlength="100" <?php echo !$is_insert ? " readonly " : "" ?> />
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
											<input type="text" name="data[address1]" id="address1" value="<?= ( !empty($address1) ? $address1 : '' ); ?>" class="form-control" maxlength="100" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- user address2 -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[address2]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('address2') ?>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[address2]" id="address2" value="<?= ( !empty($address2) ? $address2 : '' ); ?>"  class="form-control" maxlength="100" />
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
											<input type="text" name="data[city]" value="<?= ( !empty($city) ? $city : '' ); ?>" data-required="1" class="form-control" maxlength="100" />
										</div><!-- ./col -->
										<div class="col-md-1">
											<input type="text" name="data[state]" value="<?= ( !empty($state) ? $state : '' ); ?>" data-required="1"  class="form-control" maxlength="50" />
										</div><!-- ./col -->
										<div class="col-md-1">
											<input type="text" name="data[zip]" value="<?= ( !empty($zip) ? $zip : '' ); ?>" data-required="1" class="form-control" maxlength="50" />
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
											<input type="text" name="data[mobile]" id="mobile" value="<?= ( !empty($mobile) ? $mobile : '' ); ?>" class="form-control" maxlength="50" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- user mobile -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[phone]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('phone') ?>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[phone]" id="phone" value="<?= ( !empty($phone) ? $phone : '' ); ?>"  class="form-control" maxlength="20" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>

							<div class="row">
								<!-- user employment -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("user_has_groups_label", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('user_employment') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<label class="radio-inline">
                                            <?php $checked = 'checked="checked"';?>
                                              <input type="radio" name="user_employment" value="full_time"   style="left:21px;opacity:1;" <?php if(isset($user_employment) && $user_employment=='full_time') { echo $checked; } else { echo ''; }?> />Full Time
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="user_employment" value="part_time" style="left:21px;opacity:1;" <?php if(isset($user_employment) && $user_employment=='part_time') { echo $checked; } else { echo ''; }?>>Part Time
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="user_employment" value="contractor" style="left:21px;opacity:1;" <?php if(isset($user_employment) && $user_employment=='contractor') { echo $checked; } else { echo ''; }?>>contractor
                                            </label>
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div> <!-- ./row -->

							<div class="row" >
								<div class="col-md-6 ">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[avatar]", ' has-error ')?>">

										<label class="control-label col-md-4">User Title</label>
										<div class="col-md-7">
                                            <select id="user_title" name="data[user_title]"  class="form-control editable_field">
                                                <option value="">  -Select User Title-  </option>
                                                <option value="2" >Superuser</option>
                                                <option value="3" >Administrative</option>
                                                <option value="7" >Registered Nurse</option>
                                                <option value="10" >Licensed Vocational Nurse</option>
                                                <option value="4" >Aid</option>
                                                <option value="6" >Quality Assurance</option>
                                                <option value="8" >Social Worker</option>
                                                <option value="9" >Spiritual Councellor</option>
                                            </select>
                                        </div>
									</div>
								</div>
							</div>
                            
                            <div class="row">
								<!-- Licence Number -->
								<div class="col-md-6">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("user_has_groups_label", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('licence_number'); ?>
										</label>
										<div class="col-md-7">
                                            <input type="text" name="data[licence_number]" id="licence_number" value="<?= ( !empty($licence_number) ? $licence_number : '' ); ?>" class="form-control" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>

							<div class="row">
								<!-- licence start -->
                                <div class="col-lg-6 col-md-6">
                                    <label class="control-label col-md-4"><?php echo lang('licence_from'); ?>
                                            </label>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                        <input class="datepicker lic_start_date" name="data[licence_from]" data-date-format="yyyy-mm-dd">
                                    </div><!-- ./col -->
                                </div>
                            </div>
                            <div class="row">
								<!-- licence end -->
                                <div class="col-lg-6 col-md-6">
                                    <label class="control-label col-md-4"><?php echo lang('licence_to'); ?>
                                            </label>
                                    <div class="col-md-7 col-sm-6 col-xs-12 ">
                                        <input class="datepicker lic_end_date" name="data[licence_to]" data-date-format="yyyy-mm-dd">
                                    </div><!-- ./col -->
                                </div>
							</div>
								
									
                            <section class="row ">
								<!--<div class=" btn-group pull-right editor_btn_group " >-->
									<div class="col-sm-3 col-xs-12 ">
										<button type="button" class="btn btn-primary" onclick="javascript:onSubmit();" >Submit</button>
									</div>
									<div class="col-sm-2 col-xs-12 pull-left ">
										<button type="reset" class="btn btn-cancel-action" onclick="javascript:document.location='<?=base_url()?>newUserDetails/<?php echo $user_id;?>'" >Reset</button>
									</div>
								<!--</div>-->
							</section>
                            

						</form>
                        
						<!--Code for new user information end-->


					</div>



				</div>



			</div>

			<!-- END VALIDATION STATES-->



		</div>



	</div>



</div><!-- ./row -->