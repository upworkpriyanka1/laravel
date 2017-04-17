<?php $ci = &get_instance(); ?>

<script type="text/javascript">
	/*<![CDATA[*/
	var client_id= '<?= ( !empty($client->cid) ? $client->cid : '' ) ?>'
	var base_url= '<?= base_url() ?>'
	var is_insert= '<?= $is_insert ?>'

	/*]]>*/
</script>

<div class="row" id="newuserform">
	<div class="col-md-12">
        <div class="row">
            <!-- BEGIN FORM-->
            <form action="#" id="new_user_form">

                <div class="form-body">
                    <!-- start Account-->

                    <!-- User name -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-name" type="text" class="validate">

                                    <label for="us-name" class="control-label"><?php echo lang('user_name') ?>
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User password -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-pass" type="password" class="validate">

                                    <label for="us-pass" class="control-label"><?php echo lang('password') ?>
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-pass-conf" type="password" class="">

                                    <label data-error="wrong" data-success="right" for="us-pass-conf" class="control-label"><?php echo lang('password_confirm') ?>
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end Account-->


                    <!-- start General-->

                    <!-- User names -->
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-fr-nm" type="text" class="validate">
                                    <label for="us-fr-nm" class="control-label"><?php echo lang('first_name') ?>
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-md-nm" type="text" class="validate">
                                    <label for="us-md-nm" class="control-label"><?php echo lang('middle_name') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-fr-nm" type="text" class="validate">
                                    <label for="us-fr-nm" class="control-label"><?php echo lang('last_name') ?>
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end General-->

                    <!-- start Contact-->

                    <!-- user address -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-adr"  type="text"  class="validate">
                                    <label for="us-adr" class="control-label"><?php echo lang('address') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-adr2"  type="text"  class="validate">
                                    <label for="us-adr2" class="control-label"><?php echo lang('address2') ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- City-state-zip-->
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-city"  type="text"  class="validate">
                                    <label for="us-city" class="control-label"><?php echo lang('city') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-state"  type="text"  class="validate">
                                    <label for="us-state" class="control-label"><?php echo lang('state') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <div class="input-field">
                                    <input id="us-zip"  type="number"  class="validate">
                                    <label for="us-zip" class="control-label"><?php echo lang('zip') ?></label>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--Phone-->
                    <div class="row">
                        <!-- client phone -->
                        <div class="col-md-12 phone add-row-able" next-row-class="phone-second-row">
                            <div class="form-group input-field">
                                <div class="col-md-6" style="padding-left: 0">
                                    <table>
                                        <tr>
                                            <td style="width: 98%">
                                                <input type="text" id="us_phone"  class="form-control required_form " maxlength="50" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');" " />
                                                <label for="us_phone" class=""><?php echo lang('phone') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                            </td>
                                        </tr>
                                    </table>
                                </div><!-- ./col -->
                                <div class="input-field col-md-6 rem-sel">
                                    <input type="text" name="phone1" list="phonename8">
                                    <datalist id="phonename8">
                                        <option value="Home">
                                        <option value="Work">
                                        <option value="Other">
                                    </datalist>

                                </div>
                            </div>
                            <!-- ./form-group -->
                            <div class="btn-add add-row-button" next-row-class="phone-second-row">
                                <a href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                            </div>


                        </div><!-- ./col -->

                        <!-- client phone_2 -->
                        <div class="col-md-12 phone  phone-second-row" id="div_phone_2" style="display: <?= ( !empty($client->client_phone_2) ? 'block' : 'none' ); ?>">
                            <div class="form-group input-field">
                                <div class="col-md-6" style="padding-left: 0">
                                    <input type="text"  id="us_phone-2" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                    <label for="us_phone-2" class=""><?php echo lang('phone_2') ?></label>
                                </div><!-- ./col -->
                                <div class="input-field col-md-6">
                                    <input type="text" name="phone2" list="phonename2">
                                    <datalist id="phonename2">
                                        <option value="Home">
                                        <option value="Work">
                                        <option value="Other">
                                    </datalist>

                                </div>
                            </div><!-- ./form-group -->
                            <div class="btn-add add-row-button" next-row-class="phone-third-row">
                                <a href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                            </div>
                            <div class="btn-rem">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </div>
                        </div><!-- ./col -->

                        <!-- client phone_3 -->
                        <div class="col-md-12 phone  phone-third-row" id="div_phone_3" style="display: none;">
                            <div class="form-group input-field">
                                <div class="col-md-6" style="padding-left: 0">
                                    <input type="text" id="us_phone_3"  class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                    <label for="us_phone_3" class=""><?php echo lang('phone_3') ?></label>
                                </div><!-- ./col -->
                                <div class="input-field col-md-6">
                                    <input type="text" name="phone3" list="phonename3">
                                    <datalist id="phonename3">
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
                        <div class="col-md-12">
                            <div class="input-field">
                                <input id="us-email" type="email" class="validate">
                                <label for="us-email" data-error="wrong" data-success="right">Email</label>
                            </div>
                        </div>
                    </div>

                    <!-- end Contact-->


                    <!--start Employment-->
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="col-sm-4">
                                    <input class="with-gap" name="group1" type="radio" id="full_time"  />
                                    <label for="full_time"><?php echo lang('full_time')?></label>
                                </div>
                                <div class="col-sm-4">
                                    <input class="with-gap" name="group1" type="radio" id="part_time"  />
                                    <label for="part_time"><?php echo lang('part_time')?></label>
                                </div>
                                <div class="col-sm-4">
                                    <input class="with-gap" name="group1" type="radio" id="contractor"  />
                                    <label for="contractor"><?php echo lang('contractor')?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end Employment-->

                    <!--title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-field">
                                <input id="us-title" type="text">
                                <label for="us-title"><?php echo lang('title')?></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-field">
                                <input id="us-lic" type="text">
                                <label for="us-lic"><?php echo lang('license')?></label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <label>from</label>
                                <input type="date" class="datepicker">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label>to</label>
                                <input type="date" class="datepicker">
                            </div>
                        </div>
                    </div>

                    <ul class="md-foot-top">
                        <li class="create-contact-more" style="display: inline-block"><button class="btn-flat btn-flat1 reset_form_btn">Reset</button></li>
                        <li class="create-contact-more" style="display: inline-block;"><button class="btn-flat btn-flat1">SUBMIT</button></li>
                    </ul>


                </div>

            </form>
            <!-- END FORM-->
        </div>
	</div>
</div><!-- ./row -->


