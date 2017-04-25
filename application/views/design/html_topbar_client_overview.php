</head>
<?php
$query = $this->db->get("upload_bg");
if($query->num_rows() > 0){
$res = $query->row();
$img_url = base_url()."/assets/avatar/".$res->filename;
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md" style="background:url(<?php echo $img_url; ?>) no-repeat center center / cover;">
<?php }else{ ?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<?php } ?>

<!-- BEGIN HEADER -->

<header>
    <nav class="top-nav">
        <div class="container">
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN PAGE TITLE-->
                <div class="page-title">
                    <h1  id="logo">
                        <!-- <a href="#" data-activates="nav-mobile" class="button-collapse" id="nav_mobile_button"><i class="material-icons">menu</i></a>-->
                        <span class='logo_first'><?php echo $client->client_name[0] ?></span><?php echo $client->client_name ?>

                    </h1>
                    <div class="rand-place">

                        <div class="row">
                            <div class="col s2 locat-call ">
                                <div class="tb-adr">
                                    <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                    <ul class="text-tb-cl">
                                        <li><?php echo $client->client_address1 ?></li>
                                        <li><?php echo $client->client_address2 ?></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col s2 locat-call">
                                <div class="tb-adr">
                                    <p class="icon-tb-cl"><i class="material-icons">call</i></p>
                                    <ul class="text-tb-cl">
                                        <li><?php echo $client->client_phone?></li>
                                        <li><?php echo $client->client_phone_2?></li>
                                        <li><?php echo $client->client_phone_3?></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="chevron">
                            <span class="chevron-down" style="display:none;">
                                <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                            </span>
                            <span class="chevron-up" style="display:none;">
                                <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                            </span>
                    </div>
                </div>
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
                                        <a href="#"> <img src="/assets/layouts/default/img/new-messages.png" alt="new-messages">
                                            <span class="round">1</span>
                                        </a>
                                    </li>
                                    <li class="patient-updates">
                                        <a href="#"> <img src="/assets/layouts/default/img/patient-updates.png" alt="patient-updates">
                                            <span class="round">2</span>
                                        </a>
                                    </li>
                                    <li class="news">
                                        <a href="#">
                                            <img src="/assets/layouts/default/img/news.png" alt="news">
                                            <span class="round">3</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE TITLE-->

                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
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
                                                <li class="color-light3 current" data-style="light3" data-container="body" data-html="true" data-original-title="Light 3"> </li>
                                                <li class="color-light2" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>
                                                <li class="color-light" data-style="light" data-container="body" data-original-title="Light"> </li>
                                                <li class="color-default" data-style="default" data-container="body" data-original-title="Default"> </li>
                                                <li class="color-darkblue" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>
                                                <li class="color-blue" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                                            </ul>
                                        </div>
                                        <div class="theme-option">
                                            <span> Theme Background </span>
                                            <div id="selectImage">
                                                <label>Select Your Image or File</label><br>
                                                <form action="http://devk.loc/upload_controller/do_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                                    <input type='file' name='userfile' id='file'/><br>
                                                    <input type='submit' name='submit' value='Upload' class='btn btn-default'/>
                                                </form>
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
        </div>
    </nav>

    <!-- END LOGO -->