<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>SYS&nbsp;Admin&nbsp;Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/css/materialize.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/css/ghpages-materialize.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?= base_url(); ?>assets/layouts/default/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/layouts/default/css/themes/light2.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?= base_url(); ?>assets/layouts/default/css/custom-client-overview.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/favicon.ico" />
	<script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript" ></script>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md user form-edit-us" id="profile-form-mock">

<!-- BEGIN HEADER -->
<header>
    <nav class="top-nav">
        <div class="container">
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN PAGE TITLE-->
                <div class="page-title client-ed">
                    <h1 id="logo" style="color:#666;">					
                        <span id="span_client_client_name">Dashboard</span>
                    </h1>
                    <div class="rand-place">
                        <div class="row">
                            <div class="col s2 locat-call tb-adr" id="div_client_client_owner">
                                <div class="tb-adr">
                                    <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                    <ul class="text-tb-cl">
                                        <li><span id="span_client_client_owner">22</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s2 locat-call" id="div_client_client_type_label">
                                <div class="tb-adr">
                                    <span class="icon-tb-cl"><i class="material-icons">account_circle</i></span>
                                    <ul class="text-tb-cl">
                                        <li><span id="span_client_client_type_label">Adult Day Care</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s2 locat-call" id="div_client_client_address1">
                                <div class="tb-adr">
                                    <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                    <ul class="text-tb-cl">
                                        <li><span id="span_client_client_address1">44,45</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s2 locat-call" id="div_client_client_city">
                                <div class="tb-adr">
                                    <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                    <ul class="text-tb-cl">
                                        <li><span id="span_client_client_city">88,77,66</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s2 locat-call" id="div_client_client_phone">
                                <div class="tb-adr">
                                    <p class="icon-tb-cl"><i class="material-icons">call</i></p>
                                    <ul class="text-tb-cl">
                                        <li><span id="span_client_client_phone">99999999</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s2 locat-call" id="div_client_client_email">
                                <div class="tb-adr">
                                    <p class="icon-tb-cl"><i class="material-icons prefix">email</i></p>
                                    <ul class="text-tb-cl">
                                        <li><span id="span_client_client_email">bb@hjhj.com</span></li>
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
                                        <a href="#"> <img src="<?= base_url(); ?>assets/layouts/default/img/new-messages.png" alt="new-messages">
                                            <span class="round">1</span>
                                        </a>
                                    </li>
                                    <li class="patient-updates">
                                        <a href="#"> <img src="<?= base_url(); ?>assets/layouts/default/img/patient-updates.png" alt="patient-updates">
                                            <span class="round">2</span>
                                        </a>
                                    </li>
                                    <li class="news">
                                        <a href="#">
                                            <img src="<?= base_url(); ?>assets/layouts/default/img/news.png" alt="news">
                                            <span class="round">3</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        </div>


                    </div>
                <div class="zang"></div>

            </div>
        </div>
    </nav>
    <!-- BEGIN SIDEBAR -->
    <div class="container">
        <a href="#" id="artash" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light hide-on-large-only">
            <i class="material-icons">menu</i>
        </a>
    </div>
    <ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(-100%);">
        <li class="logo">
            <a href="/client-mockup-sacred-city/superuser" class="brand-logo">
                <!--                    <img src="<?= base_url(); ?>assets/img/logo.png" alt="logo" class="logo-default" /> -->
                <span class="logo-default"> Sacred City</span>
            </a>
        </li>

        <li class="no-padding">

            <ul class="collapsible collapsible-accordion collapsible-accordion-green">
                <!-- SIDEBAR MENU -->
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                        <span class="fa fa-book"></span>
                        <span class="title">PATIENTS</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <div class="collapsible-body" >
                        <ul>
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="/client-mockup-sacred-city/superuser/new-patient" class="nav-link ">
                                    <!-- <a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">New</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->

                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="client-overview-patient-manage"   class="nav-link ">
                                    <!-- <a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-folder-open"></span>
                                    <span class="title">Manage</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                        </ul>
                    </div>
                </li>
                <!-- END SIDEBAR MENU -->
                <!-- SIDEBAR MENU -->
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                        <span class="fa fa-user"></span>
                        <span class="title">Users</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <div class="collapsible-body" >
                        <ul>
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#" class="nav-link"  data-toggle="modal" data-target="#new_user_modal1">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">New</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-user"></span>
                                    <span class="title">Manage</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">Titles</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                        </ul>
                    </div>
                </li>
                <!--      END SIDEBAR MENU -->
                <!-- SIDEBAR MENU -->
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                        <span class="fa fa-edit"></span>
                        <span class="title">SETTINGS</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <div class="collapsible-body" >
                        <ul>
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <!-- <a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-edit"></span>
                                    <span class="title">CMS Items Listing</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">Add CMS Item</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                            <!-- SIDEBAR MENU LINK -->
                            <li>
                                <a href="client-overview-settings-theme" class="nav-link ">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">Theme</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                        </ul>
                    </div>
                </li>
                <!-- END SIDEBAR MENU -->
                <!-- SIDEBAR MENU LINK -->
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">

                        <span><img alt="" class="img-circle" src="<?= base_url(); ?>assets/avatar/avatar-gr.png"></span>

                        <span class="title">Rod D</span>
                    </a>
                    <div class="collapsible-body" style="display: none;">
                        <ul>
                            <li class="nav-item">
                                <a href="#">
                                    <span class="fa fa-user"></span>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="fa fa-sign-out" aria-hidden="true"></span>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- END SIDEBAR MENU LINK -->
                <!-- SIDEBAR MENU LINK -->
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                        <span class="fa fa-edit"></span>
                        <span class="title">MESSAGES</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                </li>
                <!-- SIDEBAR MENU -->
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                        <span class="fa fa-book"></span>
                        <span class="title">CONTACTS</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <div class="collapsible-body" >
                        <ul>
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">Users</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">Vendors</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                            <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item">
                                <a href="#"   class="nav-link ">
                                    <!--<a href="--><!--" class="nav-link ">-->
                                    <span class="fa fa-plus"></span>
                                    <span class="title">Locations</span>
                                </a>
                            </li>
                            <!-- END SIDEBAR MENU LINK -->
                        </ul>
                    </div>
                </li>

            </ul>

        </li>
    </ul>
    <!-- END SIDEBAR -->
