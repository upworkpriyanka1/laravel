<?php $ci = &get_instance();
echo link_tag('/assets/layouts/default/css/custom-client-overview-view.css');
?>
<script>
    var client_id= '<?php echo $client->cid ?>'
</script>

<style>
.error{
	left: 0 !important;
    position: relative !important;
    top: 0 !important;
}
</style>
<div class="row clients-overview">
    <div class="col s12 m9 l10">
        <div class="row" style="margin-bottom: 0;">
            <?php

            $message = $this->session->flashdata('massege');
            if($message && $message != ''){ ?>
                <div class="massege" style="background-color: #fff;padding: 10px;margin-bottom: 10px">
				<?=$this->session->flashdata('massege');?></div>
            <?php } ?>

            <div class="edit" style="display: inline-block;margin-right: 30px;">
                <a  href="/sys-admin/client-edit/<?=$client->cid?>/" class="btn-floating btn-large waves-effect waves-light " style="border-radius: 50% !important;"><i class="large material-icons">edit</i></a>
            </div>


            <button data-toggle="modal" data-target="#client_new_user_dialog" class="client_new_user_dialog waves-effect waves-light btn-large" style="background-color: #fff; color: #000;font-size: 16px;">
                <i class="fa fa-plus" style="font-size: 16px"></i>
                USER
            </button>

            <div class="user-st">
                <h4>Status</h4>

                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="status_but_name"><?=$client_active_status_array[$client->client_status];?></span><span class="caret"></span></button>
                    <ul class="dropdown-menu client-status-parent">
                        <li class="client-status <?=($client->client_status == "P") ? "disabled":''?>"><a href="javascript:void(0)">Pending</a></li>
                        <li class="client-status <?=($client->client_status == "A") ? "disabled":''?>"><a href="javascript:void(0)">Active</a></li>
                        <li class="client-status <?=($client->client_status == "I") ? "disabled":''?>"><a href="javascript:void(0)">Inactive</a></li>
                    </ul>
                </div>
            </div>

            <div id="client-status-change-confirm-modal" class="modal fade in">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <input type="hidden" name="id" value="<?= $client->cid; ?>">
                            <h4> Change <?= $client->client_name; ?> status to <span class="client-change-status-title"></span> ? </h4>
                            <div class="btn-group">
                                <button class="btn btn-danger" data-dismiss="modal" style="margin-right: 10px">No</button>
                                <input type="button" class="btn btn-primary client_status_confirm" value="yes">
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->

            <div class="modal fade newclient" id="client_new_user_dialog" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class=" modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">New user for <?php echo $client->client_name ?> </h3>
                            <h5>All fields are required.</h5>
                        </div>

                        <div class="row">
                            <form class="col s12 form-horizontal" action="<?php echo base_url() ;?>sys-admin/users/users-edit/new" method="post" id="form_user_modal_editor" name="form_user_modal_editor" enctype="multipart/form-data">


                                <input type="hidden" name="form_user_modal_editor_client_id" value="<?php echo $client_id;?>" id="form_user_modal_editor_client_id" />
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input required type="text" name="form_user_modal_editor_username" id="form_user_modal_editor_username" maxlength="100" value="" class="validate" onchange="validateFormEnableOrDisable('form_user_modal_editor');" />
                                        <label for="username">Username</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input required type="text" name="form_user_modal_editor_first_name" id="form_user_modal_editor_first_name" maxlength="50" value="" class="validate" onchange="validateFormEnableOrDisable('form_user_modal_editor');" />
                                        <label for="first_name">First Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">supervisor_account</i>
                                        <input required type="text" name="form_user_modal_editor_last_name" id="form_user_modal_editor_last_name" maxlength="50" value="" class="validate" onchange="validateFormEnableOrDisable('form_user_modal_editor');" />
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">phone</i>
                                        <input  type="tel" name="form_user_modal_editor_phone" id="form_user_modal_editor_phone" value="" maxlength="20" class="userphone validate" onchange="validateFormEnableOrDisable('form_user_modal_editor');" />
                                        <label for="phone">Telephone</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">email</i>
                                        <input required type="email" name="form_user_modal_editor_email" id="form_user_modal_editor_email" value="" maxlength="100" class="user_email validate required_form"  onchange="validateFormEnableOrDisable('form_user_modal_editor');"/>
                                        <label for="email">Email address</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">email</i>
                                        <input required type="email" name="form_user_modal_editor_email1" id="form_user_modal_editor_email1" value="" maxlength="100" class="user_email_confirm validate required_form" onChange="validateFormEnableOrDisable('form_user_modal_editor');"/>
                                        <label for="email1">Verify email address</label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="input-field row col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <label for="form_user_modal_editor_title">Verify title</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <select required name="form_user_modal_editor_title" id="form_user_modal_editor_title" class="user_email_confirm validate required_form" onchange="validateFormEnableOrDisable('form_user_modal_editor');" >
                                            <option value="">Select Type</option>
                                            <?php foreach( $groupsSelectionList as $next_key=>$nextGroupsSelection ) { ?>
                                                <option value="<?=$nextGroupsSelection['key']  ?>" ><?=$nextGroupsSelection['value']  ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="modal-footer">
                            <div class="col-xs-12">
                                <ul class ="md-foot-bot">
                                    <li data-dismiss="modal">
                                        <button class="btn"  data-dismiss="modal" role="button" type="button" >CANCEL</button>
                                        <!-- <button type="button" class="btn btn-cancel-action" data-dismiss="modal" role="button">Cancel</button> -->
                                    </li>
                                    <li> <!-- class="create-contact-save " data-action="save"-->
<!--                                        <button class="btn-flat  disable_form_id_form_user_modal_editor" disabled> VERIFY </button>-->
                                        <button type="button" class="btn add_Userform" id="but-verify" onClick="javascript:onuserModalEditorSubmit();" >VERIFY</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div id="grid-pinned" class="scrollspy">
                <h3 class="header">Pinned</h3>
                <h3 class="header">Status : <?= $this->common_lib->get_client_status_label($client->client_status ) ?></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci assumenda at distinctio, dolorem exercitationem iure libero nesciunt nihil nisi odio odit pariatur placeat porro, repellendus, sapiente sunt totam unde! Accusamus.</p>
            </div>


            <!-- Grid associations -->
            <div class="row">
                <div id="grid-associations" class="scrollspy">
                    <h3 class="header">Associations</h3>
                    <nav class="nav-extended">
                        <div class="nav-content">
                            <ul class="tabs tabs-transparent">
                                <li class="tab"><a href="#tab_client_related_users" class="active">Users</a></li>
                                <li class="tab"><a href="#tab_client_related_patients">Patients</a></li>
                            </ul>
                        </div>
                    </nav>


                    <div id="tab_client_related_users" class="col s12" style="background-color: #fff; padding-top: 20px">
                        <div id="div_load_client_related_users"></div>
                    </div>


                    <div id="tab_client_related_patients" class="col s12" style="background-color: #fff; padding-top: 20px"">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
                </div>
            </div>

            <!-- Grid History -->

            <div id="grid-history" class="scrollspy">
                <h3 class="header">Activity</h3>


                <div class="row">
                    <div class="widget-area no-padding blank">
                        <div class="status-upload">
                            <form action="#">
                                <div class="area-icon">
                                    <textarea placeholder="Add Comment"></textarea>
                                    <ul>
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="Audio"><i class="fa fa-music"></i></a></li>
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>
                                        <li><a title="" data-toggle="tooltip" data-placement="top" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-default" aria-label="Center Align">View History</button>
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
                        <li class="transp-coll">
                            <div class="collapsible-header"><i class="material-icons">whatshot</i>Third Comment</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_drama</i>Fourth Comment</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                        </li>
                        <li class="transp-coll">
                            <div class="collapsible-header"><i class="material-icons">place</i>Fifth Comment</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">whatshot</i>Sixth Comment</div>
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
                    <li><a href="#grid-history" class="">Activity</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    var validation_text = '<?php echo $this->session->flashdata( 'validation_errors_text1' );?>';
    //validation_text = stripslashes(validation_text);
    //validation_text.replace(/\\/g, '')
    //console.log('valiadtion text is : ' + validation_text);
    //alert('123');
    //validation_text = '12345';
    if(validation_text != '')
    {
        $('#client_new_user_dialog').modal('show');
    }
</script>