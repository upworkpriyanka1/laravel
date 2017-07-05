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
    <form class="login_client-form" action="<?php echo base_url() ;?>login/switch_active_client" method="post">
        <h3 class="form-title font-green"><?= lang("select_active_client");?></h3>
        <?php if ( $this->session->flashdata( 'message' ) ) : ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata( 'message' ); ?></div>
        <?php endif; ?>

        <div class="form-group">
            <?php foreach( $clients as $c ) { ?>
                <input class="with-gap" type="radio" value="<?= $c->cid; ?>" name="active_client_id" id="active_client_<?= $c->cid; ?>" >
                <label class="control-label" for="active_client_<?= $c->cid; ?>"><?= $c->client_name; ?></label>
                <div class="clear_fix"></div>
            <?php } ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn green uppercase"><?= lang("switch_to_active_client");?></button>
            <div class="clear_fix"></div>
        </div>

    </form>

</div>