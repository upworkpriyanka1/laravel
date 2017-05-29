<?php if ( !isset($related_users_list) or empty($related_users_list) ) {
    echo '<h4>There are no users for this client</h4>';
    return;
}
?>


<div class="table-responsive">
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Title</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
        </thead>

        <tbody>
        <? foreach ($related_users_list as $next_related_user) { ?>
        <tr>
            <td><?php echo $next_related_user->username; ?></td>
            <td><?php echo $next_related_user->user_group_description; ?> </td>
            <td><?php echo $this->users_mdl->getUserActiveStatusLabel($next_related_user->user_active_status) ?></td>
            <td><?php echo $this->common_lib->format_datetime( $next_related_user->created_at) ?></td>
        </tr>
            <?php
        }//end foreach( $ as $next_key=>$next_value ) {
        ?>
        </tbody>
    </table>
</div>


<?php

return;

$ci = &get_instance();
if ( isset($related_users_list) && count($related_users_list) > 0 ) { ?>

<!--<h4>--><?//=$users_count ?><!-- Related User(s)  $related_users_type::--><?//= $related_users_type ?><!--;; $related_users_filter::--><?//= $related_users_filter ?><!--</h4>   <!-- $related_users_type, 'related_users_filter' -->

<div class="table-toolbar table_info">
    <? if ( count($related_users_list) > 0 ) { ?>
        <?= count($related_users_list); ?>&nbsp;Row<? if ( count($related_users_list) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $users_count ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
    <? } ?>
</div>

<div class="table-responsive">

    <table class="table table-striped table-bordered table-hover  order-column" id="clients_listing">
        <tbody>

        <thead>
        <tr>
            <th>
                <?= $this->common_lib->showListHeaderItemJS ( 'relatedUserSortingClick', lang('username'), "username", $sort_direction, $sort ) ?>
            </th>
            <th>
                <?= $this->common_lib->showListHeaderItemJS ( 'relatedUserSortingClick', lang('user_active_status'), "user_active_status", $sort_direction, $sort ) ?>
            </th>
            <th>
                <?= $this->common_lib->showListHeaderItemJS ( 'relatedUserSortingClick', lang('email'), "email", $sort_direction, $sort ) ?>
            </th>
            <th>
                <?= $this->common_lib->showListHeaderItemJS ( 'relatedUserSortingClick', lang('phone'), "phone", $sort_direction, $sort ) ?>
            </th>
            <th>
                <?= $this->common_lib->showListHeaderItemJS ( 'relatedUserSortingClick', lang('uc_active_status'), "uc_active_status", $sort_direction, $sort ) ?>
            </th>
            <th>
                <?= $this->common_lib->showListHeaderItemJS ( 'relatedUserSortingClick', lang('created_at'), "created_at", $sort_direction, $sort ) ?>
            </th>
            <th>
                <?= $this->common_lib->showListHeaderItemJS ( 'relatedUserSortingClick', lang('updated_at'), "updated_at", $sort_direction, $sort ) ?>
            </th>
            <th><i class="fa fa-pencil"></i></th>
        </tr>
        </thead>
        <?
        foreach ($related_users_list as $next_related_user) { // echo '<pre>$next_related_user::'.print_r($next_related_user,true).'</pre>';
            ?>


        <tr>

            <td>
                <!-- <?php // echo $next_related_user->id; ?> = --><?php echo $next_related_user->username; ?>
            </td>

            <td>
                <?php echo $this->clients_mdl->getUserActiveStatusLabel($next_related_user->user_active_status) ?>
            </td>

            <td>
                <?php echo $next_related_user->email; ?>
            </td>

            <td>
                <?php echo $next_related_user->phone; ?>
            </td>

            <td>
                <?php $uc_active_status= $next_related_user->uc_active_status;
                if ( empty($uc_active_status) ) $uc_active_status= 'N';
                if ( !empty($client_id) and $client_id!= $next_related_user->uc_client_id ) $uc_active_status= 'N';
                echo $this->clients_mdl->getUsersClientsActiveStatusLabel( $uc_active_status ) ?>
            </td>

            <td><?php echo $this->common_lib->format_datetime( $next_related_user->uc_created_at) ?></td>
            <td><?php echo $this->common_lib->format_datetime( $next_related_user->uc_updated_at ) ?></td>

            <td>
                <a class="btn waves-effect waves-light btn-sm blue"
                   data-target="#related_user_enabled_dialog" data-toggle="modal"
                   onclick="javascript:setRelatedUserEnabled( '<?= addslashes($next_related_user->username) ?>//', '<?= $this->clients_mdl->getUserActiveStatusLabel($next_related_user->user_active_status) ?>', '<?= addslashes($next_related_user->email) ?>', '<?= addslashes($next_related_user->phone) ?>', '<?= $uc_active_status ?>', '<?= $this->clients_mdl->getUsersClientsActiveStatusLabel( $uc_active_status ) ?>', <?= $next_related_user->id ?>)">
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
if ( !isset($related_users_list) or empty($related_users_list) ) {
    echo '<h4>No Users found.</h4>';
}