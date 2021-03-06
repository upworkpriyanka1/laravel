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
    <link href="<?= base_url(); ?>assets/layouts/default/css/custom-eh.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/favicon.ico" />
    
    <style>
		.panel-heading {
		  padding: 0;
			border:0;
		}
		.panel-title>a, .panel-title>a:active{
			display:block;
			padding:15px;
		  color:#555;
		  font-size:16px;
		  font-weight:bold;
			text-transform:uppercase;
			letter-spacing:1px;
		  word-spacing:3px;
			text-decoration:none;
		}
		.panel-heading  a:before {
		   font-family: 'Glyphicons Halflings';
		   content: "\e114";
		   float: left;
		   transition: all 0.5s;
		   
		   webkit-transform: rotate(180deg); 
    -moz-transform: rotate(180deg);
    transform: rotate(-90deg);
		}
		.panel-heading.active a:before {
			-webkit-transform: rotate(180deg);
			-moz-transform: rotate(180deg);
			transform: rotate(0deg);
		} 
		div.patient-plans div.col.s12 p{
			padding-left:30px;
		}
		div.patient-plans .panel-title a{
			padding:9px;
		}
		.patient-plans .tabs.tab-demo.z-depth-1{
			margin-bottom:20px;
		}
		/*.patient-plans div.panel.panel-default div.panel-collapse.collapse .panel-body{
			padding-left:25px;
		}*/
		ul.tabs.tab-demo.z-depth-1:after {
			content: "";
			display: table;
			clear: both;
		}
		.panel-collapse .panel-body{
			background-color: transparent;
			padding-left:25px;
		}
		.section_one .panel-title a{
			text-transform:none;
		}
		.sec-back{
			background-color: #cccccc;
		}
		.save-btn{
			margin-top:20px;
			margin-bottom:20px;
			margin-left:15px;
		}
		.panel-default {
			border-color: transparent;
		}
		.panel-default>.panel-heading {
			background-color: transparent !important;
			border-color: transparent !important;
		}
		.panel-default {
			border-color: transparent;
			background-color: transparent;
		}
		.section_one{
			background: transparent;
		}
	</style>
    
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">

    <!-- BEGIN HEADER -->
    <header>
        <nav class="top-nav">
            <div class="container">
                <div class="page-header navbar navbar-fixed-top">
                    <!-- BEGIN PAGE TITLE-->
                    <div class="page-title">
                        <h1  id="logo">
                            <!-- <a href="#" data-activates="nav-mobile" class="button-collapse" id="nav_mobile_button"><i class="material-icons">menu</i></a>-->
                            <span class='logo_first'>P</span>Patient
                        </h1>
                        <div class="rand-place">

                            <div class="row">
                                <div class="col s2 locat-call ">
                                    <div class="tb-adr">
                                        <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                        <ul class="text-tb-cl">
                                            <li>622 Central Ave, Unit X </li>
                                            <li>Central Valley, OE 99999</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col s2 locat-call">
                                    <div class="tb-adr">
                                        <p class="icon-tb-cl"><i class="material-icons">call</i></p>
                                        <ul class="text-tb-cl">
                                            <li>(246 463-2538)</li>
                                            <li>(246 463-2500)</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col s2 locat-call ">
                                    <div class="tb-adr">
                                        <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                        <ul class="text-tb-cl">
                                            <li>622 Central Ave, Unit X </li>
                                            <li>Central Valley, OE 99999</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col s2 locat-call ">
                                    <div class="tb-adr">
                                        <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                        <ul class="text-tb-cl">
                                            <li>622 Central Ave, Unit X </li>
                                            <li>Central Valley, OE 99999</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col s2 locat-call">
                                    <div class="tb-adr">
                                        <p class="icon-tb-cl"><i class="material-icons">call</i></p>
                                        <ul class="text-tb-cl">
                                            <li>(246 463-2538)</li>
                                            <li>(246 463-2500)</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col s2 locat-call ">
                                    <div class="tb-adr">
                                        <span class="icon-tb-cl"><i class="material-icons">location_on</i></span>
                                        <ul class="text-tb-cl">
                                            <li>622 Central Ave, Unit X </li>
                                            <li>Central Valley, OE 99999</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="chevron">
                            <span class="chevron-down" style="display:none;">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </span>
                            <span class="chevron-up" style="display:none;">
                                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <div class="zang" style="right:0px;"></div>
                    <!-- END PAGE TITLE-->

                    <!-- BEGIN HEADER INNER -->
                    <div class="page-header-inner ">
                        <!-- BEGIN TOP NAVIGATION MENU -->
                        <div class="top-menu">
                            <ul class="right">
                                <li>
                                    <div class="theme-panel">
                                        <!--<div class="toggler" style="display: block;"> </div>-->
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
        <!-- BEGIN SIDEBAR -->
        <div class="container">
            <a href="#" id="artash" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light hide-on-large-only">
                <i class="material-icons">menu</i>
            </a>
        </div>
        <ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(-100%);">
            <li class="logo">
                <a href="./" class="brand-logo">
                    <img src="<?= base_url(); ?>assets/img/logo.png" alt="logo" class="logo-default" />
                </a>
            </li>

            <li class="no-padding">

                <ul class="collapsible collapsible-accordion">
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item  eh   clients">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="fa fa-book"></span>
                            <span class="title">Clients</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <div class="collapsible-body" >
                            <ul>
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /clients-view   /eh/">
                                    <a href="/sys-admin/clients-view"   class="nav-link ">
                                        <!-- <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-folder-open"></span>
                                        <span class="title">Manage</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /client/new/   /eh/">
                                    <a href="#" class="create_contact"  class="nav-link ">
                                        <!-- <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">New</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /clients-type   /eh/">
                                    <a href="/sys-admin/clients-type"   class="nav-link ">
                                        <!--<a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">Client&nbsp;Type</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                            </ul>
                        </div>
                    </li>
                    <!-- END SIDEBAR MENU -->
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item  eh   users">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="fa fa-user"></span>
                            <span class="title">Users</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <div class="collapsible-body" >
                            <ul>
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /users/users-view   /eh/">
                                    <a href="/sys-admin/users/users-view"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-user"></span>
                                        <span class="title">Manage</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /users/users-edit/new/   /eh/">
                                    <a href="/sys-admin/users/users-edit/new/"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">New</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /users-role   /eh/">
                                    <a href="/sys-admin/users-role"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">Titles</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                            </ul>
                        </div>
                    </li>
                    <!-- END SIDEBAR MENU -->
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item  eh   contacts">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="fa fa-book"></span>
                            <span class="title">Contacts</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <div class="collapsible-body" >
                            <ul>
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /contact-type   /eh/">
                                    <a href="/sys-admin/contact-type"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">Contact&nbsp;Category</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                            </ul>
                        </div>
                    </li>
                    <!-- END SIDEBAR MENU -->
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item  eh   activity">

                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="fa fa-book"></span>
                            <span class="title">Activities</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <div class="collapsible-body" >
                            <ul>
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /activity-logs   /eh/">
                                    <a href="/sys-admin/activity-logs"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-bars"></span>
                                        <span class="title">Activity&nbsp;Logs</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                            </ul>
                        </div>
                    </li>
                    <!-- END SIDEBAR MENU -->
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item  eh   vendors-services">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="fa fa-wheelchair"></span>
                            <span class="title">Vendors/Services</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <div class="collapsible-body" >
                            <ul>
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /vendors/vendor-types-view   /eh/">
                                    <a href="/sys-admin/vendors/vendor-types-view"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-trophy"></span>
                                        <span class="title">New&nbsp;Vendor</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /vendors/vendor-types-edit/new   /eh/">
                                    <a href="/sys-admin/vendors/vendor-types-edit/new"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">Add&nbsp;Vendor&nbsp;Type</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /vendors/vendors-view   /eh/">
                                    <a href="/sys-admin/vendors/vendors-view"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-wheelchair"></span>
                                        <span class="title">Vendors&nbsp;Listing</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /vendors/vendors-edit/new/   /eh/">
                                    <a href="/sys-admin/vendors/vendors-edit/new/"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">Add&nbsp;Vendor</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /services/services-view   /eh/">
                                    <a href="/sys-admin/services/services-view"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-wifi"></span>
                                        <span class="title">Services&nbsp;Listing</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /services/services-edit/new/   /eh/">
                                    <a href="/sys-admin/services/services-edit/new/"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">Add&nbsp;Service</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                            </ul>
                        </div>
                    </li>
                    <!-- END SIDEBAR MENU -->
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item  eh   cms-items">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="fa fa-edit"></span>
                            <span class="title">CMS&nbsp;Items</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <div class="collapsible-body" >
                            <ul>
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /cms-items/cms-items-view   /eh/">
                                    <a href="/sys-admin/cms-items/cms-items-view"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-edit"></span>
                                        <span class="title">CMS&nbsp;Items&nbsp;Listing</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item /cms-items/cms-items-edit/new/   /eh/">
                                    <a href="/sys-admin/cms-items/cms-items-edit/new/"   class="nav-link ">
                                        <!--                                        <a href="--><!--" class="nav-link ">-->
                                        <span class="fa fa-plus"></span>
                                        <span class="title">Add&nbsp;CMS&nbsp;Item</span>
                                    </a>
                                </li>
                                <!-- END SIDEBAR MENU LINK -->
                            </ul>
                        </div>
                    </li>
                    <!-- END SIDEBAR MENU -->
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
                <div class="col s12 patient-plans">
                    <div id="structure" class="section scrollspy">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                            <div class="page-content"><br/>
                                <div class="clearfix"></div>
                                <div class="col s12 sec-back">
									<ul class="tabs tab-demo z-depth-1 rand-place">
                                    	<li class="tab"><a class="" href="#vs_pain"><?php echo lang('vs_pain')?></a></li>	
										<li class="tab"><a href="#circulatory" class=""><?php echo lang('circulatory')?></a></li>
										<li class="tab"><a class="" href="#digestive"><?php echo lang('digestive')?></a></li>
										<li class="tab"><a href="#endocrine" class=""><?php echo lang('endocrine')?></a></li>
										<li class="tab"><a href="#skin_wounds" class=""><?php echo lang('skin_wounds')?></a></li>
										<li class="tab"><a class="" href="#lymphatic"><?php echo lang('lymphatic')?></a></li>
										<li class="tab"><a class="" href="#musc_skeletal"><?php echo lang('musc_skeletal')?></a></li>
										<li class="tab"><a class="" href="#nervous"><?php echo lang('nervous')?></a></li>
										<li class="tab"><a class="" href="#reproductive"><?php echo lang('reproductive')?></a></li>
										<li class="tab"><a class="" href="#respiratory"><?php echo lang('respiratory')?></a></li>
										<li class="tab"><a class="" href="#urinary"><?php echo lang('urinary')?></a></li>
											
									</ul>
                                    
                                    
  
									<div id="circulatory" class="col s12">
                                    	
                                        <div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#circulatory-section">
                                            	Circulatory
                                            </a>
                                            </h4>
                                        </div>
        
										<p id="circulatory-section" class="panel-collapse collapse in">The container class is not strictly part of the grid but is important in laying out content. It allows you to center your page content. The container class is set to ~70% of the window width. It helps you center and contain your page content. We use the container to contain our body content.</p>
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-circulatory">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#circulatory-care_plan" aria-expanded="false" aria-controls="circulatory-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="circulatory-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-circulatory">
                                                <div class="panel-body">
                                                    The tabs structure consists of an unordered list of tabs that have hashes corresponding to tab ids. Then when you click on each tab, only the container with the corresponding tab id will become visible. 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        	
									</div>
									<div id="digestive" class="col s12">
                                    
										<div class="panel-heading active section_one" role="tab" id="heading-digestive">
                                            <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#digestive-section" aria-expanded="true" aria-controls="digestive-section" class="">
                                            	Digestive
                                            </a>
                                            </h4>
                                        </div>

										<div id="digestive-section" class="panel-collapse collapse in">	
										<div class="row">
											<div class="col-md-12">
												<div class="input-field">
														<select class="title-drop" name="data[lic-title]">
															<option value="" disabled="" selected="">Title</option>
															<option value="1">Superuser</option>
															<option value="2">Administrative</option>
															<option value="3">Registered Nurse</option>
															<option value="4">Licensed Vocational Nurse</option>
															<option value="5">Aid</option>
															<option value="6">Quality Assurance</option>
															<option value="7">Social Worker</option>
															<option value="8">Spiritual Councellor</option>
														</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-field">
													<input id="us-lic" type="text" name="data[us-lic]">
													<label for="us-lic">License</label>
												</div>
											</div>											
										</div>
                                        </div>
										
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-digestive">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#digestive-care_plan" aria-expanded="false" aria-controls="digestive-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="digestive-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-digestive">
                                                <div class="panel-body">
                                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        
									</div>
									<div id="endocrine" class="col s12">
                                    	<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#endocrine-section">
                                            	Endocrine
                                            </a>
                                            </h4>
                                        </div>
        
										<p id="endocrine-section" class="panel-collapse collapse in">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
                                        

										
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-endocrine">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#endocrine-care_plan" aria-expanded="false" aria-controls="endocrine-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="endocrine-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-endocrine">
                                                <div class="panel-body">
                                                    The tabs structure consists of an unordered list of tabs that have hashes corresponding to tab ids. Then when you click on each tab, only the container with the corresponding tab id will become visible. 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        	
									</div>
									<div id="skin_wounds" class="col s12">
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#skin_wounds-section">
                                            	Skin-wounds
                                            </a>
                                            </h4>
                                        </div>
        
										<p id="skin_wounds-section" class="panel-collapse collapse in">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>

										
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-skin_wounds">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#skin_wounds-care_plan" aria-expanded="false" aria-controls="skin_wounds-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="skin_wounds-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-skin_wounds">
                                                <div class="panel-body">
                                                    It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        	
									</div>
									<div id="lymphatic" class="col s12">
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#lymphatic-section">
                                            	Lymphatic
                                            </a>
                                            </h4>
                                        </div>
        
										<p id="lymphatic-section" class="panel-collapse collapse in">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>

										
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-lymphatic">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#lymphatic-care_plan" aria-expanded="false" aria-controls="lymphatic-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="lymphatic-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-lymphatic">
                                                <div class="panel-body">
                                                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        	
									</div>
									<div id="musc_skeletal" class="col s12">
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#musc_skeletal-section">
                                            	Musc-skeletal
                                            </a>
                                            </h4>
                                        </div>
        
										<p id="musc_skeletal-section" class="panel-collapse collapse in">The container class is not strictly part of the grid but is important in laying out content. It allows you to center your page content. The container class is set to ~70% of the window width. It helps you center and contain your page content. We use the container to contain our body content.</p>

										
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-musc_skeletal">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#musc_skeletal-care_plan" aria-expanded="false" aria-controls="musc_skeletal-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="musc_skeletal-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-musc_skeletal">
                                                <div class="panel-body">
                                                    The tabs structure consists of an unordered list of tabs that have hashes corresponding to tab ids. Then when you click on each tab, only the container with the corresponding tab id will become visible. 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        	
									</div>
									<div id="nervous" class="col s12">
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#nervous-section">
                                            	Nervous
                                            </a>
                                            </h4>
                                        </div>
        								
                                        <div id="nervous-section" class="panel-collapse collapse in">
										<div class="row">
											<div class="col-md-12">
												<div class="input-field">
													<input id="us-lic" type="text" name="data[us-lic]">
													<label for="us-lic">Company</label>
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-field">
													<input id="us-lic" type="text" name="data[us-lic]">
													<label for="us-lic">Address</label>
												</div>
											</div>											
										</div>
                                        </div>

										
                                        	
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-nervous">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#nervous-care_plan" aria-expanded="false" aria-controls="nervous-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="nervous-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-nervous">
                                                <div class="panel-body">
                                                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        
									</div>
									<div id="reproductive" class="col s12">
										
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#reproductive-section">
                                            	Reproductive
                                            </a>
                                            </h4>
                                        </div>
        
										<p id="reproductive-section" class="panel-collapse collapse in">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>

										
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-reproductive">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#reproductive-care_plan" aria-expanded="false" aria-controls="reproductive-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="reproductive-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-reproductive">
                                                <div class="panel-body">
                                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        	
									</div>
									<div id="respiratory" class="col s12">
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#respiratory-section">
                                            	Respiratory
                                            </a>
                                            </h4>
                                        </div>
        								<div id="respiratory-section" class="panel-collapse collapse in">
										<div class="row">
											<div class="col-md-12">
												<div class="input-field">
													<input id="us-lic" type="text" name="data[us-lic]">
													<label for="us-lic">First Name</label>
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-field">
													<input id="us-lic" type="text" name="data[us-lic]">
													<label for="us-lic">Last Name</label>
												</div>
											</div>											
										</div>
                                        </div>

										
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-respiratory">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#respiratory-care_plan" aria-expanded="false" aria-controls="respiratory-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="respiratory-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-respiratory">
                                                <div class="panel-body">
                                                    But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        	
									</div>
									<div id="urinary" class="col s12">
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#urinary-section">
                                            	Urinary
                                            </a>
                                            </h4>
                                        </div>
        
										<p id="urinary-section" class="panel-collapse collapse in">On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.</p>

											
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-urinary">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#urinary-care_plan" aria-expanded="false" aria-controls="urinary-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="urinary-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-urinary">
                                                <div class="panel-body">
                                                    Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? 
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                    
                                    
									</div>
									<div id="vs_pain" class="col s12">
										<div class="panel-heading active section_one" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a data-toggle="collapse" data-target="#vs_pain-section">
                                            	Vs-Pain
                                            </a>
                                            </h4>
                                        </div>
                                        
                                        
        
										<p id="vs_pain-section" class="panel-collapse collapse in">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-vs_pain">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#vs_pain-care_plan" aria-expanded="false" aria-controls="vs_pain-care_plan">
                                                        Care Plan
                                                    </a>
                                                </h4>
                                            </div><!--End of panel-heading -->
                                            <div id="vs_pain-care_plan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-vs_pain">
                                                <div class="panel-body">
                                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                </div>
                                            </div>
                                        </div><!--End of panel panel-default -->
                                        
                                        
                                            
                                        
									</div>
                                    
                                   
                                    <button type="button" class="btn btn-default save-btn">SAVE</button>
                                    <button type="button" class="btn btn-default save-btn">SAVE AND NEXT</button>
                                      
									
                                </div>
                            </div><!-- ./page-conten -->
                        </div>
                        <!-- END CONTAINER ./page-content-wrapper -->
                    </div>
                </div>
            </div>
        </div>
    </main>﻿
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
    <script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/js/materialize.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/js/init.js" type="text/javascript" ></script>
    <script src="<?= base_url(); ?>assets/global/js/eh.js" type="text/javascript" ></script>

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
	<script>
		$('.panel-collapse').on('show.bs.collapse', function () {
		$(this).siblings('.panel-heading').addClass('active');
		});
		
		$('.panel-collapse').on('hide.bs.collapse', function () {
		$(this).siblings('.panel-heading').removeClass('active');
		});
	</script>


</body>
</html>