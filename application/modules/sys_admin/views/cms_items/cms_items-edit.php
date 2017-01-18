<?php $ci = &get_instance();  ?>

<script type="text/javascript">
	/*<![CDATA[*/
    var ci_id= '<?= $ci_id ?>'
    var is_insert= '<?= $is_insert ?>'
    var base_url= '<?= base_url() ?>'
	/*]]>*/
</script>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit portlet-form bordered">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet light portlet-fit portlet-form bordered">

				<h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('cms_item') ?></center></h3>
				<?= $this->common_lib->show_info($editor_message) ?>

				<div class="portlet-body">
					<!-- BEGIN FORM-->
					<form action="<?php echo base_url() ;?>sys-admin/cms_items/cms_items-edit/<?= ( $is_insert ? "new" : $ci_id ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_cms_item_edit" name="form_cms_item_edit" class="form-horizontal">
						<input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

						<input type="hidden" id="filter_ci_title" name="filter_ci_title" value="<?=$filter_ci_title?>">
						<input type="hidden" id="filter_ci_published" name="filter_ci_published" value="<?=$filter_ci_published?>">
						<input type="hidden" id="filter_ci_alias" name="filter_ci_alias" value="<?=$filter_ci_alias?>">
						<input type="hidden" id="filter_ci_page_type" name="filter_ci_page_type" value="<?=$filter_ci_page_type?>">
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
									<!-- cms item ci_id -->
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-4"><?php echo lang('ci_id');?></label>
											<div class="col-md-7">
												<input type="text" name="data[ci_id]" id="ci_id" value="<?= (!empty($cms_item->ci_id) ? $cms_item->ci_id:''); ?>" data-required="1" class="form-control" readonly />

											</div><!-- ./col -->
										</div><!-- ./form-group -->
									</div><!-- ./col -->
								</div>
							<?php endif; ?>

							<div class="row">
								<!-- cms item ci_title -->
								<div class="col-md-12">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[ci_title]", ' has-error ')?> ">
										<label class="control-label col-md-4"><?php echo lang('ci_title') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[ci_title]" id="ci_title" value="<?= ( !empty($cms_item->ci_title) ? $cms_item->ci_title : '' ); ?>" data-required="1" class="form-control" maxlength="100"/>

										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>

							<div class="row">
								<!-- cms item alias -->
								<div class="col-md-12">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[ci_alias]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('ci_alias') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[ci_alias]" id="ci_alias" value="<?= ( !empty($cms_item->ci_alias) ? $cms_item->ci_alias : '' ); ?>" data-required="1" class="form-control" maxlength="50" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div>

							<div class="row">
								<!-- cms item ci_short_descr -->
								<div class="col-md-12">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[ci_short_descr]", ' has-error ')?>">
										<label class="control-label col-md-4"><?php echo lang('ci_short_descr') ?>
										</label>
										<div class="col-md-7">
											<input type="text" name="data[ci_short_descr]" value="<?= ( !empty($cms_item->ci_short_descr) ? $cms_item->ci_short_descr : '' ) ?>" data-required="1" class="form-control" maxlength="255"/>
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
							</div> <!-- ./row -->



							<div class="row">
								<!-- cms item Types ci_content -->
								<div class="col-md-12">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[ci_content]", ' has-error ')?> ">
										<label class="control-label col-md-4"><?php echo lang('ci_content') ?>
										</label>
										<div class="col-md-7">
											<textarea rows="8" cols="120" name="data[ci_content]" id="ci_content" data-required="1" class="form-control" /><?= ( !empty($cms_item->ci_content) ? $cms_item->ci_content : '' ) ?></textarea>

											<?php if ( !$is_insert ) : ?>
												<b>Tags</b>:</br>
											<?php endif; ?>

											<?php if ( !empty($cms_item->ci_content_hints ) ) : ?><?php echo $cms_item->ci_content_hints ?><?php endif ?>

										</div><!-- ./col -->
									</div> <!-- ./form-group -->
								</div><!-- ./col -->
							</div> <!-- ./row -->


							<div class="row">
								<!-- ci_page_type -->
								<div class="col-md-12">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[ci_page_type]", ' has-error ')?>">

										<label class="col-md-4 control-label" for="ci_page_type">Page Type</label>
										<div class="col-md-7">
											<select id="ci_page_type" name="data[ci_page_type]"  class="form-control editable_field">
												<option value="">  -Select Page Type-  </option>
												<?php foreach( $cms_item_PageTypeSelectionList as $next_key=>$next_item_page_type ) { ?>
													<option value="<?= $next_item_page_type['key'] ?>" <?= ( !empty($cms_item->ci_page_type) and $cms_item->ci_page_type == $next_item_page_type['key'] ) ? "selected" : "" ?> ><?= $next_item_page_type['value'] ?></option>
												<?php } ?>
											</select>
										</div>

									</div><!-- ./form-group -->
								</div><!-- ./col -->

							</div>


							<div class="row">
								<!-- ci_published -->
								<div class="col-md-12">
									<div class="form-group <?= $this->common_lib->set_field_error_tag("data[ci_published]", ' has-error ')?>">

										<label class="col-md-4 control-label" for="ci_published">Published</label>
										<div class="col-md-7">
											<select id="ci_published" name="data[ci_published]"  class="form-control editable_field">
												<option value="">  -Select Published-  </option>
												<?php foreach( $cms_item_PublishedSelectionList as $next_key=>$next_item_Published ) { ?>
													<option value="<?= $next_item_Published['key'] ?>" <?= ( !empty($cms_item->ci_published) and $cms_item->ci_published == $next_item_Published['key'] ) ? "selected" : "" ?> ><?= $next_item_Published['value'] ?></option>
												<?php } ?>
											</select>
										</div>

									</div><!-- ./form-group -->
								</div><!-- ./col -->

							</div>


							<?php if ( !$is_insert ) : ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label col-md-4"><?php echo lang('created_at') ?>
											</label>
											<div class="col-md-7">
												<input type="text" value="<?= ( !empty($cms_item->ci_created_at) ? $ci->common_lib->format_datetime( $cms_item->ci_created_at ) : '' ) ?>" class="form-control" disabled />
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
												<input type="text" value="<?= ( !empty($cms_item->ci_updated_at) ? $ci->common_lib->format_datetime( $cms_item->ci_updated_at ) : '' ) ?>" class="form-control" disabled />
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
										<button type="reset" class="btn btn-cancel-action waves-effect waves-light" onclick="javascript:document.location='<?=base_url()?>sys-admin/cms_items/cms_items-view<?=$page_parameters_with_sort?>'" >Cancel</button>
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