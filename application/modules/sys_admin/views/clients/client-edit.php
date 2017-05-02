<div class="row" id="client-edit">
    <div class="col s12">
        <div id="structure" class="section scrollspy">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

                    <div class="clearfix"></div>
                    <div class="col-xs-12">
                        <div id="profile-form-client">

                            <div class="row">
                                <!-- BEGIN FORM-->
                                <form action="" id="client_edit_form" method="POST" enctype="multipart/form-data">
                                    <?php echo validation_errors(); ?>
                                    <input type="hidden" class="validate" value="" name="data[id]">
                                    <div class="form-body">
                                        <!-- start Company-->
                                        <div class="row">
                                            <div class="pad-card">
                                                <div class="cards-container">
                                                    <div class="card blue-grey darken-1">
                                                        <div class="card-content white-text">
                                                            <span class="card-title">Company</span>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="cl-name" type="text" class="validate">

                                                                            <label for="cl-name" class="control-label"> <?php echo lang('name') ?>
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <select class="tag-drop" name="">
                                                                                <option value="" disabled selected>Tag line</option>
                                                                                <option value="1">Slogan</option>
                                                                                <option value="2">Saying</option>
                                                                                <option value="3">Quote</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="file-field input-field">
                                                                        <div class="col-md-4">
                                                                            <div class="btn">
                                                                                <span>Picture 1</span>
                                                                                <input type="file" id="avatar-cl" name="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="file-path-wrapper col-md-8">
                                                                            <input class="file-path validate" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="cl-website" type="text" class="validate"  name="">

                                                                            <label for="cl-website" class="control-label"><?php echo lang('website') ?></label>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- end Company-->
                                                        </div>
                                                    </div>
                                                    <div class="card blue-grey darken-1">
                                                        <div class="card-content white-text">
                                                            <!-- start Location-->
                                                            <span class="card-title">Location</span>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="cl-adr"  type="text"  class="validate" name="">
                                                                            <label for="cl-adr" class="control-label"><?php echo lang('address') ?>
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="us-adr2"  type="text"  class="validate"  name="">
                                                                            <label for="us-adr2" class="control-label"><?php echo lang('address2') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- City-state-zip-->

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="us-city"  type="text"  class="validate"  name="">
                                                                            <label for="us-city" class="control-label"><?php echo lang('city') ?>
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="us-state"  type="text"  class="validate" name="">
                                                                            <label for="us-state" class="control-label"><?php echo lang('state') ?>
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="us-zip"  type="number"  class="validate" name="">
                                                                            <label for="us-zip" class="control-label"><?php echo lang('zip') ?>
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
                                                                    <div class="form-group input-field">
                                                                        <div class="col-md-6" style="padding-left: 0">
                                                                            <table>
                                                                                <tr>
                                                                                    <td style="width: 98%">
                                                                                        <input type="text" id="cl_phone" name="data[phone]" class="form-control required_form " maxlength="50" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');" " />
                                                                                        <label for="cl_phone" class=""><?php echo lang('phone') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div><!-- ./col -->
                                                                        <div class="input-field col-md-6 rem-sel">
                                                                            <input type="text" list="phonename8" name="data[phone_type]">
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
                                                                    <div class="form-group input-field">
                                                                        <div class="col-md-6" style="padding-left: 0">
                                                                            <input type="text"  id="cl_phone_2" name="data[phone2]" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                            <label for="cl_phone_2" class=""><?php echo lang('phone_2') ?></label>
                                                                        </div><!-- ./col -->
                                                                        <div class="input-field col-md-6" style="margin-top: 0">
                                                                            <input type="text" name="data[phone_type]" list="phonename9">
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
                                                                    <div class="form-group input-field">
                                                                        <div class="col-md-6" style="padding-left: 0">
                                                                            <input type="text" id="cl_phone_3"  name="data[phone3]" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                            <label for="cl_phone_3" class=""><?php echo lang('phone_3') ?></label>
                                                                        </div><!-- ./col -->
                                                                        <div class="input-field col-md-6" style="margin-top: 0">
                                                                            <input type="text" name="phone3" list="phonename10">
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
                                                                    <div class="form-group input-field">
                                                                        <div class="col-md-6" style="padding-left: 0">
                                                                            <input type="text" id="cl_phone_4"  name="data[phone4]" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                            <label for="cl_phone_4" class=""><?php echo lang('phone-4') ?></label>
                                                                        </div><!-- ./col -->
                                                                        <div class="input-field col-md-6" style="margin-top: 0">
                                                                            <input type="text" name="phone4" list="phonename11">
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
                                                                    <div class="form-group input-field">
                                                                        <div class="col-md-6" style="padding-left: 0">
                                                                            <input type="text" id="cl_phone_5"  name="data[phone4]" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                            <label for="cl_phone_5" class=""><?php echo lang('phone_5') ?></label>
                                                                        </div><!-- ./col -->
                                                                        <div class="input-field col-md-6" style="margin-top: 0">
                                                                            <input type="text" name="phone5" list="phonename12">
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
                                                                    <div class="input-field">
                                                                        <input id="cl-email" type="email" class="validate" name="data[email]" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                        <label for="cl-email" data-error="wrong" data-success="right">Email</label>
                                                                    </div>
                                                                    <div class="btn-add add-row-button" next-row-class="email-second-row">
                                                                        <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                                <!--email 2-->
                                                                <div class="col-md-12 email  email-second-row" style="display: none">
                                                                    <div class="input-field">
                                                                        <input id="cl-email-2" type="email" class="validate" name="" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                        <label for="cl-email-2" data-error="wrong" data-success="right">Email 2</label>
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
                                                                    <div class="input-field">
                                                                        <input id="cl-email-3" type="email" class="validate" name="" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                        <label for="cl-email-3" data-error="wrong" data-success="right">Email 3</label>
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
                                                                    <div class="input-field">
                                                                        <input id="cl-email-4" type="email" class="validate" name="" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                        <label for="cl-email-4" data-error="wrong" data-success="right">Email 4</label>
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
                                                                    <div class="input-field">
                                                                        <input id="cl-email-5" type="email" class="validate" name="" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');">
                                                                        <label for="cl-email-5" data-error="wrong" data-success="right">Email 5</label>
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
                                                                                <input id="cl-primary-color" type="text" class="validate">
                                                                                <label for="cl-primary-color" class="control-label"><?php echo lang('primary-color') ?></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <div class="input-field">
                                                                                <input id="cl-accent-color" type="text" class="validate">
                                                                                <label for="cl-accent-color" class="control-label"><?php echo lang('accent-color') ?></label>
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
                </div><!-- ./page-conten -->
            </div>
            <!-- END CONTAINER ./page-content-wrapper -->
        </div>
    </div>
</div>