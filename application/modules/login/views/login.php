

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="<?php echo base_url() ?>assets/img/logo.png" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="" method="post">
                <h3 class="form-title font-green"><?php echo lang('sign-in')?></h3>
                <?php if ( $this->session->flashdata( 'message' ) ) : ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata( 'message' ); ?></div>
                <?php endif; ?>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo lang('sign-in-help')?> </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9"><?= lang("username");?></label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9"><?= lang('password');?></label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="<?= lang('password');?>" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase"><?= lang("log-in");?></button>
                    <label class="rememberme check">
                        <input type="checkbox" name="remember" value="1" /><?= lang("remember");?> </label>
                    <a href="<?php echo base_url('login/reset') ?>" id="forget-password" class="forget-password"><?= lang("forgot-password");?></a><div class="clear_fix"></div>
                </div>
            </form>

        </div>

        <div class="xntral-footer">
            <ul>
                <li class="first"><a href="#">Home Page</a></li>
                <li><a href="#">Create an account</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
            <div class="clear_fix"></div>
        </div>