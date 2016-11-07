<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
        Name: <?= $user->first_name." ".$user->last_name;?><br />
        Title: <?= lang($user->job_title);?><br />
        Group: <?= lang($user->group_title);?><br />
        Client: <?= $user->client_name;?><br />
        <pre>
        <?php
            var_dump($_SESSION);
            ?>
        </div>
    </div>
</div>

