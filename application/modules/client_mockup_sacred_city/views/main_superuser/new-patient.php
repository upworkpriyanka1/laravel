<?php $ci = &get_instance();
echo link_tag('/assets/layouts/default/css/custom-client-overview.css');
?>

<!-- BEGIN MAIN PAGE -->
<main>
    <div class="page-content" id="new_patient">
        <div class="row">
            <div class="col s12">
                <div id="structure" class="section scrollspy">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="page-content">
                            <div class="row">
                                <!-- BEGIN FORM-->
                                <form action="" id="new_patient_form" method="POST" enctype="multipart/form-data">
                                    <?php echo validation_errors(); ?>
<!--                                        <input type="hidden" class="validate" value="--><?//=$user->id?><!--" name="data[id]">-->
                                    <div class="form-body">
                                        <!-- start Account-->
                                        <div class="row">
                                            <div class="pad-card">
                                                <div class="cards-container">
                                                    <!--start Name -->
                                                    <div class="card blue-grey darken-1">
                                                        <div class="card-content white-text">
                                                            <span class="card-title">Name</span>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-prefix" type="text" class="validate" value="" name="">

                                                                            <label for="pat-prefix" class="control-label"><?php echo lang('prefix')?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-first" type="text" class="validate" value="" name="">

                                                                            <label for="pat-first" class="control-label"><?php echo lang('first') ?>
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-middle" type="text" class="validate" value="" name="">

                                                                            <label for="pat-middle" class="control-label"><?php echo lang('middle') ?>
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-last" type="text" class="validate" value="" name="">

                                                                            <label for="pat-last" class="control-label"><?php echo lang('last')?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-suffix" type="text" class="validate" value="" name="">

                                                                            <label for="pat-suffix" class="control-label"><?php echo lang('suffix')?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-nickname" type="text" class="validate" value="" name="">

                                                                            <label for="pat-nickname" class="control-label"><?php echo lang('nickname')?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end Name-->


                                                    <!--start Attributes -->
                                                    <div class="card blue-grey darken-1">
                                                        <div class="card-content white-text">

                                                            <span class="card-title">Attributes</span>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-gender" type="text" class="validate" value="" name="">
                                                                            <label for="pat-gender" class="control-label"><?php echo lang('gender') ?>
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo lang('date-of-birth') ?><span class="required"> * </span></label>
                                                                        <input id="pat-date-of-birth" type="date" class="form-control"  placeholder="Date of Birth" name="">
                                                                    </div>
                                                                </div>

                                                               <div class="col-md-12">
                                                                   <div class="form-group">
                                                                       <div class="input-field">
                                                                           <input id="pat-soc-secur-number" type="text" class="validate" value="" name="">
                                                                           <label for="pat-soc-secur-number" class="control-label"><?php echo lang('soc-secur-number') ?>
                                                                               <span class="required"> * </span>
                                                                           </label>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end Attributes -->

                                                    <!--start Location -->

                                                    <div class="card blue-grey darken-1">
                                                        <div class="card-content white-text">
                                                            <span class="card-title">Location</span>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-address"  type="text"  class="validate" value="" name="" >
                                                                            <label for="pat-address" class="control-label"><?php echo lang('address') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-address2"  type="text"  class="validate" value="" name="">
                                                                            <label for="pat-address2" class="control-label"><?php echo lang('address2') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-state"  type="text"  class="validate" value="" name="">
                                                                            <label for="pat-state" class="control-label"><?php echo lang('state') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-zip"  type="number"  class="validate" value="" name="">
                                                                            <label for="pat-zip" class="control-label"><?php echo lang('zip') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-city"  type="text"  class="validate" name="">
                                                                            <label for="pat-city" class="control-label"><?php echo lang('country') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group input-field">
                                                                        <div class="col-md-6" style="padding-left: 0">
                                                                            <table>
                                                                                <tr>
                                                                                    <td style="width: 98%">
                                                                                        <input type="text" id="pat_phone" value="" name="" class="form-control  " maxlength="50" />
                                                                                        <label for="pat_phone" class=""><?php echo lang('phone') ?>
                                                                                            <span class="required">*</span>
                                                                                        </label>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div><!-- ./col -->
                                                                        <div class="input-field col-md-6">
                                                                            <input type="text" list="patients-phone" value="" name="">
                                                                            <datalist id="patients-phone">
                                                                                <option value="Home">
                                                                                <option value="Work">
                                                                                <option value="Other">
                                                                            </datalist>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- ./row -->

                                                        </div>

                                                    </div>
                                                    <!-- end Location-->


                                                    <!--start Referred -->
                                                    <div class="card blue-grey darken-1">
                                                        <div class="card-content white-text">
                                                            <span class="card-title">Referred by</span>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-referred1" type="radio" class="with-gap" name="referred">
                                                                            <label for="pat-referred1"><?php echo lang('me')?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-referred2" type="radio" class="with-gap" name="referred">
                                                                            <label for="pat-referred2"><?php echo lang('doctor')?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-referred3" type="radio" class="with-gap" name="referred">
                                                                            <label for="pat-referred3"><?php echo lang('social-worker')?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end Referred -->

                                                    <!--start Note -->
                                                    <div class="card blue-grey darken-1">
                                                        <div class="card-content white-text">
                                                            <span class="card-title">Note</span>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <textarea id="textarea1" class="materialize-textarea" data-length="200"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 text-center ">
                                                    <button class="btn"><a href="" style="color: #fff;"> CANCEL</a></button>
                                                    <button class="btn" name="submit" type="submit">+CONTACT</button>
                                                    <button class="btn" name="submit" type="submit">SAVE</button>
                                                    <button class="btn" name="submit" type="submit"><a href="new-patient-verification" style="color: #fff;"> SUBMIT</a></button>

                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>

                        </div><!-- ./page-conten -->
                    </div>
                    <!-- END CONTAINER ./page-content-wrapper -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- END MAIN PAGE -->

