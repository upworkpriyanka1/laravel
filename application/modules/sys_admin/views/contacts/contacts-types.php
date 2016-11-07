<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover  order-column" id="contact_types">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> <?= lang('contact-type');?> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($contact_types) && count($contact_types)>0){
                		    foreach($contact_types as $row){?>
                        <tr>
                            <td><?php echo $row->con_type_id;?></td>
                            <td><a class="editableTxt" href="#" id="<?php echo $row->con_type_id;?>" data-type="text" data-pk="1" data-url="<?= current_url();?>" data-title="Edit"><?php echo $row->con_type_name;?></a></td>
                            </td>
                        </tr>
                        <?php
                            }//end foreach
                        }//end isset
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
<!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
               <div class="portlet-body">
                   <!-- BEGIN FORM-->
                   <form action="<?php echo current_url();?>" method="post" id="contact-type-add" class="form-horizontal">
                       <div class="form-body">
                           <div class="alert alert-danger display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                           </div>
                           <div class="alert alert-success display-hide">
                               <button class="close" data-close="alert"></button> <?= lang('form_sucess');?>
                           </div>

    <div class="row">
    <!-- Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-4"><?php echo lang('contact-type') ?>
                    <span class="required"> * </span>
                </label>
                <div class="col-md-7">
                    <input type="text" id="name" name="data[con_type_name]" data-required="1" class="form-control" />
                </div><!-- ./col -->
            </div><!-- ./form-group -->
        </div><!-- ./col -->

    </div> <!-- ./row -->

    <div class="row">
        <div class="col-md-6">
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-4 col-md-9">
                        <button type="submit" class="btn green"><i class="fa fa-plus"></i> <?php echo lang('add-new');?></button>
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
    </div>
</div><!-- ./row -->