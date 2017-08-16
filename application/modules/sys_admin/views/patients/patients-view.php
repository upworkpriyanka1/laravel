<?php $ci = &get_instance();
echo link_tag('assets/global/plugins/picker/classic.css');
echo link_tag('assets/global/plugins/picker/classic.date.css');

?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="page-content" style="min-height:576px">
                            <div class="row">
                                <!-- BEGIN FORM-->
                                <form action="" id="new_patient_form" method="POST" enctype="multipart/form-data">
                                    <!--                                        <input type="hidden" class="validate" value="--><!--" name="data[id]">-->
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
                                                                            <input id="pat-prefix" type="text" class="validate" value="" name="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">

                                                                            <label for="pat-prefix" class="control-label">Prefix</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-first" type="text" class="validate" value="" name="">

                                                                            <label for="pat-first" class="control-label">First                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-middle" type="text" class="validate" value="" name="">

                                                                            <label for="pat-middle" class="control-label">Middle                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-last" type="text" class="validate" value="" name="">

                                                                            <label for="pat-last" class="control-label">Last</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-suffix" type="text" class="validate" value="" name="">

                                                                            <label for="pat-suffix" class="control-label">Suffix</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-nickname" type="text" class="validate" value="" name="">

                                                                            <label for="pat-nickname" class="control-label">Nickname</label>
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
                                                                            <label for="pat-gender" class="control-label">Gender                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Date of Birth<span class="required"> * </span></label>
                                                                        <input id="pat-date-of-birth" type="date" class="form-control" placeholder="Date of Birth" name="">
                                                                    </div>
                                                                </div>

                                                               <div class="col-md-12">
                                                                   <div class="form-group">
                                                                       <div class="input-field">
                                                                           <input id="pat-soc-secur-number" type="text" class="validate" value="" name="">
                                                                           <label for="pat-soc-secur-number" class="control-label">Social Security Number                                                                               <span class="required"> * </span>
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
                                                                            <input id="pat-name" type="text" class="validate" value="" name="">
                                                                            <label for="pat-name" class="control-label">Name</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <div class="input-field">
                                                                                <select>
                                                                                    <option value="" disabled="" selected="">Type</option>
                                                                                    <option value="1">Primary Residence</option>
                                                                                    <option value="2"> House,Primary Residence</option>
                                                                                    <option value="3"> Apartment/Community</option>
                                                                                    <option value="4">Independent Living Communities</option>
                                                                                    <option value="5">Assisted Living</option>
                                                                                    <option value="6">Nursing Homes</option>
                                                                                    <option value="7">Alzheimer's Care</option>
                                                                                    <option value="8">Residential Care Homes</option>
                                                                                    <option value="9">Respite Care</option>
                                                                                    <option value="10">Home Care</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-address" type="text" class="validate" value="" name="">
                                                                            <label for="pat-address" class="control-label">Address</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-address2" type="text" class="validate" value="" name="">
                                                                            <label for="pat-address2" class="control-label">Suite, #, Unit</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-state" type="text" class="validate" value="" name="">
                                                                            <label for="pat-state" class="control-label">State</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-zip" type="number" class="validate" value="" name="">
                                                                            <label for="pat-zip" class="control-label">Zip</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-city" type="text" class="validate" name="">
                                                                            <label for="pat-city" class="control-label">Country</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group input-field">
                                                                        <div class="col-md-6" style="padding-left: 0">
                                                                            <table>
                                                                                <tbody><tr>
                                                                                    <td style="width: 98%">
                                                                                        <input type="text" id="pat_phone" value="" name="" class="form-control  " maxlength="50">
                                                                                        <label for="pat_phone" class="">Phone                                                                                            <span class="required">*</span>
                                                                                        </label>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </div><!-- ./col -->
                                                                        <div class="input-field col-md-6">
                                                                            <input type="text" list="patients-phone" value="" name="">
                                                                            <datalist id="patients-phone">
                                                                                <option value="Home">
                                                                                </option><option value="Work">
                                                                                </option><option value="Other">
                                                                            </option></datalist>
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
                                                                            <label for="pat-referred1">Me</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-referred2" type="radio" class="with-gap" name="referred">
                                                                            <label for="pat-referred2">Doctor</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-field">
                                                                            <input id="pat-referred3" type="radio" class="with-gap" name="referred">
                                                                            <label for="pat-referred3">Social Worker</label>
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

                                                <div class="col-xs-12 card-bottom text-center ">
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
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>