</header>
<!-- END HEADER -->

<!-- BEGIN MAIN PAGE -->
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
                            <div class="col-xs-12">
                                <div id="profile-form">
                                    <div class="row">
										<button data-toggle="modal" data-target="#client_new_user_dialog_checking" class="client_new_user_dialog waves-effect waves-light btn-large" style="background-color: #fff; color: #000;font-size: 16px; margin-top:80px;">
											<i class="fa fa-plus" style="font-size: 16px"></i>
											Add location
										</button>  
										
										<div class="modal fade newclient" id="client_new_user_dialog_checking" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class=" modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
														<h3 class="modal-title" id="lineModalLabel">Add Location</h3>               
														<h5>All fields are required.</h5>
													</div>

													<div class="row">
														<form class="col s12 form-horizontal" action="" method="post" id="form_location" name="form_location" enctype="multipart/form-data">
															<div class="row">
																<div class="input-field col s12">                                    
																	<input required type="text" name="name" id="name" />
																	<label for="name">Name</label>
																</div>
															</div>

															<div class="row">
																<div class="input-field col s12">                                   
																	<input required type="text" name="address" id="address" value="" />
																	<label for="address">Address</label>
																</div>
															</div>
															<div class="row">
																<div class="input-field col s12">                                   
																	<input required type="text" name="residents" id="residents" value="" />
																	<label for="residents">Residents</label>
																</div>
															</div>

															<div class="row" style="display: none">
																<div class="input-field col s12">
																	<span id="span_message"></span>
																</div>
															</div>
															
															<div class="row md-foot-row">
																<div class="col-xs-12">					
																	<button class="btn" data-dismiss="modal" role="button" type="button" >CANCEL</button>
																
																	<button type="submit" class="btn">Save</button>
																		
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div> 
									</div>
								</div>
                            </div>
                        </div><!-- ./page-conten -->
                    </div>
                    <!-- END CONTAINER ./page-content-wrapper -->
                </div>
            </div>
            <div class="modal fade newuser1" id="new_user_modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modal-top">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">New User</h3>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="row">
                                    <form class="col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">account_circle</i>
                                                <input id="icon_prefix" type="text" class="validate"/>
                                                <label for="icon_prefix">First Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">supervisor_account</i>
                                                <input id="last_name" type="text" class="validate"/>
                                                <label for="last_name">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">phone</i>
                                                <input id="icon_telephone" type="tel" class="validate"/>
                                                <label for="icon_telephone">Telephone</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">email</i>
                                                <input id="email" type="email" class="validate required_form"  onchange="validateFormEnableOrDisable('form_client_edit2');"/>
                                                <label for="email">Email address</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix">email</i>
                                                <input id="email" type="email" class="validate required_form" onchange="validateFormEnableOrDisable('form_client_edit2');"/>
                                                <label for="email">Verify email address</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">

                            <div class="col-xs-12">

                                <ul class="md-foot-top">
                                    <li class="create-contact-more"><button class="btn-flat btn-flat1 reset_form_btn">Reset</button></li>
                                    <li class="create-contact-more"><button class="btn-flat btn-flat1">SUBMIT</button></li>
                                </ul>

                                <ul class ="md-foot-bot">
                                    <li data-dismiss="modal"> <button class="btn">CANCEL</button> </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- END MAIN PAGE -->

<!-- BEGIN FOOTER -->
<div class="clearfix"></div>
<footer>
    <div class="page-footer">
        <div class="container">
            <div class="col-lg-6 col-md-12 pg-footer-center">
                <ul class="footer-list">
                    <li><a href="#">About</a> |</li>
                    <li><a href="#">Terms & Conditions</a> |</li>
                    <li><a href="#"> Privacy Policy </a> |</li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-12 text-right pg-footer-center">
                <div class="page-footer-inner">
                    Copyright &copy; Zentral 2017
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
        </div>

    </div>
</footer>

<!-- END FOOTER -->


<!--[if lt IE 9]>
<script src="<?= base_url(); ?>assets/global/plugins/respond.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/plugins/excanvas.min.js" type="text/javascript" ></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->

<script src="<?= base_url(); ?>assets/global/js/materialize.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/js/init.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/global/js/client-overview.js" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript" ></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?= base_url(); ?>assets/layouts/default/scripts/layout.js" type="text/javascript" ></script>
<script src="<?= base_url(); ?>assets/layouts/default/scripts/demo.js" type="text/javascript" ></script>
<!-- END THEME LAYOUT SCRIPTS -->


</body>
</html>
