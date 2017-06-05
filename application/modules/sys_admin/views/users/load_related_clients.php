<?php if ( !isset($related_clients_list) or empty($related_clients_list) ) {
    echo '<h4>No client association</h4>';
    return;
}
?>
<div class="table-responsive">
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
        </thead>

        <tbody>
<!--        --><?php //var_dump($clients); ?>

<?php //var_dump($related_users_list); ?>
        <? foreach ($related_clients_list as $next_clients_client) { ?>
        <tr>
            <td><?php echo $next_clients_client->client_name; ?></td>
            <td><?php echo $next_clients_client->user_group_description; ?> </td>
            <td><?php echo $this->clients_mdl->getClientActiveStatusLabel($next_clients_client->client_active_status) ?></td>
            <td><?php echo $this->common_lib->format_datetime( $next_clients_client->created_at) ?></td>
        </tr>
            <?php
        }//end foreach( $ as $next_key=>$next_value ) {
        ?>
        </tbody>
    </table>
</div>

