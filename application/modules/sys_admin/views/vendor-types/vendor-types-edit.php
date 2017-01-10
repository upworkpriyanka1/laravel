<?php $ci = &get_instance(); ?>

    <script type="text/javascript">
        /*<![CDATA[*/
        var vt_id= '<?= $vt_id ?>'
        var base_url= '<?= base_url() ?>'

        /*]]>*/
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit portlet-form bordered">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">


                    <div >
                        <h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('vendor-types') ?></center></h3>
                        <?= $this->common_lib->show_info($editor_message) ?>
                    </div>

                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo base_url() ;?>sys-admin/vendors/vendor-types-edit/<?= ( $is_insert ? "new" : $vt_id ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_vendor_types_edit" name="form_vendor_types_edit" class="form-horizontal">
                            <input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                            <input type="hidden" id="filter_vt_name" name="filter_vt_name" value="<?=$filter_vt_name?>">
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
                                    <!-- Vendor Types vt_id -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('vt_id') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[vt_id]" id="vt_id" value="<?= (!empty($vendor_types->vt_id) ? $vendor_types->vt_id:''); ?>" data-required="1" class="form-control" readonly />

                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div>
                                <?php endif; ?>

                                <div class="row">
                                    <!-- Vendor Types vt_name -->
                                    <div class="col-md-12">
                                        <div class="form-group <?= $this->common_lib->set_field_error_tag("vt_name", ' has-error ')?> ">
                                            <label class="control-label col-md-4"><?php echo lang('vt_name') ?>
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="data[vt_name]" id="vt_name" value="<?= ( !empty($vendor_types->vt_name) ? $vendor_types->vt_name : '' ); ?>" data-required="1" class="form-control" />

                                            </div><!-- ./col -->
                                        </div><!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div>

                                <div class="row">
                                    <!-- Vendor Types vt_description -->
                                    <div class="col-md-12">
                                        <div class="form-group <?= $this->common_lib->set_field_error_tag("vt_description", ' has-error ')?> ">
                                            <label class="control-label col-md-4"><?php echo lang('vt_description') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <textarea rows="8" cols="120" name="data[vt_description]" data-required="1" class="form-control" /><?= ( !empty($vendor_types->vt_description) ? $vendor_types->vt_description : '' ) ?></textarea>
                                            </div><!-- ./col -->
                                        </div> <!-- ./form-group -->
                                    </div><!-- ./col -->
                                </div> <!-- ./row -->





                                <?php if ( !$is_insert ) : ?>
                                <div class="row">
                                    <!-- vendor_types email -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><?php echo lang('created_at') ?>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" value="<?= ( !empty($vendor_types->created_at) ? $ci->common_lib->format_datetime( $vendor_types->created_at ) : '' ) ?>" class="form-control" disabled />
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
                                            <button type="reset" class="btn btn-cancel-action" onclick="javascript:document.location='<?=base_url()?>sys-admin/vendors/vendor-types-view<?=$page_parameters_with_sort?>'" >Cancel</button>
<!--                                            <img src="{{ base_url }}static/images/{{ current_skin_name }}/clear-data.png" alt="Clear All Data" title="Clear All Data" class="a_link  img_clear_data" onclick="javascript:clearAllData()">-->
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

