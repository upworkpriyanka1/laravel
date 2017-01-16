<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover  order-column" id="groups">
                    <thead>
                        <tr>
                            <th> <?= lang('name');?> </th>
                            <th> <?= lang('description');?> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($groups) && count($groups)>0){
                		    foreach($groups as $row){ ?>
                        <tr>

                            <td><?php echo lang($row->group_title);?></td>
                            <td><?php echo lang($row->group_title."-desc");?></td>
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