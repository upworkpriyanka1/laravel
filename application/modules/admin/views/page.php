<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb" style="padding: 21px;">
                <li>
                    <a href="./"><?php echo lang('home');?></a>
                    <i class="fa fa-circle"></i>
                </li>
                <?php if (isset($this->uri->segments['2'])){ ?>
                <li>
                    <span><a href="./<?= $this->uri->segment('2');?>"><?php echo lang($this->uri->segment('2'));?></a></span>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <?php
        $page_title= lang('page-title');
            if (isset($this->uri->segments['2'])){$page_title= lang($this->uri->segment('2'));}
        ?>
<!--        <h3 class="page-title"> --><?php //echo $page_title;?><!--</h3>-->
        <!-- END PAGE TITLE-->
        <div class="clearfix"></div>

<?php 
    if (isset($page)){
        $this->load->view($page);
    }
?>


    </div><!-- ./page-conten -->
</div>
<!-- END CONTAINER ./page-content-wrapper -->