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
    <link href="/assets/layouts/default/css/custom-client-overview-view.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="/assets/favicon.ico" />

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<?php //echo "<pre>"; print_r($client);die;?>
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
                                        <li><?php echo $client-> client_address1 ?></li>
                                        <li><?php echo $client-> client_address2 ?></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col s2 locat-call">
                                <div class="tb-adr">
                                    <p class="icon-tb-cl"><i class="material-icons">call</i></p>
                                    <ul class="text-tb-cl">
                                        <li><?php echo $client-> client_phone?></li>
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
    <!-- BEGIN SIDEBAR -->
    <div class="container">
        <a href="#" id="artash" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light hide-on-large-only">
            <i class="material-icons">menu</i>
        </a>
    </div>
    <ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(-100%);">
        <li class="logo">
            <a href="./" class="brand-logo">
                 <img src="/assets/img/logo.png" alt="logo" class="logo-default" />
<!--                <span class="logo-default"> SYSTEM </span>-->
            </a>
        </li>

        <li class="no-padding">

            <ul class="collapsible collapsible-accordion collapsible-accordion-green">

                <?php
                foreach ($menu as $key => $value):

                    if (is_array($value)): //is value is array, it means it is Menu Item
                        //sent active menu
                        $MenuActive = ($view['0'] == $menu[$key]['title'] || $view['0'] == 'contact' && $menu[$key]['title'] == "contacts" || $view['0'] == 'vendors' && $menu[$key]['title'] == "vendors-services" || $view['0'] == 'services' && $menu[$key]['title'] == "vendors-services" ) ? 'the_active' : $view['0'].'   '.$menu[$key]['title'];
