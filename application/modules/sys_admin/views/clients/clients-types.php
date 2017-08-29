<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-body">
                <div class="page-bar">
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <div class="table-toolbar table_info">
                    <h4>
                        <? if ( count($client_types) > 0 ) { ?>
                            <?= count($client_types); ?>&nbsp;Row<? if ( count($client_types) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
                        <? } ?>
                    </h4>

                    <button type="button" class="btn btn-plus sbold btn-sm pull-right "  data-toggle="modal" data-target="#add-clients-type">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </div>
                <div class="modal fade" id="add-clients-type" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">New Client</h4>
                            </div>
                            <div class="modal-body">
                                <!-- BEGIN FORM-->
                                <form action="<?php echo current_url();?>" method="post" id="client-type-add" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> <?= lang('form_sucess');?>
                                        </div>

                                        <div class="row">
                                            <!-- Name-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12" id="name_input">
                                                            <i class="material-icons prefix">assignment_ind</i>
                                                            <input type="text" name="data[name]" id="name" class="form-control required_form" maxlength="100" />
                                                            <label for="name" class=""><?php echo lang('name') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>
                                            <!-- Description -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12" id="description_input">
                                                            <i class="material-icons prefix">business</i>
                                                            <textarea id="description" name="data[description]" data-required="1"  maxlength="100" class=" form-control required_form materialize-textarea"></textarea>

                                                            <label for="description" class="description"><?php echo lang('description') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>



                                        </div> <!-- ./row -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <button type="button" class="btn btn-type" data-dismiss="modal">CANCEL</button>
                                                            <button type="submit" class="btn btn-type"><?php echo lang('SAVE');?></button>
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
                    </div>
                </div>
                <div class="modal fade" id="edit-clients-type" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modify Client Type</h4>
                            </div>
                            <div class="modal-body">
                                <!-- BEGIN FORM-->
                                <form action="<?php echo current_url();?>" method="post" id="client-type-add" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> <?= lang('form_sucess');?>
                                        </div>

                                        <div class="row">
                                            <!-- Name-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12">
                                                            <i class="material-icons prefix">assignment_ind</i>
                                                            <input type="text" name="data[name]" id="edit-type-name" class="form-control required_form" maxlength="100" />
                                                            <label for="edit-type-name" class=""><?php echo lang('name') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>
                                            <!-- Description -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12">
                                                            <i class="material-icons prefix">business</i>
                                                            <textarea id="edit-type-description" name="data[description]" data-required="1"  maxlength="100" class=" form-control required_form materialize-textarea"></textarea>

                                                            <label for="edit-type-description" class="description"><?php echo lang('description') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>



                                        </div> <!-- ./row -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <button type="button" class="btn btn-type" data-dismiss="modal">CANCEL</button>
                                                            <button type="button" class="btn btn-type">DELETE </button>
                                                            <button type="button" class="btn btn-type"><?php echo lang('SAVE');?></button>
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
                    </div>
                </div>

				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover  order-column" id="client_types">
						<thead>
						<tr>
							<th> <?= lang('name');?> </th>
							<th> <?= lang('description');?> </th>
						</tr>
						</thead>
						<tbody>
						<?php if (isset($client_types) && count($client_types)>0){
							foreach($client_types as $row){?>
								<tr>

									<td><?php echo $row->type_name;?></td>
									<td><?php echo $row->type_description;?>
                                        <a href="#" class="icon-type-pen" data-toggle="modal" data-target="#edit-clients-type"><i class="material-icons">edit</i></a>
                                    </td>
								</tr>
								<?php
							}//end foreach
						}//end isset
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>