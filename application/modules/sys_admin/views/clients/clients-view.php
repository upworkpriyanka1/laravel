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
                    <!--<h3 class="page-title"><?=lang('clients-view')?></h3>-->
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <div class="table-toolbar table_info">
                    <h4>
                        <? if ( count($clients) > 0 ) { ?>
                            <?= count($clients); ?>&nbsp;Row<? if ( count($clients) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
                        <? } ?>
                    </h4>

<!--                    <button type="button" class="btn btn-filter btn-default btn-sm pull_right_only_on_xs padding_right_sm " onclick="javascript:clientsListFilterApplied();" data-target="#clients_list_dialog_filter"  data-delay="50" data-toggle="modal" title="" data-original-title="Open dialog window to set filter for Clients. --><?//= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?><!-- "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>-->
                    <button type="button" class=" dropdown-button btn filter_dropdown btn-filter " data-activates='dropdown1' onclick="javascript:clientsListFilterApplied();" title="" data-original-title="Open dialog window to set filter for Clients. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> "><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter </button>

                    <!-- Dropdown Structure -->

                    <ul id='dropdown1' class='dropdown-content'>
                        <li> <span class="drop-title">Clients&nbsp;Filter&nbsp;Setup</span></li>
                        <li class="divider"></li>
                        <li>
                            <form role="form" class="form-horizontal dropdown-form" id="form_clients" name="form_clients" method="post"  enctype="multipart/form-data" >

                        <input type="hidden" id="page_number" name="page_number" value="1">
                        <input type="hidden" id="hidden_filter_client_name" name="filter_client_name" value="<?= $filter_client_name ?>">
                        <input type="hidden" id="hidden_filter_client_active_status" name="filter_client_active_status" value="<?= $filter_client_active_status ?>">
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
                                <label class="col-xs-12 col-sm-4 control-label" for="filter_client_active_status">Client Active Status</label>
                                <div class="col-xs-12 col-sm-8">
                                    <select id="filter_client_active_status"  class="form-control editable_field">
                                        <option value="">  -Select All-  </option>
                                        <?php foreach( $client_ActiveStatusList as $next_key=>$next_Client_ActiveStatus ) { ?>
                                            <option value="<?= $next_Client_ActiveStatus['key'] ?>" ><?= $next_Client_ActiveStatus['value'] ?></option>
                                        <?php } ?>
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
                                        <?php foreach( $client_TypesSelectionList as $next_key=>$next_Client_Type ) { ?>
                                            <option value="<?= $next_Client_Type['key'] ?>" ><?= $next_Client_Type['value'] ?></option>
                                        <?php } ?>
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
                        </li>
                        <li>
                            <div class="btn-group  pull-right editor_btn_group " role="group" aria-label="group button">
                                <div class="btn-group  pull-right editor_btn_group " role="group" aria-label="group button">
                                    <button type="button" id="saveImage" class="btn btn-primary" onclick="javascript:clientsListMakeFilterDialogSubmit(); return false; " role="button">Filter</button>
                                    <button type="button" class="btn btn-cancel-action close_filter" data-dismiss="modal"  role="button">Cancel</button>
                                    &nbsp;<a class="btn btn-sm" onclick="javascript:clearAllData(); return false; "  alt="Clear All Data" title="Clear All Data">
                                        <i class=" 	fa fa-square-o"></i>
                                    </a>
                                </div>
                            </div>
                        </li>

                    </ul>

                    <button type="button" class="btn btn-plus sbold btn-sm pull-right" data-toggle="modal" data-target="#newclient"  ><!--<i class="glyphicon glyphicon-plus"></i> -->ADD </button>

                </div>

                <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover  order-column" id="clients_listing">
                    <thead>
                        <tr>

                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('client_name'), "client_name", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('client_owner'), "client_owner", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('client_active_status'), "client_active_status", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('phone'), "client_phone", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('clients-type'), "type_description", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('created_at'), "created_at", $sort_direction, $sort ) ?></th>
                            <th><?= $this->common_lib->showListHeaderItem ( '/sys-admin/clients-view', $page_parameters_without_sort, lang('updated_at'), "updated_at", $sort_direction, $sort ) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($clients) && count($clients)>0){
                		    foreach($clients as $row){?>
                        <tr>


                            <td>
                                <a class="a_link" href="<?= base_url($this->uri->segment(1).'/clients-edit/'.$row->cid);?>/<?= $page_parameters_with_sort ?>">
                                    <?php echo $row->client_name;?>
                                </a>
                            </td>
                            <td>
                                <a href="mailto:<?php echo $row->client_email;?>"> <?php echo $row->client_owner;?> </a>
                            </td>
                            <td><?php echo $this->common_lib->get_client_active_status_label($row->client_active_status);?>  </td>
                            <td><?php echo $row->client_phone;?>  </td>
                            <td><?php echo $row->type_description;?></td>
                            <td><?php echo $ci->common_lib->format_datetime( $row->created_at) ?></td>
                            <td><?php echo $ci->common_lib->format_datetime( $row->updated_at ) ?></td>
                        </tr>
                        <?php
                            }//end foreach
                        }//end isset
                        ?>


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

