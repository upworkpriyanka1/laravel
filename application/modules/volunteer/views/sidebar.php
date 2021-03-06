<!-- BEGIN SIDEBAR -->
<div class="container">
    <a href="#" id="artash" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</div>
<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(-100%);">
    <li class="logo">
        <a href="/volunteer/" class="brand-logo">
            <img src="<?= base_url('assets/img/logo.png');?>" alt="logo" class="logo-default" />
        </a>
    </li>




    <li class="no-padding">

        <ul class="collapsible collapsible-accordion">
            <?php
            //make sure $segment and $view is defined
            $segment = (isset($this->uri->segments['2'])) ? $this->uri->segments['2'] : '';
            $segment_2 = (isset($this->uri->segments['3'])) ? $this->uri->segments['3'] : '';
            $view = explode("-", $segment);

            foreach ($menu as $key => $value):

                if (is_array($value)): //is value is array, it means it is Menu Item
                    //sent active menu
                    $MenuActive = ($view['0'] == $menu[$key]['title'] || $view['0'] == 'contact' && $menu[$key]['title'] == "contacts" || $view['0'] == 'vendors' && $menu[$key]['title'] == "vendors-services" || $view['0'] == 'services' && $menu[$key]['title'] == "vendors-services" ) ? 'the_active' : $view['0'].'   '.$menu[$key]['title'];
//                        print_r($MenuActive);
//                        die;
                    ?>
                    <!-- SIDEBAR MENU -->
                <li class="nav-item  <?=$MenuActive;?>">
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
                                $LinkActive = ($link['href'] == "/".$segment || $link['href'] == "/".$segment.'/'.$segment_2 || $link['href'] == "/client/new/" && "/".$segment == "/client" || $link['href'] == "/users/users-edit/new/" && "/".$segment.'/'.$segment_2 == "/users/users-edit" || $link['href'] == "/users/users-view" && "/".$segment.'/'.$segment_2 == "/users/users-view" || $link['href'] == "/vendors/vendor-types-edit/new" && "/".$segment.'/'.$segment_2 == "/vendors/vendor-types-edit" || $link['href'] == "/vendors/vendors-edit/new/" && "/".$segment.'/'.$segment_2 == "/vendors/vendors-edit" || $link['href'] == "/services/services-edit/new/" && "/".$segment.'/'.$segment_2 == "/services/services-edit" ) ? 'the_active' : $link['href'].'   '."/".$segment.'/'.$segment_2;
                                ?>
                                <!-- SIDEBAR MENU LINK -->
                                <li class="nav-item <?= $LinkActive ;?>">
                                    <a href="<?php
                                    if($link['href'] != '/client/new/' && $link['href'] != '/users/users-edit/new/') echo base_url().$this->uri->segment('1').$link['href'];
                                    else echo '#' ?>"
                                        <?php if($link['href'] == '/client/new/') echo 'class="create_contact"' ?>  class="nav-link <?php if($link['href'] == '/users/users-edit/new/') echo 'new_user_btn'?> ">
                                        <!--                                        <a href="--><?php //echo base_url().$this->uri->segment('1').$link['href'];?><!--" class="nav-link ">-->
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
                        <?php
                        $ci = &get_instance();
                        $logged_user_title_name= $ci->session->userdata['logged_user_title_name'];
                        $logged_user_title_description= $ci->session->userdata['logged_user_title_description'];
//                        echo '<pre>$logged_user_title_description::'.print_r($logged_user_title_description,true).'</pre>';
//                        die("-1 XXZ");
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
                                <a href="<?= base_url($logged_user_title_name.'/profile');?>">
                                    <span class="fa fa-user"></span>
                                    <span><?= lang('my-profile'); ?></span>
                                </a>
                            </li>
                            <?php
                            $usersGroups = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user->user_id, 'status'=>'A','show_groups_description'=> 1) );
                            ?>

                            <?php foreach( $usersGroups as $nextUsersGroup ) : ?>
                                <?php if ( $nextUsersGroup->group_name == $logged_user_title_name ) continue; ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url()?>login/switch_active_title/active_title_id/<?= $nextUsersGroup->group_id?>" class="nav-link ">
                                        <span class="fa fa-sign-out" aria-hidden="true"></span>
                                        <span> <?= str_replace(' ','&nbsp;',"Switch as " . $nextUsersGroup->group_description) ?></span>
                                    </a>
                                </li>
                            <?php endforeach;?>

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

<script>
    $(document).ready(function(){
        $("body").on('click','.btn-rem',function(){
//            console.log($(this));
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


