<!-- BEGIN SIDEBAR -->
<ul id="nav-mobile" class="page-sidebar-menu side-nav fixed">
    <li class="logo">
        <a href="./"><img src="<?= base_url('assets/img/logo.png');?>" alt="logo" class="logo-default" /></a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <?php 
            //make sure $segment and $view is defined
            $segment = (isset($this->uri->segments['2'])) ? $this->uri->segments['2'] : '';
            $view = explode("-", $segment);
            foreach ($menu as $key => $value):
                if (is_array($value)): //is value is array, it means it is Menu Item
                    //sent active menu
                    $MenuActive = ($view['0'] == $menu[$key]['title']) ? 'active' : '';
                ?>
                <!-- SIDEBAR MENU -->
                <li class="nav-item <?= $MenuActive;?>">
                    <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                        <span class="<?= $menu[$key]['icon'];?>"></span>
                        <span class="title"><?php echo lang($menu[$key]['title']);?></span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <div class="collapsible-body">
                    <ul>
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
                    </div>
                </li>
                <!-- END SIDEBAR MENU -->
            <?php
                    endif; //end if $link is array 
                endif;//end if $value is array 
            endforeach;//end $menu foreach
            ?>
            <?php if ( !empty($user->user_id) ) : ?>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                    <?php 		$this->load->model('users_mdl');
                    $logged_user= $this->users_mdl->getUserRowById( $user->user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
                     ?>

	                <? if ( !empty($logged_user->image_url) and !empty($logged_user->image_path_width) and !empty($logged_user->image_path_height) ) { ?>
                    <span><img alt="" class="img-circle" src="<?= $logged_user->image_url;?>" width="<?= $logged_user->image_path_width ?>" height="<?= $logged_user->image_path_height ?>" /></span> <!-- class="img-circle" -->
		            <?php } ?>

	                <? if ( empty($logged_user->image_url) or empty($logged_user->image_path_width) or empty($logged_user->image_path_height) ) { ?>
		                <span><img alt="" class="img-circle" src="<?php echo base_url() ?>assets/avatar/avatar.png"></span>
	                <?php } ?>

	                <span class="title"><?php echo $user->first_name." ". $user->last_name;?></span>
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li class="nav-item">
                            <a href="<?= base_url($this->uri->segment(1).'/profile');?>">
                                <span class="fa fa-user"></span>
                                <span><?= lang('my-profile'); ?></span>
                            </a>
                        </li>
                        <?php if ($user->group_title !="g-user"){?>
                            <li class="nav-item">
                                <a href="<?php echo base_url($user->job_name)?>">
                                    <span class="fa fa-user"></span> 
                                    <span><?php echo lang($user->job_title); ?></span>
                                </a>
                            </li>
                            <?php if ($user->job_name !=$group){?>
                            <li class="nav-item">
                                <a href="<?php echo base_url($group)?>">
                                    <span class="fa fa-user"></span> 
                                    <span><?= lang($user->group_title);?></span>
                                </a>
                            </li>
                            <?php }
                        } ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url()?>login/logout" class="nav-link ">
                                <span class="fa fa-sign-out" aria-hidden="true"></span>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php endif; ?>
        </ul>
    </li>
</ul>