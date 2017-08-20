<?php if ( $this->common_lib->is_ajax_request() ) : ?>
    <?php
    if (isset($page)){
        $this->load->view($page);
        return;
    }
    ?>
<?php endif; ?>
</header>
<main>
    <div class="page-content" id="top_container">
        <div class="row">
            <div class="col s12">
                <div id="structure" class="section scrollspy">

                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="page-content">
                            <div class="clearfix"></div>
                            <?php
                                if (isset($page)){
                                    $this->load->view($page);
                                }
                            ?>
                        </div><!-- ./page-conten -->
                    </div>
                    <!-- END CONTAINER ./page-content-wrapper -->
                </div>
            </div>
        </div>
    </div>
</main>