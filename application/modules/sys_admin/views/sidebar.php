<!-- BEGIN SIDEBAR -->
<div class="container">
    <a href="#" id="artash" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</div>
<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(-100%);">
    <li class="logo">
        <a href="/sys-admin/" class="brand-logo">
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
                                    $LinkActive = ($link['href'] == "/".$segment || $link['href'] == "/".$segment.'/'.$segment_2 || $link['href'] == "/clients-edit/new/" && "/".$segment == "/clients-edit" || $link['href'] == "/users/users-edit/new/" && "/".$segment.'/'.$segment_2 == "/users/users-edit" || $link['href'] == "/users/users-view" && "/".$segment.'/'.$segment_2 == "/users/users-view" || $link['href'] == "/vendors/vendor-types-edit/new" && "/".$segment.'/'.$segment_2 == "/vendors/vendor-types-edit" || $link['href'] == "/vendors/vendors-edit/new/" && "/".$segment.'/'.$segment_2 == "/vendors/vendors-edit" || $link['href'] == "/services/services-edit/new/" && "/".$segment.'/'.$segment_2 == "/services/services-edit" ) ? 'the_active' : $link['href'].'   '."/".$segment.'/'.$segment_2;
                                    ?>
                                    <!-- SIDEBAR MENU LINK -->
                                    <li class="nav-item <?= $LinkActive ;?>">
                                            <a href="<?php
                                                        if($link['href'] != '/clients-edit/new/' && $link['href'] != '/users/users-edit/new/') echo base_url().$this->uri->segment('1').$link['href'];
                                                        else echo '#' ?>"
                                                <?php if($link['href'] == '/clients-edit/new/') echo 'class="create_contact"' ?>  class="nav-link <?php if($link['href'] == '/users/users-edit/new/') echo 'new_user_btn'?> ">
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
                            <?php 		$this->load->model('users_mdl');
                            $logged_user= $this->users_mdl->getUserRowById( $user->user_id, array('show_file_info'=> 1, 'image_width'=> 32, 'image_height'=> 32) );
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

<div class="modal fade newclient" id="create-contact" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">New Client</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <form action="" method="post" id="form_create_contact" name="form_create_contact" class="form-horizontal">

                                <div class="input-field col-xs-12 name-rem">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="icon_prefix" type="text" class="validate" name="name" value="">
                                    <label for="icon_prefix">Name</label>
                                    <div class="btn-rem-name">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="input-field col-md-6">
                                    <i class="material-icons prefix">business</i>
                                    <input id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Company</label>
                                </div>
                                <div class="input-field col-md-6">
                                    <select>
                                        <option value="" disabled selected>Job title</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                </div>


                                <div class="input-field col-md-12 email-add">
                                    <div class="input-field col-md-6 email-add">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" type="email" class="validate">
                                        <label for="email">Email</label>

                                    </div>
                                   <!-- <div class="input-field col-md-6">
                                        <input id="icon_prefix" type="text" class="validate">
                                        <label for="icon_prefix">Job title</label>
                                    </div>-->
                                    <div class="input-field col-md-6">
                                        <select>
                                            <option value="" disabled selected>Job title</option>
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                            <option value="3">Option 3</option>
                                        </select>
                                    </div>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="input-field col-md-12 email-add">
                                    <div class="input-field col-md-6 email-add">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="icon_telephone" type="tel" class="validate">
                                        <label for="icon_telephone">Phone</label>

                                    </div>
                                    <div class="input-field col-md-6">
                                        <input id="icon_prefix" type="text" class="validate">
                                        <label for="icon_prefix">Job title</label>
                                    </div>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="input-field col-md-12 email-add">
                                    <div class="col-md-4">
                                        <input type="text" name="data[client_city]" id="client_city" value="" class="form-control">
                                        <label for="client_city" class="control-label col-md-2">City</label>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" name="data[client_state]" id="client_state" value="" class="form-control">
                                        <label for="client_state" class="control-label col-md-2">State</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="data[client_zip]" id="client_zip" value="" class="form-control" maxlength="5">
                                        <label for="client_zip" class="control-label col-md-2">Zip</label>
                                    </div>


                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="input-field col-md-6">
                                        <select name="data[clients_types_id]" class="form-control" id="clients_types_id">
                                            <option value=""> -Client Type- </option>
                                            <option value="1">Adult Day Care</option>
                                            <option value="2">Assisted /Senior Living Facilities</option>
                                            <option value="4">Home Health</option>
                                            <option value="5">SYS Admin</option>
                                            <option value="6">testing description</option>
                                            <option value="7">a home providing care for the sick, especially the terminally ill.</option>
                                        </select>
                                    </div>

                                        <input name="group1" type="radio" id="test1" />
                                        <label for="test1">Client Type</label>
                                        <input name="group1" type="radio" id="test2" />
                                        <label for="test2">Business Type</label>

                                </div>
                                <div class="input-field col s12">
                                    <select>
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>

                                </div>










                                <!--<div class="input-field col-xs-12 email-add">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" class="validate">
                                    <label for="email">Email</label>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>
--><!--
                                <div class="input-field col-xs-12">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="icon_telephone" type="tel" class="validate">
                                    <label for="icon_telephone">Phone</label>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>-->

                                <div class="input-field col-xs-12">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                                    <label for="icon_prefix2">Notes</label>

                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="input-field col-xs-12">
                                    <div class="col-md-2">
                                        <span class="create-contact-more"><a href="#">MORE</a></span>

                                    </div>

                                    <div class="col-md-10 text-right">
                                        <span data-dismiss="modal" role="button">CANCEL </span>
                                        <span class="create-contact-save" data-action="save" role="button"> SAVE </span>
                                    </div>
                                </div>
                            </form>





                        </div>


                    </div>

                </div>

            </div><!-- ./row -->








        </div>


    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
//        $(".btn-add").click(function(){
//            $(".email-add").append('<div class="input-field col-xs-12">' +
//                '<input type="email" class="validate"> <label for="email">Email</label><div class="btn-rem"><i class="fa fa-times-circle" aria-hidden="true"></i></div></div>');
//        });

          $("body").on('click','.btn-rem',function(){

              console.log($(this));
            $(this).parent().remove();
         });

        $('input[name=name]').keyup(function() {
            var nameInput = $(this).val();
            if(nameInput !== ""){
                $('.btn-rem-name').css('display', 'block');
            }
        });

       /* $('body').on('click','.btn-rem-name',function(){

            console.log(68)
            $('input[name=name]').val('');
//            $('.btn-rem-name').css('display', 'none');
        });*/







    });




</script>


