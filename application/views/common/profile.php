 <?php if (isset($usertoedit) && count($usertoedit)>0){
    // print_r($usertoedit);
     ?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
<!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
               <div class="portlet-body">
                   <!-- BEGIN FORM-->
                   <form action="<?php echo current_url();?>/update" method="post" id="user-add" class="form-horizontal">
                       <div class="form-body">
                           <div class="alert alert-danger display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                           </div>
                           <div class="alert alert-success display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_updated');?>
                           </div>

    <div class="row">
    <!-- client Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('first_name') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[first_name]" value="<?= $usertoedit->first_name;?>" data-required="1" class="form-control requiredField" />

                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client owner -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('last_name') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[last_name]" value="<?= $usertoedit->last_name;?>" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div> <!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->
    <div class="row">
    <!-- client Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('create_user_password_label') ?>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[password]" data-required="1" id="password" class="form-control" />
                    <span class="help-block"> <?= lang('min-5-chars').". ".lang('blank-no-change'); ?></span>
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('create_user_password_confirm_label') ?>
                </label>
                <div class="col-md-7">
                    <input type="text" name="password_confirm" data-required="1" id="password_confirm" class="form-control" />
                    <span class="help-block"> <?= lang('min-5-chars').". ".lang('blank-no-change'); ?></span>

                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    </div>
    <div class="row">
    <!-- client Addrtess 1 -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('address1') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[address1]" value="<?= $usertoedit->address1;?>" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client Address 2 -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('address1') ?>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[address2]" value="<?= $usertoedit->address2;?>"  class="form-control" />
                </div><!-- ./col -->
            </div> <!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->



    <div class="row">
    <!-- client city/state/zip -->
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label col-md-2"><?php echo lang('city') ?>/<?php echo lang('state') ?>/<?php echo lang('zip') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-1">
                    <input type="text" name="data[city]" value="<?= $usertoedit->city;?>" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
                <div class="col-md-1">
                    <input type="text" name="data[state]" value="<?= $usertoedit->state;?>" data-required="1"  class="form-control requiredField" />
                </div><!-- ./col -->
                <div class="col-md-1">
                    <input type="text" name="data[zip]" value="<?= $usertoedit->zip;?>" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client state -->

    </div> <!-- ./row -->



    <div class="row">
    <!-- client phone -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('phone') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[phone]" value="<?= $usertoedit->phone;?>" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client fax -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('mobile') ?>  <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[mobile]" value="<?= $usertoedit->mobile;?>" class="form-control requiredField" />
                </div><!-- ./col -->
            </div> <!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->


    <div class="row">
    <!-- client email -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('email') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[email]" value="<?= $usertoedit->email;?>" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->

        <div class="col-md-6">
            <div class="form-group">
                <label  class="control-label col-md-4"><?= lang('avatar');?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-addon modalshow pointer" data-id="avatar" data-filename="<?= $usertoedit->id.$usertoedit->username;?>" data-folder="upload">
                            <span class="fa fa-upload"></span>  Upload
                        </span>
                        <input class="form-control requiredField"  id="avatar_original"  name="data[avatar_original]" type="text" value="<?= $usertoedit->avatar_original;?>" readonly>
                        <input  id="avatar"  name="data[avatar]" type="hidden" value="<?= $usertoedit->avatar;?>">
                    </div><!-- ./input-group -->
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->




    <div class="row">
        <div class="col-md-6">
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-4 col-md-9">
                        <button type="submit" class="btn green"><?php echo lang('submit');?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
                   </form>
                   <!-- END FORM-->
               </div>
            </div>
        <!-- END VALIDATION STATES-->
        </div>
    </div>
</div><!-- ./row -->

<!-- Upload Modal webnaz -->
<div class="modal fade" id="modal"  data-field='folder' data-filename='' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content"><!-- content -->
            <div class="modal-header"><!-- Modal header -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close<"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span id="title"><?= lang('upload');?></span></h4>
            </div><!-- /Modal header -->
            <div class="modal-body">
				<form action="#" enctype="multipart/form-data" method="post" id="FileForm">
				<span id="helpBlock" class="help-block"><?= lang('allowed-extensions');?> <?= $this->config->item('image_allowed_types'); ?><br >
                    <?= lang('max-file-size');?> <?= $this->config->item('avatar-megabyte'); ?></span>
				<div class="input-group">
					<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
							<?= lang('select');?> <input type="file" name="file_upload" id="file_upload">
						</span>
					</span>
                <input type="text" id="TheFile" class="form-control requiredField" readonly="">
				</div>
				<p>
				<input class="btn btn-primary modalButton" disabled type="submit" name="submit" value="<?= lang('upload');?>">
				</p>
			</form>
				<div id="output"></div> <!-- show notifications -->
            </div><!-- /Modal body -->
            <!-- /Modal footer -->
        </div><!-- /Modal contente -->
    </div> <!-- /Modal dialogue -->
</div><!-- /Upload Modal webnaz -->
<?php } ?>
<script>
var debug           = <?= $this->config->item('js_debug'); ?>;
var AllowedTypes    = "<?= $this->config->item('image_allowed_types'); ?>";
var TXT_Uploading   = "<?= lang('uploading');?>";
var TXT_Allowed     = "<?= lang('allowed-extensions');?> <?= $this->config->item('image_allowed_types'); ?>";
var LngAjaxError    = "<?= lang('ajax-error');?>";
var MaxUpladSize    = <?= $this->config->item('avatar-byte'); ?>;
var TXT_TooBig      = "<?= lang('upload-too-big'); ?>";
</script>