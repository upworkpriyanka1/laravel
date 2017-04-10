<?php $ci = &get_instance();
echo link_tag('/assets/layouts/default/css/custom-users-overview-view.css');
?>

<script type="text/javascript">
    /*<![CDATA[*/
    var user_id= '<?= $user_id ?>'
    var is_insert= '<?= $is_insert ?>'
    var base_url= '<?= base_url() ?>'

    /*]]>*/
</script>

<div id="users-overview">
    <div class="row" style="background-color: #fff"">
    <div class="col s12 m9 l10">
        <div>


            <div id="grid-pinned" class="scrollspy">
                <h3 class="header">Clients</h3>

                <div class="use-over">
                    <div class="col-xs-12">
                        <form action="<?php echo base_url() ;?>sys-admin/users/users-edit/<?= ( $is_insert ? "new" : $user_id ) ?><?= $page_parameters_with_sort ?>" method="post" id="form_user_edit" name="form_user_edit" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $ci->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                            <input type="hidden" id="filter_username" name="filter_username" value="<?=$filter_username?>">
                            <input type="hidden" id="filter_user_active_status" name="filter_user_active_status" value="<?=$filter_user_active_status?>">
                            <input type="hidden" id="filter_zip" name="filter_zip" value="<?=$filter_zip?>">
                            <input type="hidden" id="filter_user_group_id" name="filter_user_group_id" value="<?=$filter_user_group_id?>">
                            <input type="hidden" id="filter_created_at_from" name="filter_created_at_from" value="<?=$filter_created_at_from?>">
                            <input type="hidden" id="filter_created_at_till" name="filter_created_at_till" value="<?=$filter_created_at_till?>">
                            <input type="hidden" id="filter_created_at_till" name="filter_created_at_till" value="<?=$filter_created_at_till?>">
                            <input type="hidden" id="filter_created_at_till" name="filter_created_at_till" value="<?=$filter_created_at_till?>">
                            <input type="hidden" name="user" value="<?=$user_id?>">

                            <div class="row">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                                </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> <?= lang('form_updated');?>
                                </div>
                            </div>

                            <?php if ( $validation_errors_text != "" ) : ?>
                                <div class="row error" style="padding: 5px; margin: 5px;" >
                                    <?= $validation_errors_text ?>
                                </div>
                            <? endif; ?>

                            <?php if ( !$is_insert ) : ?>
                                <input type="hidden" name="data[id]" id="id" value="<?= (!empty($editable_user->id) ? $editable_user->id:''); ?>" class="form-control" readonly />
                            <?php endif; ?>
                            <!-- User First & Middle name -->
                            <div class="row">
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[first_name]", ' has-error ')?>">
                                    <label for="first_name" class="col-md-4 control-label" ><?php echo lang('first_name') ?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[first_name]" id="first_name" value="<?= ( !empty($editable_user->first_name) ? $editable_user->first_name : '' ); ?>" class="form-control" maxlength="50"  />
                                    </div>
                                </div>

                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[middle_name]", ' has-error ')?>">
                                    <label for="middle-name" class="col-md-4 control-label">Middle Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[middle_name]" id="middle-name" value="<?= ( !empty($editable_user->middle_name) ? $editable_user->middle_name : '' ); ?>" class="form-control" maxlength="50">
                                    </div>
                                </div>
                            </div>

                            <!-- User Last name & Title -->
                            <div class="row">
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[last_name]", ' has-error ')?>">
                                    <label for="last_name" class="col-md-4 control-label"><?php echo lang('last_name') ?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[last_name]" id="last_name" value="<?= ( !empty($editable_user->last_name) ? $editable_user->last_name : '' ); ?>" class="form-control" maxlength="50" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="col-md-4 control-label"><?php echo lang('title') ?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[title]" id="title" value=""  class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- User Client & status -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="client" class="col-md-4 control-label">Client </label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="client" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label">Status</label>
                                    <div class="input-field col-md-8">
                                        <select class="form-control" id="user_active_status" name="data[user_active_status]">
                                            <?php foreach( $userActiveStatusValueArray as $next_key=>$next_User_Status ) { ?>
                                                <option value="<?= $next_User_Status['key'] ?>" <?= ( !empty($editable_user->user_active_status) and $editable_user->user_active_status == $next_User_Status['key'] ) ? "selected" : "" ?> ><?= $next_User_Status['value'] ?></option>
                                            <?php } ?>
