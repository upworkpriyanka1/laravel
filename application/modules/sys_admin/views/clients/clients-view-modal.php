<?php $ci = &get_instance();?>

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
                    <!-- BEGIN FORM 50 -->
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
                                        <label for="client_owner" class=""><?php echo lang('company_name') ?><span class="required">&nbsp;*&nbsp;</span></label>
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
                                                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="data[client_phone]" id="client_phone" value="<?= ( !empty($client->client_phone) ? $client->client_phone : '' ); ?>" class="form-control required_form " maxlength="50" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');" " />
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
                                        <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="data[client_phone_2]" id="client_phone_2" value="<?= ( !empty($client->client_phone_2) ? $client->client_phone_2 : '' ); ?>" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
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
                                        <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="data[client_phone_2]" name="data[client_phone_3]" id="client_phone_3" value="<?= ( !empty($client->client_phone_3) ? $client->client_phone_3 : '' ); ?>" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
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
								  <?php /*
								  $query = $this->db->select('clients_types_id')->get('clients');
								  $fi=$query->result();
								  $oneDimensionalArray = array_map('current', $fi);
								  $res=array_unique($oneDimensionalArray);
								  echo "<pre>";print_R($res);
								  foreach($res as $values)
								  {echo $values;
								   $query = $this->db->where('type_id != ',$values)->get('clients_types');
								   $result=$query->result();
								  }
								  
								  echo "<pre>";print_R($result);die;*/
								  ?>
								  <span id ='radioerr' style="color:red"></span>
                                    <?php foreach ($cl_type as $key => $value): ?>
									
                                        <p>
                                            <input class="with-gap required_form_to_check radios" name="group1" type="radio" id="<?php echo $key?>" value="<?php echo $value->type_id?>" onchange="validateFormEnableOrDisable('form_client_edit');" />
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
