<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-form bordered">
      <!-- BEGIN VALIDATION STATES-->
      <div class="portlet light portlet-fit portlet-form bordered">
        <div class="portlet-body">
          <div class="padding_lg">
            <!--Code for authentication of lastname and email start-->
            <form action="<?php echo base_url() ;?>sys-admin/main/send_user_mail" method="post" id="form_user_edit" name="form_user_mail" class="form-horizontal" >
              <?php /*?><input type="hidden" id="auth_user_id" name="auth_user_id" value="<?= $auth_user_id; ?>"><?php */?>
              <?php /*?><?php if ( $this->session->flashdata( 'validation_errors_text' ) ) : ?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata( 'validation_errors_text' ); ?></div>
              <?php endif; ?><?php */?>
              
                <!-- user email -->
                <div class="col-md-6">
                  <?php /*?><div class="form-group <?= $this->common_lib->set_field_error_tag("data[email]", ' has-error ')?>"><?php */?>
                    <label class="control-label col-md-4"><?php echo 'email'; ?> <span class="required"> * </span> </label>
                    <div class="col-md-7">
                      <input type="text" name="data[email]" id="email" value="" class="form-control" maxlength="100" />
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- ./form-group -->
                </div>
                <!-- ./col -->
              </div>
              <div class="row">
                <!-- Buttons -->
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="col-md-7">
                      <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- ./form-group -->
                </div>
                <!-- ./col -->
                <!-- user email -->
                <div class="col-md-6">
                  <div class="form-group"> </div>
                  <!-- ./form-group -->
                </div>
                <!-- ./col -->
              </div>
            </form>
            <!--Code for authentication of lastname and email end-->
          </div>
        </div>
      </div>
      <!-- END VALIDATION STATES-->
    </div>
  </div>
</div>
<!-- ./row -->