<!--                                            <option>active</option>-->
<!--                                            <option>inactive</option>-->
<!--                                            <option>online</option>-->
<!--                                            <option>offline</option>-->
<!--                                            <option>last login</option>-->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--User Phone-->
                            <div class="row">
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[phone]", ' has-error ')?>">
                                    <label for="phone" class="col-md-4 control-label"><?php echo lang('phone')?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[phone]" id="phone" value="<?= ( !empty($editable_user->phone) ? $editable_user->phone : '' ); ?>" class="form-control" maxlength="20" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone-type" class="col-md-4 control-label">Phone Type</label>
                                    <div class="input-field col-md-8">
                                        <select class="form-control" id="user_phone_type"  name="data[user_phone_type]">
                                            <?php foreach( $userPhoneTypeArray as $next_key=>$next_User_Status ) { ?>
                                                <option value="<?= $next_User_Status['key'] ?>" <?= ( !empty($editable_user->user_active_status) and $editable_user->user_active_status == $next_User_Status['key'] ) ? "selected" : "" ?> ><?= $next_User_Status['value'] ?></option>
                                            <?php } ?>
<!--                                            <option value="Home">-->
<!--                                            </option><option value="Work">-->
<!--                                            </option><option value="Other">-->
<!--                                            </option>-->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- User address1 & address2 -->
                            <div class="row">
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[address1]", ' has-error ')?>">
                                    <label for="address1" class="col-md-4 control-label"><?php echo lang('user_address1')?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[address1]" id="address1" value="<?= ( !empty($editable_user->address1) ? $editable_user->address1 : '' ); ?>" class="form-control" maxlength="100" />

                                    </div>
                                </div>
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[address2]", ' has-error ')?>">
                                    <label for="address2" class="col-md-4 control-label"><?php echo lang('user_address2')?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[address2]" id="address2" value="<?= ( !empty($editable_user->address2) ? $editable_user->address2 : '' ); ?>"  class="form-control" maxlength="100" />

                                    </div>
                                </div>
                            </div>
                            <!-- User City -->
                            <div class="row">
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[city]", ' has-error ')?>">
                                    <label for="city" class="col-md-4 control-label"><?php echo lang('city')?></label>
                                    <div class="col-md-8">
                                        <input type="text" id="city" name="data[city]" value="<?= ( !empty($editable_user->city) ? $editable_user->city : '' );?>" class="form-control" maxlength="100" />
                                    </div>
                                </div>
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[zip]", ' has-error ')?>">
                                    <label for="zip" class="col-md-4 control-label"><?php echo lang('zip')?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[zip]" value="<?= ( !empty($editable_user->zip) ? $editable_user->zip : '' ) ;?>" class="form-control" maxlength="50" />
                                    </div>
                                </div>
                            </div>
                            <!-- User State -->
                            <div class="row">
                                <div class="col-md-6 <?= $this->common_lib->set_field_error_tag("data[state]", ' has-error ')?>">
                                    <label for="state" class="col-md-4 control-label"><?php echo lang('state')?></label>
                                    <div class="col-md-8">
                                        <input type="text" name="data[state]" value="<?= ( !empty($editable_user->state) ? $editable_user->state : '' )?>" class="form-control" maxlength="50" />

                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label for="pat-assig" class="col-md-4 control-label">Patient Assignments</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="pat-assig" value="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- User Picture 1installes status -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="file-field input-field">
                                        <div class="col-md-4">
                                            <div class="btn">
                                                <span>Picture 1</span>
                                                <input type="file" id="avatar" name="avatar">
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
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label">App installed status</label>
                                    <div class="input-field col-md-8">
                                        <select class="form-control">
                                            <option>phone make / model</option>
                                            <option>OS (version)</option>
                                            <option>Time/date app was installed log</option>
                                            <option value="">Time/date app was uninstalled log</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class=" btn-group  editor_btn_group " >

                                    <div class="col-sm-3 col-xs-12 ">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>


                <table>
                    <thead>
                    <tr>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Last Login</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>Alvin</td>
                        <td>Hi</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>Alan</td>
                        <td>Hello</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>Jonathan</td>
                        <td>Hi</td>
                        <td>5</td>
                    </tr>
                    </tbody>
                </table>

            </div>



            <!-- Grid associations -->
            <div id="grid-associations" class="scrollspy">
                <h3 class="header">Associations</h3>
                <nav class="nav-extended">
                    <div class="nav-content">
                        <ul class="tabs tabs-transparent">
                            <li class="tab"><a href="#test3" class="active">Users</a></li>
                            <li class="tab"><a href="#test4">Patients</a></li>
                        </ul>
                    </div>
                </nav>
                <div id="test3" class="col s12">

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
                <div id="test4" class="col s12">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
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
            <div>
                <ul class="section table-of-contents">
                    <li><a href="#grid-pinned" class="active">Clients</a></li>
                    <li><a href="#grid-associations" class="">Associations</a></li>
                    <li><a href="#grid-history" class="">History</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
