<?php $ci = &get_instance();
echo link_tag('/assets/layouts/default/css/custom-client-overview-view.css');
?>
<script>
    var client_id= '<?php echo $client->cid ?>'

    var selected_user_id= 0
</script>

<style>
.error{left: 0 !important; position: relative !important;top: 0 !important;}.page-footer{position:relative;}
@media (min-width: 993px) {.page-content-wrapper .page-content {padding-top: 150px;}}
</style>
<div class="row clients-overview">
    <div class="col s12 m9 l10">
        <div class="row" style="margin-bottom: 0;">
            <?php
            $message = $this->session->flashdata('massege');
            if($message && $message != ''){ ?>
                <div class="massege" style="background-color: #fff;padding: 10px;margin-bottom: 10px">
				<?=$this->session->flashdata('massege');?></div>
            <?php } ?>          


            <button data-toggle="modal" data-target="#client_new_user_dialog_checking" class="client_new_user_dialog waves-effect waves-light btn-large" style="background-color: #fff; color: #000;font-size: 16px;">
                <i class="fa fa-plus" style="font-size: 16px"></i>
                Add location
            </button>  
			
            <div class="modal fade newclient" id="client_new_user_dialog_checking" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class=" modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title" id="lineModalLabel">Add Location</h3>               
                            <h5>All fields are required.</h5>
                        </div>

                        <div class="row">
                            <form class="col s12 form-horizontal" action="" method="post" id="form_location" name="form_location" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="input-field col s12">                                    
                                        <input required type="text" name="name" id="name" />
                                        <label for="name">Name</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">                                   
                                        <input required type="text" name="address" id="address" value="" />
                                        <label for="address">Address</label>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="input-field col s12">                                   
                                        <input required type="text" name="residents" id="residents" value="" />
                                        <label for="residents">Residents</label>
                                    </div>
                                </div>

                                <div class="row" style="display: none">
                                    <div class="input-field col s12">
                                        <span id="span_message"></span>
                                    </div>
                                </div>
                                
                                <div class="row md-foot-row">
                                    <div class="col-xs-12">
                                        <ul class ="md-foot-bot">
                                            <li data-dismiss="modal">
                                                <button class="btn" data-dismiss="modal" role="button" type="button" >CANCEL</button>
                                            </li>
                                            <li> 
                                                <button type="submit" class="btn">Save</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>   
		</div>
	
<script>
    var validation_text = '<?php echo $this->session->flashdata( 'validation_errors_text1' );?>';
    //validation_text = stripslashes(validation_text);
    //validation_text.replace(/\\/g, '')
    //console.log('valiadtion text is : ' + validation_text);
    //alert('123');
    //validation_text = '12345';
    if(validation_text != '')
    {
//        $('#client_new_user_dialog').modal('show');
        $('#client_new_user_dialog_checking').modal('show');
    }
</script>