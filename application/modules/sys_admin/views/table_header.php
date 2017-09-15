<!--Sart of table-toolbar -->
<div class="table-toolbar table_info">
    <h4>
        <?php if ($TotalRecords > 0) { ?>
            <span> <?= $TotalRecords; ?>&nbsp;Row<?php if ($TotalRecords > 1) { ?>s<?php } ?>
                &nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?></strong>)</span>
        <?php } ?>
    </h4>


    <button type="button" class="btn btn-filter btn-default btn-sm pull_right_only_on_xs padding_right_sm"
            onclick="javascript:vendorsListFilterApplied();" data-toggle="tooltip" data-html="true" data-position="top"
            title=""
            data-original-title="Open dialog window to set filter for Vendors. <?= (trim($filters_label) != "" ? "Current filter(s):" . $filters_label : "") ?> ">
        <i class="glyphicon glyphicon-filter"></i>&nbsp;Filter
    </button>

    <!--
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="autocomplete" name="search" class="autocomplete">
                    <label for="autocomplete-input">Autocomplete</label>
                    <ul class="autocomplete-content dropdown-content"></ul>
                </div>
            </div>
        </div>
        -->
    <form method="get" style="display: inline-block; margin-left: 10px;">
        <i class="fa fa-search" aria-hidden="true"></i>
        <input type="text" placeholder="" name="search" class="header-autocomplete autocomplete"
               id="autocomplete"/>
    </form>

    <button type="button" class="btn btn-plus sbold btn-sm pull-right all-table-plus-btn"

        <?php if ($sidebarMenu == "clients") { ?>
            onclick="javascript:clientsListFilterApplied();"
        <?php } elseif ($sidebarMenu == "users") { ?>
            onclick="javascript:document.location='<?= base_url() ?>sys-admin/users/users-edit/new<?= $page_parameters_with_sort ?>'"
        <?php } elseif ($sidebarMenu == "vendors") { ?>
            onclick="javascript:document.location='<?= base_url() ?>sys-admin/vendors/vendors-edit/new<?= $page_parameters_with_sort ?>'"
        <?php } ?>
    >
        <i class="glyphicon glyphicon-plus"></i>
    </button>
</div>
<!--End of table-toolbar -->