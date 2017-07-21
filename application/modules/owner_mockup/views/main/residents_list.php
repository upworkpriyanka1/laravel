<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			
			<div class="table-toolbar table_info">
				<h4>10&nbsp;Rows&nbsp;of&nbsp;18&nbsp;(Page # <strong>1 </strong>)</h4>

				<button type="button" class="btn-filter " data-activates='dropdown1' data-toggle="modal" data-html="true" data-placement="top" title="" data-original-title="Open dialog window to set filter for Locations" data-target="#resident_list_dialog_filter"><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
						  
				
				<button type="button" class="btn btn-plus sbold btn-sm pull-right "  data-toggle="modal" data-target="#new_owner_resident">
					<i class="glyphicon glyphicon-plus"></i>
				</button>
				
			</div> 
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover order-column" id="residents_listing">
					<thead>
						<tr>

							<th><?= lang('name') ?></th>
							<th><?= lang('age') ?></th>
							<th><?= lang('gender') ?></th>
							<th><?= lang('services') ?></th>										                         

						</tr>
					</thead>
					<tbody>                    
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>								
						</tr>
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>									
						</tr>
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>									
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Popup dialog for filtering set -->
<div class="modal fade" id="resident_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Resident&nbsp;Filter&nbsp;Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_resident" name="form_residents" method="post"  enctype="multipart/form-data" >                    

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_resident_name">Name</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_resident_name" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>                   

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_resident_gender">Gender</label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_resident_gender" name="filter_resident_gender" class="form-control editable_field">
                                    <option value="">Select</option>                              
                                    <option value="male">Male</option>                             
                                    <option value="female">Female</option>                             
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="service">Service</label>
							<div class="col-xs-12 col-sm-8">
								<select name="service" class="editable_field form-control">
									<option value="">Select Service</option>								
								</select>
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