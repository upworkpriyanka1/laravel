<?php $ci = &get_instance(); ?>
<?php if (isset($client) && count($client)>0){
    ?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
<!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
               <div class="portlet-body">
                   <!-- BEGIN FORM-->
                   <form action="<?php echo current_url() ;?>/update/<?= $PageParametersWithSort ?>" method="post" id="client-add" class="form-horizontal">
                       <div class="form-body">
                           <div class="alert alert-danger display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_error');?> 
                           </div>
                           <div class="alert alert-success display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_updated');?>
                           </div>
      
    <div class="row">
    <!-- client Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('client_name') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[client_name]" value="<?= $client->client_name;?>" data-required="1" class="form-control" />
                    
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client owner -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('client_owner') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[client_owner]" value="<?= $client->client_owner;?>" data-required="1" class="form-control" />
                </div><!-- ./col -->
            </div> <!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->
            
    <div class="row">
    <!-- client Addrtess 1 -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('address1') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[client_address1]" value="<?= $client->client_address1;?>" data-required="1" class="form-control" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client Address 2 -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('address1') ?> 
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[client_address2]" value="<?= $client->client_address2;?>"  class="form-control" />
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
                    <input type="text" name="data[client_city]" value="<?= $client->client_city;?>" data-required="1" class="form-control" />
                </div><!-- ./col -->
                <div class="col-md-1">
                    <input type="text" name="data[client_state]" value="<?= $client->client_state;?>" data-required="1"  class="form-control" />
                </div><!-- ./col -->
                <div class="col-md-1">
                    <input type="text" name="data[client_zip]" value="<?= $client->client_zip;?>" data-required="1" class="form-control" />
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
                    <input type="text" name="data[client_phone]" value="<?= $client->client_phone;?>" data-required="1" class="form-control" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    <!-- client fax -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('fax') ?> 
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[client_fax]" value="<?= $client->client_fax;?>" class="form-control" />
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
                    <input type="text" name="data[client_email]" value="<?= $client->client_email;?>" data-required="1" class="form-control" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
        
    <!-- client url -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('website') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" name="data[client_website]" value="<?= $client->client_website;?>" data-required="1" class="form-control" />
                    <span class="help-block"> <?php echo lang('website_help');?></span>
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->     
    
    
    <div class="row">
        <div class="col-md-6">        
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('clients-type') ?>
                    <span class="required"> * </span>
                </label>
            <div class="col-md-7">
                <?php 
        
                echo MyCustom_menu($client_types,'data[clients_types_id]','form-control',$client->type_id," -Client Type- ",'id ="clients_types_id"'); ?>
            </div>
        </div>    </div>
    <!-- notes -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('notes') ?>

                </label>
                <div class="col-md-7">
                    <textarea name="data[client_notes]"  class="form-control" /> <?= $client->client_notes;?></textarea>
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->



     <div class="row">
    <!-- client email -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('created_at') ?>
                </label>
                <div class="col-md-7">
                    <input type="text" value="<?= strftime( $ci->common_lib->getSettings('date_time_as_text_format'), strtotime( $client->created_at ) )?>" class="form-control" disabled />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->

    <!-- client url -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('updated_at') ?>
                </label>
                <div class="col-md-7">
                    <input type="text" value="<?= strftime( $ci->common_lib->getSettings('date_time_as_text_format'), strtotime( $client->updated_at ) )?>" class="form-control" disabled />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->
    </div> <!-- ./row -->


    <div class="row">
        <div class="col-md-6">  
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-4 col-md-9">
                        <button type="submit" id="BtnSave" data-action="edit" class="btn green"><?php echo lang('submit');?></button>
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
<?php } ?>