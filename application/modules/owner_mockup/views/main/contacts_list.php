<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="table-toolbar table_info">
				<h4>5&nbsp;Rows&nbsp;of&nbsp;10&nbsp;(Page # <strong>1 </strong>)</h4>

				<button type="button" class="btn-filter " data-activates='dropdown1' data-toggle="modal" data-html="true" data-placement="top" title="" data-original-title="Open dialog window to set filter for Locations" data-target="#contact_list_dialog_filter"><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
						  
				
				<button type="button" class="btn btn-plus sbold btn-sm pull-right "  data-toggle="modal" data-target="#new_owner_contact">
					<i class="glyphicon glyphicon-plus"></i>
				</button>
				
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover order-column" id="clients_listing">
					<thead>
						<tr>

							<th><?= lang('name') ?></th>
							<th><?= lang('type') ?></th>
							<th><?= lang('phone') ?></th>
							<th><?= lang('fax') ?></th>
							<th><?= lang('email') ?></th>				                         

						</tr>
					</thead>
					<tbody>                    
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>
							<td>test@gmail.com</td>				
						</tr>
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>
							<td>test@gmail.com</td>				
						</tr>
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>
							<td>test@gmail.com</td>				
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Popup dialog for filtering set -->
<div class="modal fade" id="contact_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Contact&nbsp;Filter&nbsp;Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_contact" name="form_contact" method="post"  enctype="multipart/form-data" >                    

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_contact_name">Name</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" name="filter_contact_name" id="filter_contact_name" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_email">Email</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" name="filter_email" id="filter_email" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>                   

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_contact_type">Type</label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_contact_type" name="filter_contact_type" class="form-control editable_field">
                                    <option value="">Select Type</option>
									<option value="person">Person</option>
									<option value="home_health">Home Health</option>
									<option value="hospice">Hospice</option>
									<option value="other">Other</option>                          
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