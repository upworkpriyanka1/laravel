<?php $ci = &get_instance();
echo link_tag('/assets/layouts/default/css/custom-client-overview-view.css');

?>

<script type="text/javascript">
    /*<![CDATA[*/
    var client_id= '<?= ( !empty($client->cid) ? $client->cid : '' ) ?>'
    var base_url= '<?= base_url() ?>'
    var is_insert= '<?= $is_insert ?>'

    /*]]>*/
</script>


<div class="col s12 m9 l10">
    <div>
        <div id="grid-pinned" class="section scrollspy">
            <h3 class="header">Pinned</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci dicta, eaque error fugit inventore magni minima perspiciatis quos reiciendis sit tempora tempore, voluptas? Delectus impedit nemo odit sunt vitae!</p>
        </div>


        <!-- Grid associations -->
        <div id="grid-associations" class="section scrollspy">
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

        <div id="grid-history" class="section scrollspy">
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