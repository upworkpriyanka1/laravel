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
<body class=" loginc page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md user form-edit-us" id="profile-form-mock">

<!-- BEGIN HEADER -->

<!-- END HEADER -->

<!-- BEGIN MAIN PAGE -->

<main>
<div class=" logo">
            <a href="index.html">
                <img src="<?php echo base_url() ?>assets/img/logo.png" alt="" style="backgro" /> </a>
        </div>
    <div class="page-content" id="top_container">
        <div class="row">
            <div class="col s12">
                <div id="structure" class="section scrollspy">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="page-content1" style="width:65%;margin:0 auto;">

                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                                <div id="profile-form">
                                    <div class="row card">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12"><h3>Sign Up Form</h3></div>
                                            </div>
                                           <form action="" id="new_user_form" method="POST" enctype="multipart/form-data">
                                                <?php echo validation_errors(); ?>

                                                                                                <div class="row" id="step1">
                                                                                                        <div class="col-md-12">
                                                                                                                <div class="collection">
                                                                                                                        <a href="javascript:void(0);" class="collection-item">I am a licensee of a Residential Care Home (also called Assisted Living, Board and Care Homes, Group Homes, Adult Family Homes).</a>
                                                                                                                        <a href="javascript:void(0);" class="collection-item">I am an administrator / manager of a Residential Care Home (also called Assisted Living, Board and Care Homes, Group Homes, Adult Family Homes).</a>
                                                                                                                        <a href="javascript:void(0);" class="collection-item">I own or live in a Home Care / House / Home.</a>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div style="height:30px;"></div>

                                                <div class="row" id="step2" style="display:none;">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="input-field">
                                                                <input id="us-name" type="text" class="validate" value="" name="data[first_name]" required>

                                                                <label for="us-name" class="control-label">First Name
                                                                    <span class="required"> * </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="input-field">
                                                                <input id="us-name" type="text" class="validate" value="" name="data[last_name]" required>

                                                                <label for="us-name" class="control-label">Last Name
                                                                    <span class="required"> * </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="input-field">
                                                                <input id="us-email" type="email" class="validate" name="data[email]" autocomplete="off" required>
                                                                <label for="us-email" class="control-label">Email Address
                                                                    <span class="required"> * </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="input-field">
                                                                <input id="us-email-conf" type="email" class="" name="data[email_confirm]" autocomplete="off" required>
                                                                <label data-error="wrong" data-success="right" for="us-pass-conf" class="control-label">Verify Email Address
                                                                    <span class="required"> * </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button class="btn " name="cancel" type="reset">Reset</button>
                                                        <button class="btn disabled" name="submit" type="submit" id="send">Send</button>
                                                    </div>
                                                </div>
                                           </form>
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

<script>
$("#us-email-conf").blur(function(){
                var email=$("#us-email").val();
                var emailc=$("#us-email-conf").val();
                if(email==emailc){
                        $("#send").removeClass('disabled');
                }else{
                        $("#send").addClass('disabled');
                }
        });
        $(document).ready(function(){
                $('#step1 .collection a').click(function(){
                        $('#step1 .collection a').removeClass('active');
                        $(this).addClass('active');
                        $('#step2').show('slow','swing');
                });
        });


</script>
<style>
.login {
    background-color: none !important;
}
</style>
</body>
</html>
