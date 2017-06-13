<?php if ( !isset($related_users_list) or empty($related_users_list) ) {
    echo '<h4>There are no users for this client</h4>';
    return;
}
?>


<div class="table-responsive" style="background-color: #fff">
    <table class="table table-striped table-bordered table-hover  order-column">
        <thead>
        <tr>
            <th>Username</th>
            <th>Title</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
        </thead>

        <tbody>

        <?
        $h= array();$t= array();$t1= array(); foreach ($related_users_list as $next_related_user) {
            if ( in_array($next_related_user->username, $h) && in_array($next_related_user->user_client_relation_description, $t1)  || in_array($next_related_user->username, $h) && in_array($next_related_user->user_group_description, $t) ) {
                continue;
            }else{

                $h[] = $next_related_user->username;
                $t1[] = $next_related_user->user_client_relation_description;
                $t[] = $next_related_user->user_group_description;
                if ($next_related_user->user_group_description == $next_related_user->user_client_relation_description) {

                    ?>
                    <tr>
                        <td>
                            <a href="<?= base_url('/sys-admin/users/users-overview/' . $next_related_user->id . '/'); ?>">
                                <?= $next_related_user->username; ?>
                            </a>
<!--                            (--><?php //echo $this->users_mdl->getUserStatusLabel($next_related_user->user_status) ?><!--)-->
                        </td>
                        <td><?php echo $next_related_user->user_client_relation_description; ?> </td>
                        <td><?php echo $this->users_mdl->getUserStatusLabel($next_related_user->user_status) ?></td>
<!--                        <td>--><?php //echo $this->users_mdl->getUserGroupStatusLabel( $next_related_user->user_group_status ) ?><!--</td>-->
                        <td><?php echo $this->common_lib->format_datetime($next_related_user->created_at) ?></td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td>
                            <a href="<?= base_url('/sys-admin/users/users-overview/' . $next_related_user->id . '/'); ?>">
                                <?= $next_related_user->username; ?>
                            </a>
<!--                            (--><?php //echo $this->users_mdl->getUserStatusLabel($next_related_user->user_status) ?><!--)-->
                        </td>
                        <td><?php echo $next_related_user->user_client_relation_description; ?> </td>
                        <td><?php echo $this->users_mdl->getUserStatusLabel($next_related_user->user_status) ?></td>
                        <!--                        <td>--><?php //echo $this->users_mdl->getUserGroupStatusLabel( $next_related_user->user_group_status ) ?><!--</td>-->
                        <td><?php echo $this->common_lib->format_datetime($next_related_user->created_at) ?></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?= base_url('/sys-admin/users/users-overview/' . $next_related_user->id . '/'); ?>">
                                <?= $next_related_user->username; ?>
                            </a>
<!--                            (--><?php //echo $this->users_mdl->getUserStatusLabel($next_related_user->user_status) ?><!--)-->
                        </td>
                        <td><?php echo $next_related_user->user_group_description; ?> </td>
                        <td><?php echo $this->users_mdl->getUserStatusLabel($next_related_user->user_status) ?></td>
                        <!--                        <td>--><?php //echo $this->users_mdl->getUserGroupStatusLabel( $next_related_user->user_group_status ) ?><!--</td>-->
                        <td><?php echo $this->common_lib->format_datetime($next_related_user->created_at) ?></td>
                    </tr>
                    <?php

                }
            }
        }
        //end foreach( $ as $next_key=>$next_value ) {
        ?>
        </tbody>
    </table>
</div>