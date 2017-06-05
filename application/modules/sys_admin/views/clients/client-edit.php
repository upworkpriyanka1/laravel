<div class="row" id="client-edit">
    <div class="col s12">
        <div id="structure" class="section scrollspy">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="clearfix"></div>
                <div class="col-xs-12">
                    <div id="profile-form-client">

                        <div class="row">
                            <?php
                            $errors = $this->session->flashdata('errors');
                            if($errors && $errors != ''){ ?>
                                <div class=" has-error " style="background-color: #fff; color:red; padding: 10px;margin-bottom: 10px"><?=$this->session->flashdata('errors');?></div>
                            <?php } ?>
                            <!-- BEGIN FORM-->
                            <form action="<?php echo current_url();?>" id="client_edit_form" method="POST" enctype="multipart/form-data">
<!--                                22222--><?php //echo validation_errors(  ); ?><!-- 1111-->
                                <input type="hidden" class="validate" value="<?=$client->cid?>" name="data[client_id]" id="client_id">
                                <div class="form-body">
                                    <!-- start Company-->
                                    <div class="row">
                                        <div class="pad-card">
                                            <div class="cards-container">
                                                <div class="card blue-grey darken-1 card_db">
                                                    <div class="card-content white-text">
                                                        <span class="card-title">Company</span>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_name]", ' has-error ')?>">
                                                                        <input id="client_name" type="text" class="validate <?= $this->common_lib->set_field_error_tag("data[client_name]", ' has-error ')?>" value="<?=$client->client_name?>" name="data[client_name]" >
                                                                        <label for="client_name" class="control-label"> <?php echo lang('name') ?>
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field">
                                                                        <select class="tag-drop" name="data[client_lic_tag]" id="client_lic_tag">
                                                                            <option value="" disabled selected>Tag line</option>
                                                                            <option value="1">Slogan</option>
                                                                            <option value="2">Saying</option>
                                                                            <option value="3">Quote</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <?php if ( !empty($client->image_url) and !empty($client->image_path_height) ) : ?>
                                                                    <div class="col-md-12">
                                                                        <img src="<?= $client->image_url ?>" width="<?= $client->image_path_width ?>"  height="<?= $client->image_path_height ?>" >
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="col-md-12">
                                                                    <div class="file-field input-field">
                                                                        <div class="col-md-4 col-sm-2">
                                                                            <div class="btn">
                                                                                <span>Upload avatar</span>
                                                                                <input type="file" id="client_img" name="data[client_img]">
                                                                            </div>
                                                                        </div>
                                                                        <div class="file-path-wrapper col-md-8 col-sm-10">
                                                                            <input class="file-path validate" type="file">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_website]", ' has-error ')?>">
                                                                        <input id="client_website" type="text" class="validate <?= $this->common_lib->set_field_error_tag("data[client_website]", ' has-error ')?>"  name="data[client_website]" value="<?=$client->client_website?>">
                                                                        <label for="client_website" class="control-label"><?php echo lang('website') ?></label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!-- end Company-->
                                                    </div>
                                                </div>
                                                <div class="card blue-grey darken-1 ">
                                                    <div class="card-content white-text">
                                                        <!-- start Location-->
                                                        <span class="card-title">Location</span>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_address1]", ' has-error ')?>">
                                                                        <input id="client_address1"  type="text"  class="validate <?= $this->common_lib->set_field_error_tag("data[client_address1]", ' has-error ')?>" name="data[client_address1]" value="<?=$client->client_address1?>">
                                                                        <label for="client_address1" class="control-label"><?php echo lang('address') ?>
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_address2]", ' has-error ')?>">
                                                                        <input id="client_address2"  type="text"  class="validate <?= $this->common_lib->set_field_error_tag("data[client_address2]", ' has-error ')?>"  name="data[client_address2]" value="<?=$client->client_address2?>">
                                                                        <label for="client_address2" class="control-label"><?php echo lang('address2') ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- City-state-zip-->

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_city]", ' has-error ')?>">
                                                                        <input id="client_city"  type="text"  class="validate <?= $this->common_lib->set_field_error_tag("data[client_city]", ' has-error ')?>"  name="data[client_city]" value="<?=$client->client_city?>">
                                                                        <label for="client_city" class="control-label"><?php echo lang('city') ?>
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_state]", ' has-error ')?>">
                                                                        <input id="client_state"  type="text"  class="validate <?= $this->common_lib->set_field_error_tag("data[client_state]", ' has-error ')?>" name="data[client_state]" value="<?=$client->client_state?>">
                                                                        <label for="client_state" class="control-label"><?php echo lang('state') ?>
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_zip]", ' has-error ')?>">
                                                                        <input id="client_zip"  type="number"  class="validate <?= $this->common_lib->set_field_error_tag("data[client_zip]", ' has-error ')?>" name="data[client_zip]" value="<?=$client->client_zip?>">
                                                                        <label for="client_zip" class="control-label"><?php echo lang('zip') ?>
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end Location-->
                                                    </div>

                                                </div>
                                                <div class="card blue-grey darken-1">
                                                    <div class="card-content white-text">
                                                        <span class="card-title">Contact</span>
                                                        <!-- start Contact-->

                                                        <div class="row">
                                                            <!--Phone-->

                                                            <!-- client phone -->
                                                            <div class="col-md-12 phone add-row-able" next-row-class="phone-second-row">
                                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone]", ' has-error ')?>">
                                                                    <div class="col-md-6" style="padding-left: 0">
                                                                        <table>
                                                                            <tr>
                                                                                <td style="width: 98%">
                                                                                    <input type="text" id="client_phone" name="data[client_phone]" class="form-control required_form <?= $this->common_lib->set_field_error_tag("data[client_phone]", ' has-error ')?>" value="<?=$client->client_phone?>" maxlength="50" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');" " />
                                                                                    <label for="client_phone" class=""><?php echo lang('phone') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div><!-- ./col -->
                                                                    <div class="input-field col-md-6 rem-sel">
                                                                        <input type="text" list="phonename8" name="data[client_phone_type]" id="client_phone_type" value="<?=$client->client_phone_type?>">
                                                                        <datalist id="phonename8">
                                                                            <option value="Home">
                                                                            <option value="Work">
                                                                            <option value="Other">
                                                                        </datalist>

                                                                    </div>
                                                                </div>
                                                                <!-- ./form-group -->
                                                                <div class="btn-add add-row-button" next-row-class="phone-second-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                            </div><!-- ./col -->

                                                            <!-- client phone_2 -->
                                                            <div class="col-md-12 phone  phone-second-row" id="div_phone_2" style="display: <?= ( !empty($client->client_phone_2) ? 'block' : 'none' ); ?>">
                                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_2]", ' has-error ')?>">
                                                                    <div class="col-md-6" style="padding-left: 0">
                                                                        <input type="text"  id="client_phone_2" name="data[client_phone_2]" class="form-control <?= $this->common_lib->set_field_error_tag("data[client_phone]", ' has-error ')?>" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                        <label for="client_phone_2" class=""><?php echo lang('phone_2') ?></label>
                                                                    </div><!-- ./col -->
                                                                    <div class="input-field col-md-6" style="margin-top: 0">
                                                                        <input type="text" name="data[client_phone_type]" list="phonename9" id="client_phone_type">
                                                                        <datalist id="phonename9">
                                                                            <option value="Home">
                                                                            <option value="Work">
                                                                            <option value="Other">
                                                                        </datalist>

                                                                    </div>
                                                                </div><!-- ./form-group -->
                                                                <div class="btn-add add-row-button" next-row-class="phone-third-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div><!-- ./col -->

                                                            <!-- client phone_3 -->
                                                            <div class="col-md-12 phone  phone-third-row" id="div_phone_3" style="display: none;">
                                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_3]", ' has-error ')?>">
                                                                    <div class="col-md-6" style="padding-left: 0">
                                                                        <input type="text" id="client_phone_3"  name="data[client_phone_3]" class="form-control <?= $this->common_lib->set_field_error_tag("data[client_phone_3]", ' has-error ')?>" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                        <label for="client_phone_3" class=""><?php echo lang('phone_3') ?></label>
                                                                    </div><!-- ./col -->
                                                                    <div class="input-field col-md-6" style="margin-top: 0">
                                                                        <input type="text" id="client_phone_type" name="data[client_phone_type]" list="phonename10">
                                                                        <datalist id="phonename10">
                                                                            <option value="Home">
                                                                            <option value="Work">
                                                                            <option value="Other">
                                                                        </datalist>

                                                                    </div>
                                                                </div><!-- ./form-group -->

                                                                <div class="btn-add add-row-button" next-row-class="phone-fourth-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div><!-- ./col -->

                                                            <!-- client phone_4 -->
                                                            <div class="col-md-12 phone  phone-fourth-row" id="div_phone_4" style="display: none;">
                                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_4]", ' has-error ')?>">
                                                                    <div class="col-md-6" style="padding-left: 0">
                                                                        <input type="text" id="client_phone_4"  name="data[client_phone_4]" class="form-control <?= $this->common_lib->set_field_error_tag("data[client_phone_4]", ' has-error ')?>" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                        <label for="client_phone_4" class=""><?php echo lang('phone-4') ?></label>
                                                                    </div><!-- ./col -->
                                                                    <div class="input-field col-md-6" style="margin-top: 0">
                                                                        <input type="text" id="client_phone_type" name="data[client_phone_type]" list="phonename11">
                                                                        <datalist id="phonename11">
                                                                            <option value="Home">
                                                                            <option value="Work">
                                                                            <option value="Other">
                                                                        </datalist>
                                                                    </div>
                                                                </div><!-- ./form-group -->

                                                                <div class="btn-add add-row-button" next-row-class="phone-fifth-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div><!-- ./col -->

                                                            <!-- client phone_5 -->
                                                            <div class="col-md-12 phone  phone-fifth-row" id="div_phone_5" style="display: none;">
                                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_5]", ' has-error ')?>">
                                                                    <div class="col-md-6" style="padding-left: 0">
                                                                        <input type="text" id="client_phone_5"  name="data[client_phone_5]" class="form-control <?= $this->common_lib->set_field_error_tag("data[client_phone_5]", ' has-error ')?>" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                        <label for="client_phone_5" class=""><?php echo lang('phone_5') ?></label>
                                                                    </div><!-- ./col -->
                                                                    <div class="input-field col-md-6" style="margin-top: 0">
                                                                        <input type="text" id="client_phone_type" name="data[client_phone_type]" list="phonename12">
                                                                        <datalist id="phonename12">
                                                                            <option value="Home">
                                                                            <option value="Work">
                                                                            <option value="Other">
                                                                        </datalist>
                                                                    </div>
                                                                </div><!-- ./form-group -->


                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div><!-- ./col -->
                                                        </div> <!-- ./row -->
                                                        <!--END Phone-->

                                                        <!-- email-->
                                                        <div class="row">
                                                            <!--email 1-->
                                                            <div class="col-md-12 email add-row-able" next-row-class="email-second-row">
                                                                <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_email]", ' has-error ')?>">
                                                                    <input id="client_email" type="email" class="validate <?= $this->common_lib->set_field_error_tag("data[client_email]", ' has-error ')?>" name="data[client_email]" value="<?=$client->client_email?>" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                    <label for="client_email" data-error="wrong" data-success="right">Email</label>
                                                                </div>
                                                                <div class="btn-add add-row-button" next-row-class="email-second-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                            </div>
                                                            <!--email 2-->
                                                            <div class="col-md-12 email  email-second-row" style="display: none">
                                                                <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_email_2]", ' has-error ')?>">
                                                                    <input id="client_email_2" type="email" class="validate <?= $this->common_lib->set_field_error_tag("data[client_email_2]", ' has-error ')?>" name="data[client_email_2]" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                    <label for="client_email_2" data-error="wrong" data-success="right">Email 2</label>
                                                                </div>
                                                                <div class="btn-add add-row-button" next-row-class="email-third-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <!--email 3-->
                                                            <div class="col-md-12 email  email-third-row" style="display: none">
                                                                <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_email_3]", ' has-error ')?>">
                                                                    <input id="client_email_3" type="email" class="validate <?= $this->common_lib->set_field_error_tag("data[client_email_3]", ' has-error ')?>" name="data[client_email_3]" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                    <label for="client_email_3" data-error="wrong" data-success="right">Email 3</label>
                                                                </div>
                                                                <div class="btn-add add-row-button" next-row-class="email-fourth-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <!--email 4-->
                                                            <div class="col-md-12 email  email-fourth-row" style="display: none">
                                                                <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_email_4]", ' has-error ')?>">
                                                                    <input id="client_email_4" type="email" class="validate <?= $this->common_lib->set_field_error_tag("data[client_email_4]", ' has-error ')?>" name="data[client_email_4]" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                    <label for="client_email_4" data-error="wrong" data-success="right">Email 4</label>
                                                                </div>
                                                                <div class="btn-add add-row-button" next-row-class="email-fifth-row">
                                                                    <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                </div>
                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <!--email 5-->
                                                            <div class="col-md-12 email  email-fourth-row" style="display: none">
                                                                <div class="input-field <?= $this->common_lib->set_field_error_tag("data[client_email_5]", ' has-error ')?>">
                                                                    <input id="client_email_5" type="email" class="validate <?= $this->common_lib->set_field_error_tag("data[client_email_5]", ' has-error ')?>" name="data[client_email_5]" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                    <label for="client_email_5" data-error="wrong" data-success="right">Email 5</label>
                                                                </div>
                                                                <div class="btn-rem">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- end Contact-->

                                                </div>
                                                <div class="card blue-grey darken-1">
                                                    <div class="card-content white-text">
                                                        <div class="card-content white-text">
                                                            <!-- start Theme-->
                                                            <span class="card-title">Theme</span>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="client_primary_color" type="text" class="validate" name="data[client_primary_color]">
                                                                            <label for="client_primary_color" class="control-label"><?php echo lang('primary-color') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="client_accent_color" type="text" class="validate" name="data[client_accent_color]">
                                                                            <label for="client_accent_color" class="control-label"><?php echo lang('accent-color') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end Theme-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 text-center sev-canc-mock">
                                            <button class="btn"><a href="/sys-admin/client/<?=$client->cid?>" style="color: #fff;"> CANCEL</a></button>
                                            <button class="btn" name="submit" type="submit">SAVE</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>

                    </div>
                </div>


            </div>
            <!-- END CONTAINER ./page-content-wrapper -->
        </div>
    </div>
</div>