<script>
var table_no_data                   = "<?= lang('table_no_data');?>";
var table_showing_x_records         = "<?= lang('table_showing_x_records');?>";
var table_no_records                = "<?= lang('table_no_records');?>";
var table_filtered_from_x_records   = "<?= lang('table_filtered_from_x_records');?>";
var table_show_menu         = "<?= lang('table_show_menu');?>";
var table_search            = "<?= lang('table_search');?>";
var table_no_result         = "<?= lang('table_no_result');?>";
var table_prev              = "<?= lang('table_prev');?>";
var table_next              = "<?= lang('table_next');?>";
var table_last              = "<?= lang('table_last');?>";
var table_first             = "<?= lang('table_first');?>";

var table_print             = "<?= lang('table_print');?>";
var table_copy              = "<?= lang('table_copy');?>";
var table_pdf               = "<?= lang('table_pdf');?>";
var table_excel             = "<?= lang('table_excel');?>";
var table_csv               = "<?= lang('table_csv');?>";
var client_id= '<?= ( !empty($client->cid) ? $client->cid : '' ) ?>'
var base_url= '<?= base_url() ?>'
var is_insert= '<?= $is_insert ?>'
</script>
<script src=""> </script>

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
                    <input type="hidden" id="hidden_filter_client_active_status" name="filter_client_active_status" value="<?= $filter_client_active_status ?>">
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
                            <label class="col-xs-12 col-sm-4 control-label" for="filter_client_active_status">Client Active Status</label>
                            <div class="col-xs-12 col-sm-8">
                                <select id="filter_client_active_status"  class="form-control editable_field">
                                    <option value="">  -Select All-  </option>
                                    <?php foreach( $client_ActiveStatusList as $next_key=>$next_Client_ActiveStatus ) { ?>
                                        <option value="<?= $next_Client_ActiveStatus['key'] ?>" ><?= $next_Client_ActiveStatus['value'] ?></option>
                                    <?php } ?>
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
                                    <?php foreach( $client_TypesSelectionList as $next_key=>$next_Client_Type ) { ?>
                                        <option value="<?= $next_Client_Type['key'] ?>" ><?= $next_Client_Type['value'] ?></option>
                                    <?php } ?>
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
                        <i class=" 	fa fa-square-o"></i>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>



