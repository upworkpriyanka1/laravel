<!--$client_id::--><?//=$client_id ?>
<?php $ci = &get_instance();
if ( isset($provides_vendors_list) && count($provides_vendors_list) > 0 ) { ?>

    <div class="table-toolbar table_info">
        <? if ( count($provides_vendors_list) > 0 ) { ?>
            <?= count($provides_vendors_list); ?>&nbsp;Row<? if ( count($provides_vendors_list) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $client_vendors_count ?>&nbsp;(Page # <strong><?= (empty($page_number)?1:$page_number) ?> </strong>)
        <? } ?>
    </div>

    <div class="table-responsive">

        <table class="table table-striped table-bordered table-hover  order-column" id="clients_listing">
            <tbody>

            <thead>
            <tr>
                <th>
                    <?= $this->common_lib->showListHeaderItemJS ( 'providesVendorsSortingClick', lang('vn_name'), "vn_name", $sort_direction, $sort ) ?>
                </th>
                <th>
                    <?= $this->common_lib->showListHeaderItemJS ( 'providesVendorsSortingClick', lang('cv_active_status'), "cv_active_status", $sort_direction, $sort ) ?>
                </th>
                <th>
                    <?= $this->common_lib->showListHeaderItemJS ( 'providesVendorsSortingClick', lang('created_at'), "created_at", $sort_direction, $sort ) ?>
                </th>
                <th>
                    <?= $this->common_lib->showListHeaderItemJS ( 'providesVendorsSortingClick', lang('updated_at'), "updated_at", $sort_direction, $sort ) ?>
                </th>
                <th><i class="fa fa-pencil"></i></th>
            </tr>
            </thead>
            <?
            foreach ($provides_vendors_list as $next_provides_vendor) {
                ?>


                <tr>

                    <td>
                        <!--<?php //echo $next_provides_vendor->cv_id; ?> = <?php //echo $next_provides_vendor->vn_id; ?> = --> <?php echo $next_provides_vendor->vn_name; ?>
                    </td>


                    <td>
                        <?php $cv_active_status= $next_provides_vendor->cv_active_status;
                        if ( empty($cv_active_status) ) $cv_active_status= 'N';
                        if ( !empty($client_id) and $client_id!= $next_provides_vendor->cv_client_id ) $cv_active_status= 'N';
                        echo $this->clients_mdl->getClientsVendorsActiveStatusLabel( $cv_active_status ) ?>
                    </td>

                    <td><?php echo $this->common_lib->format_datetime( $next_provides_vendor->created_at) ?></td>
                    <td><?php echo $this->common_lib->format_datetime( $next_provides_vendor->updated_at ) ?></td>

                    <td>
                        <a class="btn btn-sm blue" onclick="javascript:setProvidesVendorsEnabled( '<?= addslashes($next_provides_vendor->vn_name) ?>', '<?= addslashes($next_provides_vendor->vn_email) ?>', '<?= addslashes($next_provides_vendor->vn_website) ?>', '<?= $this->clients_mdl->getClientsVendorsActiveStatusLabel( $cv_active_status ) ?>', '<?= $cv_active_status ?>', '<?= $next_provides_vendor->vn_id ?>' )">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
                <?php
            }//end foreach( $ as $next_key=>$next_value ) {

            ?>
            </tbody>
        </table>
    </div>

    <div class="table_pagination">
        <?= $pagination_links; ?>
    </div>

<?php  } ?>


<?
if ( !isset($provides_vendors_list) or empty($provides_vendors_list) ) {
    echo '<h4>No Vendors found.</h4>';
}