//                        print_r($MenuActive);
//                        die;
                        ?>
                        <!-- SIDEBAR MENU -->
                    <li class="nav-item  <?=$MenuActive;?>">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="<?= $menu[$key]['icon'];?>"></span>
                            <span class="title"><?php echo lang($menu[$key]['title']);?></span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <div class="collapsible-body" >
                        <ul>
                        <?php
                        if (is_array($menu[$key])): //if $menu[$key] is arry, it means it is menu link
                            foreach ($menu[$key] as $key => $link):
                                if (is_array($link)): //if $link, ie  $key value is array
                                    $LinkActive = ($link['href'] == "/".$segment || $link['href'] == "/".$segment.'/'.$segment_2 || $link['href'] == "/clients-edit/new/" && "/".$segment == "/clients-edit" || $link['href'] == "/users/users-edit/new/" && "/".$segment.'/'.$segment_2 == "/users/users-edit" || $link['href'] == "/users/users-view" && "/".$segment.'/'.$segment_2 == "/users/users-view" || $link['href'] == "/vendors/vendor-types-edit/new" && "/".$segment.'/'.$segment_2 == "/vendors/vendor-types-edit" || $link['href'] == "/vendors/vendors-edit/new/" && "/".$segment.'/'.$segment_2 == "/vendors/vendors-edit" || $link['href'] == "/services/services-edit/new/" && "/".$segment.'/'.$segment_2 == "/services/services-edit" ) ? 'the_active' : $link['href'].'   '."/".$segment.'/'.$segment_2;
                                    ?>
                                    <!-- SIDEBAR MENU LINK -->
                                    <li class="nav-item <?= $LinkActive ;?>">
                                        <a href="<?php if($link['href'] != '/clients-edit/new/') echo base_url().$this->uri->segment('1').$link['href']; else echo '#' ?>" <?php if($link['href'] == '/clients-edit/new/') echo 'class="create_contact"' ?>  class="nav-link ">
                                            <!--                                        <a href="--><?php //echo base_url().$this->uri->segment('1').$link['href'];?><!--" class="nav-link ">-->
                                            <span class="<?php echo $link['icon'];?>"></span>
                                            <span class="title"><?php echo lang($link['title']);?></span>
                                        </a>
                                    </li>
                                    <!-- END SIDEBAR MENU LINK -->
                                    <?php
                                endif; //end if $link is array
                            endforeach;//end $menu[$key] foreach
                            ?>
                            </ul>
                            </div>
                            </li>
                            <!-- END SIDEBAR MENU -->
                            <?php
                        endif; //end if $link is array
                    endif;//end if $value is array
                endforeach;//end $menu foreach
                ?>
                <?php if ( !empty($user->user_id) ) : ?>
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <?php 		$this->load->model('users_mdl');
                            $logged_user= $this->users_mdl->getUserRowById( $user->user_id, array('show_file_info'=> 1, 'image_width'=> 32, 'image_height'=> 32) );
                            ?>

                            <? if ( !empty($logged_user->image_url) and !empty($logged_user->image_path_width) and !empty($logged_user->image_path_height) ) { ?>
                                <span><img alt="" class="img-circle" src="<?= $logged_user->image_url;?>" width="<?= $logged_user->image_path_width ?>" height="<?= $logged_user->image_path_height ?>" /></span> <!-- class="img-circle" -->
                            <?php } ?>

                            <? if ( empty($logged_user->image_url) or empty($logged_user->image_path_width) or empty($logged_user->image_path_height) ) { ?>
                                <span><img alt="" class="img-circle" src="<?php echo base_url() ?>assets/avatar/avatar.png"></span>
                            <?php } ?>

                            <span class="title"><?php echo $user->first_name." ". $user->last_name;?></span>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li class="nav-item">
                                    <a href="<?= base_url($this->uri->segment(1).'/profile');?>">
                                        <span class="fa fa-user"></span>
                                        <span><?= lang('my-profile'); ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url()?>login/logout" class="nav-link ">
                                        <span class="fa fa-sign-out" aria-hidden="true"></span>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>


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

                            <div class="row clients-overview" style="background-color: #fff">
                                <div class="col s12 m9 l10">
                                    <div>
                                        <div id="grid-pinned" class="scrollspy">
                                            <h3 class="header">Pinned</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci dicta, eaque error fugit inventore magni minima perspiciatis quos reiciendis sit tempora tempore, voluptas? Delectus impedit nemo odit sunt vitae!</p>
                                        </div>


                                        <!-- Grid associations -->
                                        <div id="grid-associations" class="scrollspy">
                                            <h3 class="header">Associations</h3>
                                            <nav class="nav-extended">
                                                <div class="nav-content">
                                                    <ul class="tabs tabs-transparent">
                                                        <li class="tab"><a href="#test1" class="active">Users</a></li>
                                                        <li class="tab"><a href="#test2">Patients</a></li>
                                                    </ul>
                                                </div>
                                            </nav>
                                            <div id="test1" class="col s12">

                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Title</th>
                                                        <th>Status</th>
                                                        <th>Created</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        <td>Alvin</td>
                                                        <td>Eclair</td>
                                                        <td>Hi</td>
                                                        <td>$0.87</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alan</td>
                                                        <td>Jellybean</td>
                                                        <td>Hello</td>
                                                        <td>$3.76</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jonathan</td>
                                                        <td>Lollipop</td>
                                                        <td>Hi</td>
                                                        <td>$7.00</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div id="test2" class="col s12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
                                        </div>


                                        <!-- Grid History -->

                                        <div id="grid-history" class="scrollspy">
                                            <h3 class="header">History</h3>

                                            <button type="button" class="btn btn-default" aria-label="Center Align">View History</button>

                                            <h3><i class="fa fa-comment" aria-hidden="true"></i>Add Comment</h3>

                                            <div class="row">


                                                <div class="widget-area no-padding blank">
                                                    <div class="status-upload">
                                                        <form>
                                                            <textarea placeholder="What are you doing right now?" ></textarea>
                                                            <ul>
                                                                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a></li>
                                                                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
                                                                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>
                                                                <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
                                                            </ul>
                                                            <button type="submit" class="btn btn-success">Send</button>
                                                        </form>
                                                    </div><!-- Status Upload  -->
                                                </div><!-- Widget Area -->

                                            </div>
                                            <div class="row">
                                                <ul class="collapsible popout" data-collapsible="accordion">
                                                    <li>
                                                        <div class="collapsible-header"><i class="material-icons">filter_drama</i>First Comment</div>
                                                        <div class="collapsible-body"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header"><i class="material-icons">place</i>Second Comment</div>
                                                        <div class="collapsible-body"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                                                    </li>
                                                    <li>
                                                        <div class="collapsible-header"><i class="material-icons">whatshot</i>Third Comment</div>
                                                        <div class="collapsible-body"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col hide-on-small-only m3 l2">
                                    <div class="toc-wrapper pin-top" style="top: 250px; position:fixed;">
                                        <!--                                    <div class="buysellads hide-on-small-only">-->
                                        <!--                                        <!-- CarbonAds Zone Code -->
                                        <!--                                        <script async="" type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&amp;serve=C6AILKT&amp;placement=materializecss" id="_carbonads_js"></script>-->
                                        <!---->
                                        <!--                                    </div>-->
                                        <div>
                                            <ul class="section table-of-contents">
                                                <li><a href="#grid-pinned" class="active">Pinned</a></li>
                                                <li><a href="#grid-associations" class="">Associations</a></li>
                                                <li><a href="#grid-history" class="">History</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
    <div class="modal fade newclient" id="newclient" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">New Client</h3>
                </div>
                <div class="modal-body">
                    <?php $ci = &get_instance();?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="page-bar">
                                        <!--<h3><center><?= ( $is_insert ? "Insert" : "Edit" ) ?> <?=lang('client') ?></center></h3>-->
                                        <?= $this->common_lib->show_info($editor_message) ?>
                                    </div>

                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        <form action="<?php echo base_url() ;?>sys-admin/clients-view/<?= ( $is_insert ? "new" : $cid ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_client_edit" name="form_client_edit" class="form-horizontal"  enctype="multipart/form-data">
                                            <!--                                        <input type="hidden" name="--><?//= $ci->security->get_csrf_token_name() ?><!--" value="--><?//= $this->security->get_csrf_hash() ?><!--" />-->

                                            <input type="hidden" id="filter_client_name" name="filter_client_name" value="<?=$filter_client_name?>">
                                            <!--						<input type="hidden" id="filter_client_active_status" name="filter_client_active_status" value="--><?//=$filter_client_active_status?><!--">-->
                                            <input type="hidden" id="filter_client_type" name="filter_client_type" value="<?=$filter_client_type?>">
                                            <input type="hidden" id="filter_client_zip" name="filter_client_zip" value="<?=$filter_client_zip?>">
                                            <input type="hidden" id="filter_created_at_from" name="filter_created_at_from" value="<?=$filter_created_at_from?>">
                                            <input type="hidden" id="filter_created_at_till" name="filter_created_at_till" value="<?=$filter_created_at_till?>">

                                            <input type="hidden" id="filter_created_at_till_formatted" name="filter_created_at_till_formatted" value="<?=$filter_created_at_till_formatted?>">
                                            <input type="hidden" id="filter_created_at_from_formatted" name="filter_created_at_from_formatted" value="<?=$filter_created_at_from_formatted?>">


                                            <input type="hidden" name="data[client_name]" id="client_name" value="" class="form-control" maxlength="100">
                                            <input type="hidden" name="data[clients_types_id]" id="client_name" value="1" class="form-control" maxlength="100">
                                            <input type="hidden" name="data[client_fax]" value="15" class="form-control" maxlength="50">
                                            <div class="form-body">

                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                                                </div>
                                                <div class="alert alert-success display-hide">
                                                    <button class="close" data-close="alert"></button> <?= lang('form_updated');?>
                                                </div>

                                                <?php if ( $validation_errors_text != "" ) : ?>
                                                    <div class="row error" style="padding: 5px; margin: 5px;" >
                                                        <?= $validation_errors_text ?>
                                                    </div>
                                                <? endif; ?>

                                                <?php if ( !$is_insert ) : ?>
                                                    <div class="row">
                                                        <!-- Client Types cid -->
                                                        <div class="col-md-6">
                                                            <div class="form-group input-field">
                                                                <div class="col-md-7">
                                                                    <input type="text" name="data[cid]" id="cid" value="<?= (!empty($client->cid) ? $client->cid:''); ?>" class="form-control" readonly />
                                                                    <label for="cid" class="control-label col-md-4"><?php echo lang('cid');?></label>
                                                                </div><!-- ./col -->
                                                            </div><!-- ./form-group -->
                                                        </div><!-- ./col -->
                                                    </div>
                                                <?php endif; ?>

                                                <div class="row">
                                                    <!-- Client  client_name -->
                                                    <div class="col-md-12" style="display: none">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_name]", ' has-error ')?> ">

                                                            <?php
                                                            $client_name_button_visible = $is_insert;
                                                            $client_name_input_visible = !$is_insert;
                                                            if ( $validation_errors_text!= "" and !empty($client->client_name) ) {
                                                                $client_name_button_visible = false;
                                                                $client_name_input_visible = true;
                                                            }
                                                            ?>
                                                            <div class="col-md-12" style="display: none" id="div_client_name_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_name',true);" id="btn_add_client_name">Add a name<span class="required">&nbsp;*&nbsp;</span></button>
                                                            </div>

                                                            <div class="col-md-12" style="display: <?php echo ( ( $client_name_input_visible ) ? "block" :"block" ) ; ?>" id="div_client_name_input">
                                                                <i class="material-icons prefix">assignment_ind</i>
                                                                <input type="text" name="data[client_name]" id="client_name" value="<?= ( !empty($client->client_name) ? $client->client_name : '' ); ?>" class="form-control x-able" maxlength="100" <?php echo !$is_insert ? " readonly " : "" ?> />
                                                                <label for="client_name"> <?php echo lang('company_name') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div>
                                                            <!-- ./col -->

                                                        </div>
                                                        <!-- ./form-group -->

                                                    </div>
                                                    <!-- ./col client

                                                    <!-- client owner -->
                                                    <div class="col-md-12">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_owner]", ' has-error ')?>">

                                                            <?php
                                                            $is_debug= false;
                                                            $client_owner_button_visible = $is_insert;
                                                            $client_owner_input_visible = !$is_insert;
                                                            $client_owner_view_visible = !$is_insert;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_owner) ) {
                                                                $client_owner_button_visible = false;
                                                                $client_owner_input_visible = true;
                                                                $client_owner_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $client_owner_button_visible = false;
                                                                $client_owner_input_visible = false;
                                                                $client_owner_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>$client_owner_button_visible::' . print_r( $client_owner_button_visible, true ) . '</pre>';
                                                                echo '<pre>$client_owner_input_visible::' . print_r( $client_owner_input_visible, true ) . '</pre>';
                                                                echo '<pre>$client_owner_view_visible::' . print_r( $client_owner_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-7" style="display: <?php echo ( $client_owner_button_visible ? "none" :"none") ; ?>" id="div_client_owner_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_owner',true);" id="btn_add_client_owner">Add an owner</button>
                                                            </div>

                                                            <div class="col-md-12" style="display: <?php echo ( $client_owner_input_visible ? "block" :"block" ) ; ?>" id="div_client_owner_input">

                                                                <i class="material-icons prefix">assignment_ind</i>
                                                                <input type="text" name="data[client_owner]" id="client_owner" value="<?= ( !empty($client->client_owner) ? $client->client_owner : '' ); ?>" class="x-able form-control" maxlength="100" />
                                                                <label for="client_owner" class=""><?php echo lang('company_name') ?></label>
                                                            </div>

                                                            <div class="col-md-12" style="display: <?php echo ( ( $client_owner_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_owner_view">
                                                                <i class="material-icons prefix">account_circle</i>
                                                                <input type="text" name="data[client_name]" id="client_owner_view" value="<?= ( !empty($client->client_owner) ? $client->client_owner : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                                <label for="client_owner_view" class="control-label col-md-4"><?php echo lang('client_owner') ?></label>
                                                            </div><!-- ./col -->
                                                        </div> <!-- ./form-group -->
                                                    </div><!-- ./col -->
                                                </div>

                                                <div class="row">
                                                    <!-- client Addrtess 1 -->
                                                    <div class="col-md-6 ">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_address1]", ' has-error ')?>">
                                                            <?php
                                                            $is_debug= false;
                                                            $address1_button_visible = $is_insert;
                                                            $address1_input_visible = !$is_insert;
                                                            $address1_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_address1) ) {
                                                                $address1_button_visible = false;
                                                                $address1_input_visible = true;
                                                                $address1_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == ""  and !$is_insert ) {
                                                                $address1_button_visible = false;
                                                                $address1_input_visible = false;
                                                                $address1_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $address1_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $address1_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $address1_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-7" style="display: <?php echo ( $address1_button_visible ? "none" :"none") ; ?>" id="div_client_address1_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_address1',true);" id="btn_add_client_address1">Add an address<span class="required">&nbsp;*&nbsp;</span></button>
                                                            </div>
                                                            <div class="col-md-12" style="display: <?php echo ( $address1_input_visible ? "block" :"block" ) ; ?>" id="div_client_address1_input">
                                                                <i class="material-icons prefix">business</i>
                                                                <input type="text" name="data[client_address1]" id="client_address1" value="<?= ( !empty($client->client_address1) ? $client->client_address1 : '' ); ?>" class="form-control x-able" maxlength="100" />
                                                                <label for="client_address1"><?php echo lang('address1') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div>
                                                            <div class="col-md-7" style="display: <?php echo ( ( $address1_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_address1_view">
                                                                <input type="text" name="data[client_address1_view]" id="client_address1_view" value="<?= ( !empty($client->client_address1) ? $client->client_address1 : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                                <label for="client_address1_view" class="control-label col-md-4"><?php echo lang('address1') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div><!-- ./col -->
                                                        </div><!-- ./form-group -->
                                                    </div><!-- ./col -->

                                                    <!-- client Address 2 -->
                                                    <div class="col-md-6">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_address2]", ' has-error ')?>">
                                                            <?php
                                                            $is_debug= false;
                                                            $address2_button_visible = $is_insert;
                                                            $address2_input_visible = !$is_insert;
                                                            $address2_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_address2) ) {
                                                                $address2_button_visible = false;
                                                                $address2_input_visible = true;
                                                                $address2_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $address2_button_visible = false;
                                                                $address2_input_visible = false;
                                                                $address2_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $address2_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $address2_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $address2_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-7" style="display: <?php echo ( $address2_button_visible ? "none" :"none") ; ?>" id="div_client_address2_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_address2',true);" id="btn_add_client_address2">Add an additive address</button>
                                                            </div>
                                                            <div class="col-md-12" style="display: <?php echo ( $address2_input_visible ? "block" :"block" ) ; ?>;" id="div_client_address2_input">


                                                                <input type="text" name="data[client_address2]" id="client_address2" value="<?= ( !empty($client->client_address2) ? $client->client_address2 : '' ); ?>"  class="form-control x-able" maxlength="100" />
                                                                <label for="client_address2" class="control-label col-md-4"><?php echo lang('address2') ?></label>
                                                            </div>
                                                            <div class="col-md-7" style="display: <?php echo ( ( $address2_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_address2_view">
                                                                <input type="text" name="data[client_address2_view]" id="client_address2_view" value="<?= ( !empty($client->client_address2) ? $client->client_address2 : '' ); ?>"  class="form-control" maxlength="100" readonly />
                                                                <label for="client_address2_view" class="control-label col-md-4"><?php echo lang('address2') ?></label>
                                                            </div><!-- ./col -->
                                                        </div> <!-- ./form-group -->
                                                    </div><!-- ./col -->
                                                </div> <!-- ./row -->

                                                <!--							<div class="row">
                                                                                <div class="input-field col s6">
                                                                                    <input placeholder="Placeholder" id="first_name" class="validate" type="text">
                                                                                    <label for="first_name" class="active">First Name</label>
                                                                                </div>
                                                                                <div class="input-field col s6">
                                                                                    <input id="last_name" type="text">
                                                                                    <label for="last_name" class="">Last Name</label>
                                                                                </div>
                                                                            </div>
                                                -->

                                                <div class="row">
                                                    <!-- client city/state/zip -->
                                                    <div class="col-md-12">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_state]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[client_city]", ' has-error ')?> <?= $this->common_lib->set_field_error_tag("data[client_zip]", ' has-error ')?> ">


                                                            <?php
                                                            $is_debug= false;
                                                            $client_city_button_visible = $is_insert;
                                                            $client_city_input_visible = !$is_insert;
                                                            $client_city_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_city) ) {
                                                                $client_city_button_visible = false;
                                                                $client_city_input_visible = true;
                                                                $client_city_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $client_city_button_visible = false;
                                                                $client_city_input_visible = false;
                                                                $client_city_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $client_city_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $client_city_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $client_city_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-4" style="display: <?php echo ( $client_city_button_visible ? "none" :"none") ; ?>" id="div_client_city_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_city',true);" id="btn_add_client_city">Add a city<span class="required">&nbsp;*&nbsp;</span></button>
                                                            </div>
                                                            <div class="col-md-4"  style="display: <?php echo ( $client_city_input_visible ? "block" :"block" ) ; ?>" id="div_client_city_input">
                                                                <i class="material-icons prefix">location_on</i>
                                                                <input type="text" name="data[client_city]" id="client_city" value="<?= ( !empty($client->client_city) ? $client->client_city : '' ); ?>" class="form-control x-able" maxlength="100" />
                                                                <label for="client_city" class=""><?php echo lang('city') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div>
                                                            <div class="col-md-4"  style="display: <?php echo ( ( $client_city_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_city_view">
                                                                <input type="text" name="data[client_city_view]" id="client_city_view" value="<?= ( !empty($client->client_city) ? $client->client_city : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                                <label for="client_city_view" class=""><?php echo lang('city') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div><!-- ./col -->


                                                            <?php
                                                            $is_debug= false;
                                                            $client_state_button_visible = $is_insert;
                                                            $client_state_input_visible = !$is_insert;
                                                            $client_state_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_state) ) {
                                                                $client_state_button_visible = false;
                                                                $client_state_input_visible = true;
                                                                $client_state_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $client_state_button_visible = false;
                                                                $client_state_input_visible = false;
                                                                $client_state_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $client_state_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $client_state_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $client_state_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-4" style="display: <?php echo ( $client_state_button_visible ? "none" :"none") ; ?>" id="div_client_state_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_state',true);" id="btn_add_client_state">Add a state<span class="required">&nbsp;*&nbsp;</span></button>
                                                            </div>
                                                            <div class="col-md-4" style="display: <?php echo ( $client_state_input_visible ? "block" :"block" ) ; ?>" id="div_client_state_input">
                                                                <input type="text" name="data[client_state]" id="client_state" value="<?= ( !empty($client->client_state) ? $client->client_state : '' ); ?>" class="form-control x-able" maxlength="50" />
                                                                <label for="client_state" class="control-label col-md-2"><?php echo lang('state') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div>
                                                            <div class="col-md-4" style="display: <?php echo ( ( $client_state_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_state_view">
                                                                <input type="text" name="data[client_state_view]" id="client_state_view" value="<?= ( !empty($client->client_state) ? $client->client_state : '' ); ?>" class="form-control" maxlength="50" readonly/>
                                                                <label for="client_state_view" class="control-label col-md-2"><?php echo lang('state') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div><!-- ./col -->



                                                            <?php
                                                            $is_debug= false;
                                                            $client_zip_button_visible = $is_insert;
                                                            $client_zip_input_visible = !$is_insert;
                                                            $client_zip_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_zip) ) {
                                                                $client_zip_button_visible = false;
                                                                $client_zip_input_visible = true;
                                                                $client_zip_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $client_zip_button_visible = false;
                                                                $client_zip_input_visible = false;
                                                                $client_zip_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $client_zip_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $client_zip_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $client_zip_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-4" style="display: <?php echo ( $client_zip_button_visible ? "none" :"none") ; ?>" id="div_client_zip_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_zip',true);" id="btn_add_client_zip">Add a zip<span class="required">&nbsp;*&nbsp;</span></button>
                                                            </div>
                                                            <div class="col-md-4"  style="display: <?php echo ( $client_zip_input_visible ? "block" :"block" ) ; ?>" id="div_client_zip_input">
                                                                <input type="text" name="data[client_zip]" id="client_zip" value="<?= ( !empty($client->client_zip) ? $client->client_zip : '' ); ?>" class="form-control x-able" maxlength="5" />
                                                                <label for="client_zip" class="control-label col-md-2"><?php echo lang('zip') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div>
                                                            <div class="col-md-4" style="display: <?php echo ( ( $client_zip_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_zip_view">
                                                                <input type="text" name="data[client_zip_view]" id="client_zip_view" value="<?= ( !empty($client->client_zip) ? $client->client_zip : '' ); ?>" class="form-control" maxlength="5" readonly/>
                                                                <label for="client_zip_view" class="control-label col-md-2"><?php echo lang('zip') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            </div><!-- ./col -->

                                                        </div><!-- ./form-group -->
                                                    </div><!-- ./col -->
                                                    <!-- client state -->

                                                </div> <!-- ./row -->

                                                <!--Phone-->
                                                <div class="row">
                                                    <!-- client phone -->
                                                    <div class="col-md-12 phone add-row-able" next-row-class="phone-second-row">

                                                        <!-- <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:AddPhone();" id="btn_add_phone">Add a phone</button>-->


                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone]", ' has-error ')?>">
                                                            <div class="col-md-6">
                                                                <table>
                                                                    <tr>
                                                                        <td style="width: 98%">
                                                                            <i class="material-icons prefix">phone</i>
                                                                            <input type="text" name="data[client_phone]" id="client_phone" value="<?= ( !empty($client->client_phone) ? $client->client_phone : '' ); ?>" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                            <label for="client_phone" class=""><?php echo lang('phone') ?></label>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div><!-- ./col -->
                                                            <div class="input-field col-md-6 rem-sel">
                                                                <!--  <select>
                                                                      <option value="" disabled selected>Custom Lable</option>
                                                                      <option value="1">Home</option>
                                                                      <option value="2">Work</option>
                                                                      <option value="3">Other</option>
                                                                  </select>-->
                                                                <input type="text" name="phone1" list="phonename1">
                                                                <datalist id="phonename1">
                                                                    <option value="Home">
                                                                    <option value="Work">
                                                                    <option value="Other">
                                                                </datalist>

                                                            </div>

                                                        </div><!-- ./form-group -->
                                                        <div class="btn-add add-row-button" next-row-class="phone-second-row">

                                                            <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                        </div>
                                                        <!-- <div class="btn-rem">
                                                             <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                         </div>-->

                                                    </div><!-- ./col -->

                                                    <!-- client phone_2 -->
                                                    <div class="col-md-12 phone  phone-second-row" id="div_phone_2" style="display: <?= ( !empty($client->client_phone_2) ? 'block' : 'none' ); ?>">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_2]", ' has-error ')?>">
                                                            <div class="col-md-6">
                                                                <i class="material-icons prefix">phone</i>
                                                                <input type="text" name="data[client_phone_2]" id="client_phone_2" value="<?= ( !empty($client->client_phone_2) ? $client->client_phone_2 : '' ); ?>" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                <label for="client_phone_2" class=""><?php echo lang('phone_2') ?></label>
                                                            </div><!-- ./col -->
                                                            <div class="input-field col-md-6">
                                                                <!-- <select>
                                                                     <option value="" disabled selected>Custom Lable</option>
                                                                     <option value="1">Home</option>
                                                                     <option value="2">Work</option>
                                                                     <option value="3">Other</option>
                                                                 </select>-->
                                                                <input type="text" name="phone2" list="phonename2">
                                                                <datalist id="phonename2">
                                                                    <option value="Home">
                                                                    <option value="Work">
                                                                    <option value="Other">
                                                                </datalist>

                                                            </div>
                                                        </div><!-- ./form-group -->
                                                        <div class="btn-add add-row-button" next-row-class="phone-third-row">
                                                            <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                        </div>
                                                        <div class="btn-rem">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                        </div>
                                                    </div><!-- ./col -->

                                                    <!-- client phone_3 -->
                                                    <div class="col-md-12 phone  phone-third-row" id="div_phone_3" style="display: none;">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_2]", ' has-error ')?>">
                                                            <div class="col-md-6">
                                                                <i class="material-icons prefix">phone</i>
                                                                <input type="text" name="data[client_phone_3]" id="client_phone_3" value="<?= ( !empty($client->client_phone_3) ? $client->client_phone_3 : '' ); ?>" class="form-control " maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                <label for="client_phone_3" class=""><?php echo lang('phone_3') ?></label>
                                                            </div><!-- ./col -->
                                                            <div class="input-field col-md-6">
                                                                <!-- <select>
                                                                     <option value="" disabled selected>Custom Lable</option>
                                                                     <option value="1">Home</option>
                                                                     <option value="2">Work</option>
                                                                     <option value="3">Other</option>
                                                                 </select>-->

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

                                                <div class="row" style="display: none;">
                                                    <!-- client phone_3 -->
                                                    <div class="col-md-12 phone" id="div_phone_3" style="display: <?= ( !empty($client->client_phone_3) ? 'block' : 'none' ); ?>">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_3]", ' has-error ')?>">
                                                            <div class="col-md-6">
                                                                <i class="material-icons prefix">phone</i>
                                                                <input type="text" name="data[client_phone_3]" id="client_phone_3" value="<?= ( !empty($client->client_phone_3) ? $client->client_phone_3 : '' ); ?>" class="form-control x-able" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                <label for="client_phone_3" class=""><?php echo lang('phone_3') ?></label>
                                                            </div><!-- ./col -->
                                                            <div class="input-field col-md-6">
                                                                <select>
                                                                    <option value="" disabled selected>Custom Lable</option>
                                                                    <option value="1">Home</option>
                                                                    <option value="2">Work</option>
                                                                    <option value="3">Other</option>
                                                                </select>

                                                            </div>
                                                        </div><!-- ./form-group -->
                                                        <div class="btn-add">
                                                            <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                        </div>
                                                        <div class="btn-rem">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                        </div>
                                                    </div><!-- ./col -->

                                                    <!-- client phone_4 -->
                                                    <div class="col-md-6" id="div_phone_4" style="display: <?= ( !empty($client->client_phone_4) ? 'block' : 'none' ); ?>">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_phone_4]", ' has-error ')?>">
                                                            <div class="col-md-4">
                                                                <i class="material-icons prefix">phone</i>
                                                                <input type="text" name="data[client_phone_4]" id="client_phone_4" value="<?= ( !empty($client->client_phone_4) ? $client->client_phone_4 : '' ); ?>" class="form-control" maxlength="50" onchange="javascript:checkPhonesVisibilty(); " />
                                                                <label for="client_phone_4" class="control-label col-md-4"><?php echo lang('phone_4') ?></label>
                                                            </div><!--  ./col -->
                                                            <div class="col-md-3">
                                                                <select name="data[client_phone_type]" id="client_phone_type" class="form-control" onchange="javascript:client_phone_typeOnChange()">
                                                                    <option value="">Select Type</option>
                                                                    <?php foreach( $client_phone_type_array as $next_key=>$next_client_phone_type ) { ?>
                                                                        <option value="<?=$next_client_phone_type  ?>" <?= ( ( !empty($client->client_phone_type) and $client->client_phone_type == $next_client_phone_type ) ? 'selected' : '' ); ?> ><?=$next_client_phone_type  ?></option>
                                                                    <?php } ?>
                                                                    <option value="-add_new-">  - Add New-  </option>
                                                                </select>
											                <span id="span_new_client_phone_type" style="display: none;">
												                <input type="text" name="new_client_phone_type" id="new_client_phone_type" value="" class="form-control" maxlength="20" />
											                </span>
                                                            </div><!--  ./col -->
                                                        </div><!-- ./form-group -->
                                                    </div><!-- ./col -->


                                                </div> <!-- ./row -->

                                                <!--Email-->
                                                <div class="row">

                                                    <!-- client email -->
                                                    <div class="col-md-12 email add-row-able">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_email_first]", ' has-error ')?>">
                                                            <?php
                                                            $is_debug= false;
                                                            $client_email_button_visible = $is_insert;
                                                            $client_email_input_visible = !$is_insert;
                                                            $client_email_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_email) ) {
                                                                $client_email_button_visible = false;
                                                                $client_email_input_visible = true;
                                                                $client_email_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $client_email_button_visible = false;
                                                                $client_email_input_visible = false;
                                                                $client_email_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $client_email_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $client_email_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $client_email_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-6" style="display: <?php echo ( $client_email_button_visible ? "none" :"none") ; ?>" id="div_client_email_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_email',true);" id="btn_add_client_email">Add an email</button>
                                                            </div>

                                                            <div class="col-md-6" style="display: <?php echo ( $client_email_input_visible ? "block" :"block" ) ; ?>" id="div_client_email_input">
                                                                <i class="material-icons prefix">email</i>
                                                                <input type="text" name="data[client_email_first]" id="client_email" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50"  />
                                                                <label for="client_email" class=""><?php echo lang('email') ?></label>
                                                            </div>

                                                            <div class="col-md-6" style="display: <?php echo ( ( $client_email_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_email_view">
                                                                <input type="text" name="data[client_email_view]" id="client_email_view" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50" readonly />
                                                                <label for="client_email_view" class="control-label col-md-4"><?php echo lang('email') ?></label>
                                                            </div>
                                                            <!-- ./col -->
                                                            <div class="input-field col-md-6">
                                                                <input type="text" name="email1" list="emailname1">
                                                                <datalist id="emailname1">
                                                                    <option value="Home">
                                                                    <option value="Work">
                                                                    <option value="Other">
                                                                </datalist>
                                                                <!-- <select>
                                                                     <option value="" disabled selected>Custom Lable</option>
                                                                     <option value="1">Home</option>
                                                                     <option value="2">Work</option>
                                                                     <option value="3">Other</option>
                                                                 </select>-->
                                                            </div>
                                                        </div><!-- ./form-group -->
                                                        <div class="btn-add add-row-button" next-row-class="email-second-row">
                                                            <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                        </div>
                                                        <!-- <div class="btn-rem">
                                                             <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                         </div>-->
                                                    </div><!-- ./col -->

                                                    <!-- client email -->
                                                    <div class="col-md-12 email email-second-row" style="display:none;">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[client_email]", ' has-error ')?>" >
                                                            <?php
                                                            $is_debug= false;
                                                            $client_email_button_visible = $is_insert;
                                                            $client_email_input_visible = !$is_insert;
                                                            $client_email_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_email) ) {
                                                                $client_email_button_visible = false;
                                                                $client_email_input_visible = true;
                                                                $client_email_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $client_email_button_visible = false;
                                                                $client_email_input_visible = false;
                                                                $client_email_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $client_email_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $client_email_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $client_email_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-6" style="display: <?php echo ( $client_email_button_visible ? "none" :"none") ; ?>" id="div_client_email_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_email',true);" id="btn_add_client_email">Add an email</button>
                                                            </div>

                                                            <div class="col-md-6" style="display: <?php echo ( $client_email_input_visible ? "block" :"block" ) ; ?>" id="div_client_email_input">
                                                                <i class="material-icons prefix">email</i>
                                                                <input type="text" name="data[client_email]" id="client_email" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50"  />
                                                                <label for="client_email" class=""><?php echo lang('email') ?></label>
                                                            </div>

                                                            <div class="col-md-6" style="display: <?php echo ( ( $client_email_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_email_view">
                                                                <input type="text" name="data[client_email_view]" id="client_email_view" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50" readonly />
                                                                <label for="client_email_view" class="control-label col-md-4"><?php echo lang('email') ?></label>
                                                            </div>
                                                            <!-- ./col -->
                                                            <div class="input-field col-md-6">
                                                                <input type="text" name="email2" list="emailname2">
                                                                <datalist id="emailname2">
                                                                    <option value="Home">
                                                                    <option value="Work">
                                                                    <option value="Other">
                                                                </datalist>
                                                                <!--  <select>
                                                                      <option value="" disabled selected>Custom Lable</option>
                                                                      <option value="1">Home</option>
                                                                      <option value="2">Work</option>
                                                                      <option value="3">Other</option>
                                                                  </select>-->
                                                            </div>
                                                        </div><!-- ./form-group -->
                                                        <div class="btn-add add-row-button" next-row-class="email-third-row">
                                                            <a href="#" data-toggle="tooltip" title="Add"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                        </div>
                                                        <div class="btn-rem">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                        </div>
                                                    </div><!-- ./col -->

                                                    <!-- client email -->
                                                    <div class="col-md-12 email email-third-row" style="display:none;">
                                                        <div class="form-group  input-field <?= $this->common_lib->set_field_error_tag("data[client_email]", ' has-error ')?>" >
                                                            <?php
                                                            $is_debug= false;
                                                            $client_email_button_visible = $is_insert;
                                                            $client_email_input_visible = !$is_insert;
                                                            $client_email_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->client_email) ) {
                                                                $client_email_button_visible = false;
                                                                $client_email_input_visible = true;
                                                                $client_email_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $client_email_button_visible = false;
                                                                $client_email_input_visible = false;
                                                                $client_email_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $client_email_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $client_email_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $client_email_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>
                                                            <div class="col-md-6" style="display: <?php echo ( $client_email_button_visible ? "none" :"none") ; ?>" id="div_client_email_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_email',true);" id="btn_add_client_email">Add an email</button>
                                                            </div>

                                                            <div class="col-md-6" style="display: <?php echo ( $client_email_input_visible ? "block" :"block" ) ; ?>" id="div_client_email_input">
                                                                <i class="material-icons prefix">email</i>
                                                                <input type="text" name="data[client_email]" id="client_email" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50"  />
                                                                <label for="client_email" class=""><?php echo lang('email') ?></label>
                                                            </div>

                                                            <div class="col-md-6" style="display: <?php echo ( ( $client_email_view_visible ) ? "block" :"none" ) ; ?>" id="div_client_email_view">
                                                                <input type="text" name="data[client_email_view]" id="client_email_view" value="<?= ( !empty($client->client_email) ? $client->client_email : '' ); ?>" class="form-control" maxlength="50" readonly />
                                                                <label for="client_email_view" class="control-label col-md-4"><?php echo lang('email') ?></label>
                                                            </div>
                                                            <!-- ./col -->
                                                            <div class="input-field col-md-6">
                                                                <!--<select>
                                                                    <option value="" disabled selected>Custom Lable</option>
                                                                    <option value="1">Home</option>
                                                                    <option value="2">Work</option>
                                                                    <option value="3">Other</option>
                                                                </select>-->
                                                                <input type="text" name="email3" list="emailname3">
                                                                <datalist id="emailname3">
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

                                                </div>
                                                <!--End Email-->


                                                <!--Type of business-->
                                                <!--<div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-field col-md-12">
                                                            <input id="first_name" type="text" class="validate">
                                                            <label for="first_name">Type of business</label>
                                                        </div>


                                                        <form action="#">

                                                            <label><input class="with-gap" name="group1"  checked type="radio"/>Hospice</label>
                                                            <label> <input class="with-gap" name="group1" type="radio" /> Home Health</label>
                                                            <label><input class="with-gap" name="group1" type="radio" /> Assisted Living</label>
                                                            <label><input class="with-gap" name="group1" type="radio" /> Board & Care</label>
                                                            <label><input class="with-gap" name="group1" type="radio" id="test6"  />Board & Care</label>


                                                        </form>
                                                    </div>
                                                </div>-->

                                                <div class="row">
                                                    <!--Client_active_status-->
                                                    <!-- <div class="col-md-6">
                                                    <div class="form-group input-field <?/*= $this->common_lib->set_field_error_tag("data[client_active_status]", ' has-error ')*/?>">


                                                        <?php
                                                    /*                                                        $is_debug= false;
                                                                                                            $client_active_status_button_visible = $is_insert;
                                                                                                            $client_active_status_input_visible = !$is_insert;
                                                                                                            $client_active_status_view_visible = false;
                                                                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                                                                            if ( $validation_errors_text!= "" and !empty($client->client_active_status) ) {
                                                                                                                $client_active_status_button_visible = false;
                                                                                                                $client_active_status_input_visible = true;
                                                                                                                $client_active_status_view_visible= false;
                                                                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                                                                            }
                                                                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                                                                $client_active_status_button_visible = false;
                                                                                                                $client_active_status_input_visible = false;
                                                                                                                $client_active_status_view_visible= true;
                                                                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                                                                            }
                                                                                                            if ($is_debug) {
                                                                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                                                                echo '<pre>button_visible::' . print_r( $client_active_status_button_visible, true ) . '</pre>';
                                                                                                                echo '<pre>input_visible::' . print_r( $client_active_status_input_visible, true ) . '</pre>';
                                                                                                                echo '<pre>view_visible::' . print_r( $client_active_status_view_visible, true ) . '</pre>';
                                                                                                            }
                                                                                                            */?>
                                                        <div class="col-md-12" style="display: <?php /*echo ( $client_active_status_button_visible ? "none" :"none") ; */?>" id="div_client_active_status_btn">
                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('client_active_status',true);" id="btn_add_client_active_status">Add an active status<span class="required">&nbsp;*&nbsp;</span></button>
                                                        </div>

                                                        <div class="col-md-12" style="display: <?php /*echo ( $client_active_status_input_visible ? "block" :"block" ) ; */?>" id="div_client_active_status_input">
                                                            <table>
                                                                <tr>
                                                                    <td style="padding-bottom: 12px;">
                                                                        <label class="control-label col-md-4" for="client_active_status" >&nbsp;<?php /*echo lang('client_active_status') */?><span class="required">&nbsp;*&nbsp;</span></label>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td calss="calss">
                                                                        <?php /*echo MyCustom_menu($client_active_status_array,'data[client_active_status]','form-control',(!empty($client->client_active_status)?$client->client_active_status:'')," -Client Active Status- ",'id ="client_active_status"'); */?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7" style="display: <?php /*echo ( ( $client_active_status_view_visible ) ? "none" :"none" ) ; */?>" id="div_client_active_status_view">
                                                        <label class="control-label col-md-4" for="client_active_status_view" >&nbsp;<?php /*echo lang('client_active_status') */?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        <input type="text" name="data[client_active_status_view]" id="client_active_status_view" value="<?/*= ( !empty($client->client_active_status) ? $this->common_lib->get_client_active_status_label($client->client_active_status) : '' ); */?>" class="form-control" maxlength="100" readonly />
                                                    </div>

                                                </div> -->
                                                    <!-- ./row -->


                                                    <div class="col-md-12">
                                                        <h3>Type</h3>

                                                        <!--                                                            <form action="#">-->
                                                        <!--                                                                <label><div class="radio"><span class="checked"><input class="with-gap" name="group1" checked type="radio"> </span></div>Assisted /Senior Living Facilities</label>-->
                                                        <!--                                                                <label><div class="radio"><span > <input class="with-gap" name="group1" type="radio"></span></div> Home Health</label>-->
                                                        <!--                                                                <label><div class="radio"><span ><input class="with-gap" name="group1" type="radio"></span></div> SYS Admin</label>-->
                                                        <!--                                                                <label><div class="radio"><span ><input class="with-gap" name="group1" type="radio"></span></div> testing description </label>-->
                                                        <!--                                                                <label><div class="radio"><span ><input class="with-gap" name="group1" type="radio" id="test6"></span></div> a home providing care for the sick, especially the terminally ill.</label>-->
                                                        <!---->
                                                        <!--                                                            </form>-->
                                                        <!--                                                            <form action="#">-->
                                                        <!--                                                                <label><span class="checked"><input class="with-gap" name="group1" checked type="radio"> </span>Assisted /Senior Living Facilities</label>-->
                                                        <!--                                                                <label><span><input class="with-gap" name="group1" type="radio"></span> Home Health</label>-->
                                                        <!--                                                                <label><span><input class="with-gap" name="group1" type="radio"></span> SYS Admin</label>-->
                                                        <!--                                                                <label><span><input class="with-gap" name="group1" type="radio"></span> testing description </label>-->
                                                        <!--                                                                <label><span><input class="with-gap" name="group1" type="radio" id="test6"></span> a home providing care for the sick, especially the terminally ill.</label>-->
                                                        <!--                                                            </form>-->




                                                        <form action="#">
                                                            <p>
                                                                <input class="with-gap" name="group1" type="radio" id="assisted" />
                                                                <label for="assisted">Assisted /Senior Living Facilities</label>
                                                            </p>
                                                            <p>
                                                                <input class="with-gap" name="group1" type="radio" id="home" />
                                                                <label for="home">Home Health</label>
                                                            </p>
                                                            <p>
                                                                <input class="with-gap" name="group1" type="radio" id="SYS"  />
                                                                <label for="SYS">SYS Admin</label>
                                                            </p>
                                                            <p>
                                                                <input class="with-gap" name="group1" type="radio" id="testing"  />
                                                                <label for="testing">testing description</label>
                                                            </p>
                                                            <p>
                                                                <input class="with-gap" name="group1" type="radio" id="providing"  />
                                                                <label for="providing">a home providing care for the sick, especially the terminally ill.</label>
                                                            </p>


                                                        </form>

                                                    </div>

                                                    <!--Client_types-->

                                                    <div class="col-md-6">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[clients_types_id]", ' has-error ')?>">
                                                            <?php
                                                            $is_debug= false;
                                                            $clients_types_id_button_visible = $is_insert;
                                                            $clients_types_id_input_visible = !$is_insert;
                                                            $clients_types_id_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->clients_types_id) ) {
                                                                $clients_types_id_button_visible = false;
                                                                $clients_types_id_input_visible = true;
                                                                $clients_types_id_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $clients_types_id_button_visible = false;
                                                                $clients_types_id_input_visible = false;
                                                                $clients_types_id_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $clients_types_id_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $clients_types_id_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $clients_types_id_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>

                                                            <div class="col-md-12" style="display: <?php echo ( $clients_types_id_button_visible ? "none" :"none") ; ?>" id="div_clients_types_id_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('clients_types_id',true);" id="btn_add_clients_types_id">Add a client type<span class="required">&nbsp;*&nbsp;</span></button>
                                                            </div>
                                                            <!--                                                        <div class="col-md-12" style="display: --><?php //echo ( $clients_types_id_input_visible ? "block" :"block" ) ; ?><!--" id="div_clients_types_id_input">-->
                                                            <!--                                                            <table>-->
                                                            <!--                                                                <tr>-->
                                                            <!--                                                                    <td style="padding: 12px;">-->
                                                            <!--                                                                        <label for="clients_types_id" class="control-label col-md-4">&nbsp;--><?php //echo lang('clients-type') ?><!--<span class="required">&nbsp;*&nbsp;</span></label>-->
                                                            <!--                                                                    </td>-->
                                                            <!--                                                                </tr>-->
                                                            <!---->
                                                            <!---->
                                                            <!--                                                                <tr>-->
                                                            <!--                                                                    <td>-->
                                                            <!--                                                                        --><?php // echo MyCustom_menu($client_types,'data[clients_types_id]','form-control', ( !empty($client->clients_types_id) ? $client->clients_types_id : '' ), " -Client Type- ",'id ="clients_types_id"'); ?>
                                                            <!--                                                                    </td>-->
                                                            <!--                                                                </tr>-->
                                                            <!--                                                            </table>-->
                                                            <!--                                                        </div>-->
                                                            <!-- <div class="col-md-12" style="display: block;" id="div_clients_types_id_input">
                                                            <table>
                                                                <tbody>
                                                                <tr>
                                                                    <td style="padding: 12px;">
                                                                        <label for="clients_types_id" class="control-label col-md-4">&nbsp;Client&nbsp;Type<span class="required">&nbsp;*&nbsp;</span></label>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-12" style="display: <?php /*echo ( ( $clients_types_id_view_visible ) ? "block" :"none" ) ; */?>" id="div_clients_types_id_view">
                                                            <label class="control-label col-md-4" for="clients_types_id_view" >&nbsp;<?php /*echo lang('clients-type') */?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            <input type="text" name="data[clients_types_id_view]" id="clients_types_id_view" value="<?/*= ( !empty($client->clients_types_id) ? $this->common_lib->get_clients_types_id_label($client->clients_types_id) : '' ); */?>" class="form-control" maxlength="200" readonly />
                                                        </div>-->

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" style="display: none">

                                                    <!--                                                <div class="col-md-6">-->
                                                    <!--                                                    <div class="form-group input-field --><?//= $this->common_lib->set_field_error_tag("data[clients_types_id]", ' has-error ')?><!--">-->
                                                    <!--                                                        --><?php
                                                    //                                                        $is_debug= false;
                                                    //                                                        $clients_types_id_button_visible = $is_insert;
                                                    //                                                        $clients_types_id_input_visible = !$is_insert;
                                                    //                                                        $clients_types_id_view_visible = false;
                                                    //                                                        if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                    //                                                        if ( $validation_errors_text!= "" and !empty($client->clients_types_id) ) {
                                                    //                                                            $clients_types_id_button_visible = false;
                                                    //                                                            $clients_types_id_input_visible = true;
                                                    //                                                            $clients_types_id_view_visible= false;
                                                    //                                                            if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                    //                                                        }
                                                    //                                                        if ( $validation_errors_text == "" and !$is_insert ) {
                                                    //                                                            $clients_types_id_button_visible = false;
                                                    //                                                            $clients_types_id_input_visible = false;
                                                    //                                                            $clients_types_id_view_visible= true;
                                                    //                                                            if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                    //                                                        }
                                                    //                                                        if ($is_debug) {
                                                    //                                                            echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                    //                                                            echo '<pre>button_visible::' . print_r( $clients_types_id_button_visible, true ) . '</pre>';
                                                    //                                                            echo '<pre>input_visible::' . print_r( $clients_types_id_input_visible, true ) . '</pre>';
                                                    //                                                            echo '<pre>view_visible::' . print_r( $clients_types_id_view_visible, true ) . '</pre>';
                                                    //                                                        }
                                                    //                                                        ?>
                                                    <!---->
                                                    <!--                                                        <div class="col-md-12" style="display: --><?php //echo ( $clients_types_id_button_visible ? "none" :"none") ; ?><!--" id="div_clients_types_id_btn">-->
                                                    <!--                                                            <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('clients_types_id',true);" id="btn_add_clients_types_id">Add a client type<span class="required">&nbsp;*&nbsp;</span></button>-->
                                                    <!--                                                        </div>-->
                                                    <!--                                                        <div class="col-md-12" style="display: --><?php //echo ( $clients_types_id_input_visible ? "block" :"block" ) ; ?><!--" id="div_clients_types_id_input">-->
                                                    <!--                                                            <table>-->
                                                    <!--                                                                <tr>-->
                                                    <!--                                                                    <td style="padding: 12px;">-->
                                                    <!--                                                                        <label for="clients_types_id" class="control-label col-md-4">&nbsp;--><?php ///*//echo lang('clients-type') */?><!--<span class="required">&nbsp;*&nbsp;</span></label>-->
                                                    <!--                                                                    </td>-->
                                                    <!--                                                                </tr>-->
                                                    <!---->
                                                    <!---->
                                                    <!--                                                                <tr>-->
                                                    <!--                                                                    <td>-->
                                                    <!--                                                                        --><?php // echo MyCustom_menu($client_types,'data[clients_types_id]','form-control', ( !empty($client->clients_types_id) ? $client->clients_types_id : '' ), " -Client Type- ",'id ="clients_types_id"'); ?>
                                                    <!--                                                                    </td>-->
                                                    <!--                                                                </tr>-->
                                                    <!--                                                            </table>-->
                                                    <!--                                                        </div>-->
                                                    <!--                                                        <div class="col-md-12" style="display: block;" id="div_clients_types_id_input">-->
                                                    <!--                                                            <table>-->
                                                    <!--                                                                <tbody>-->
                                                    <!--                                                                <tr>-->
                                                    <!--                                                                    <td style="padding: 12px;">-->
                                                    <!--                                                                        <label for="clients_types_id" class="control-label col-md-4">&nbsp;Client&nbsp;Type<span class="required">&nbsp;*&nbsp;</span></label>-->
                                                    <!--                                                                    </td>-->
                                                    <!--                                                                </tr>-->
                                                    <!--                                                                </tbody>-->
                                                    <!--                                                            </table>-->
                                                    <!--                                                        </div>-->
                                                    <!--                                                        <div class="col-md-12" style="display: --><?php //echo ( ( $clients_types_id_view_visible ) ? "block" :"none" ) ; ?><!--" id="div_clients_types_id_view">-->
                                                    <!--                                                            <label class="control-label col-md-4" for="clients_types_id_view" >&nbsp;--><?php //echo lang('clients-type') ?><!--<span class="required">&nbsp;*&nbsp;</span></label>-->
                                                    <!--                                                            <input type="text" name="data[clients_types_id_view]" id="clients_types_id_view" value="--><?//= ( !empty($client->clients_types_id) ? $this->common_lib->get_clients_types_id_label($client->clients_types_id) : '' ); ?><!--" class="form-control" maxlength="200" readonly />-->
                                                    <!--                                                        </div>-->
                                                    <!---->
                                                    <!--                                                    </div>-->
                                                    <!--                                                </div>-->

                                                    <!-- client color_scheme -->
                                                    <div class="col-md-6">
                                                        <div class="form-group input-field <?= $this->common_lib->set_field_error_tag("data[color_scheme]", ' has-error ')?>">
                                                            <?php
                                                            $is_debug= false;
                                                            $color_scheme_button_visible = $is_insert;
                                                            $color_scheme_input_visible = !$is_insert;
                                                            $color_scheme_view_visible = false;
                                                            if ($is_debug) echo '<pre>$validation_errors_text::'.print_r($validation_errors_text,true).'</pre>';
                                                            if ( $validation_errors_text!= "" and !empty($client->color_scheme) ) {
                                                                $color_scheme_button_visible = false;
                                                                $color_scheme_input_visible = true;
                                                                $color_scheme_view_visible= false;
                                                                if ($is_debug) echo '<pre>INSIDE1</pre>';
                                                            }
                                                            if ( $validation_errors_text == "" and !$is_insert ) {
                                                                $color_scheme_button_visible = false;
                                                                $color_scheme_input_visible = false;
                                                                $color_scheme_view_visible= true;
                                                                if ($is_debug) echo '<pre>INSIDE2</pre>';
                                                            }
                                                            if ($is_debug) {
                                                                echo '<pre>$is_insert::' . print_r( $is_insert, true ) . '</pre>';
                                                                echo '<pre>button_visible::' . print_r( $color_scheme_button_visible, true ) . '</pre>';
                                                                echo '<pre>input_visible::' . print_r( $color_scheme_input_visible, true ) . '</pre>';
                                                                echo '<pre>view_visible::' . print_r( $color_scheme_view_visible, true ) . '</pre>';
                                                            }
                                                            ?>

                                                            <div class="col-md-12" style="display: <?php echo ( $color_scheme_button_visible ? "block" :"none") ; ?>" id="div_color_scheme_btn">
                                                                <button type="button" class="waves-effect waves-light btn btn-xs" onclick="javascript:switchFieldName('color_scheme',true);" id="btn_add_color_scheme">Add a client color scheme<span class="required">&nbsp;*&nbsp;</span></button>
                                                            </div>
                                                            <div class="col-md-12"  style="display: <?php echo ( $color_scheme_input_visible ? "block" :"none" ) ; ?>" id="div_color_scheme_input">
                                                                <table>
                                                                    <tr>
                                                                        <td style="padding: 12px;">
                                                                            <label for="color_scheme" class="control-label col-md-4">&nbsp;<?php echo lang('color_scheme') ?><?php if ( !$is_insert ) : ?><span class="required">&nbsp;*&nbsp;</span><?php endif; ?></label>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <select name="data[color_scheme]" id="color_scheme" class="form-control" <?php echo ( $is_insert ? " disabled " : "" ) ?> >
                                                                                <option value="">Select Color Scheme</option>
                                                                                <?php foreach( $client_color_schemes as $next_key=>$next_color_scheme ) { ?>

                                                                                    <?php if ( !$is_insert ) : ?>
                                                                                        <option value="<?=$next_color_scheme['id']  ?>" <?= ( ( !empty($client->color_scheme) and (int)$client->color_scheme == (int)$next_color_scheme['id'] ) ? 'selected' : '' ); ?> ><?=$next_color_scheme['title']  ?></option>
                                                                                    <?php else : ?>
                                                                                        <option value="<?=$next_color_scheme['id']  ?>" <?= ( ( $next_color_scheme['default'] ) ? 'selected' : '' ); ?> ><?=$next_color_scheme['title']  ?></option>
                                                                                    <?php endif; ?>

                                                                                <?php } ?>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div><!-- ./col -->
                                                        <div class="col-md-12" style="display: <?php echo ( ( $color_scheme_view_visible ) ? "block" :"none" ) ; ?>" id="div_color_scheme_view">
                                                            <label class="control-label col-md-4" for="color_scheme_view" >&nbsp;<?php echo lang('color_scheme') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                            <input type="text" name="data[color_scheme_view]" id="color_scheme_view" value="<?= ( !empty($client->color_scheme) ? $this->common_lib->get_color_scheme_label($client->color_scheme) : '' ); ?>" class="form-control" maxlength="100" readonly />
                                                        </div>
                                                    </div><!-- ./form-group -->

                                                </div><!-- ./col -->

                                                <section style="display: none" class="row ">
                                                    <?php $submit_buttons_visible = $is_insert;
                                                    $switch_to_edit_buttons_visible = !$is_insert;
                                                    //								echo '<pre>$validation_errors_text::'.print_r(htmlspecialchars($validation_errors_text),true).'</pre>';
                                                    if ( $validation_errors_text!= "" ) {
                                                        $submit_buttons_visible = true;
                                                        $switch_to_edit_buttons_visible = false;
                                                    }
                                                    //								echo '<pre>$submit_buttons_visible::'.print_r($submit_buttons_visible,true).'</pre>';
                                                    //								echo '<pre>$switch_to_edit_buttons_visible::'.print_r($switch_to_edit_buttons_visible,true).'</pre>';
                                                    ?>
                                                    <!--								<div class=" btn-group pull-right editor_btn_group " style="padding: 5px; display: none;" id="div_insert_buttons">-->
                                                    <!--								</div>-->

                                                    <div class=" btn-group pull-right editor_btn_group " style="padding: 5px; <?= !$switch_to_edit_buttons_visible ? "display: none;" : ""  ?> " id="div_view_buttons">
                                                        <div class="col-xs-6 pull-left ">
                                                            <button type="button" class="btn btn-default btn-sm pull_right_only_on_xs padding_right_sm tooltipped" onclick="javascript:showEditMode('<?= ( $is_insert ? "new" : $cid ) ?>', '<?=  ( $is_insert ? "1" : "" ) ?>')" data-position="top" data-delay="50" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Click to switch to edit mode">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-xs-6 pull-right ">
                                                            <button type="reset" class="btn btn-cancel-action" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'" >Cancel</button>
                                                        </div>
                                                    </div>

                                                    <div class=" btn-group pull-right editor_btn_group "  style="padding: 5px; <?= !$submit_buttons_visible ? "display: none;" : ""  ?> " id="div_editor_buttons">
                                                        <div class="col-xs-12  col-sm-4  ">
                                                            On Update&nbsp;
                                                            <select id="select_on_update" name="select_on_update">
                                                                <option value="reopen_editor" <?= ( $select_on_update == "reopen_editor" ? "selected" : "") ?> >Reopen editor</option>
                                                                <option value="open_editor_for_new" <?= ( $select_on_update == "open_editor_for_new" ? "selected" : "") ?> >Open editor for new</option>
                                                                <option value="reopen_listing" <?= ( $select_on_update == "reopen_listing" ? "selected" : "") ?> >Reopen listing</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-6  col-sm-4 ">
                                                            <button style="display: none" type="button" class="btn btn-primary" onclick="javascript:onSubmit();" >Submit</button>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-2 pull-left ">
                                                            <button style="display: none" type="reset" class="btn btn-cancel-action" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'" >Cancel</button>
                                                        </div>
                                                        <div class="col-sm-2 ">
                                                        </div>
                                                    </div>
                                                </section>

                                            </div>

                                        </form>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                                <!-- END VALIDATION STATES-->
                            </div>
                        </div>
                    </div><!-- ./row -->
                </div>
                <div class="modal-footer">

                    <div class="col-xs-12">

                        <ul class="md-foot-top">
                            <li class="create-contact-more"><a href="#">+CONTACT</a> </li>
                            <li class="create-contact-more"><a href="#">+SUPERUSER</a></li>
                        </ul>

                        <ul class ="md-foot-bot">
                            <li data-dismiss="modal" role="button"><a href="#" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'">CANCEL</a>  </li>
                            <li class="create-contact-save" data-action="save" role="button"><a href="#"> SAVE</a> </li>
                        </ul>


                    </div>
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
<script src="/assets/global/js/client-overview-view.js" type="text/javascript" ></script>

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


<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-56218128-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');
</script>



<script>
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        var width = $(window).width();
        var grid_pinned = $('#grid-pinned').offset().top - 300;
        var grid_associations = $('#grid-associations').offset().top - 300;
        var grid_history = $('#grid-history').offset().top - 300;

        // Do something
//        alert('wwwwww');
//        console.log(scroll+' - '+width+" - "+grid_responsive);
        if(scroll >= grid_history) {
            $('.table-of-contents li a').removeClass('active');
            $('.table-of-contents li a[href="#grid-history"]').addClass('active');
        }else if(scroll >= grid_associations) {
            $('.table-of-contents li a').removeClass('active');
            $('.table-of-contents li a[href="#grid-associations"]').addClass('active');
        }else {
            $('.table-of-contents li a').removeClass('active');
            $('.table-of-contents li a[href="#grid-pinned"]').addClass('active');
        }


    });

</script>


</body>
</html>