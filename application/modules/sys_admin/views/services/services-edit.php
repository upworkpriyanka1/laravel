<?php $ci = &get_instance();
echo link_tag('assets/global/plugins/fancybox/source/jquery.fancybox.css');
echo link_tag('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css');
?>

<script type="text/javascript">
    /*<![CDATA[*/
    var sv_id= '<?= $sv_id ?>'
    var is_insert= '<?= $is_insert ?>'
    var base_url= '<?= base_url() ?>'

    /*]]>*/
</script>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">


                <div class="page-bar">
                    <h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('service') ?></center></h3>
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url() ;?>sys-admin/services/services-edit/<?= ( $is_insert ? "new" : $sv_id ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_service_edit" name="form_service_edit" class="form-horizontal">
                        <input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                        <input type="hidden" id="filter_sv_title" name="filter_sv_title" value="<?=$filter_sv_title?>">
                        <input type="hidden" id="filter_vendor_type_id" name="filter_vendor_type_id" value="<?=$filter_vendor_type_id?>">
                        <input type="hidden" id="filter_active_status" name="filter_active_status" value="<?=$filter_active_status?>">
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
                            <? endif; ?>

                            <?php if ( !$is_insert ) : ?>
                                <div class="row">
                                    <!-- Service Types sv_id -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('sv_id');?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[sv_id]" id="sv_id" value="<?= (!empty($service->sv_id) ? $service->sv_id:''); ?>" data-required="1" class="form-control" readonly />

                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div>
                            <?php endif; ?>

                            <div class="row">
                                <!-- Service sv_title -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[sv_title]", ' has-error ')?> ">
                                        <label class="control-label col-md-4"><?php echo lang('sv_title') ?>
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" name="data[sv_title]" id="sv_title" value="<?= ( !empty($service->sv_title) ? $service->sv_title : '' ); ?>" data-required="1" class="form-control" />

                                        </div><!-- ./col -->
                                    </div><!-- ./form-group -->
                                </div><!-- ./col -->
                            </div>


                            <div class="row">
                                <!-- service url -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[sv_active_status]", ' has-error ')?>">
                                        <label class="control-label col-md-4"><?php echo lang('sv_active_status') ?>
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-7">
                                            <select id="sv_active_status" name="data[sv_active_status]" class="form-control">
                                                <option value="">Select Service Active Status</option>
                                                <?php foreach( $service_ActiveStatusList as $next_key=>$next_Service_Active_Status ) { ?>
                                                    <option value="<?=$next_Service_Active_Status['key']  ?>" <?=( $service->sv_active_status == $next_Service_Active_Status['key'] ? "selected" : "" ) ?> ><?=$next_Service_Active_Status['value'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div><!-- ./col -->
                                    </div><!-- ./form-group -->
                                </div><!-- ./col -->
                            </div> <!-- ./row -->


                            <div class="row">
                                <!-- service url -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[sv_vendor_type_id]", ' has-error ')?>">
                                        <label class="control-label col-md-4"><?php echo lang('vendor-types') ?>
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-7">
                                            <select id="sv_vendor_type_id" name="data[sv_vendor_type_id]" class="form-control">
                                                <option value="">Select Vendor Type</option>
                                                <?php foreach( $vendor_TypesSelectionList as $next_key=>$next_Vendor_Type ) { ?>
                                                    <option value="<?=$next_Vendor_Type['key']  ?>"  <?=( $service->sv_vendor_type_id == $next_Vendor_Type['key'] ? "selected" : "" ) ?>  ><?=$next_Vendor_Type['value']  ?></option>
                                                <?php } ?>
                                            </select>
                                        </div><!-- ./col -->
                                    </div><!-- ./form-group -->
                                </div><!-- ./col -->
                            </div> <!-- ./row -->


                            <div class="row">
                                <!-- Service Types sv_description -->
                                <div class="col-md-12">
                                    <div class="form-group <?= $this->common_lib->set_field_error_tag("data[sv_description]", ' has-error ')?> ">
                                        <label class="control-label col-md-4"><?php echo lang('sv_description') ?>
                                        </label>
                                        <div class="col-md-7">
                                            <textarea rows="8" cols="120" name="data[sv_description]" id="sv_description" data-required="1" class="form-control" /><?= ( !empty($service->sv_description) ? $service->sv_description : '' ) ?></textarea>
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
                                                <input type="text" value="<?= ( !empty($service->created_at) ? $ci->common_lib->format_datetime( $service->created_at ) : '' ) ?>" class="form-control" disabled />
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
                                                <input type="text" value="<?= ( !empty($service->updated_at) ? $ci->common_lib->format_datetime( $service->updated_at ) : '' ) ?>" class="form-control" disabled />
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
                                        <button type="button" class="btn btn-primary" onclick="javascript:onSubmit();" >Submit</button>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 pull-left ">
                                        <button type="reset" class="btn btn-cancel-action" onclick="javascript:document.location='<?=base_url()?>sys-admin/services/services-view<?=$page_parameters_with_sort?>'" >Cancel</button>
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



<?php if ( !$is_insert ) : ?>
    <div class="row" style="padding: 0; margin: 0">


        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_service_images">Service Images</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab_service_images" class="tab-pane fade in active">

                <div class="row" style="padding: 20px;">
                    <div id="div_upload_image">
                        <div class="padding_sm row">
                            <div class="col-xs-12 col-sm-3">
                                Upload&nbsp;image:&nbsp;
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <input id="fileupload"  type="file" class="service_image_fileupload" name="files[]" multiple >
                            </div>
                        </div >
                    </div >
                    <div id="div_upload_image_info" class=" has-error "></div >

                </div >

                <div class="row" style="padding: 20px;">
                    <div id="div_save_upload_image"  style="display:none" >

                        <div class="row padding_sm" >
                            <img id="img_preview_image" alt="Preview" title="Preview" width="128" height="128" >
                            <div id="img_preview_image_info" ></div>
                            <div >
                                <label for="is_main_image">Is Main Image&nbsp;</label><input type="checkbox" id="is_main_image" value="1">
                            </div>
                            <input type="hidden" id="hidden_selected_image">
                        </div>

                        <div class="row" >
                            <div class=" btn-group pull-left editor_btn_group" >
                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="javascript:UploadImage();">Upload Image</button>
                                <button type="button" class="btn btn-cancel-action" data-dismiss="modal" onclick="javascript:CancelUploadImage();">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="div_load_service_images"></div>
            </div>
        </div>
    </div>
<?php endif ; ?>

