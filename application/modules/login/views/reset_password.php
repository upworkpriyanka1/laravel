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
              <?php if ( $this->session->flashdata( 'message' ) ) : ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata( 'message' ); ?></div>
<?php endif; ?>
        <?php echo form_open(current_url().'/' . $code);?>

            <p>
                <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
                <?php echo form_input($new_password);?>
            </p>

            <p>
                <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                <?php echo form_input($new_password_confirm);?>
            </p>

            <?php echo form_input($user_id);?>
     

            <p><?php echo form_submit('submit', lang('reset_password_submit_btn'),"class='btn btn-primary'");?></p>

        <?php echo form_close();?>
  


    </div>