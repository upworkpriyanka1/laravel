
<!--Sart of table-toolbar -->               
<div class="table-toolbar table_info" >
    <h4>
		<?php if ( $TotalRecords > 0 ) { ?>
        	<span> <?= $TotalRecords; ?>&nbsp;Row<?php if ( $TotalRecords > 1 ) { ?>s<?php } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)</span>
        <?php } ?>
    </h4>
    
    <button type="button" class="btn btn-filter btn-default btn-sm pull_right_only_on_xs padding_right_sm" onclick="javascript:vendorsListFilterApplied();" data-toggle="tooltip" data-html="true" data-position="top" title="" data-original-title="Open dialog window to set filter for Vendors. <?= ( trim($filters_label) != "" ? "Current filter(s):".$filters_label : "") ?> ">
    	<i class="glyphicon glyphicon-filter"></i>&nbsp;Filter 
	</button>
    
    
    <button type="button" class="btn btn-plus sbold btn-sm pull-right" 
    	
		<?php if($sidebarMenu == "clients"){?>
        	onclick="javascript:clientsListFilterApplied();"
        <?php }elseif($sidebarMenu == "users"){?>
        	onclick="javascript:document.location='<?= base_url() ?>sys-admin/users/users-edit/new<?=$page_parameters_with_sort ?>'"
        <?php }elseif($sidebarMenu == "vendors"){?>
        	onclick="javascript:document.location='<?= base_url() ?>sys-admin/vendors/vendors-edit/new<?=$page_parameters_with_sort ?>'"
        <?php }?>        
	>
    	<i class="glyphicon glyphicon-plus"></i>
    </button>
</div>                
<!--End of table-toolbar -->