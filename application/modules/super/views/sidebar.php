
<div class="container">
    <a href="#" id="artash" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</div>
<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(-100%);">
    <li class="logo cl-logo"">
        <a href="/super" class="brand-logo ">
            <!--<img src="<?= base_url('assets/img/logo.png');?>" alt="logo" class="logo-default" /> -->
			<span class="logo-default"> Client Name </span>
        </a>
    </li>
			<li class="no-padding">
			   <ul class="collapsible collapsible-accordion">
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
                    ?>
                    <!-- SIDEBAR MENU -->
                    <li class="nav-item <?= $MenuActive;?>">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
                            <span class="<?= $menu[$key]['icon'];?>"></span>
                            <span class="title"><?php echo lang($menu[$key]['title']);?></span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
						<div class="collapsible-body" >
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
								<?php if($link['title'] == "my-profile"){?>
									<span style="margin-left:10%;"><i class="fa fa-pencil" aria-hidden="true"></i></span>
									<?php }?>
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
			
				<?php 
								
				
				if ( !empty($userInfoById->id) ) : ?>
				
				
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
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

                            <span class="title"><?php echo $userInfoById->first_name." ". $userInfoById->last_name . ( !empty($logged_user_title_description) ? ', <b><small>'.$logged_user_title_description . '</small></b>' : '' );?></span>
							
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li class="nav-item profile-li">
                                    <a href="<?= base_url($logged_user_title_name.'/sys-admin/users/users-overview');?>">
                                        <span class="fa fa-user"></span>
                                        <span><?= lang('my-profile'); ?></span>
                                    </a>
                                    <a class="editpencil" href="<?= base_url($logged_user_title_name.'/super/users-edit');?>">
                                    <span style="margin-left:10%;"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                    </a>
                                </li>                          
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
				<li class="nav-item">
                                    <a href="<?php echo base_url()?>login/logout" class="nav-link ">
                                        <span class="fa fa-sign-out" aria-hidden="true"></span>
                                        <span>Logout</span>
                                    </a>
                                </li>
                  
								
				</ul>				
			</li>					
        </ul>
        <!-- END SIDEBAR MENU -->
    
    <!-- END SIDEBAR -->

<!-- END SIDEBAR -->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript" ></script>

<script>
    $(document).ready(function(){
          $("body").on('click','.btn-rem',function(){
//              console.log($(this));
            $(this).parent().remove();
         });

        $('input[name=name]').keyup(function() {
            var nameInput = $(this).val();
            if(nameInput !== ""){
                $('.btn-rem-name').css('display', 'block');
            }
        });
    });

</script>