<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="table-toolbar table_info">
				<h4>3&nbsp;Rows&nbsp;of&nbsp;5&nbsp;(Page # <strong>1 </strong>)</h4>

				<button type="button" class="btn-filter " data-activates='dropdown1' data-toggle="modal" data-html="true" data-placement="top" title="" data-original-title="Open dialog window to set filter for Locations" data-target="#location_list_dialog_filter"><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
						  
				
				<button type="button" class="btn btn-plus sbold btn-sm pull-right "  data-toggle="modal" data-target="#new_user_modal1">
					<i class="glyphicon glyphicon-plus"></i>
				</button>
				
			</div> 
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover order-column" id="clients_listing">
					<thead>
						<tr>
							<th><?= lang('name') ?></th>
							<th><?= lang('address') ?></th>
							<th><?= lang('residents') ?></th>  
						</tr>
					</thead>
					<tbody>                    
						<tr>
							<td>Test Testing</td>
							<td>abc 01</td>
							<td>4/5</td>											
						</tr>
						<tr>
							<td>Abc Xyz</td>
							<td>xyz 02</td>
							<td>2/3</td>										
						</tr>
						<tr>
							<td>B0oondock Saints</td>
							<td>#43 abc</td>
							<td>3/4</td>										
						</tr>						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Popup dialog for filtering set -->
<div class="modal fade" id="location_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Location Filter Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_location" name="form_locations" method="post"  enctype="multipart/form-data" >                    

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_location_name">Name</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_location_name" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_location_type">Type</label>
							<div class="col-xs-12 col-sm-8">
								<input class="form-control editable_field" name="filter_location_type" id="filter_location_type" type="text" size="20" maxlength="100">
							</div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="modal-footer ">
                <div class="btn-group  pull-right editor_btn_group " role="group" aria-label="group button">
                    <button type="button" id="filter" class="btn btn-primary" onclick="" role="button">Filter</button>
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal" role="button">Cancel</button>
					<button type="button" class="btn btn-sm" onclick="" alt="Clear All Data" title="Clear All Data"><i class="fa fa-square-o"></i></button>                    
                </div>
            </section>
        </div>
    </div>
</div>