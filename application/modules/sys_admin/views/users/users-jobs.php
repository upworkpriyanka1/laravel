<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover  order-column" id="jobs">
                    <thead>
                        <tr>
                            <th> <?= lang('name');?> </th>
                            <th> <?= lang('description');?> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($jobs) && count($jobs)>0){
                		    foreach($jobs as $row){?>
                        <tr>

<!--                            <td>--><?php //echo lang($row->job_title);?><!--</td>-->
<!--                            <td>--><?php //echo lang($row->job_title."-desc");?><!--</td>-->
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
