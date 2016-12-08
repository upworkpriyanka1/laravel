<div class="table-toolbar table_info">
    <?= count($related_vendor_contacts_list)?>&nbsp;<?=lang('vendor_contacts') ?>
    <button type="button" class="btn sbold green  btn-sm pull-right" onclick="javascript:editRelatedVendorContact( '',  '', '',  '',   '', '')" ><i class="glyphicon glyphicon-plus"></i></button>
</div>

<?php $ci = &get_instance();
if ( isset($related_vendor_contacts_list) && count($related_vendor_contacts_list) > 0 ) { ?>

    <div class="table-responsive">

        <table class="table table-striped table-bordered table-hover  order-column" id="clients_listing">
            <tbody>
            <thead>
            <tr>
                <th>
                    <?= lang('vc_person_name') ?>
                </th>
                <th>
                    <?= lang('vc_person_description') ?>
                </th>
                <th>
                    <?= lang('vc_phone') ?>
                </th>
                <th>
                    <?= lang('vc_phone_description') ?>
                </th>
                <th>
                    <?= lang('vc_person_email') ?>
                </th>
                <th>
                    <?= lang('created_at') ?>
                </th>
                <th><i class="fa fa-pencil"></i></th>
            </tr>
            </thead>
            <?
            foreach ($related_vendor_contacts_list as $next_vendor_contact) { // echo '<pre>$next_vendor_contact::'.print_r($next_vendor_contact,true).'</pre>';
                ?>

                <tr>

                    <td>
                        <?php echo $next_vendor_contact->vc_person_name; ?>
                    </td>

                    <td>
                        <?php echo $next_vendor_contact->vc_person_description; ?>
                    </td>

                    <td>
                        <?php echo $next_vendor_contact->vc_phone; ?>
                    </td>

                    <td>
                        <?php echo $next_vendor_contact->vc_phone_description; ?>
                    </td>

                    <td>
                        <?php echo $next_vendor_contact->vc_person_email; ?>
                    </td>

                    <td><?php echo $this->common_lib->format_datetime( $next_vendor_contact->created_at) ?></td>

                    <td>
                        <a class="btn btn-sm blue" onclick="javascript:editRelatedVendorContact( '<?= addslashes($next_vendor_contact->vc_person_name) ?>',  '<?= addslashes($next_vendor_contact->vc_person_description) ?>', '<?= addslashes($next_vendor_contact->vc_phone) ?>',  '<?= addslashes($next_vendor_contact->vc_phone_description) ?>',   '<?= addslashes($next_vendor_contact->vc_person_email) ?>', <?= $next_vendor_contact->vc_id ?>)">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
                <?php
            }//end foreach( $ as $next_key=>$next_value ) {


            ?>
            </tbody>
        </table>
    </div>

<?php  } ?>


<?
