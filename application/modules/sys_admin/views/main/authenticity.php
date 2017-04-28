<div class="row">

	<div class="col-md-12">

		<div class="portlet light portlet-fit portlet-form bordered">

			<!-- BEGIN VALIDATION STATES-->

			<div class="portlet light portlet-fit portlet-form bordered">



				<div class="portlet-body">



					<div class="padding_lg">


						<!--Code for authentication of lastname and email start-->
                       <form action="<?php echo base_url() ;?>sys-admin/main/authenticate_user/<?= $user_id; ?>" method="post" id="form_user_edit" name="form_user_auth" class="form-horizontal" >
                       
                       		<?php /*?><input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" /><?php */?>
                            <input type="hidden" id="auth_user_id" name="auth_user_id" value="<?= $auth_user_id; ?>">
                           <?php /*?> <?php if ( $validation_errors_text != "" ) : ?>

								<div class="row error" style="padding: 5px; margin: 5px;" >

									<?= $validation_errors_text ?>

								</div>

							<? endif; ?>
                            <?php */?>
                            <?php if ( $this->session->flashdata( 'validation_errors_text' ) ) : ?>
                                    <div class="alert alert-danger"><?php echo $this->session->flashdata( 'validation_errors_text' ); ?></div>
                            <?php endif; ?>

                            <div class="row">
    
                                <!-- User Types lastname -->
    
                                <div class="col-md-6">
    
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[lastname]", ' has-error ')?> ">
    
                                        <label class="control-label col-md-4"><?php echo lang('last_name') ?>
    
                                            <span class="required"> * </span>
    
                                        </label>
    
                                        <div class="col-md-7">
    
                                            <input type="text" name="data[lastname]" id="lastname" value="" class="form-control" maxlength="100" />
    
    
    
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
    
                                            <input type="text" name="data[email]" id="email" value="" class="form-control" maxlength="100" />
    
                                        </div><!-- ./col -->
    
                                    </div><!-- ./form-group -->
    
                                </div><!-- ./col -->
    
                            </div>
                            
                            <div class="row">
    
                                <!-- Buttons -->
    
                                <div class="col-md-6">
    
                                    <div class="form-group">
                                        <div class="col-md-7">
 											<button type="submit" class="btn btn-primary" >Submit</button>   
                                           
                                        </div><!-- ./col -->
    
                                    </div><!-- ./form-group -->
    
                                </div><!-- ./col -->
    
                                <!-- user email -->
    
                                <div class="col-md-6">
    
                                    <div class="form-group">
    
                                    </div><!-- ./form-group -->
    
                                </div><!-- ./col -->
    
                            </div>

						</form>
                        
						<!--Code for authentication of lastname and email end-->


					</div>



				</div>



			</div>

			<!-- END VALIDATION STATES-->



		</div>



	</div>



</div><!-- ./row -->