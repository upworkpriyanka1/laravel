<?php if ( $this->common_lib->is_ajax_request() ) : ?>

    <?php
    if (isset($page)){
        $this->load->view($page);
        return;
    }
    ?>

<?php endif; ?>
</header>
<?php
if (isset($page)){
    $this->load->view($page);
}
?>
