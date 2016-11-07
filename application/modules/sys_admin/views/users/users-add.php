<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
<!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
               <div class="portlet-body">
                   <!-- BEGIN FORM-->
                   <form action="<?php echo current_url();?>/add" method="post" id="user-add" class="form-horizontal">
                       <div class="form-body">
                           <div class="alert alert-danger display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_error');?> 
                           </div>
                           <div class="alert alert-success display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_sucess');?>
                           </div>
      
    <div class="row">
    <!-- client Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('first_name') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[first_name]" data-required="1" class="form-control requiredField" />
                    
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client owner -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('last_name') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[last_name]" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div> <!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->
    <div class="row">
    <!-- client Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('create_user_password_label') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[password]" data-required="1" id="password" class="form-control requiredField" />
                    <span class="help-block"> <?= lang('min-5-chars').". ".lang('blank-no-change'); ?></span>
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
        
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('create_user_password_confirm_label') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="password_confirm" data-required="1" id="password_confirm" class="form-control requiredField" />
                    <span class="help-block"> <?= lang('min-5-chars').". ".lang('blank-no-change'); ?></span>
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    </div>
    <div class="row">
    <!-- client Addrtess 1 -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('address1') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[address1]" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client Address 2 -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('address1') ?> 
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[address2]"  class="form-control" />
                </div><!-- ./col -->
            </div> <!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->
    
    
    
    <div class="row">
    <!-- client city/state/zip -->
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label col-md-2"><?php echo lang('city') ?>/<?php echo lang('state') ?>/<?php echo lang('zip') ?> 
                    <span class="required"> * </span>
                </label>
                <div class="col-md-1">
                    <input type="text" name="data[city]" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
                <div class="col-md-1">
                    <input type="text" name="data[state]" data-required="1"  class="form-control requiredField" />
                </div><!-- ./col -->
                <div class="col-md-1">
                    <input type="text" name="data[zip]" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client state -->

    </div> <!-- ./row -->
                    
    
    
    <div class="row">
    <!-- client phone -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('phone') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[phone]" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client fax -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('mobile') ?>  <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[mobile]" class="form-control requiredField" />
                </div><!-- ./col -->
            </div> <!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->         
            
        
    <div class="row">
    <!-- client email -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('email') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[email]" data-required="1" class="form-control requiredField" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
        
    <!-- client url -->
    <div class="col-md-6">        
        <div class="form-group">
            <label class="control-label col-md-4"><?php echo lang('company') ?>
                <span class="required"> * </span>
            </label>
            <div class="col-md-7">
            <?php 
            $array=array();
            foreach($clients as $row):
                $array[$row->cid]=$row->client_name;
            endforeach;
            

            echo MyCustom_menu($array,'data[clients]','form-control requiredField',FALSE,TRUE,'id ="user_clients"'); ?>  
            </div>
        </div>    
    </div>
    
    </div> <!-- ./row -->     
    
    
    <div class="row">
        <div class="col-md-6">        
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('job') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                <?php 
                $array=array();
                foreach($jobs as $row):
                    $array[$row->id]=lang($row->job_title."-desc");
                endforeach;
                
                echo MyCustom_menu($array,'job_id','form-control requiredField',FALSE,TRUE,'id ="jobs"'); ?>  
                </div>
            </div>    
        </div>
    <!-- notes -->
        <div class="col-md-6">        
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('group') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                <?php 
                $array=array();
                $x=0;
                foreach($groups as $row):
                    if ($x=='2'){break; }
                    $array[$row->id]=lang($row->group_title."-desc");
                    $x++;
                endforeach;
                
                echo MyCustom_menu($array,'data[groups]','form-control requiredField',FALSE,TRUE,'id ="groups"'); ?>  
                </div>
            </div>    
        </div>
    </div> <!-- ./row -->        
            
    <div class="row">
        <div class="col-md-6">  
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-4 col-md-9">
                        <button type="submit" class="btn green"><?php echo lang('submit');?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
                   </form>
                   <!-- END FORM-->
               </div>
            </div>
        <!-- END VALIDATION STATES-->
        </div>
    </div>
</div><!-- ./row -->