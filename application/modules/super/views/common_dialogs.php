<div class="modal fade newclient" id="newclient" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-top">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">New Client</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="page-bar">
                                    <!--<h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('client') ?></center></h3>-->
                                    <?= $this->common_lib->show_info($editor_message) ?>
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form action="<?php echo base_url() ;?>sys-admin/clients-view/<?= ( $is_insert ? "new" : $cid ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_client_edit" name="form_client_edit" class="form-horizontal"  enctype="multipart/form-data">


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
                                                <!-- Client Types cid -->
                                                <div class="col-md-6">
                                                    <div class="form-group input-field">
                                                        <div class="col-md-7">
                                                            <input type="text" name="data[cid]" id="cid" value="<?= (!empty($client->cid) ? $client->cid:''); ?>" class="form-control" readonly />
                                                            <label for="cid" class="control-label col-md-4"><?php echo lang('cid');?></label>
                                                        </div><!-- ./col -->
                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>
                                        <?php endif; ?>

                                        <div class="row">
                                            <!-- client owner -->
                                            <div class="col-md-12">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_owner]", ' has-error ')?>">

                                                    <div class="col-md-12" style="display: <?php echo ( $client_owner_input_visible ? "block" :"block" ) ; ?>" id="div_client_owner_input">
                                                        <i class="material-icons prefix">assignment_ind</i>
                                                        <input type="text" name="data[client_owner]" id="client_owner" value="<?= ( !empty($client->client_owner) ? $client->client_owner : '' ); ?>" class="x-able form-control required_form" maxlength="100" onchange="validateFormEnableOrDisable('form_client_edit');"/>
                                                        <label for="client_owner" class=""><?php echo lang('client_owner') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                    </div>

                                                </div>
                                                <!-- ./form-group -->
                                            </div><!-- ./col -->
                                        </div>

                                        <div class="row">
                                            <!-- client Addrtess 1 -->
                                            <div class="col-md-6 ">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_address1]", ' has-error ')?>">

                                                    <div class="col-md-12" style="display: <?php echo ( $address1_input_visible ? "block" :"block" ) ; ?>" id="div_client_address1_input">
                                                        <i class="material-icons prefix">business</i>
                                                        <input type="text" name="data[client_address1]" id="client_address1" value="<?= ( !empty($client->client_address1) ? $client->client_address1 : '' ); ?>" class="form-control x-able required_form" maxlength="100" onchange="validateFormEnableOrDisable('form_client_edit');"/>
                                                        <label for="client_address1" class="col-md-4"><?php echo lang('address1') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                    </div>

                                                </div>
                                            </div><!-- ./col -->

                                            <!-- client Address 2 -->
                                            <div class="col-md-6">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_address2]", ' has-error ')?>">

                                                    <div class="col-md-12" style="display: <?php echo ( $address2_input_visible ? "block" :"block" ) ; ?>;" id="div_client_address2_input">
                                                        <input type="text" name="data[client_address2]" id="client_address2" value="<?= ( !empty($client->client_address2) ? $client->client_address2 : '' ); ?>"  class="form-control x-able" maxlength="100" />
                                                        <label for="client_address2" class="control-label col-md-4"><?php echo lang('address2') ?></label>
                                                    </div>

                                                </div> <!-- ./form-group -->
                                            </div><!-- ./col -->
                                        </div> <!-- ./row -->

                                        <div class="row">
                                            <!-- client city/state/zip -->
                                            <div class="col-md-12">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_state]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[client_city]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[client_zip]", ' has-error ')?> ">


                                                    <div class="col-md-4"  style="display: <?php echo ( $client_city_input_visible ? "block" :"block" ) ; ?>" id="div_client_city_input">
                                                        <i class="material-icons prefix">location_on</i>
                                                        <input type="text" name="data[client_city]" id="client_city" value="<?= ( !empty($client->client_city) ? $client->client_city : '' ); ?>" class="form-control x-able required_form" maxlength="100" onchange="validateFormEnableOrDisable('form_client_edit');"/>
                                                        <label for="client_city" class=""><?php echo lang('city') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                    </div>



                                                    <div class="col-md-4" style="display: <?php echo ( $client_state_input_visible ? "block" :"block" ) ; ?>" id="div_client_state_input">
                                                        <input type="text" name="data[client_state]" id="client_state" value="<?= ( !empty($client->client_state) ? $client->client_state : '' ); ?>" class="form-control x-able required_form" maxlength="100" onchange="validateFormEnableOrDisable('form_client_edit');"/>
                                                        <label for="client_state" class="control-label col-md-2"><?php echo lang('state') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                    </div>



                                                    <div class="col-md-4"  style="display: <?php echo ( $client_zip_input_visible ? "block" :"block" ) ; ?>" id="div_client_zip_input">
                                                        <input type="text" name="data[client_zip]" id="client_zip" value="<?= ( !empty($client->client_zip) ? $client->client_zip : '' ); ?>" class="form-control x-able required_form" maxlength="100" onchange="validateFormEnableOrDisable('form_client_edit');"/>
                                                        <label for="client_zip" class="control-label col-md-2"><?php echo lang('zip') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                    </div>


                                                </div>
                                            </div><!-- ./col -->
                                            <!-- client state -->

                                        </div> <!-- ./row -->

                                        <!--Phone-->
                                        <div class="row">
                                            <!-- client phone -->
                                            <div class="col-md-12 phone add-row-able" next-row-class="phone-second-row">

                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone]", ' has-error ')?>">
                                                    <div class="col-md-6">
                                                        <table>
                                                            <tr>
                                                                <td style="width: 98%">
                                                                    <i class="material-icons prefix">phone</i>
                                                                    <input type="text" name="data[client_phone]" id="client_phone" value="<?= ( !empty($client->client_phone) ? $client->client_phone : '' ); ?>" class="form-control required_form " maxlength="50" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');" " />
                                                                    <label for="client_phone" class=""><?php echo lang('phone') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div><!-- ./col -->
                                                    <div class="input-field col-md-6 rem-sel">

                                                        <input type="text" name="phone1" list="phonename1">
                                                        <datalist id="phonename1">
                                                            <option value="Home">
                                                            <option value="Work">
                                                            <option value="Other">
                                                        </datalist>

                                                    </div>

                                                </div><!-- ./form-group -->
                                                <div class="btn-add add-row-button" next-row-class="phone-second-row">

                                                    <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                </div>

                                            </div><!-- ./col -->

                                            <!-- client phone_2 -->
                                            <div class="col-md-12 phone  phone-second-row" id="div_phone_2" style="display: <?= ( !empty($client->client_phone_2) ? 'block' : 'none' ); ?>">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_2]", ' has-error ')?>">
                                                    <div class="col-md-6">
                                                        <i class="material-icons prefix">phone</i>
                                                        <input type="text" name="data[client_phone_2]" id="client_phone_2" value="<?= ( !empty($client->client_phone_2) ? $client->client_phone_2 : '' ); ?>" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                        <label for="client_phone_2" class=""><?php echo lang('phone_2') ?></label>
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
                                                    <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="btn-rem">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                </div>
                                            </div><!-- ./col -->

                                            <!-- client phone_3 -->
                                            <div class="col-md-12 phone  phone-third-row" id="div_phone_3" style="display: none;">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_2]", ' has-error ')?>">
                                                    <div class="col-md-6">
                                                        <i class="material-icons prefix">phone</i>
                                                        <input type="text" name="data[client_phone_3]" id="client_phone_3" value="<?= ( !empty($client->client_phone_3) ? $client->client_phone_3 : '' ); ?>" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                        <label for="client_phone_3" class=""><?php echo lang('phone_3') ?></label>
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

                                        <div class="row" style="display: none;">
                                            <!-- client phone_3 -->
                                            <div class="col-md-12 phone" id="div_phone_3" style="display: <?= ( !empty($client->client_phone_3) ? 'block' : 'none' ); ?>">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_3]", ' has-error ')?>">
                                                    <div class="col-md-6">
                                                        <i class="material-icons prefix">phone</i>
                                                        <input type="text" name="data[client_phone_3]" id="client_phone_3" value="<?= ( !empty($client->client_phone_3) ? $client->client_phone_3 : '' ); ?>" class="form-control x-able" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                        <label for="client_phone_3" class=""><?php echo lang('phone_3') ?></label>
                                                    </div><!-- ./col -->
                                                    <div class="input-field col-md-6">
                                                        <select>
                                                            <option value="" disabled selected>Custom Lable</option>
                                                            <option value="1">Home</option>
                                                            <option value="2">Work</option>
                                                            <option value="3">Other</option>
                                                        </select>

                                                    </div>
                                                </div><!-- ./form-group -->
                                                <div class="btn-add">
                                                    <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="btn-rem">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                </div>
                                            </div><!-- ./col -->

                                            <!-- client phone_4 -->
                                            <div class="col-md-6" id="div_phone_4" style="display: <?= ( !empty($client->client_phone_4) ? 'block' : 'none' ); ?>">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_4]", ' has-error ')?>">
                                                    <div class="col-md-4">
                                                        <i class="material-icons prefix">phone</i>
                                                        <input type="text" name="data[client_phone_4]" id="client_phone_4" value="<?= ( !empty($client->client_phone_4) ? $client->client_phone_4 : '' ); ?>" class="form-control" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                        <label for="client_phone_4" class="control-label col-md-4"><?php echo lang('phone_4') ?></label>
                                                    </div><!--  ./col -->
                                                    <div class="col-md-3">
                                                        <select name="data[client_phone_type]" id="client_phone_type" class="form-control" onchange="javascript:client_phone_typeOnChange()">
                                                            <option value="">Select Type</option>
                                                            <?php foreach( $client_phone_type_array as $next_key=>$next_client_phone_type ) { ?>
                                                                <option value="<?=$next_client_phone_type  ?>" <?= ( ( !empty($client->client_phone_type) and $client->client_phone_type == $next_client_phone_type ) ? 'selected' : '' ); ?> ><?=$next_client_phone_type  ?></option>
                                                            <?php } ?>
                                                            <option value="-add_new-">  - Add New-  </option>
                                                        </select>
                                                        <span id="span_new_client_phone_type" style="display: none;">
												                <input type="text" name="new_client_phone_type" id="new_client_phone_type" value="" class="form-control" maxlength="20" />
											                </span>
                                                    </div><!--  ./col -->
                                                </div><!-- ./form-group -->
                                            </div><!-- ./col -->


                                        </div> <!-- ./row -->

                                        <!--Email-->
                                        <div class="row">

                                            <!-- client email -->
                                            <div class="col-md-12 email add-row-able">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_email_first]", ' has-error ')?>">

                                                    <div class="col-md-6" style="display: <?php echo ( $client_email_input_visible ? "block" :"block" ) ; ?>" id="div_client_email_input">
                                                        <i class="material-icons prefix">email</i>
                                                        <input type="text" name="data[client_email_first]" id="client_email" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50"  />
                                                        <label for="client_email" class=""><?php echo lang('email') ?></label>
                                                    </div>

                                                    <div class="input-field col-md-6">
                                                        <input type="text" name="email1" list="emailname1">
                                                        <datalist id="emailname1">
                                                            <option value="Home">
                                                            <option value="Work">
                                                            <option value="Other">
                                                        </datalist>

                                                    </div>
                                                </div><!-- ./form-group -->
                                                <div class="btn-add add-row-button" next-row-class="email-second-row">
                                                    <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                </div>
                                                <!-- <div class="btn-rem">
                                                     <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                 </div>-->
                                            </div><!-- ./col -->

                                            <!-- client email -->
                                            <div class="col-md-12 email email-second-row" style="display:none;">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_email]", ' has-error ')?>" >



                                                    <div class="col-md-6" style="display: <?php echo ( $client_email_input_visible ? "block" :"block" ) ; ?>" id="div_client_email_input">
                                                        <i class="material-icons prefix">email</i>
                                                        <input type="text" name="data[client_email]" id="client_email" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50"  />
                                                        <label for="client_email" class=""><?php echo lang('email') ?></label>
                                                    </div>


                                                    <!-- ./col -->
                                                    <div class="input-field col-md-6">
                                                        <input type="text" name="email2" list="emailname2">
                                                        <datalist id="emailname2">
                                                            <option value="Home">
                                                            <option value="Work">
                                                            <option value="Other">
                                                        </datalist>

                                                    </div>
                                                </div><!-- ./form-group -->
                                                <div class="btn-add add-row-button" next-row-class="email-third-row">
                                                    <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="btn-rem">
                                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                </div>
                                            </div><!-- ./col -->

                                            <!-- client email -->
                                            <div class="col-md-12 email email-third-row" style="display:none;">
                                                <div class="form-group  input-field <?= $this->common_lib->set_field_error_tag("data[client_email]", ' has-error ')?>" >



                                                    <div class="col-md-6" style="display: <?php echo ( $client_email_input_visible ? "block" :"block" ) ; ?>" id="div_client_email_input">
                                                        <i class="material-icons prefix">email</i>
                                                        <input type="text" name="data[client_email]" id="client_email" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50"  />
                                                        <label for="client_email" class=""><?php echo lang('email') ?></label>
                                                    </div>


                                                    <!-- ./col -->
                                                    <div class="input-field col-md-6">

                                                        <input type="text" name="email3" list="emailname3">
                                                        <datalist id="emailname3">
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

                                        </div>
                                        <!--End Email-->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Type</h3>


                                                <form action="#">
                                                    <?php foreach ($cl_type as $key => $value): ?>
                                                        <p>
                                                            <input class="with-gap required_form_to_check" name="group1" type="radio" id="<?php echo $key?>" onchange="validateFormEnableOrDisable('form_client_edit');" />
                                                            <label for="<?php echo $key?>"><?php echo $value->type_name ?></label>
                                                        </p>
                                                    <?php endforeach;?>
                                                </form>
                                            </div>

                                            <!--Client_types-->

                                            <div class="col-md-6">
                                                <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[clients_types_id]", ' has-error ')?>">

                                                    <div class="col-md-12" style="display: <?php echo ( $clients_types_id_button_visible ? "none" :"none") ; ?>" id="div_clients_types_id_btn">
                                                        <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('clients_types_id',true);" id="btn_add_clients_types_id">Add a client type<span class="required">&nbsp;*&nbsp;</span></button>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>

                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
            </div>

            <div class="modal-footer">

                <div class="col-xs-12">

                    <ul class="md-foot-top">
                        <li class="create-contact-more"><button class="btn-flat disable_form_id_form_client_edit" disabled>+CONTACT</button></li>
                        <li class="create-contact-more"><button class="btn-flat  disable_form_id_form_client_edit supuser" disabled>+SUPERUSER</button></li>
                    </ul>

                    <ul class ="md-foot-bot">
                        <li data-dismiss="modal"> <button class="btn" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'">CANCEL</button> </li>
                        <li class="create-contact-save " data-action="save"> <button class="btn-flat  disable_form_id_form_client_edit" disabled> SAVE</button> </li>
                    </ul>


                </div>
            </div>
        </div>
        <div class=" modal-content modal-content1" style="display:none">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Company Name</h3>
            </div>


            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="text" class="validate"/>
                            <label for="icon_prefix">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">supervisor_account</i>
                            <input id="last_name" type="text" class="validate"/>
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">phone</i>
                            <input id="icon_telephone" type="tel" class="validate"/>
                            <label for="icon_telephone">Telephone</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" class="validate required_form"  onchange="validateFormEnableOrDisable('form_client_edit2');"/>
                            <label for="email">Email address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" class="validate required_form" onchange="validateFormEnableOrDisable('form_client_edit2');"/>
                            <label for="email">Verify email address</label>
                        </div>
                    </div>
                </form>
            </div>


            <div class="modal-footer">

                <div class="col-xs-12">


                    <ul class ="md-foot-bot">

                        <li data-dismiss="modal"> <button class="btn" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'">CANCEL</button> </li>
                        <li class="create-contact-save " data-action="save"> <button class="btn-flat  disable_form_id_form_client_edit2" disabled> VERIFY </button> </li>


                    </ul>


                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade newuser" id="new_user_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-top">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">New User</h3>
            </div>
            <div class="modal-body">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-field">
                                            <input id="us-fr-nm" type="text" class="validate">
                                            <label for="us-fr-nm" class="control-label"><?php echo lang('first_name') ?>
                                                <span class="required"> * </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-field">
                                            <input id="us-md-nm" type="text" class="validate">
                                            <label for="us-md-nm" class="control-label"><?php echo lang('middle_name') ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-field">
                                            <input id="us-city"  type="text"  class="validate">
                                            <label for="us-city" class="control-label"><?php echo lang('city') ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-field">
                                            <input id="us-state"  type="text"  class="validate">
                                            <label for="us-state" class="control-label"><?php echo lang('state') ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                    <div class="input-field">
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


                        </div>
                    </form>
                    <!-- END FORM-->
                </div>

            </div><!-- ./row -->
            <div class="modal-footer">

                <div class="col-xs-12">

                    <ul class="md-foot-top">
                        <li class="create-contact-more"><button class="btn-flat btn-flat1 reset_form_btn">Reset</button></li>
                        <li class="create-contact-more"><button class="btn-flat btn-flat1">SUBMIT</button></li>
                    </ul>

                    <ul class ="md-foot-bot">
                        <li data-dismiss="modal"> <button class="btn" onclick="javascript:document.location='<?=base_url()?>sys-admin/users/users-view<?=$page_parameters_with_sort?>'">CANCEL</button> </li>
                    </ul>


                </div>
            </div>
        </div>
    </div>
</div>