  <script src="<?= base_url(); ?>/assets/global/plugins/jquery.min.js" type="text/javascript" ></script>
</head>
<?php
	$body_cls = isset($body_class) ? $body_class : '';
    $query = $this->db->get("upload_bg");
    if($query->num_rows() > 0){
    $res = $query->row();
    $img_url = base_url()."/assets/avatar/".$res->filename;
	
	

	
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md <?php echo $body_cls; ?>" style="background:url(<?php echo $img_url; ?>) no-repeat center center / cover;">
<?php }else{ ?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md owner-dashboard <?php echo $body_cls; ?>">
<?php } ?>

        <!-- BEGIN HEADER -->

        <header>
            <nav class="top-nav">
                <div class="container">
                    <div class="page-header navbar navbar-fixed-top">
                        <!-- BEGIN PAGE TITLE-->
                        <?php
                        $ci = &get_instance();
                        $logged_user_title_description = '';
                        $username= '';
                        if ( !empty($username) and !empty($logged_user_title_description) ) {
                            $page_title = $logged_user_title_description . ' : ' . $username;
                        } else {
                            $page_title = lang('dashboard-title');
                        }
                        if (isset($this->uri->segments['2'])){
                            $page_title= lang($this->uri->segment('2'));
                        }
                        ?>
                        <h1 class="page-title" id="logo">
                            <span class="page-title-text">
                                <?php if($page_title != ''){ echo $page_title; }else{ ?>
                                   <?=$page_title?>
                                <?php } ?>
                            </span>
                        </h1>
                        <h1 class="page-title-dots">...</h1>
                        <div class="top-notific-page">
                            <div class="notifications">
                                <div class="zang">
                                    <span class="round">3</span>
                                </div>
                                <div class="notific-area" style="display: none;">
                                    <div class="notific-area-header">
                                        <ul>
                                            <li><a href="#">ALL</a></li>
                                            <li class="new-messages">
                                                <a href="#"> <img src="<?= base_url(); ?>/assets/layouts/default/img/new-messages.png" alt="new-messages">
                                                    <span class="round">1</span>
                                                </a>
                                            </li>
                                            <li class="patient-updates">
                                                <a href="#"> <img src="<?= base_url(); ?>/assets/layouts/default/img/patient-updates.png" alt="patient-updates">
                                                    <span class="round">2</span>
                                                </a>
                                            </li>
                                            <li class="news">
                                                <a href="#">
                                                    <img src="<?= base_url(); ?>/assets/layouts/default/img/news.png" alt="news">
                                                    <span class="round">3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>


                                </div>


                            </div>

                            <!-- BEGIN HEADER INNER -->
                            <div class="page-header-inner" style="display: none">
                                <!-- BEGIN TOP NAVIGATION MENU -->
                                <div class="top-menu">
                                    <ul class="right">
                                        <li>
                                            <div class="theme-panel">
                                                <div class="toggler" style="display: block;"> </div>
                                                <div class="toggler-close" style="display: none;"> </div>
                                                <div class="theme-options" style="display: none;">
                                                    <div class="theme-option theme-colors clearfix">
                                                        <span> THEME COLOR </span>
                                                        <ul>
                                                            <li class="color-light2 current" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>
                                                            <li class="color-light" data-style="light" data-container="body" data-original-title="Light"> </li>
                                                            <li class="color-default" data-style="default" data-container="body" data-original-title="Default"> </li>
                                                            <li class="color-darkblue" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>
                                                            <li class="color-blue" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                                                        </ul>
                                                    </div>
                                                    <div class="theme-option">
                                                        <span> Theme Background </span>
                                                        <?php if($query->num_rows() > 0){
                                                            $res = $query->row();
                                                            $img_url = base_url()."/assets/avatar/".$res->filename;
                                                            $del_id = $res->id;
                                                            ?>
                                                            <div class="img_bar">
                                                                <img src="<?php echo $img_url; ?>"/>
                                                                <a href="<?php echo base_url(); ?>upload_controller/delete_bg/<?php echo $del_id; ?>" class="delete_img"><span class="fa fa-close"></span></a>
                                                            </div>
                                                        <?php } ?>
                                                        <div id="selectImage">
                                                            <label>Select Your Image or File</label><br>
                                                            <?php echo form_open_multipart('upload_controller/do_upload');?>
                                                            <?php echo "<input type='file' name='userfile' id='file'/>"; ?><br>
                                                            <?php echo "<input type='submit' name='submit' value='Upload' class='btn btn-default'/> ";?>
                                                            <?php echo "</form>"?>
                                                            <span>(NOTE: Only JPG, JPEG, PNG are allowed. Max Size: 2MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="theme-option">
                                                        <span> Theme Style </span>
                                                        <select class="layout-style-option form-control input-sm">
                                                            <option value="square" selected="selected">Square corners</option>
                                                            <option value="rounded">Rounded corners</option>
                                                        </select>
                                                    </div>
                                                    <div class="theme-option">
                                                        <span> Header </span>
                                                        <select class="page-header-option form-control input-sm">
                                                            <option value="fixed" selected="selected">Fixed</option>
                                                            <option value="default">Default</option>
                                                        </select>
                                                    </div>
                                                    <div class="theme-option">
                                                        <span> Footer </span>
                                                        <select class="page-footer-option form-control input-sm">
                                                            <option value="fixed">Fixed</option>
                                                            <option value="default" selected="selected">Default</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>                                        
                                        <!-- END QUICK SIDEBAR TOGGLER -->
                                    </ul>
                                </div>
                                <!-- END TOP NAVIGATION MENU -->
                            </div>
                            <!-- END HEADER INNER -->
                        </div>
                        <!-- END PAGE TITLE-->


                    </div>
                </div>
            </nav>

            <!-- END LOGO -->