<?php $ci = &get_instance();
echo link_tag('assets/global/plugins/picker/classic.css');
echo link_tag('assets/global/plugins/picker/classic.date.css');
?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">

                <div class="page-bar">
                    <!--<h3 class="page-title"><?=lang('location-view')?></h3>-->
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <div class="table-toolbar table_info">
                    <h4>10&nbsp;Rows&nbsp;of&nbsp;18&nbsp;(Page # <strong>1 </strong>)</h4>

                    <button type="button" class="btn-filter " data-activates='dropdown1' data-toggle="modal" data-html="true" data-placement="top" title="" data-original-title="Open dialog window to set filter for Locations" data-target="#clients_list_dialog_filter"><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>
			                  
					
					<button type="button" class="btn btn-plus sbold btn-sm pull-right "  data-toggle="modal" data-target="#clients_list_dialog_filter">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
					
                </div>     

                </div>

                <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover order-column" id="clients_listing">
                    <thead>
                        <tr>

                            <th><?= lang('name') ?></th>
                            <th><?= lang('type') ?></th>
                            <th><?= lang('address') ?></th>
                            <th><?= lang('city') ?></th>
                            <th><?= lang('zip') ?></th>
                            <th><?= lang('res') ?></th>                           

                        </tr>
                    </thead>
                    <tbody>                    
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>
							<td>10245</td>
							<td>test</td>
						</tr>
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>
							<td>10245</td>
							<td>test</td>
						</tr>
						<tr>
							<td>B0oondock Saints</td>
							<td>home_health</td>
							<td>abc 01</td>
							<td>testCity</td>
							<td>10245</td>
							<td>test</td>
						</tr>
						
                    </tbody>
                </table>
                </div>

                <div class="table_pagination" style="z-index: 99999999999">
                <?= $pagination_links;?>
                </div>

            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<!-- Popup dialog for filtering set -->
<div class="modal fade" id="clients_list_dialog_filter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding-right: 20px;">
            <section class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title">Clients&nbsp;Filter&nbsp;Setup</div>
            </section>

            <section class="modal-body">
                <form role="form" class="form-horizontal" id="form_clients" name="form_clients" method="post"  enctype="multipart/form-data" >

                    <input type="hidden" id="page_number" name="page_number" value="1">
                    <input type="hidden" id="hidden_filter_client_name" name="filter_client_name" value="<?= $filter_client_name ?>">
                    <input type="hidden" id="hidden_filter_client_status" name="filter_client_status" value="<?= $filter_client_status ?>">
                    <input type="hidden" id="hidden_filter_client_type" name="filter_client_type" value="<?= $filter_client_type ?>">
                    <input type="hidden" id="hidden_filter_client_zip" name="filter_client_zip" value="<?= $filter_client_zip ?>">
                    <input type="hidden" id="hidden_filter_created_at_from" name="filter_created_at_from" value="<?= $filter_created_at_from ?>">
                    <input type="hidden" id="hidden_filter_created_at_till" name="filter_created_at_till" value="<?= $filter_created_at_till ?>">
                    <input type="hidden" id="hidden_filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?= $filter_created_at_from_formatted ?>">
                    <input type="hidden" id="hidden_filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?= $filter_created_at_till_formatted ?>">

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_name">Client name</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_client_name" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_status">Client Active Status</label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_client_status"  class="form-control editable_field">
                                    <option value="">  -Select All-  </option>                                   
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_type">Client Type</label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_client_type"  class="form-control editable_field">
                                    <option value="">  -Select All-  </option>                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_zip">Client zip</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field" value="" id="filter_client_zip" type="text" size="20" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_created_at_from">Created at from</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field datepicker_input" value="" id="filter_created_at_from" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" >
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_created_at_till">Created at till</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control editable_field datepicker_input" value="" id="filter_created_at_till" type="text">
                            </div>
                        </div>
                    </div>


                </form>
            </section>

            <section class="modal-footer ">
                <div class="btn-group  pull-right editor_btn_group " role="group" aria-label="group button">
                    <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:clientsListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
                    <button type="button" class="btn btn-cancel-action" data-dismiss="modal"  role="button">Cancel</button>
                    &nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
                        <i class="fa fa-square-o"></i>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>