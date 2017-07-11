<style type="text/css">
 body{margin:50px;}
      #accordion .glyphicon { margin-right:10px; }
      .panel-collapse>.list-group .list-group-item:first-child {border-top-right-radius: 0;border-top-left-radius: 0;}
      .panel-collapse>.list-group .list-group-item {border-width: 1px 0;}
      .panel-collapse>.list-group {margin-bottom: 0;}
      .panel-collapse .list-group-item {border-radius:0;}

      .panel-collapse .list-group .list-group {margin: 0;margin-top: 10px;}
      .panel-collapse .list-group-item li.list-group-item {margin: 0 -15px;border-top: 1px solid #ddd !important;border-bottom: 0;padding-left: 30px;}
      .panel-collapse .list-group-item li.list-group-item:last-child {padding-bottom: 0;}

      .panel-collapse div.list-group div.list-group{margin: 0;}
      .panel-collapse div.list-group .list-group a.list-group-item {border-top: 1px solid #ddd !important;border-bottom: 0;padding-left: 30px;}
      .panel-collapse .list-group-item li.list-group-item {border-top: 1px solid #DDD !important;}
		a.collapsed .fa-angle-down {
		transform: rotate(-89deg);
		}
		li.collapsed .fa-angle-down {
		transform: rotate(-89deg);
		}
		.panel .fa{margin-right:10px;}
		.new_accordian .fa-folder{
			display:initial;
		}
		
		.new_accordian a .fa-folder{
			display:none;
		}
		.new_accordian a .fa-folder-open{
			display:initial;
		}

		.new_accordian li.collapsed .fa-folder{
			display:initial;
		}
		.new_accordian li.collapsed .fa-folder-open{
			display:none;
		}
		li .fa.fa-folder-open {
		display:initial;
		}
		li .fa.fa-folder {
		display:none;
		}
		.new_accordian a.collapsed .fa-folder{
			display:initial;
		}
		.new_accordian a.collapsed .fa-folder-open{
			display:none;
		}
		.new_accordian .panel ul li a{
		    color: #4c4c4c;
		}
		.new_accordian .list-group-item{
		    background-color: #c8c8c8;
		}
		.new_accordian .panel-default>.panel-heading {
			color: #333;
			background-color: #e4e4e4;
			border-color: #ddd;
		}
</style>
<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="index.html">
        <img src="<?php echo base_url() ?>assets/img/logo.png" alt="" /> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <?php /*?><form class="login_client-form" action="<?php echo base_url() ;?>login/switch_active_client" method="post">
        <h3 class="form-title font-green"><?= lang("select_active_client");?></h3>
        <?php if ( $this->session->flashdata( 'message' ) ) : ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata( 'message' ); ?></div>
        <?php endif; ?>

        <div class="form-group">
            <?php foreach( $clients as $c ) { ?>
                <input class="with-gap" type="radio" value="<?= $c->cid; ?>" name="active_client_id" id="active_client_<?= $c->cid; ?>" >
                <label class="control-label" for="active_client_<?= $c->cid; ?>"><?= $c->client_name; ?></label>
                <div class="clear_fix"></div>
            <?php } ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn green uppercase"><?= lang("switch_to_active_client");?></button>
            <div class="clear_fix"></div>
        </div>

    </form><?php */?>
    
    <?php
		/*echo "clients are : <br/>";
		//print_r($clients);
		foreach($clients as $c)
		{
			echo "<br/>".$c['client_data']->client_name . "<br/>";
			foreach($c['titles'] as $t)
			{
				echo "<br/>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' class='user_client_title' data-client_id='".$c['client_data']->cid."' data-title_id='".$t->id."'>" . $t->description . "</a>";
			}
		}*/
	?>
    
    Select Client and Title :  <br/><br/>
    <div class="panel-group new_accordian" >
        <div class="panel panel-default">
        	<?php
				$i=0;
				foreach($clients as $c)
				{
			?>
					
					 <div class="panel-heading" id="accordion<?php echo $i;?>">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion<?php echo $i;?>" href="#collapse<?php echo $i;?>">
						   <span class="fa fa-angle-down"></span>
						   <span class="fa fa-folder-open "></span> <span class="fa fa-folder "></span><?php echo $c['client_data']->client_name; ?></a>
						</h4>
					  </div>
					  <div id="collapse<?php echo $i;?>" class="panel-collapse collapse <?php echo ($i == 0)?'in':''; ?>">
						<ul class="list-group">
						  <?php 
						  foreach($c['titles'] as $t)
						  {	
						  ?>
                          <li class="list-group-item" >
						  	<span class="fa fa-folder "></span><a href="javascript:void(0)" class="user_client_title" data-client_id="<?php echo $c['client_data']->cid; ?>" data-title_id="<?php echo $t->id;?>"><?php echo $t->description;?></a>
						  </li>
                          <?php 
						  }
						  ?>
						</ul>
					  </div>
          	<?php 	
				$i++;
				}
          	?>
          
        </div>
      
       
      </div>
    

</div>