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
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/css/materialize.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/css/ghpages-materialize.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/assets/layouts/default/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/default/css/themes/light2.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/assets/layouts/default/css/custom-client-overview.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="/assets/favicon.ico" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md user form-edit-us" id="profile-form-mock">

<!-- BEGIN HEADER -->
<header>
    <nav class="top-nav">
        <div class="container">
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN PAGE TITLE-->
                <div class="page-title">
                    <h1  id="logo">
                        <!-- <a href="#" data-activates="nav-mobile" class="button-collapse" id="nav_mobile_button"><i class="material-icons">menu</i></a>-->
<!--                        <span class='logo_first'>S</span>Sacred City-->
                       [first name] [last name]
                    </h1>

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
            <a href="client-overview" class="brand-logo">
                <!--                    <img src="/assets/img/logo.png" alt="logo" class="logo-default" /> -->
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
                                <a href="client-overview-patient-new" class="nav-link ">
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
                <!-- END SIDEBAR MENU -->
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

                        <span><img alt="" class="img-circle" src="/assets/avatar/avatar-gr.png"></span>

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
                                        <!-- BEGIN FORM-->
                                        <form action="" id="new_user_form" method="POST" enctype="multipart/form-data">
                                            <?php echo validation_errors(); ?>
                                            <input type="hidden" class="validate" value="<?=$user->id?>" name="data[id]">
                                            <div class="form-body">
                                                <!-- start Account-->
                                                <div class="row">
                                                    <div class="pad-card">
                                                        <div class="cards-container">
                                                            <div class="card blue-grey darken-1">
                                                                <div class="card-content white-text">
                                                                    <span class="card-title">Account</span>
                                                                    <!-- User name -->
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-name" type="text" class="validate" value="<?=$user->username?>" name="data[username]">

                                                                                    <label for="us-name" class="control-label"><?php echo lang('user_name') ?>
                                                                                        <span class="required"> * </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-pass" type="password" class="validate" name="data[password]">

                                                                                    <label for="us-pass" class="control-label"><?php echo lang('password') ?>
                                                                                        <span class="required"> * </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-pass-conf" type="password" class="" name="data[password_confirm]">

                                                                                    <label data-error="wrong" data-success="right" for="us-pass-conf" class="control-label"><?php echo lang('password_confirm') ?>
                                                                                        <span class="required"> * </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end Account-->
                                                                </div>
                                                            </div>
                                                            <div class="card blue-grey darken-1">
                                                                <div class="card-content white-text">
                                                                    <span class="card-title">General</span>
                                                                    <!-- User names -->
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-fr-nm" type="text" class="validate" value="<?=$user->first_name?>" name="data[first_name]">
                                                                                    <label for="us-fr-nm" class="control-label"><?php echo lang('first_name') ?>
                                                                                        <span class="required"> * </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-md-nm" type="text" class="validate" value="<?=$user->middle_name?>" name="data[middle_name]">
                                                                                    <label for="us-md-nm" class="control-label"><?php echo lang('middle_name') ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-fr-nm" type="text" class="validate" value="<?=$user->last_name?>" name="data[last_name]">
                                                                                    <label for="us-fr-nm" class="control-label"><?php echo lang('last_name') ?>
                                                                                        <span class="required"> * </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Date of Birth</label>
                                                                                <input type="date" class="form-control" id="exampleInputDOB1" placeholder="Date of Birth" name="data[birth_date]">
                                                                            </div>
                                                                        </div>
                                                                        <!-- User Picture 1installes status -->

                                                                        <div class="col-md-12">
                                                                            <div class="file-field input-field">
                                                                                <div class="col-md-4">
                                                                                    <div class="btn">
                                                                                        <span>Picture 1</span>
                                                                                        <input type="file" id="avatar" name="data[avatar]">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="file-path-wrapper col-md-8">
                                                                                    <input class="file-path validate" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div class="container">
                                                                                <div class="row image_row">
                                                                                    <?php if($user_image){
                                                                                        foreach( $user_image as $key=>$value ) { ?>
                                                                                            <input type="hidden" name="data[user_image_name]" value="<?=$user_image_name[$key+2]?>">
                                                                                            <div class="col-md-3 col-sm-4 col-xs-6">
                                                                                                <div class="user-img-box">
                                                                                                    <img src="<?=base_url($value)?>" alt="Avatar" class="image" style="width:100%">
                                                                                                    <div class="img-middle">
                                                                                                        <div class="img-text">
                                                                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="set as default" class="image_set_as_default"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                                                                            <a href="#" class="delete_image"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php }} ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="ethnicity" type="text" class="validate" name="data[ethnicity]">
                                                                                    <label for="ethnicity" class="control-label"> Ethnicity </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                    <!-- end General-->
                                                                </div>
                                                            </div>
                                                            <div class="card blue-grey darken-1">
                                                                <div class="card-content white-text">
                                                                    <span class="card-title">Contact</span>
                                                                    <!-- start Contact-->
                                                                    <!-- user address -->
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-adr"  type="text"  class="validate" value="<?=$user->address1?>" name="data[address1]">
                                                                                    <label for="us-adr" class="control-label"><?php echo lang('address') ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-adr2"  type="text"  class="validate" value="<?=$user->address2?>" name="data[address2]">
                                                                                    <label for="us-adr2" class="control-label"><?php echo lang('address2') ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <!-- City-state-zip-->

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-city"  type="text"  class="validate" value="<?=$user->city?>" name="data[city]">
                                                                                    <label for="us-city" class="control-label"><?php echo lang('city') ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-state"  type="text"  class="validate" value="<?=$user->state?>" name="data[state]">
                                                                                    <label for="us-state" class="control-label"><?php echo lang('state') ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-zip"  type="number"  class="validate" value="<?=$user->zip?>" name="data[zip]">
                                                                                    <label for="us-zip" class="control-label"><?php echo lang('zip') ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <!--Phone-->

                                                                        <!-- client phone -->
                                                                        <div class="col-md-12 phone add-row-able" next-row-class="phone-second-row">
                                                                            <div class="form-group input-field">
                                                                                <div class="col-md-6" style="padding-left: 0">
                                                                                    <table>
                                                                                        <tr>
                                                                                            <td style="width: 98%">
                                                                                                <input type="text" id="us_phone" value="<?=$user->phone?>" name="data[phone]" class="form-control required_form " maxlength="50" onchange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');" " />
                                                                                                <label for="us_phone" class=""><?php echo lang('phone') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div><!-- ./col -->
                                                                                <div class="input-field col-md-6 rem-sel">
                                                                                    <input type="text" list="phonename8" value="<?=$user->phone_type?>" name="data[phone_type]">
                                                                                    <datalist id="phonename8">
                                                                                        <option value="Home">
                                                                                        <option value="Work">
                                                                                        <option value="Other">
                                                                                    </datalist>

                                                                                </div>
                                                                            </div>
                                                                            <!-- ./form-group -->
                                                                            <div class="btn-add add-row-button" next-row-class="phone-second-row">
                                                                                <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                            </div>

                                                                        </div><!-- ./col -->

                                                                        <!-- client phone_2 -->
                                                                        <div class="col-md-12 phone  phone-second-row" id="div_phone_2" style="display: <?= ( !empty($client->client_phone_2) ? 'block' : 'none' ); ?>">
                                                                            <div class="form-group input-field">
                                                                                <div class="col-md-6" style="padding-left: 0">
                                                                                    <input type="text"  id="us_phone-2" name="data[phone2]" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                                    <label for="us_phone-2" class=""><?php echo lang('phone_2') ?></label>
                                                                                </div><!-- ./col -->
                                                                                <div class="input-field col-md-6" style="margin-top: 0">
                                                                                    <input type="text" name="data[phone_type]" list="phonename2">
                                                                                    <datalist id="phonename2">
                                                                                        <option value="Home">
                                                                                        <option value="Work">
                                                                                        <option value="Other">
                                                                                    </datalist>

                                                                                </div>
                                                                            </div><!-- ./form-group -->
                                                                            <div class="btn-add add-row-button" next-row-class="phone-third-row">
                                                                                <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="btn-rem">
                                                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                            </div>
                                                                        </div><!-- ./col -->

                                                                        <!-- client phone_3 -->
                                                                        <div class="col-md-12 phone  phone-third-row" id="div_phone_3" style="display: none;">
                                                                            <div class="form-group input-field">
                                                                                <div class="col-md-6" style="padding-left: 0">
                                                                                    <input type="text" id="us_phone_3"  name="data[phone3]" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                                    <label for="us_phone_3" class=""><?php echo lang('phone_3') ?></label>
                                                                                </div><!-- ./col -->
                                                                                <div class="input-field col-md-6" style="margin-top: 0">
                                                                                    <input type="text" name="phone3" list="phonename3">
                                                                                    <datalist id="phonename3">
                                                                                        <option value="Home">
                                                                                        <option value="Work">
                                                                                        <option value="Other">
                                                                                    </datalist>

                                                                                </div>
                                                                            </div><!-- ./form-group -->

                                                                            <div class="btn-rem">
                                                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                            </div>
                                                                        </div><!-- ./col -->


                                                                    </div> <!-- ./row -->
                                                                    <!--END Phone-->
                                                                    <!-- email-->
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="input-field">
                                                                                <input id="us-email" type="email" class="validate" value="<?=$user->email?>" name="data[email]">
                                                                                <label for="us-email" data-error="wrong" data-success="right">Email</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- end Contact-->
                                                                </div>

                                                            </div>
                                                            <div class="card blue-grey darken-1">
                                                                <div class="card-content white-text">
                                                                    <span class="card-title">Title / License</span>
                                                                    <!--start title-->
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="input-field">
                                                                                    <select class="title-drop" name="data[lic-title]">
                                                                                        <option value="" disabled selected>Title</option>
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
                                                                                <label for="us-lic"><?php echo lang('license')?></label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <label>from</label>
                                                                                <input type="date" class="datepicker" name="data[start-date]">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <label>to</label>
                                                                                <input type="date" class="datepicker" name="data[end-date]">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end title-->
                                                                </div>
                                                            </div>
                                                            <div class="card blue-grey darken-1">
                                                                <div class="card-content white-text">
                                                                    <span class="card-title">Langauge</span>
                                                                    <!--start langauge-->
                                                                    <div class="row">
                                                                        <div class="col-md-12 add-row-able" next-row-class="lang-second-row">
                                                                            <div class="input-field col-md-12">
                                                                                <select class="leng" name="data[lang]">
                                                                                    <option value="" disabled selected>Choose your langauge</option>
                                                                                    <option value="1">Option 1</option>
                                                                                    <option value="2">Option 2</option>
                                                                                    <option value="3">Option 3</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="input-field col-md-12 rem-sel">
                                                                                <input type="text" name="data[langauge1]" list="langauge1">
                                                                                <datalist id="langauge1">
                                                                                    <option value=" Read"></option>
                                                                                    <option value="Write"></option>
                                                                                    <option value="Spoken"></option>
                                                                                </datalist>

                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <div class="input-field">
                                                                                        <input id="us-profic"  type="text"  class="validate" name="data[us-profic]">
                                                                                        <label for="us-profic" class="control-label">Proficiency</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-add add-row-button" next-row-class="lang-second-row">
                                                                                <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 phone  lang-second-row"  style="display:none">
                                                                            <div class="input-field col-md-12">
                                                                                <select class="leng">
                                                                                    <option value="" disabled selected>Choose your langauge</option>
                                                                                    <option value="1">Option 1</option>
                                                                                    <option value="2">Option 2</option>
                                                                                    <option value="3">Option 3</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="input-field col-md-12 rem-sel">
                                                                                <input type="text" name="langauge2" list="langauge2">
                                                                                <datalist id="langauge2">
                                                                                    <option value=" Read"></option>
                                                                                    <option value="Write"></option>
                                                                                    <option value="Spoken"></option>
                                                                                </datalist>

                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <div class="input-field">
                                                                                        <input id="us-profic2"  type="text"  class="validate" name="data[us-profic2]">
                                                                                        <label for="us-profic2" class="control-label">Proficiency</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-add add-row-button" next-row-class="lang-third-row">
                                                                                <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="btn-rem">
                                                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 phone  lang-third-row"  style="display: none;">
                                                                            <div class="input-field col-md-12">
                                                                                <select class="leng">
                                                                                    <option value="" disabled selected>Choose your langauge</option>
                                                                                    <option value="1">Option 1</option>
                                                                                    <option value="2">Option 2</option>
                                                                                    <option value="3">Option 3</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="input-field col-md-12 rem-sel">
                                                                                <input type="text" name="langauge3" list="langauge3">
                                                                                <datalist id="langauge3">
                                                                                    <option value=" Read"></option>
                                                                                    <option value="Write"></option>
                                                                                    <option value="Spoken"></option>
                                                                                </datalist>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <div class="input-field">
                                                                                        <input id="us-profic3"  type="text"  class="validate">
                                                                                        <label for="us-profic3" class="control-label">Proficiency</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-rem">
                                                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end Langauge-->
                                                                </div>

                                                            </div>
                                                            <div class="card blue-grey darken-1">
                                                                <div class="card-content white-text">
                                                                    <span class="card-title">Electronic Signature</span>
                                                                    <!--start Electronic Signature-->
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-text" type="text" class="validate" name="data[us-text]">
                                                                                    <label for="us-text" class="control-label">Placeholder </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-code" type="text" class="validate" name="data[us-code]">
                                                                                    <label for="us-code" class="control-label">Code</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-field">
                                                                                    <input id="us-code-conf" type="text" class="validate" name="data[us-code-conf]">
                                                                                    <label for="us-code-conf" class="control-label">Confirm Code</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end Electronic Signature-->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 text-center sev-canc-mock">
                                                        <button class="btn"><a href="/sys-admin/users/users-overview/<?=$user->id?>" style="color: #fff;"> CANCEL</a></button>
                                                        <button class="btn" name="submit" type="submit">SAVE</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                        <!-- END FORM-->
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
<script src="/assets/global/plugins/respond.min.js" type="text/javascript" ></script>
<script src="/assets/global/plugins/excanvas.min.js" type="text/javascript" ></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript" ></script>
<script src="/assets/global/js/materialize.min.js" type="text/javascript" ></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript" ></script>
<script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript" ></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript" ></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript" ></script>
<script src="/assets/global/js/init.js" type="text/javascript" ></script>
<script src="/assets/global/js/client-overview.js" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/global/scripts/app.min.js" type="text/javascript" ></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/layouts/default/scripts/layout.js" type="text/javascript" ></script>
<script src="/assets/layouts/default/scripts/demo.js" type="text/javascript" ></script>
<!-- END THEME LAYOUT SCRIPTS -->


</body>
</html>