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

<div id="users-overview" class="gridhead">
    <div class="row">
    <div class="col s12 m9 l10">
        <div>
            <?php
            $message = $this->session->flashdata('massege');
            if($message && $message != ''){ ?>
            <div class="massege" style="background-color: #fff;padding: 10px;margin-bottom: 10px"><?=$this->session->flashdata('massege');?></div>
            <?php } ?>
            
                <!--<div class="edit">
                    <a  href="/client-mockup-sacred-city/superuser/client-overview-profile-form/<?php echo $editable_user->id ?>/" class="btn-floating btn-large waves-effect waves-light " style="border-radius: 50% !important;"><i class="large material-icons">edit</i></a>
                </div>-->

                <div class="user-st stat">
                    <h4>Status</h4>

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="status_but_name"><?=$user_status;?></span><span class="caret"></span></button>
                        <ul class="dropdown-menu user-status-parent">
                            <li class="user-status <?=($editable_user->user_status == "P") ? "disabled":''?>"><a href="javascript:void(0)">Pending</a></li>
                            <li class="user-status <?=($editable_user->user_status == "A") ? "disabled":''?>"><a href="javascript:void(0)">Active</a></li>
                            <li class="user-status <?=($editable_user->user_status == "I") ? "disabled":''?>"><a href="javascript:void(0)">Inactive</a></li>
                        </ul>
                    </div>
                </div>

                <div id="user-status-change-confirm-modal" class="modal fade in">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <input type="hidden" name="id" value="<?= $editable_user->id; ?>">
                                <h4> Change <?= $editable_user->username; ?> status to <span class="user-change-status-title"></span> ? </h4>
                                <div class="btn-group">
                                    <button class="btn btn-danger" data-dismiss="modal" style="margin-right: 10px">No</button>
                                    <input type="button" class="btn btn-primary user_status_confirm" value="yes">
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dalog -->
                </div><!-- /.modal -->

                <!--<h3 class="header">Clients</h3>





                <div class="table-responsive">
                    <table style="background-color: #fff;" class="table table-striped table-bordered table-hover  order-column">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(empty($clients)):?>
                        <tr><td colspan="4">No client association</td></tr>
                        <?php else:?>
                        <?php  foreach($clients as $client):  ?>
                            <tr>
                                <td> <a href="<?= base_url('/sys-admin/client/' . $client->cid . '/'); ?>">
                                        <?php echo $client->client_name ?>
                                    </a></td>
                                <td><?php echo $client->group->name?></td>
                                <td><?php echo $client->client_active_status ?></td>
                                <td><?php echo $client->created_at?></td>
                            </tr>
                        <?php  endforeach;  ?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>

<!-               <div id="tab_user_related_clients" class="col s12">-->
<!--                    <div id="div_load_user_related_clients">-->
<!---->
<!--                    </div>-->
<!--                </div>

            </div> -->
            <!-- Grid History -->
            
            
            <!-- Schedule section -->
			<div id="grid-pinned" class="scrollspy">
                <h3 class="header" id="assgn">Schedule</h3>
                <div class="row">
                 <div class="col s12 m12">
				 <div class="schedule">
                 <img src="/assets/img/calendar-img.jpg" alt="Calendar Image" />
				 </div>
                 </div>
                </div>
			 </div>	
				
            <!-- end schedule section -->
             <!-- Assignment section -->
			 <div id="grid-assignment" class="scrollspy">
                    <h3 class="header" id="assgn">Assignments</h3>
                      <div class="row assdiv">
      <div class="col s12 m6" id="leftalgn">
        <div class="card-panel teal">
          <span class="card-title">Card Title</span>
         <p><span class="white-text"> I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
          </span></p>
        </div>
      </div>
       <div class="col s12 m6" id="rightalgn">
        <div class="card-panel teal">
         <span class="card-title">Card Title</span>
         <p><span class="white-text"> I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
          </span></p>
        </div>
      </div>
       <div class="col s12 m6" id="leftalgn">
        <div class="card-panel teal">
        <span class="card-title">Card Title</span>
         <p><span class="white-text"> I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
          </span></p>
        </div>
      </div>
       <div class="col s12 m6" id="rightalgn">
        <div class="card-panel teal">
        <span class="card-title">Card Title</span>
         <p><span class="white-text"> I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
          </span></p>
        </div>
      </div>
    </div>
	    </div>
            <!-- end assignment section -->
            <!-- drafts section -->
			<div id="grid-drafts" class="scrollspy">
        <h3 class="header" id="assgn">Drafts</h3>
                      <div class="row assdiv">
      <div class="col s12 m6">
        <div class="card-panel teal">
          <span class="card-title">Card Title</span>
        </div>
      </div>
       <div class="col s12 m6">
        <div class="card-panel teal">
         <span class="card-title">Card Title</span>
        </div>
      </div>
       <div class="col s12 m6">
        <div class="card-panel teal">
        <span class="card-title">Card Title</span>
        </div>
      </div>
       <div class="col s12 m6">
        <div class="card-panel teal">
        <span class="card-title">Card Title</span>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="card-panel teal">
        <span class="card-title">Card Title</span>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="card-panel teal">
        <span class="card-title">Card Title</span>
        </div>
      </div>
    </div>
	     </div>
            <!-- end drafts section -->
			<div id="grid-history" class="scrollspy">
                <h3 class="header">Activity</h3>


                <div class="row">
				<div class="col s12 m12">
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
        <div class="toc-wrapper pin-top" id="toc-wrap" style="top: 140px; position:fixed;">
            <div>
                <ul class="section table-of-contents">
                    
                   	<li><a href="##grid-pinned" class="active">Schedule</a></li>
					<li><a href="#grid-assignment" class="">Assignment</a></li>
					<li><a href="#grid-drafts" class="">Drafts</a></li>
					<li><a href="#grid-history" class="">Activity</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script>
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        var width = $(window).width();
        var grid_pinned = $('#grid-pinned').offset().top - 300;
        var grid_assignment = $('#grid-assignment').offset().top - 300;
        var grid_drafts = $('#grid-drafts').offset().top - 300;
        var grid_history = $('#grid-history').offset().top - 300;
       
        // Do something
//        alert('wwwwww');
//        console.log(scroll+' - '+width+" - "+grid_responsive);
        if(scroll >= grid_history){
            $('.table-of-contents li a').removeClass('active');
            $('.table-of-contents li a[href="#grid-history"]').addClass('active');
        }else if(scroll >= grid_drafts) {
            $('.table-of-contents li a').removeClass('active');
            $('.table-of-contents li a[href="#grid-drafts"]').addClass('active');
        }else if(scroll >= grid_assignment) {
            $('.table-of-contents li a').removeClass('active');
            $('.table-of-contents li a[href="#grid-assignment"]').addClass('active');
        }else if(scroll >= grid_pinned) {
            $('.table-of-contents li a').removeClass('active');
            $('.table-of-contents li a[href="#grid-pinned"]').addClass('active');
        }

    });

</script>

