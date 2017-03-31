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
                        <form action="#" method="post">
                            <!-- User First & Middle name -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name" class="col-md-4 control-label">First Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="first_name" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="middle-name" class="col-md-4 control-label">Middle Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="middle-name" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- User Last name & Title -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="last_name" class="col-md-4 control-label">Last Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="last_name" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="col-md-4 control-label">Title</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="title" value=""  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- User Picture 1 & Picture2 -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="file-field input-field">
                                        <div class="col-md-4">
                                            <div class="btn">
                                                <span>Picture 1</span>
                                                <input type="file">
                                            </div>
                                        </div>

                                        <div class="file-path-wrapper col-md-8">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="file-field input-field">
                                        <div class="col-md-4">
                                            <div class="btn">
                                                <span>Picture 2</span>
                                                <input type="file">
                                            </div>
                                        </div>

                                        <div class="file-path-wrapper col-md-8">
                                            <input class="file-path validate" type="text">
                                        </div>
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
                                        <select class="form-control">
                                            <option>active</option>
                                            <option>inactive</option>
                                            <option>online</option>
                                            <option>offline</option>
                                            <option>last login</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--Phone-->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone" class="col-md-4 control-label">Phone</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="phone" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone-type" class="col-md-4 control-label">Phone Type</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="phone-type" value="" class="form-control">
                                    </div>
                                </div>

                            </div> <!-- ./row -->
                            <!--END Phone-->

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2 control-label">App installed status</label>
                                    <div class="input-field col-md-10">
                                        <select class="form-control">
                                            <option>phone make / model</option>
                                            <option>OS (version)</option>
                                            <option>Time/date app was installed log</option>
                                            <option value="">Time/date app was uninstalled log</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="address-1" class="col-md-4 control-label">Address 1</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="address-1" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="address-2" class="col-md-4 control-label">Address 2</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="address-2" value="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="city" class="col-md-4 control-label">City</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="city" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="zip" class="col-md-4 control-label">Zip</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="zip" value="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="state" class="col-md-4 control-label">State</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="state" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="pat-assig" class="col-md-4 control-label">Patient Assignments</label>
                                    <div class="col-md-8">
                                        <input type="text" name="" id="pat-assig" value="" class="form-control">
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
            <!--                                    <div class="buysellads hide-on-small-only">-->
            <!--                                        <!-- CarbonAds Zone Code -->
            <!--                                        <script async="" type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&amp;serve=C6AILKT&amp;placement=materializecss" id="_carbonads_js"></script>-->
            <!---->
            <!--                                    </div>-->
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
<script src="/assets/global/js/users-overview-view.js"></script>