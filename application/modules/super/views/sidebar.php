<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed super" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
           <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <?php 
            //make sure $segment and $view is defined
			
				/*echo "segment is : " . $segment;
				echo "<br/>view is : " . $view;*/
			
                $segment = (isset($this->uri->segments['2'])) ? $this->uri->segments['2'] : '';
                $view = explode("-", $segment);
                foreach ($menu as $key => $value):
                    if (is_array($value)): //is value is array, it means it is Menu Item
                        //sent active menu
                        $MenuActive = ($view['0'] == $menu[$key]['title']) ? 'active' : '';
						//echo '<pre>';print_r($menu);
                    ?>
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item <?= $MenuActive;?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="<?= $menu[$key]['icon'];?>"></span>
                            <span class="title"><?php echo lang($menu[$key]['title']);?></span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                    <?php
                        if (is_array($menu[$key])): //if $menu[$key] is arry, it means it is menu link
                            foreach ($menu[$key] as $key => $link):
                                if (is_array($link)): //if $link, ie  $key value is array
                                    $LinkActive = ($link['href'] == "/".$segment) ? 'active' : '';
                    ?>
				
                    <!-- SIDEBAR MENU LINK -->
                            <li class="nav-item <?= $LinkActive ;?>">
                                <a href="<?php echo base_url().$this->uri->segment('1').$link['href'];?>" class="nav-link ">
                                    <span class="<?php echo $link['icon'];?>"></span>
                                    <span class="title"><?php echo lang($link['title']);?></span>
                                </a>
                            </li>
                    <!-- END SIDEBAR MENU LINK -->
                            <?php
                                endif; //end if $link is array 
                            endforeach;//end $menu[$key] foreach
                            ?>
                    </ul> 
                </li>
                <!-- END SIDEBAR MENU -->
                <?php
                        endif; //end if $link is array 
                    endif;//end if $value is array 
                endforeach;//end $menu foreach
                ?>
				<? if ( !empty($user->user_id) ) : ?>
				<div class="collapsible collapsible-accordion super_border">
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header  super_link">
                            <?php
                            $ci = &get_instance();
                            $logged_user_title_name= $ci->session->userdata['logged_user_title_name'];
                            $logged_user_title_description= $ci->session->userdata['logged_user_title_description'];
//                            echo '<pre>$logged_user_title_name::'.print_r($logged_user_title_name,true).'</pre>';
                            $this->load->model('users_mdl');
                            $logged_user= $this->users_mdl->getUserRowById( $user->user_id, array('show_file_info'=> 1, 'image_width'=> 32, 'image_height'=> 32) );
                            ?>

                            <? if ( !empty($logged_user->image_url) and !empty($logged_user->image_path_width) and !empty($logged_user->image_path_height) ) { ?>
                                <span><img alt="" class="img-circle" src="<?= $logged_user->image_url;?>" width="<?= $logged_user->image_path_width ?>" height="<?= $logged_user->image_path_height ?>" /></span> <!-- class="img-circle" -->
                            <?php } ?>

                            <? if ( empty($logged_user->image_url) or empty($logged_user->image_path_width) or empty($logged_user->image_path_height) ) { ?>
                                <span><img alt="" class="img-circle" src="<?php echo base_url() ?>assets/avatar/avatar.png"></span>
                            <?php } ?>

                            <span class="title"><?php echo $user->first_name." ". $user->last_name . ( !empty($logged_user_title_description) ? ', <b><small>'.$logged_user_title_description . '</small></b>' : '' );?></span>
                        </a>
						
                        <div class="collapsible-body">
                            <ul>
								<li class="nav-item">
                                    <a href="<?php echo base_url()?>super/users-view" class="nav-link ">
                                        <span class="fa fa-folder-open custom" aria-hidden="true"></span>
                                        <span class="title_super">View Users</span>
                                    </a>
                                </li>
								
								<li class="nav-item">
                                    <a href="<?php echo base_url()?>super/users-add" class="nav-link ">
                                        <span class="fa fa-plus custom" aria-hidden="true"></span>
                                        <span class="title_super">Add Users</span>
                                    </a>
                                </li>
								
                                <li class="nav-item">
                                    <?/* <a href="<?= base_url($logged_user_title_name.'users/client-overview-profile-form');?>"> */?>
                                        <span class="fa fa-user"></span>
                                        <span class="title_super"><?= lang('my-profile'); ?><a class="super_pencil" href="<?php echo base_url()?>super/client-overview-profile-form"><span class="fa fa-pencil"></span></a></span>
                                 <?php    /* </a> */?>
                                </li>
                                <?php
                                $usersGroups = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user->user_id, 'status'=>'A','show_groups_description'=> 1) );
                                ?>

                                <li class="nav-item super_padding">
                                    <a href="<?php echo base_url()?>login/logout" class="nav-link ">
                                        <span class="fa fa-sign-out" aria-hidden="true"></span>
                                        <span class="title_super">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
				</div>
                <?php endif; ?>
        </ul>
		
		
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->