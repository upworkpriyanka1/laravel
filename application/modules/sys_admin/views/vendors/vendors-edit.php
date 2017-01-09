<?php $ci = &get_instance();  ?>

<script type="text/javascript">
    /*<![CDATA[*/
    var vn_id= '<?= $vn_id ?>'
    var is_insert= '<?= $is_insert ?>'
    var base_url= '<?= base_url() ?>'

    /*]]>*/
</script>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">

	            <h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('vendor') ?></center></h3>
	            <?= $this->common_lib->show_info($editor_message) ?>

                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url() ;?>sys-admin/vendors/vendors-edit/<?= ( $is_insert ? "new" : $vn_id ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_vendor_edit" name="form_vendor_edit" class="form-horizontal">
                        <input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                        <input type="hidden" id="filter_vn_name" name="filter_vn_name" value="<?=$filter_vn_name?>">
                        <input type="hidden" id="filter_vendor_type_id" name="filter_vendor_type_id" value="<?=$filter_vendor_type_id?>">
                        <input type="hidden" id="filter_created_at_from" name="filter_created_at_from" value="<?=$filter_created_at_from?>">
                        <input type="hidden" id="filter_created_at_till" name="filter_created_at_till" value="<?=$filter_created_at_till?>">


                        <div class="form-body">
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
                            <?php endif; ?>

                            <?php if ( !$is_insert ) : ?>
                                <div class="row">
                                    <!-- Vendor Types vn_id -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('vn_id');?></label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[vn_id]" id="vn_id" value="<?= (!empty($vendor->vn_id) ? $vendor->vn_id:''); ?>" data-required="1" class="form-control" readonly />

                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div>
                            <?php endif; ?>

                            <div class="row">
                                <!-- Vendor Types vn_name -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[vn_name]", ' has-error ')?> ">
                                        <label class="control-label col-md-4"><?php echo lang('vn_name') ?>
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" name="data[vn_name]" id="vn_name" value="<?= ( !empty($vendor->vn_name) ? $vendor->vn_name : '' ); ?>" data-required="1" class="form-control" <?php echo !$is_insert ? " readonly " : "" ?> />

                                        </div><!-- ./col -->
                                    </div><!-- ./form-group -->
                                </div><!-- ./col -->
                            </div>

                            <div class="row">
                                <!-- vendor email -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[vn_email]", ' has-error ')?>">
                                        <label class="control-label col-md-4"><?php echo lang('vn_email') ?>
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" name="data[vn_email]" id="vn_email" value="<?= ( !empty($vendor->vn_email) ? $vendor->vn_email : '' ); ?>" data-required="1" class="form-control" <?php echo !$is_insert ? " readonly " : "" ?> />
                                        </div><!-- ./col -->
                                    </div><!-- ./form-group -->
                                </div><!-- ./col -->
                            </div>

                            <div class="row">
                                <!-- vendor website -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[vn_website]", ' has-error ')?>">
                                        <label class="control-label col-md-4"><?php echo lang('vn_website') ?>
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" name="data[vn_website]" value="<?= ( !empty($vendor->vn_website) ? $vendor->vn_website : '' ) ?>" data-required="1" class="form-control" />
                                            <span class="help-block"> <?php echo lang('website_help');?></span>
                                        </div><!-- ./col -->
                                    </div><!-- ./form-group -->
                                </div><!-- ./col -->
                            </div> <!-- ./row -->

                            <div class="row">
                                <!-- vendor has types label -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("vendor_has_types_label", ' has-error ')?>">
                                        <label class="control-label col-md-4"><?php echo lang('vendor_has_types_label') ?>
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-7">
                                            <?php foreach( $vendor_TypesSelectionList as $next_key=>$next_vendor_Type ) { ?>
                                            <div class="text-left" style="padding: 10px;">
                                                <input type="checkbox" value="1" id="cbx_vendor_type_<?=$next_vendor_Type['key'] ?>" name="cbx_vendor_type_<?=$next_vendor_Type['key'] ?>" <?= ( !empty($next_vendor_Type['checked']) ? "checked" : "") ?> >
<!--                                                --><?//=$next_vendor_Type['value'] ?><!--&nbsp;-->
	                                            <label for="cbx_vendor_type_<?=$next_vendor_Type['key'] ?>"><?=$next_vendor_Type['value'] ?></label>
                                            </div>
                                            <?php }  ?>


                                        </div><!-- ./col -->
                                    </div><!-- ./form-group -->
                                </div><!-- ./col -->
                            </div> <!-- ./row -->






                            <div class="row">
                                <!-- Vendor Types vn_description -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[vn_description]", ' has-error ')?> ">
                                        <label class="control-label col-md-4"><?php echo lang('vn_description') ?>
                                        </label>
                                        <div class="col-md-7">
                                            <textarea rows="8" cols="120" name="data[vn_description]" id="vn_description" data-required="1" class="form-control" /><?= ( !empty($vendor->vn_description) ? $vendor->vn_description : '' ) ?></textarea>
                                        </div><!-- ./col -->
                                    </div> <!-- ./form-group -->
                                </div><!-- ./col -->
                            </div> <!-- ./row -->


                            <?php if ( !$is_insert ) : ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('created_at') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" value="<?= ( !empty($vendor->created_at) ? $ci->common_lib->format_datetime( $vendor->created_at ) : '' ) ?>" class="form-control" disabled />
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div><!-- ./col -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('updated_at') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" value="<?= ( !empty($vendor->updated_at) ? $ci->common_lib->format_datetime( $vendor->updated_at ) : '' ) ?>" class="form-control" disabled />
                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div><!-- ./col -->
                            <?php endif; ?>

                            <section class="row ">
                                <div class=" btn-group pull-right editor_btn_group " >
                                    <div class="col-xs-6  col-sm-4  ">
                                        On Update&nbsp;
                                        <select id="select_on_update" name="select_on_update">
                                            <option value="reopen_editor" <?= ( $select_on_update == "reopen_editor" ? "selected" : "") ?> >Reopen editor</option>
                                            <option value="open_editor_for_new" <?= ( $select_on_update == "open_editor_for_new" ? "selected" : "") ?> >Open editor for new</option>
                                            <option value="reopen_listing" <?= ( $select_on_update == "reopen_listing" ? "selected" : "") ?> >Reopen listing</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6  col-sm-4 ">
                                        <button type="button" class="btn green waves-effect waves-light" onclick="javascript:onSubmit();" >Submit</button>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 pull-left ">
                                        <button type="reset" class="btn btn-cancel-action waves-effect waves-light" onclick="javascript:document.location='<?=base_url()?>sys-admin/vendors/vendors-view<?=$page_parameters_with_sort?>'" >Cancel</button>
                                    </div>
                                    <div class="col-sm-2 ">
                                    </div>
                                </div>
                            </section>

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
            <a data-toggle="tab" href="#tabpanel_vendor_contacts in">
                <span class=""><?=lang('vendor_contacts') ?></span>
            </a>
        </li>
    </ul>

    <div id="tabpanel_vendor_contacts" class="tab-pane fade in">
        <div class="col-lg-12">
            <div id="div_load_vendor_contacts"></div>
        </div>
    </div>
</div>


<!-- Popup dialog for Vendor Contact -->
<div class="modal fade" id="vendor_related_contact_dialog" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title"><?= lang('edit')?>&nbsp;<?= lang('vendor_contact')?></div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_vendors" name="form_vendors" method="post"  enctype="multipart/form-data" >

                    <input type="hidden" id="popup_vc_id" name="popup_vc_id" value="">

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="popup_vc_person_name"><?php echo lang('vc_person_name') ?></label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="popup_vc_person_name" type="text" size="50" maxlength="50">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="popup_vc_person_description"><?php echo lang('vc_person_description') ?></label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="popup_vc_person_description" type="text" size="50" maxlength="255">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="popup_vc_phone"><?php echo lang('vc_phone') ?></label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="popup_vc_phone" type="text" size="50" maxlength="50">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="popup_vc_phone_description"><?php echo lang('vc_phone_description') ?></label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="popup_vc_phone_description" type="text" size="50" maxlength="255">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="popup_vc_person_email"><?php echo lang('vc_person_email') ?></label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="popup_vc_person_email" type="text" size="20" maxlength="50">
                            </div>
                        </div>
                    </div>



                </form>
            </section>

            <section class="modal-footer ">
                <div class="btn-group  pull-right editor_btn_group " role="group" aria-label="group button">
                    <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:saveRelatedVendorContact(); return false; " role="button">Submit</button>
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
                </div>
            </section>
        </div>
    </div>
</div>