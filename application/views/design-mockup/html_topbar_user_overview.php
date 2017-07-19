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
                        <span class='logo_first'></span>
                    </h1>

                    <div class="rand-place">

                        <div class="row">
                            <div class="col s2 locat-call ">
                                <div class="tb-adr">
                                    <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                    <ul class="text-tb-cl">
                                        <li></li>
                                        <li></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col s2 locat-call">
                                <div class="tb-adr">
                                    <p class="icon-tb-cl"><i class="material-icons">call</i></p>
                                    <ul class="text-tb-cl">
                                        <li></li>
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

            </div>
        </div>
    </nav>

    <!-- END LOGO -->