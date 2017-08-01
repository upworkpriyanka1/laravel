<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
        Name: <?= $user->first_name." ".$user->last_name;?><br />
        Title: <?= lang($user->job_title);?><br />
        Group: <?= lang($user->group_title);?><br />
        Superviser: <?= $superviser;?><br />
        Client: <?= $user->client_name;?><br />
		<pre>
            <?php print_r($user); ?>
        </pre>
        </div>
    </div>
</div>

