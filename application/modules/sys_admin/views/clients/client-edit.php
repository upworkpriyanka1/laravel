<?php $ci = &get_instance(); ?>
<?php if (isset($client) && count($client)>0){  ?>
    base_url

    <script type="text/javascript">
        /*<![CDATA[*/
        var client_id= '<?= $client->cid ?>'
        var base_url= '<?= base_url() ?>'
        //        alert( "client_id::"+var_dump(client_id) )

        /*]]>*/
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit portlet-form bordered">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo current_url() ;?>/update/<?= $PageParametersWithSort ?>" method="post" id="client-add" class="form-horizontal">
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
                                            <label class="control-label col-md-4"><?php echo lang('client_name') ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[client_name]" id="client_name" value="<?= $client->client_name;?>" data-required="1" class="form-control" />

                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                    <!-- client owner -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('client_owner') ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[client_owner]" value="<?= $client->client_owner;?>" data-required="1" class="form-control" />
                                            </div><!-- ./col -->
                                        </div> <!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div> <!-- ./row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('client_active_status') ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <?php echo MyCustom_menu($client_active_status_array,'data[client_active_status]','form-control',$client->client_active_status," -Client Active Status- ",'id ="client_active_status"'); ?>
                                            </div>
                                        </div>
                                    </div> <!-- ./row -->
                                </div>


                                <div class="row">
                                    <!-- client Addrtess 1 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('address1') ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[client_address1]" value="<?= $client->client_address1;?>" data-required="1" class="form-control" />
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                    <!-- client Address 2 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('address1') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[client_address2]" value="<?= $client->client_address2;?>"  class="form-control" />
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
                                                <input type="text" name="data[client_city]" value="<?= $client->client_city;?>" data-required="1" class="form-control" />
                                            </div><!-- ./col -->
                                            <div class="col-md-1">
                                                <input type="text" name="data[client_state]" value="<?= $client->client_state;?>" data-required="1"  class="form-control" />
                                            </div><!-- ./col -->
                                            <div class="col-md-1">
                                                <input type="text" name="data[client_zip]" value="<?= $client->client_zip;?>" data-required="1" class="form-control" />
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
                                                <input type="text" name="data[client_phone]" value="<?= $client->client_phone;?>" data-required="1" class="form-control" />
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                    <!-- client fax -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('fax') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[client_fax]" value="<?= $client->client_fax;?>" class="form-control" />
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
                                                <input type="text" name="data[client_email]" value="<?= $client->client_email;?>" data-required="1" class="form-control" />
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->

                                    <!-- client url -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('website') ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[client_website]" value="<?= $client->client_website;?>" data-required="1" class="form-control" />
                                                <span class="help-block"> <?php echo lang('website_help');?></span>
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div> <!-- ./row -->


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('clients-type') ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <?php echo MyCustom_menu($client_types,'data[clients_types_id]','form-control',$client->type_id," -Client Type- ",'id ="clients_types_id"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- notes -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('notes') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <textarea name="data[client_notes]"  class="form-control" /> <?= $client->client_notes;?></textarea>
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div> <!-- ./row -->



                                <div class="row">
                                    <!-- client email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('created_at') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" value="<?= $ci->common_lib->format_datetime( $client->created_at )?>" class="form-control" disabled />
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->

                                    <!-- client url -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('updated_at') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" value="<?= $ci->common_lib->format_datetime( $client->updated_at ) ?>" class="form-control" disabled />
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div> <!-- ./row -->


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-4 col-md-9">
                                                    <button type="submit" id="BtnSave" data-action="edit" class="btn green"><?php echo lang('submit');?></button>
                                                </div>
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


    <div class="row" style="padding: 0; margin: 0">
        <ul class="nav nav-tabs">
            <li class="active" >
                <a data-toggle="tab" href="#tabpanel_client_related_users in">
                    <span class="">Related Users</span>
                </a>
            </li>

<!--            <li >-->
<!--                <a data-toggle="tab" href="#tabpanel_another_tab">-->
<!--                    <span class="">Another Tab</span>-->
<!--                </a>-->
<!--            </li>-->

        </ul>

        <div id="tabpanel_client_related_users" class="tab-pane fade in">

            <div class="col-lg-12" style="padding: 5px;">
                <input type="hidden" name="status" id="status" value="A">
                <input type="hidden" name="sort_field_name" id="sort_field_name" value="username">
                <input type="hidden" name="sort_direction" id="sort_direction" value="desc">

                <div class="col-xs-6 col-sm-4" style="padding: 5px;">
                    <select id="select_related_users_type" class="form-control">
                        <option value="A">Select All</option>
                        <option value="E">Only Employees</option>
                        <option value="O">Only Out Of Staff</option>
<!--                        <option value="N">Only Not Related</option>-->
                    </select>
                </div>
                <div class="col-xs-6 col-sm-4" style="padding: 5px;">
                    <select id="select_user_active_status" class="form-control">
                        <option value="">Select User Status</option>
                        <?php foreach( $user_active_status_array as $next_key=>$next_user_active_status ) { ?>
                            <option value="<?=$next_user_active_status['key']  ?>"><?=$next_user_active_status['value']  ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4" style="padding: 5px;">
                    <div class="col-xs-8">
                        <input type="text" id="input_related_users_filter" name="input_related_users_filter" value="" size="20" maxlength="50" class="form-control">
                    </div>
                    <div class="col-xs-4">
                        <button type="button" id="BtnFilter" data-action="edit" class="btn green" onclick="javascript:run_related_users_filter();" ><?php echo lang('Filter');?></button>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div id="div_load_related_users"></div>
            </div>
        </div>

<!--        <div id="tabpanel_another_tab" class="tab-pane fade">-->
<!--            tabpanel_another_tab-->
<!--        </div>-->

    </div>

<?php } ?>

<!-- Popup dialog for filtering set -->
<div class="modal fade" id="related_user_enabled_dialog" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Client/User&nbsp;Relation&nbsp;Setup</div>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post"  enctype="multipart/form-data" >

                    <input type="hidden" id="hidden_related_user_id" name="hidden_related_user_id" value="">

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-7 control-label" >Choose Operation for Client </label>
                            <div class="col-xs-12 col-sm-5">
                                <h4><b><span id="span_client_name"></span></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 center">
                            You can set relation for user
                            <b><span id="span_related_user_username"></span></b>
                            &nbsp;( <b><span id="span_related_user_active_status_label"></span>&nbsp;status,&nbsp;<span id="span_uc_active_status_label"></span></b>&nbsp;)<br>
                            &nbsp;with email&nbsp;<b><span id="span_related_user_email"></span></b>,&nbsp;with phone&nbsp;<b><span id="span_related_user_phone"></span></b>
                        </div>
                    </div>

                    <hr>

                    <div class="row" id="div_set_status_employee">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-7 control-label" >Set Status "Employee" - client would be able to give tasks for the user as Employee.</label>
                            <div class="col-xs-12 col-sm-5">
                                <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:setRelatedUserStatus('E'); return false; " role="button">Set Status "Employee"</button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row" id="div_set_status_out_of_staff">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-7 control-label" >Set Status "Out Of Staff" - client would be able to give tasks for the user as Contractor.</label>
                            <div class="col-xs-12 col-sm-5">
                                <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:setRelatedUserStatus('O'); return false; " role="button">Set Status "Out Of Staff"</button>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="div_set_status_not_related">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-7 control-label" >Set Status "Not Related" - client would not be able to give tasks for the user.</label>
                            <div class="col-xs-12 col-sm-5">
                                <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:setRelatedUserStatus('N'); return false; " role="button">Set Status "Not Related"</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer ">
                <div class="btn-group  pull-right editor_btn_group " role="group" aria-label="group button">
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
                </div>
            </div>
        </div> <!-- class="modal-body" -->
    </div>

</div>
