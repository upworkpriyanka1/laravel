<?php $ci = &get_instance();
echo link_tag('/assets/layouts/default/css/custom-client-overview-view.css');
?>
<div class="row clients-overview">
    <div class="col s12 m9 l10">
        <div class="row" style="margin-bottom: 0;">
            <?php
            $message = $this->session->flashdata('massege');
            if($message && $message != ''){ ?>
                <div class="massege" style="background-color: #fff;padding: 10px;margin-bottom: 10px"><?=$this->session->flashdata('massege');?></div>
            <?php } ?>

            <div class="edit" style="display: inline-block;margin-right: 30px;">
                <a  href="/sys-admin/client-edit/<?=$client->cid?>/" class="btn-floating btn-large waves-effect waves-light " style="border-radius: 50% !important;"><i class="large material-icons">edit</i></a>

            </div>


            <button data-toggle="modal" data-target="#newclient-over" class="newclient-over waves-effect waves-light btn-large" style="background-color: #fff; color: #000;font-size: 16px;">
                <i class="fa fa-plus" style="font-size: 16px"></i>
                USER
            </button>

            <div class="modal fade newclient" id="newclient-over" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class=" modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">New user for <?php echo $client->client_name ?> </h3>
                        </div>

                        <div class="row">
                            <form class="col s12 form-horizontal" action="<?php echo base_url() ;?>sys-admin/users/users-edit/new" method="post" id="form_user_edit" name="form_user_edit" enctype="multipart/form-data">
                                <?php if ( $validation_errors_text != "" ) : ?>

                                    <div class="row error" style="padding: 5px; margin: 5px;" >

                                        <?= $validation_errors_text ?>

                                    </div>

                                <? endif; ?>

                                <?php if ( $this->session->flashdata( 'validation_errors_text1' ) ) { ?>
                                    <div class="alert alert-danger"><?php echo stripslashes($this->session->flashdata( 'validation_errors_text1' )); ?></div>
                                    <?php
                                    $edit = 1;
                                    $form_data = explode('^',$this->session->flashdata( 'user_edit_new_post_data1' ));
                                    ?>
                                <?php }
                                else
                                {
                                    $edit = 0;
                                }
                                ?>

                                <input type="hidden" name="hdn_client_id" value="<?php echo $client_id;?>" id="hdn_client_id" />
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input type="text" name="data[first_name]" id="first_name" value="<?php echo ($edit == 1)?$form_data[0]:'';?>" class="validate"/>
                                        <label for="first_name">First Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">supervisor_account</i>
                                        <input type="text" name="data[last_name]" id="last_name" value="<?php echo ($edit == 1)?$form_data[1]:'';?>" class="validate"/>
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">phone</i>
                                        <input type="tel" name="data[phone]" id="phone" value="<?php echo ($edit == 1)?$form_data[2]:'';?>" class="validate"/>
                                        <label for="phone">Telephone</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">email</i>
                                        <input type="email" name="data[email]" id="email" value="<?php echo ($edit == 1)?$form_data[3]:'';?>"  class="validate required_form"  onchange="validateFormEnableOrDisable('form_client_edit2');"/>
                                        <label for="email">Email address</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">email</i>
                                        <input type="email" name="data[email1]" id="email1" value="<?php echo ($edit == 1)?$form_data[4]:'';?>" class="validate required_form" onChange="validateFormEnableOrDisable('form_client_edit2');"/>
                                        <label for="email1">Verify email address</label>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="modal-footer">
                            <div class="col-xs-12">
                                <ul class ="md-foot-bot">
                                    <li data-dismiss="modal">
                                        <button class="btn" onClick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'">CANCEL</button>
                                    </li>
                                    <li> <!-- class="create-contact-save " data-action="save"-->
                                        <!--<button class="btn-flat  disable_form_id_form_client_edit2" disabled> VERIFY </button> -->
                                        <button type="button" class="btn" onClick="javascript:onuserSubmit();" >VERIFY</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="grid-pinned" class="scrollspy">
                <h3 class="header">Pinned</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci assumenda at distinctio, dolorem exercitationem iure libero nesciunt nihil nisi odio odit pariatur placeat porro, repellendus, sapiente sunt totam unde! Accusamus.</p>
            </div>


            <!-- Grid associations -->
            <div class="row">
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
                        <div class="table-responsive">
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
                    </div>
                    <div id="test2" class="col s12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
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
        alert( "-1 ::" )
        $('#newclient-over').modal('show');
    }
</script>