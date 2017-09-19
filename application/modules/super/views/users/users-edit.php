 <?php
         
  if (isset($usertoedit) && count($usertoedit)>0){
    // print_r($usertoedit);
     ?>


    <!--<div class="page-content" id="top_container">-->
        <div class="row">
            <div class="col s12">
               <!-- <div id="structure" class="section scrollspy"> -->
                    <!-- BEGIN CONTENT -->
                   <!-- <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY --
                        <div class="page-content">-->

                            <div class="clearfix"></div>
                           <!-- <div class="col-xs-12">-->
                                <div id="profile-form">

<div class="row">
<!-- BEGIN FORM-->
<form action="<?php echo current_url();?>/update" id="new_user_form" method="POST" enctype="multipart/form-data">
<?php echo validation_errors(); ?>
<div class="alert alert-danger display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                           </div>
                           <div class="alert alert-success display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_updated');?>
                           </div>
<input type="hidden" class="validate" value="<?=$userInfoById->id?>" name="data[id]">
<div class="form-body">
<!-- start Account-->
<div class="row">
<div class="pad-card">
    <div class="cards-container">
        <div class="card">
            <div class="card-content ">
                <span class="card-title">Account</span>
                <!-- User name -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-name" type="text" class="validate" value="<?= $userInfoById->username;?>" name="data[username]">
                                    <input type="hidden" name="ajaxpost" value="1">
                                <label for="us-name" class="control-label"><?php echo lang('user_name') ?>
                                    <span class="required"> * </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="password" type="password" class="validate" name="data[password]">

                                <label for="us-pass" class="control-label"><?php echo lang('password') ?>
                                    <span class="required"> * </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="password_confirm" type="password" class="" name="data[password_confirm]">

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
        <div class="card ">
            <div class="card-content ">
                <span class="card-title">General</span>
                <!-- User names -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-fr-nm" type="text" class="validate" value="<?=$userInfoById->first_name?>" name="data[first_name]">
                                <label for="us-fr-nm" class="control-label"><?php echo lang('first_name') ?>
                                    <span class="required"> * </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-md-nm" type="text" class="validate" value="<?=$userInfoById->middle_name?>" name="data[middle_name]">
                                <label for="us-md-nm" class="control-label"><?php echo lang('middle_name') ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-fr-nm" type="text" class="validate" value="<?=$userInfoById->last_name?>" name="data[last_name]">
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
        <div class="card">
            <div class="card-content">
                <span class="card-title">Contact</span>
                <!-- start Contact-->
                <!-- user address -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-adr"  type="text"  class="validate" value="<?=$userInfoById->address1?>" name="data[address1]">
                                <label for="us-adr" class="control-label"><?php echo lang('address') ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-adr2"  type="text"  class="validate" value="<?=$userInfoById->address2?>" name="data[address2]">
                                <label for="us-adr2" class="control-label"><?php echo lang('address2') ?></label>
                            </div>
                        </div>
                    </div>

                <!-- City-state-zip-->

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-city"  type="text"  class="validate" value="<?=$userInfoById->city?>" name="data[city]">
                                <label for="us-city" class="control-label"><?php echo lang('city') ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-state"  type="text"  class="validate" value="<?=$userInfoById->state?>" name="data[state]">
                                <label for="us-state" class="control-label"><?php echo lang('state') ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-field">
                                <input id="us-zip"  type="number"  class="validate" value="<?=$userInfoById->zip?>" name="data[zip]">
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
                                            <input type="text" id="us_phone" value="<?=$userInfoById->phone?>" name="data[phone]" class="form-control required_form " maxlength="50" onChange="javascript:checkPhonesVisibilty(); validateFormEnableOrDisable('form_client_edit');" " />
                                            <label for="us_phone" class=""><?php echo lang('phone') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                        </td>
                                    </tr>
                                </table>
                            </div><!-- ./col -->
                            <div class="input-field col-md-6 rem-sel">
                                <input type="text" list="phonename8" value="<?=$userInfoById->phone_type?>" name="data[phone_type]">
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
                                <input type="text"  id="us_phone-2" name="data[phone2]" class="form-control " maxlength="50" onChange="javascript:checkPhonesVisibilty(); " />
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
                                <input type="text" id="us_phone_3"  name="data[phone3]" class="form-control " maxlength="50" onChange="javascript:checkPhonesVisibilty(); " />
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
                            <input id="us-email" type="email" class="validate" value="<?=$userInfoById->email?>" name="data[email]">
                            <label for="us-email" data-error="wrong" data-success="right">Email</label>
                        </div>
                    </div>
                </div>

                <!-- end Contact-->
            </div>

        </div>
        <div class="card">
            <div class="card-content">
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
        <div class="card">
            <div class="card-content">
                <span class="card-title">Langauge</span>
                <!--start langauge-->
                <div class="row">
                    <div class="col-md-12 add-row-able" next-row-class="lang-second-row">
                    <a style="float:right;" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
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
        <div class="card">
            <div class="card-content">
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

        <!--</div>-->
    </div>
</div>

<div class="col-xs-12 text-center sev-canc-mock">
    <button class="btn"><a href="/super/users-view<?=$userInfoById->id?>" style="color: #fff;"> CANCEL</a></button>
    <button class="btn" name="submit" type="submit">SAVE</button>
</div>
</div>

</div>
</form>
<!-- END FORM-->
</div>

<!--</div>
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
                                                <input id="email" type="email" class="validate required_form" onChange="validateFormEnableOrDisable('form_client_edit2');"/>
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
                <!--</div> -->
            </div>
        </div>
    </div>

<?php } ?>