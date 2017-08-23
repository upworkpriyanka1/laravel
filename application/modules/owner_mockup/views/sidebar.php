<!-- BEGIN SIDEBAR -->
<div class="container">
    <a href="#" id="artash" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</div>
<ul id="nav-mobile" class="side-nav fixed" style="transform: translateX(-100%);">
    <li class="logo" style="background:transparent;">
        <a href="/owner-mockup/" class="brand-logo">                
			<span class="logo-default" style="color:#000;font-size:33px;">JD</span>
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
					?>
					<!-- SIDEBAR MENU -->
				<li class="nav-item  <?=$MenuActive;?>">
					<a href="javascript:;" class="nav-link nav-toggle collapsible-header waves-effect waves-teal">
						<span class="<?= $menu[$key]['icon'];?>"></span>
						<span class="title"><?php if($menu[$key]['title'] == "profile"){ echo "JOHN DOE";}else{ echo lang($menu[$key]['title']);} ?></span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<div class="collapsible-body" >
					<ul>
					<?php 
					if (is_array($menu[$key])): //if $menu[$key] is arry, it means it is menu link
						foreach ($menu[$key] as $key => $link):
							if (is_array($link)): //if $link, ie  $key value is array
								$LinkActive = ($link['href'] == "/".$segment || $link['href'] == "/".$segment.'/'.$segment_2 ) ? 'the_active' : $link['href'].'   '."/".$segment.'/'.$segment_2;
								
								$dtoggle = "";
								if(isset($link['data-toggle'])){
									$dtoggle = 'data-toggle ="'.$link['data-toggle'].'" data-target="'.$link['data-target'].'"';
								}
								
																
								?>
								<!-- SIDEBAR MENU LINK -->
								<li class="nav-item <?= $LinkActive ;?>">
										<a <?php echo $dtoggle; ?> href="<?php echo base_url().$link['href']; ?>" class="nav-link">
										<span class="<?php echo $link['icon'];?>"></span>
										<span class="title"><?php echo lang($link['title']); ?></span>
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
		</ul>
    </li>
</ul>
<?php include('main/new-location.php'); ?>
<?php include('main/new-resident.php'); ?>
<?php include('main/new-contact.php'); ?>
<script src="<?= base_url(); ?>/assets/global/plugins/jquery.min.js" type="text/javascript" ></script>
<script>
    $(document).ready(function(){
          $("body").on('click','.btn-rem',function(){
			//console.log($(this));
            $(this).parent().remove();
         });

        $('input[name=name]').keyup(function() {
            var nameInput = $(this).val();
            if(nameInput !== ""){
                $('.btn-rem-name').css('display', 'block');
            }
        });
		
		$('#location_cancel').click(function(){
			window.location.href = "<?= base_url(); ?>owner-mockup/locations-list/";
		});
    });

</script>