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
<!--            --><? //
//$logged_user_title_name= $ci->session->userdata['logged_user_title_name'];
//                        echo '<pre>$logged_user_title_name::'.print_r($logged_user_title_name,true).'</pre>';
//                        echo '<pre>$user::'.print_r($user,true).'</pre>';
//                        die("-1 XXZ");
//            ?>

</div>
    </div>
</div>

