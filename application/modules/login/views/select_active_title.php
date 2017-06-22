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
    <form class="login-form" action="<?php echo base_url() ;?>login/switch_active_title" method="post">
        <h3 class="form-title font-green"><?= lang("select_active_title");?></h3>
        <?php if ( $this->session->flashdata( 'message' ) ) : ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata( 'message' ); ?></div>
        <?php endif; ?>

        <div class="form-group">
        <?php foreach( $groupsList as $nextGroup ) { ?>
            <input class="with-gap" type="radio" value="<?= $nextGroup->group_id; ?>" name="active_title_id" id="active_title_<?= $nextGroup->group_id; ?>" >
            <label class="control-label" for="active_title_id_<?= $nextGroup->group_id; ?>"><?= $nextGroup->group_description; ?></label>
                <div class="clear_fix"></div>
        <?php } ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn green uppercase"><?= lang("switch_to_active_title");?></button>
            <div class="clear_fix"></div>
        </div>

    </form>

</div>