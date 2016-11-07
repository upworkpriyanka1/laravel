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
                        <form class="" action="" method="post">
                <h3 class="font-green">Forget Password ?</h3>

              <?php if ( $this->session->flashdata( 'message' ) ) : ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata( 'message' ); ?></div>
        <?php endif; ?>
 
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                   
                     <a href="./" id="forget-password" class="btn btn-default">Back</a>
                    <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
      


        </div>