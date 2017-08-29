<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div class="page-bar">
                    <?= $this->common_lib->show_info($editor_message) ?>
                </div>

                <div class="table-toolbar table_info">
                    <h4>
                        <? if ( count($client_types) > 0 ) { ?>
                            <?= count($client_types); ?>&nbsp;Row<? if ( count($client_types) > 1 ) { ?>s<? } ?>&nbsp;of&nbsp;<?= $RowsInTable ?>&nbsp;(Page # <strong><?= $page_number ?> </strong>)
                        <? } ?>
                    </h4>

                    <button type="button" class="btn btn-plus sbold btn-sm pull-right "  data-toggle="modal" data-target="#add-clients-type">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </div>
                <div class="modal fade" id="add-clients-type" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">New Client</h4>
                            </div>
                            <div class="modal-body">
                                <!-- BEGIN FORM-->
                                <form action="<?php echo current_url();?>" method="post" id="client-type-add" class="form-horizontal">

                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> <?= lang('form_sucess');?>
                                        </div>

                                        <div class="row">
                                            <!-- Name-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12" id="name_input">
                                                            <i class="material-icons prefix">assignment_ind</i>
                                                            <input type="text" name="data[name]" id="name" class="form-control required_form" maxlength="100" />
                                                            <label for="name" class=""><?php echo lang('name') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>
                                            <!-- Description -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12" id="description_input">
                                                            <i class="material-icons prefix">business</i>
                                                            <textarea id="description" name="data[description]" data-required="1"  maxlength="100" class=" form-control required_form materialize-textarea"></textarea>

                                                            <label for="description" class="description"><?php echo lang('description') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>



                                        </div> <!-- ./row -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <input type="hidden" name="editClient" id="edClient" value=""/>
                                                            <button type="button" class="btn btn-type" data-dismiss="modal">CANCEL</button>
                                                            <button type="submit" class="btn btn-type"><?php echo lang('SAVE');?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="edit-clients-type" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modify Client Type</h4>
                            </div>
                            <div class="modal-body">
                                <!-- BEGIN FORM-->
                                <form action="<?php echo current_url();?>" method="post" id="client-type-edit" class="form-horizontal">
                                    <input type="hidden" name="row-to-update" id="row-to-update" value=""/>
                                    <input type="hidden" name="is_edit" value="1"/>
                                    <input type="hidden" name="ajaxpost" value="1"/>
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> <?= lang('form_error');?>
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> <?php echo "Client type updated.";?>
                                        </div>

                                        <div class="row">
                                            <!-- Name-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12">
                                                            <i class="material-icons prefix">assignment_ind</i>
                                                            <input type="text" name="data[name]" id="edit-type-name" class="form-control required_form" maxlength="100" />
                                                            <label for="edit-type-name" class=""><?php echo lang('name') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>
                                            <!-- Description -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group input-field ">
                                                        <div class="col-md-12">
                                                            <i class="material-icons prefix">business</i>
                                                            <textarea id="edit-type-description" name="data[description]" data-required="1"  maxlength="100" class=" form-control required_form materialize-textarea"></textarea>

                                                            <label for="edit-type-description" class="description"><?php echo lang('description') ?><span class="required">&nbsp;*&nbsp;</span></label>
                                                        </div>
                                                    </div>
                                                    <!-- ./form-group -->
                                                </div><!-- ./col -->
                                            </div>



                                        </div> <!-- ./row -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <button type="button" class="btn btn-type" data-dismiss="modal">CANCEL</button>
                                                            <button type="button" class="btn btn-type">DELETE </button>
                                                            <button type="button" id="update-client" class="btn btn-type"><?php echo lang('SAVE');?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover  order-column" id="client_types">
                        <thead>
                        <tr>
                            <th> <?= lang('name');?> </th>
                            <th> <?= lang('description');?> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($client_types) && count($client_types)>0){
                            foreach($client_types as $row){?>
                                <tr>
                                  <input type="hidden" id="row-<?php echo $row->type_id;?>" value="<?php echo $row->type_id;?>"/>
                                    <td data-td="name-<?php echo $row->type_id;?>"><?php echo $row->type_name;?></td>
                                    <td data-td="description-<?php echo $row->type_id;?>" ><?php echo $row->type_description;?>
                                        <a href="#" class="icon-type-pen" id="Edit" data-row="#row-<?php echo $row->type_id;?>" data-toggle="modal" data-target="#edit-clients-type"><i class="material-icons edit">edit</i></a>
                                    </td>
                                    <input type="hidden" name="row-<?php echo $row->type_id;?>-name" id="row-<?php echo $row->type_id;?>-name" value="<?php echo $row->type_name;?>"/>
                                    <input type="hidden" name="row-<?php echo $row->type_id;?>-desc" id="row-<?php echo $row->type_id;?>-desc" value="<?php echo $row->type_description;?>"/>
                                </tr>
                            <?php
                            }//end foreach
                        }//end isset
                        ?>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>

    window.client_type = window.client_type || {};


    client_type = {
      init : function(){
        $('#update-client').on('click',function(){
            client_type.submit();
        })
      },
      submit : function(){

          var form1 = $('#client-type-edit');

          var error1 = $('.alert-danger', form1);
          var success1 = $('.alert-success', form1);

          var formURL = form1.attr("action");
          var inputs = $('#client-type-edit :input');
          var values = inputs.serialize() + '&ajaxpost=1';
          $.ajax({
              type: "POST",
              cache: false,
              url: formURL,
              data: values
          })
              .done(function( msg ) {
                  console.log(msg);
                  if (msg) {//get server msg
                      var res =  msg.substr(0, msg.indexOf('-'));
                      if ($.isNumeric(msg)){ //if msg starts numeric, ie last db insert id
                          console.log('AJAX',msg);

                          success1.show();

                          var name = $( "#edit-type-name" ).val();
                          var description= $( "#edit-type-description" ).val();

                          $('[data-td="name-'+msg+'"]').html(name);
                          $('[data-td="description-'+msg+'"]').html(description);
//                          $(form1)[0].reset();

                      }else{//if msg NOT numeric, ie error msg from server
                          success1.hide();
                          error1.show();
                          error1.html(msg);
                      }
                  }
              })
              .fail(function() { //For some reason Ajax post failed
                  success1.hide();
                  error1.show();
                  error1.html('Critical Error: Ajax Post failed');



              });
      }
    };



    $(document).ready(function(){
        client_type.init();
        var $modalId = '#edit-clients-type';
        var $editA = $('[data-target="'+$modalId+'"]');
        if($editA.length){
            $editA.on('click',function(){
                var $rowNum = $($(this).attr('data-row')).val();
                $($modalId).on('show.bs.modal', function (e) {
                    var $modalForm = $(e.target).find('form');
                    var $modalRow = $modalForm.find('input[name="row-to-update"]');
                    var $modalName = $modalForm.find('[name="data\\[name\\]"]');
                    var $modalDesc = $modalForm.find('[name="data\\[description\\]"]');

                    $modalRow.val($rowNum);
                    $modalName.val($('#row-'+$rowNum+'-name').val());
                    $modalDesc.val($('#row-'+$rowNum+'-desc').val());



//                    console.log($(e.target).find('[name="row-to-update"]'));
                });

            })
        }

    });



</script>