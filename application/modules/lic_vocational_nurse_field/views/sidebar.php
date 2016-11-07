<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
           <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
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
        

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->