<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-body">

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
<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit portlet-form bordered">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet light portlet-fit portlet-form bordered">
				<div class="portlet-body">
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
								<!-- Name -->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo lang('name') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" id="name" name="data[name]" data-required="1" class="form-control" />
										</div><!-- ./col -->
									</div><!-- ./form-group -->
								</div><!-- ./col -->
								<!-- Description -->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo lang('description') ?>
											<span class="required"> * </span>
										</label>
										<div class="col-md-7">
											<input type="text" id="description" name="data[description]" data-required="1" class="form-control" />
											<span class="help-block"></span>
										</div><!-- ./col -->
									</div> <!-- ./form-group -->
								</div><!-- ./col -->
							</div> <!-- ./row -->

							<div class="row">
								<div class="col-md-12">
									<div class="form-actions">
										<div class="row">
											<div class="col-md-12 text-center">
												<button type="submit" class="btn blue waves-effect waves-light"><?php echo lang('add-new');?></button>
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