<div class="modal fade newclient" id="newclient" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">New Client</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">

                                <div class="page-bar">
                                    <!--<h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('client') ?></center></h3>-->
                                    <?= $this->common_lib->show_info($editor_message) ?>
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form action="<?php echo base_url() ;?>sys-admin/clients-view/<?= ( $is_insert ? "new" : $cid ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_client_edit" name="form_client_edit" class="form-horizontal"  enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                                        <input type="hidden" id="filter_client_name" name="filter_client_name" value="<?=$filter_client_name?>">
                                        <!--						<input type="hidden" id="filter_client_active_status" name="filter_client_active_status" value="--><?//=$filter_client_active_status?><!--">-->
                                        <input type="hidden" id="filter_client_type" name="filter_client_type" value="<?=$filter_client_type?>">
                                        <input type="hidden" id="filter_client_zip" name="filter_client_zip" value="<?=$filter_client_zip?>">
                                        <input type="hidden" id="filter_created_at_from" name="filter_created_at_from" value="<?=$filter_created_at_from?>">
                                        <input type="hidden" id="filter_created_at_till" name="filter_created_at_till" value="<?=$filter_created_at_till?>">

                                        <input type="hidden" id="filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?=$filter_created_at_till_formatted?>">
                                        <input type="hidden" id="filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?=$filter_created_at_from_formatted?>">

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
                                                    <!-- Client Types cid -->
                                                    <div class="col-md-6">
                                                        <div class="form-group input-field">
                                                            <div class="col-md-7">
                                                                <input type="text" name="data[cid]" id="cid" value="<?= (!empty($client->cid) ? $client->cid:''); ?>" class="form-control" readonly />
                                                                <label for="cid" class="control-label col-md-4"><?php echo lang('cid');?></label>
                                                            </div><!-- ./col -->
                                                        </div><!-- ./form-group -->
                                                    </div><!-- ./col -->
                                                </div>
                                            <?php endif; ?>

                                            <div class="row">
                                                <!-- Client  client_name -->
                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_name]", ' has-error ')?> ">

                                                        <?php
                                                        $client_name_button_visible = $is_insert;
                                                        $client_name_input_visible = !$is_insert;
                                                        if ( $validation_errors_text!= "" and !empty($client->client_name) ) {
                                                            $client_name_button_visible = false;
                                                            $client_name_input_visible = true;
                                                        }
                                                        ?>
                                                        <div class="col-md-7" style="display: none" id="div_client_name_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_name',true);" id="btn_add_client_name">Add a name<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>

                                                        <div class="col-md-12" style="display: <?php echo ( ( $client_name_input_visible ) ? "block" :"block" ) ; ?>" id="div_client_name_input">
                                                            <i class="material-icons prefix">account_circle</i>
                                                            <input type="text" name="data[client_name]" id="client_name" value="<?= ( !empty($client->client_name) ? $client->client_name : '' ); ?>" class="form-control" maxlength="100" <?php echo !$is_insert ? " readonly " : "" ?> />
                                                            <label for="client_name"> <?php echo lang('client_name') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div><!-- ./col -->

                                                    </div><!-- ./form-group -->
                                                    <div class="btn-rem-name">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                    </div>
                                                </div><!-- ./col -->

                                                <!-- client owner -->
                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_owner]", ' has-error ')?>">

                                                        <?php
                                                        $is_debug= false;
                                                        $client_owner_button_visible = $is_insert;
                                                        $client_owner_input_visible = !$is_insert;
                                                        $client_owner_view_visible = !$is_insert;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_owner) ) {
                                                            $client_owner_button_visible = false;
                                                            $client_owner_input_visible = true;
                                                            $client_owner_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_owner_button_visible = false;
                                                            $client_owner_input_visible = false;
                                                            $client_owner_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>$client_owner_button_visible::' . print_r( $client_owner_button_visible, true ) . '</pre>';
                                                            echo '<pre>$client_owner_input_visible::' . print_r( $client_owner_input_visible, true ) . '</pre>';
                                                            echo '<pre>$client_owner_view_visible::' . print_r( $client_owner_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-7" style="display: <?php echo ( $client_owner_button_visible ? "none" :"none") ; ?>" id="div_client_owner_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_owner',true);" id="btn_add_client_owner">Add an owner</button>
                                                        </div>

                                                        <div class="col-md-12" style="display: <?php echo ( $client_owner_input_visible ? "block" :"block" ) ; ?>" id="div_client_owner_input">
                                                            <i class="material-icons prefix">business</i>
                                                            <input type="text" name="data[client_owner]" id="client_owner" value="<?= ( !empty($client->client_owner) ? $client->client_owner : '' ); ?>" class="x-able form-control" maxlength="100" />
                                                            <label for="client_owner" class=""><?php echo lang('company_name') ?></label>
                                                        </div>

                                                        <div class="col-md-12" style="display: <?php echo ( ( $client_owner_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_owner_view">
                                                            <i class="material-icons prefix">account_circle</i>
                                                            <input type="text" name="data[client_owner_view]" id="client_owner_view" value="<?= ( !empty($client->client_owner) ? $client->client_owner : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                            <label for="client_owner_view" class="control-label col-md-4"><?php echo lang('client_owner') ?></label>
                                                        </div><!-- ./col -->
                                                    </div> <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>

                                            <div class="row">
                                                <!-- client Addrtess 1 -->
                                                <div class="col-md-6 ">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_address1]", ' has-error ')?>">
                                                        <?php
                                                        $is_debug= false;
                                                        $address1_button_visible = $is_insert;
                                                        $address1_input_visible = !$is_insert;
                                                        $address1_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_address1) ) {
                                                            $address1_button_visible = false;
                                                            $address1_input_visible = true;
                                                            $address1_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == ""  and !$is_insert ) {
                                                            $address1_button_visible = false;
                                                            $address1_input_visible = false;
                                                            $address1_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $address1_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $address1_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $address1_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-7" style="display: <?php echo ( $address1_button_visible ? "none" :"none") ; ?>" id="div_client_address1_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_address1',true);" id="btn_add_client_address1">Add an address<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>
                                                        <div class="col-md-12" style="display: <?php echo ( $address1_input_visible ? "block" :"block" ) ; ?>" id="div_client_address1_input">
                                                            <input type="text" name="data[client_address1]" id="client_address1" value="<?= ( !empty($client->client_address1) ? $client->client_address1 : '' ); ?>" class="form-control x-able" maxlength="100" />
                                                            <label for="client_address1" class="control-label col-md-4"><?php echo lang('address1') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                        <div class="col-md-7" style="display: <?php echo ( ( $address1_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_address1_view">
                                                            <input type="text" name="data[client_address1_view]" id="client_address1_view" value="<?= ( !empty($client->client_address1) ? $client->client_address1 : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                            <label for="client_address1_view" class="control-label col-md-4"><?php echo lang('address1') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div><!-- ./col -->
                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->

                                                <!-- client Address 2 -->
                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_address2]", ' has-error ')?>">
                                                        <?php
                                                        $is_debug= false;
                                                        $address2_button_visible = $is_insert;
                                                        $address2_input_visible = !$is_insert;
                                                        $address2_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_address2) ) {
                                                            $address2_button_visible = false;
                                                            $address2_input_visible = true;
                                                            $address2_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $address2_button_visible = false;
                                                            $address2_input_visible = false;
                                                            $address2_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $address2_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $address2_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $address2_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-7" style="display: <?php echo ( $address2_button_visible ? "none" :"none") ; ?>" id="div_client_address2_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_address2',true);" id="btn_add_client_address2">Add an additive address</button>
                                                        </div>
                                                        <div class="col-md-12" style="display: <?php echo ( $address2_input_visible ? "block" :"block" ) ; ?>;" id="div_client_address2_input">


                                                            <input type="text" name="data[client_address2]" id="client_address2" value="<?= ( !empty($client->client_address2) ? $client->client_address2 : '' ); ?>"  class="form-control x-able" maxlength="100" />
                                                            <label for="client_address2" class="control-label col-md-4"><?php echo lang('address2') ?></label>
                                                        </div>
                                                        <div class="col-md-7" style="display: <?php echo ( ( $address2_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_address2_view">
                                                            <input type="text" name="data[client_address2_view]" id="client_address2_view" value="<?= ( !empty($client->client_address2) ? $client->client_address2 : '' ); ?>"  class="form-control" maxlength="100" readonly />
                                                            <label for="client_address2_view" class="control-label col-md-4"><?php echo lang('address2') ?></label>
                                                        </div><!-- ./col -->
                                                    </div> <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div> <!-- ./row -->

                                            <!--							<div class="row">
                                                                            <div class="input-field col s6">
                                                                                <input placeholder="Placeholder" id="first_name" class="validate" type="text">
                                                                                <label for="first_name" class="active">First Name</label>
                                                                            </div>
                                                                            <div class="input-field col s6">
                                                                                <input id="last_name" type="text">
                                                                                <label for="last_name" class="">Last Name</label>
                                                                            </div>
                                                                        </div>
                                            -->

                                            <div class="row">
                                                <!-- client city/state/zip -->
                                                <div class="col-md-12">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_state]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[client_city]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[client_zip]", ' has-error ')?> ">


                                                        <?php
                                                        $is_debug= false;
                                                        $client_city_button_visible = $is_insert;
                                                        $client_city_input_visible = !$is_insert;
                                                        $client_city_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_city) ) {
                                                            $client_city_button_visible = false;
                                                            $client_city_input_visible = true;
                                                            $client_city_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_city_button_visible = false;
                                                            $client_city_input_visible = false;
                                                            $client_city_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $client_city_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $client_city_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $client_city_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-4" style="display: <?php echo ( $client_city_button_visible ? "none" :"none") ; ?>" id="div_client_city_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_city',true);" id="btn_add_client_city">Add a city<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>
                                                        <div class="col-md-4"  style="display: <?php echo ( $client_city_input_visible ? "block" :"block" ) ; ?>" id="div_client_city_input">
                                                            <i class="material-icons prefix">location_on</i>
                                                            <input type="text" name="data[client_city]" id="client_city" value="<?= ( !empty($client->client_city) ? $client->client_city : '' ); ?>" class="form-control x-able" maxlength="100" />
                                                            <label for="client_city" class=""><?php echo lang('city') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                        <div class="col-md-4"  style="display: <?php echo ( ( $client_city_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_city_view">
                                                            <input type="text" name="data[client_city_view]" id="client_city_view" value="<?= ( !empty($client->client_city) ? $client->client_city : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                            <label for="client_city_view" class=""><?php echo lang('city') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div><!-- ./col -->


                                                        <?php
                                                        $is_debug= false;
                                                        $client_state_button_visible = $is_insert;
                                                        $client_state_input_visible = !$is_insert;
                                                        $client_state_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_state) ) {
                                                            $client_state_button_visible = false;
                                                            $client_state_input_visible = true;
                                                            $client_state_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_state_button_visible = false;
                                                            $client_state_input_visible = false;
                                                            $client_state_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $client_state_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $client_state_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $client_state_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-4" style="display: <?php echo ( $client_state_button_visible ? "none" :"none") ; ?>" id="div_client_state_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_state',true);" id="btn_add_client_state">Add a state<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>
                                                        <div class="col-md-4" style="display: <?php echo ( $client_state_input_visible ? "block" :"block" ) ; ?>" id="div_client_state_input">
                                                            <input type="text" name="data[client_state]" id="client_state" value="<?= ( !empty($client->client_state) ? $client->client_state : '' ); ?>" class="form-control x-able" maxlength="50" />
                                                            <label for="client_state" class="control-label col-md-2"><?php echo lang('state') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                        <div class="col-md-4" style="display: <?php echo ( ( $client_state_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_state_view">
                                                            <input type="text" name="data[client_state_view]" id="client_state_view" value="<?= ( !empty($client->client_state) ? $client->client_state : '' ); ?>" class="form-control" maxlength="50" readonly/>
                                                            <label for="client_state_view" class="control-label col-md-2"><?php echo lang('state') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div><!-- ./col -->



                                                        <?php
                                                        $is_debug= false;
                                                        $client_zip_button_visible = $is_insert;
                                                        $client_zip_input_visible = !$is_insert;
                                                        $client_zip_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_zip) ) {
                                                            $client_zip_button_visible = false;
                                                            $client_zip_input_visible = true;
                                                            $client_zip_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_zip_button_visible = false;
                                                            $client_zip_input_visible = false;
                                                            $client_zip_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $client_zip_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $client_zip_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $client_zip_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-4" style="display: <?php echo ( $client_zip_button_visible ? "none" :"none") ; ?>" id="div_client_zip_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_zip',true);" id="btn_add_client_zip">Add a zip<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>
                                                        <div class="col-md-4"  style="display: <?php echo ( $client_zip_input_visible ? "block" :"block" ) ; ?>" id="div_client_zip_input">
                                                            <input type="text" name="data[client_zip]" id="client_zip" value="<?= ( !empty($client->client_zip) ? $client->client_zip : '' ); ?>" class="form-control x-able" maxlength="50" />
                                                            <label for="client_zip" class="control-label col-md-2"><?php echo lang('zip') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                        <div class="col-md-4" style="display: <?php echo ( ( $client_zip_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_zip_view">
                                                            <input type="text" name="data[client_zip_view]" id="client_zip_view" value="<?= ( !empty($client->client_zip) ? $client->client_zip : '' ); ?>" class="form-control" maxlength="5" readonly/>
                                                            <label for="client_zip_view" class="control-label col-md-2"><?php echo lang('zip') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div><!-- ./col -->

                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->
                                                <!-- client state -->

                                            </div> <!-- ./row -->

                                            <div class="row">
                                                <!-- client phone -->
                                                <div class="col-md-12">

                                                   <!-- <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:AddPhone();" id="btn_add_phone">Add a phone</button>-->


                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone]", ' has-error ')?>">
                                                        <div class="col-md-6">
                                                            <table>
                                                                <tr>
                                                                    <td style="width: 98%">
                                                                        <i class="material-icons prefix">phone</i>
                                                                        <input type="text" name="data[client_phone]" id="client_phone" value="<?= ( !empty($client->client_phone) ? $client->client_phone : '' ); ?>" class="form-control x-able" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                        <label for="client_phone" class=""><?php echo lang('phone') ?></label>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div><!-- ./col -->
                                                        <div class="input-field col-md-6">
                                                            <select>
                                                                <option value="" disabled selected>Custom Lable</option>
                                                                <option value="1">Home</option>
                                                                <option value="2">Work</option>
                                                                <option value="3">Other</option>
                                                            </select>

                                                        </div>

                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->

                                                <!-- client phone_2 -->
                                                <div class="col-md-12" id="div_phone_2" style="display: <?= ( !empty($client->client_phone_2) ? 'block' : 'none' ); ?>">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_2]", ' has-error ')?>">
                                                        <div class="col-md-12">
                                                            <i class="material-icons prefix">phone</i>
                                                            <input type="text" name="data[client_phone_2]" id="client_phone_2" value="<?= ( !empty($client->client_phone_2) ? $client->client_phone_2 : '' ); ?>" class="form-control x-able" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                            <label for="client_phone_2" class="control-label col-md-4"><?php echo lang('phone_2') ?></label>
                                                        </div><!-- ./col -->
                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->


                                            </div> <!-- ./row -->

                                            <div class="row">
                                                <!-- client phone_3 -->
                                                <div class="col-md-6" id="div_phone_3" style="display: <?= ( !empty($client->client_phone_3) ? 'block' : 'none' ); ?>">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_3]", ' has-error ')?>">
                                                        <div class="col-md-7">
                                                            <i class="material-icons prefix">phone</i>
                                                            <input type="text" name="data[client_phone_3]" id="client_phone_3" value="<?= ( !empty($client->client_phone_3) ? $client->client_phone_3 : '' ); ?>" class="form-control x-able" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                            <label for="client_phone_3" class="control-label col-md-4"><?php echo lang('phone_3') ?></label>
                                                        </div><!-- ./col -->
                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->

                                                <!-- client phone_4 -->
                                                <div class="col-md-6" id="div_phone_4" style="display: <?= ( !empty($client->client_phone_4) ? 'block' : 'none' ); ?>">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_4]", ' has-error ')?>">
                                                        <div class="col-md-4">
                                                            <i class="material-icons prefix">phone</i>
                                                            <input type="text" name="data[client_phone_4]" id="client_phone_4" value="<?= ( !empty($client->client_phone_4) ? $client->client_phone_4 : '' ); ?>" class="form-control x-able" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                            <label for="client_phone_4" class="control-label col-md-4"><?php echo lang('phone_4') ?></label>
                                                        </div><!--  ./col -->
                                                        <div class="col-md-3">
                                                            <select name="data[client_phone_type]" id="client_phone_type" class="form-control" onchange="javascript:client_phone_typeOnChange()">
                                                                <option value="">Select Type</option>
                                                                <?php foreach( $client_phone_type_array as $next_key=>$next_client_phone_type ) { ?>
                                                                    <option value="<?=$next_client_phone_type  ?>" <?= ( ( !empty($client->client_phone_type) and $client->client_phone_type == $next_client_phone_type ) ? 'selected' : '' ); ?> ><?=$next_client_phone_type  ?></option>
                                                                <?php } ?>
                                                                <option value="-add_new-">  - Add New-  </option>
                                                            </select>
											                <span id="span_new_client_phone_type" style="display: none;">
												                <input type="text" name="new_client_phone_type" id="new_client_phone_type" value="" class="form-control" maxlength="20" />
											                </span>
                                                        </div><!--  ./col -->
                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->


                                            </div> <!-- ./row -->

                                            <div class="row" >
                                                <!-- client fax -->
                                                <div class="col-md-6">

                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_fax]", ' has-error ')?>">

                                                        <?php
                                                        $is_debug= false;
                                                        $client_fax_button_visible = $is_insert;
                                                        $client_fax_input_visible = !$is_insert;
                                                        $client_fax_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_fax) ) {
                                                            $client_fax_button_visible = false;
                                                            $client_fax_input_visible = true;
                                                            $client_fax_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_fax_button_visible = false;
                                                            $client_fax_input_visible = false;
                                                            $client_fax_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $client_fax_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $client_fax_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $client_fax_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-7" style="display: <?php echo ( $client_fax_button_visible ? "none" :"none") ; ?>" id="div_client_fax_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_fax',true);" id="btn_add_client_fax">Add an fax<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>
                                                        <div class="col-md-7" style="display: <?php echo ( $client_fax_input_visible ? "block" :"block" ) ; ?>" id="div_client_fax_input">
                                                            <input type="text" name="data[client_fax]" value="<?= ( !empty($client->client_fax) ? $client->client_fax : '' ); ?>" class="form-control x-able" maxlength="50" />
                                                            <label for="client_fax" class="control-label col-md-4"><?php echo lang('fax') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                        <div class="col-md-7" style="display: <?php echo ( ( $client_fax_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_fax_view">
                                                            <input type="text" name="data[client_fax_view]" id="client_fax_view" value="<?= ( !empty($client->client_fax) ? $client->client_fax : '' ); ?>" class="form-control" maxlength="50" readonly />
                                                            <label for="client_fax_view" class="control-label col-md-4"><?php echo lang('fax') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div><!-- ./col -->

                                                    </div> <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div> <!-- ./row -->

                                            <div class="row">
                                                <!-- client email -->
                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_email]", ' has-error ')?>">
                                                        <?php
                                                        $is_debug= false;
                                                        $client_email_button_visible = $is_insert;
                                                        $client_email_input_visible = !$is_insert;
                                                        $client_email_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_email) ) {
                                                            $client_email_button_visible = false;
                                                            $client_email_input_visible = true;
                                                            $client_email_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_email_button_visible = false;
                                                            $client_email_input_visible = false;
                                                            $client_email_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $client_email_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $client_email_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $client_email_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-12" style="display: <?php echo ( $client_email_button_visible ? "none" :"none") ; ?>" id="div_client_email_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_email',true);" id="btn_add_client_email">Add an email</button>
                                                        </div>

                                                        <div class="col-md-12" style="display: <?php echo ( $client_email_input_visible ? "block" :"block" ) ; ?>" id="div_client_email_input">
                                                            <input type="text" name="data[client_email]" id="client_email" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control x-able" maxlength="50"  />
                                                            <label for="client_email" class="control-label col-md-4"><?php echo lang('email') ?></label>
                                                        </div>

                                                        <div class="col-md-12" style="display: <?php echo ( ( $client_email_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_email_view">
                                                            <input type="text" name="data[client_email_view]" id="client_email_view" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50" readonly />
                                                            <label for="client_email_view" class="control-label col-md-4"><?php echo lang('email') ?></label>
                                                        </div><!-- ./col -->

                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->

                                                <div class="input-field col-md-6">
                                                    <select>
                                                        <option value="" disabled selected>Custom Lable</option>
                                                        <option value="1">Home</option>
                                                        <option value="2">Work</option>
                                                        <option value="3">Other</option>
                                                    </select>

                                                </div>
                                                <!-- client url -->
                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_website]", ' has-error ')?>">
                                                        <?php
                                                        $is_debug= false;
                                                        $client_website_button_visible = $is_insert;
                                                        $client_website_input_visible = !$is_insert;
                                                        $client_website_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_website) ) {
                                                            $client_website_button_visible = false;
                                                            $client_website_input_visible = true;
                                                            $client_website_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_website_button_visible = false;
                                                            $client_website_input_visible = false;
                                                            $client_website_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $client_website_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $client_website_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $client_website_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-12" style="display: <?php echo ( $client_website_button_visible ? "none" :"none") ; ?>" id="div_client_website_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_website',true);" id="btn_add_client_website">Add an website</button>
                                                        </div>
                                                        <div class="col-md-12" style="display: <?php echo ( $client_website_input_visible ? "block" :"block" ) ; ?>" id="div_client_website_input">
                                                            <input type="text" name="data[client_website]" value="<?= ( !empty($client->client_website) ? $client->client_website : '' ); ?>" class="form-control x-able" maxlength="100" />
                                                            <label for="client_website" class="control-label col-md-4"><?php echo lang('website') ?></label>
                                                        </div>
                                                        <div class="col-md-12" style="display: <?php echo ( ( $client_website_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_website_view">
                                                            <input type="text" name="data[client_website_view]" id="client_website_view" value="<?= ( !empty($client->client_website) ? $client->client_website : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                            <label for="client_website_view" class="control-label col-md-4"><?php echo lang('website') ?></label>
                                                        </div><!-- ./col -->

                                                    </div><!-- ./form-group -->
                                                </div><!-- ./col -->

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="#">

                                                        <input class="with-gap" name="group1" type="radio" id="test1"  />
                                                        <label for="test1">Hospice</label>
                                                        <input class="with-gap" name="group1" type="radio" id="test2"  />
                                                        <label for="test2">Home Health</label>
                                                        <input class="with-gap" name="group1" type="radio" id="test3"  />
                                                        <label for="test3">Assisted Living</label>
                                                        <input class="with-gap" name="group1" type="radio" id="test4"  />
                                                        <label for="test4">Board & Care</label>

                                                    </form>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_active_status]", ' has-error ')?>">


                                                        <?php
                                                        $is_debug= false;
                                                        $client_active_status_button_visible = $is_insert;
                                                        $client_active_status_input_visible = !$is_insert;
                                                        $client_active_status_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->client_active_status) ) {
                                                            $client_active_status_button_visible = false;
                                                            $client_active_status_input_visible = true;
                                                            $client_active_status_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $client_active_status_button_visible = false;
                                                            $client_active_status_input_visible = false;
                                                            $client_active_status_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $client_active_status_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $client_active_status_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $client_active_status_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>
                                                        <div class="col-md-12" style="display: <?php echo ( $client_active_status_button_visible ? "none" :"none") ; ?>" id="div_client_active_status_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_active_status',true);" id="btn_add_client_active_status">Add an active status<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>

                                                        <div class="col-md-12" style="display: <?php echo ( $client_active_status_input_visible ? "block" :"block" ) ; ?>" id="div_client_active_status_input">
                                                            <table>
                                                                <tr>
                                                                    <td style="padding-bottom: 12px;">
                                                                        <label class="control-label col-md-4" for="client_active_status" >&nbsp;<?php echo lang('client_active_status') ?><span class="required">&nbsp;*&nbsp;</span></label>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td calss="calss">
                                                                        <?php echo MyCustom_menu($client_active_status_array,'data[client_active_status]','form-control',(!empty($client->client_active_status)?$client->client_active_status:'')," -Client Active Status- ",'id ="client_active_status"'); ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7" style="display: <?php echo ( ( $client_active_status_view_visible ) ? "none" :"none" ) ; ?>" id="div_client_active_status_view">
                                                        <label class="control-label col-md-4" for="client_active_status_view" >&nbsp;<?php echo lang('client_active_status') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        <input type="text" name="data[client_active_status_view]" id="client_active_status_view" value="<?= ( !empty($client->client_active_status) ? $this->common_lib->get_client_active_status_label($client->client_active_status) : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                    </div>

                                                </div> <!-- ./row -->
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[clients_types_id]", ' has-error ')?>">
                                                        <?php
                                                        $is_debug= false;
                                                        $clients_types_id_button_visible = $is_insert;
                                                        $clients_types_id_input_visible = !$is_insert;
                                                        $clients_types_id_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->clients_types_id) ) {
                                                            $clients_types_id_button_visible = false;
                                                            $clients_types_id_input_visible = true;
                                                            $clients_types_id_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $clients_types_id_button_visible = false;
                                                            $clients_types_id_input_visible = false;
                                                            $clients_types_id_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $clients_types_id_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $clients_types_id_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $clients_types_id_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>

                                                        <div class="col-md-12" style="display: <?php echo ( $clients_types_id_button_visible ? "none" :"none") ; ?>" id="div_clients_types_id_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('clients_types_id',true);" id="btn_add_clients_types_id">Add a client type<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>
                                                        <div class="col-md-12" style="display: <?php echo ( $clients_types_id_input_visible ? "block" :"block" ) ; ?>" id="div_clients_types_id_input">
                                                            <table>
                                                                <tr>
                                                                    <td style="padding: 12px;">
                                                                        <label for="clients_types_id" class="control-label col-md-4">&nbsp;<?php /*//echo lang('clients-type') */?><span class="required">&nbsp;*&nbsp;</span></label>
                                                                    </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>
                                                                        <?php  echo MyCustom_menu($client_types,'data[clients_types_id]','form-control', ( !empty($client->clients_types_id) ? $client->clients_types_id : '' ), " -Client Type- ",'id ="clients_types_id"'); ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-12" style="display: block;" id="div_clients_types_id_input">
                                                            <table>
                                                                <tbody>
                                                                <tr>
                                                                    <td style="padding: 12px;">
                                                                        <label for="clients_types_id" class="control-label col-md-4">&nbsp;Client&nbsp;Type<span class="required">&nbsp;*&nbsp;</span></label>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-12" style="display: <?php echo ( ( $clients_types_id_view_visible ) ? "block" :"none" ) ; ?>" id="div_clients_types_id_view">
                                                            <label class="control-label col-md-4" for="clients_types_id_view" >&nbsp;<?php echo lang('clients-type') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            <input type="text" name="data[clients_types_id_view]" id="clients_types_id_view" value="<?= ( !empty($client->clients_types_id) ? $this->common_lib->get_clients_types_id_label($client->clients_types_id) : '' ); ?>" class="form-control" maxlength="200" readonly />
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- client color_scheme -->
                                                <div class="col-md-6">
                                                    <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[color_scheme]", ' has-error ')?>">
                                                        <?php
                                                        $is_debug= false;
                                                        $color_scheme_button_visible = $is_insert;
                                                        $color_scheme_input_visible = !$is_insert;
                                                        $color_scheme_view_visible = false;
                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                        if ( $validation_errors_text!= "" and !empty($client->color_scheme) ) {
                                                            $color_scheme_button_visible = false;
                                                            $color_scheme_input_visible = true;
                                                            $color_scheme_view_visible= false;
                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                        }
                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                            $color_scheme_button_visible = false;
                                                            $color_scheme_input_visible = false;
                                                            $color_scheme_view_visible= true;
                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                        }
                                                        if ($is_debug) {
                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                            echo '<pre>button_visible::' . print_r( $color_scheme_button_visible, true ) . '</pre>';
                                                            echo '<pre>input_visible::' . print_r( $color_scheme_input_visible, true ) . '</pre>';
                                                            echo '<pre>view_visible::' . print_r( $color_scheme_view_visible, true ) . '</pre>';
                                                        }
                                                        ?>

                                                        <div class="col-md-12" style="display: <?php echo ( $color_scheme_button_visible ? "block" :"none") ; ?>" id="div_color_scheme_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('color_scheme',true);" id="btn_add_color_scheme">Add a client color scheme<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>
                                                        <div class="col-md-12"  style="display: <?php echo ( $color_scheme_input_visible ? "block" :"none" ) ; ?>" id="div_color_scheme_input">
                                                            <table>
                                                                <tr>
                                                                    <td style="padding: 12px;">
                                                                        <label for="color_scheme" class="control-label col-md-4">&nbsp;<?php echo lang('color_scheme') ?><?php if ( !$is_insert ) : ?><span class="required">&nbsp;*&nbsp;</span><?php endif; ?></label>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select name="data[color_scheme]" id="color_scheme" class="form-control" <?php echo ( $is_insert ? " disabled " : "" ) ?> >
                                                                            <option value="">Select Color Scheme</option>
                                                                            <?php foreach( $client_color_schemes as $next_key=>$next_color_scheme ) { ?>

                                                                                <?php if ( !$is_insert ) : ?>
                                                                                    <option value="<?=$next_color_scheme['id']  ?>" <?= ( ( !empty($client->color_scheme) and (int)$client->color_scheme == (int)$next_color_scheme['id'] ) ? 'selected' : '' ); ?> ><?=$next_color_scheme['title']  ?></option>
                                                                                <?php else : ?>
                                                                                    <option value="<?=$next_color_scheme['id']  ?>" <?= ( ( $next_color_scheme['default'] ) ? 'selected' : '' ); ?> ><?=$next_color_scheme['title']  ?></option>
                                                                                <?php endif; ?>

                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div><!-- ./col -->
                                                    <div class="col-md-12" style="display: <?php echo ( ( $color_scheme_view_visible ) ? "block" :"none" ) ; ?>" id="div_color_scheme_view">
                                                        <label class="control-label col-md-4" for="color_scheme_view" >&nbsp;<?php echo lang('color_scheme') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        <input type="text" name="data[color_scheme_view]" id="color_scheme_view" value="<?= ( !empty($client->color_scheme) ? $this->common_lib->get_color_scheme_label($client->color_scheme) : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                    </div>
                                                </div><!-- ./form-group -->

                                            </div><!-- ./col -->



                                        </div>

                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                    </div>
                </div><!-- ./row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <div class="col-xs-12">
                    <div class="col-md-6">
                        <ul>
                            <li><span class="create-contact-more"><a href="#">+CONTACT</a></span></li>
                            <li><span class="create-contact-more"><a href="#">+SUPERUSER</a></span></li>
                        </ul>


                    </div>

                    <div class="col-md-6 ">
                        <ul>
                            <li data-dismiss="modal" role="button">CANCEL </li>
                            <li class="create-contact-save" data-action="save" role="button"> SAVE </li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>










