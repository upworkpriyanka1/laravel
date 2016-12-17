<div class="row">
<?php $ci = &get_instance();
$image_service_directory = $this->config->item('image_service_directory');
?>

<? if ( count($service_images_list) == 0 ) { ?>
    <button type="button" class="btn btn-error btn-lg btn-block">No Images Found</button>
<? } ?>
<? if ( count($service_images_list) > 0 ) { ?>

    <? $orig_width = 346;
    $orig_height = 260;  ?>

    <h4 ><?=lang('service')?> has <?=count($service_images_list) ?> Image(s)</h4>
    <? foreach( $service_images_list as $next_key=>$next_service_image ) :  ?>
    <?  $next_service_image_path= FCPATH . $image_service_directory . $service_id.'/' . $next_service_image->si_image;
        if ( !file_exists($next_service_image_path) ) continue;
        $next_service_image_url= base_url() . $image_service_directory . $service_id.'/'. $next_service_image->si_image;
        $Filesize = @filesize($next_service_image_path);
        $filesize_label =  $ci->common_lib->getFileSizeAsString($Filesize);

        $FilenameInfo = $ci->common_lib->GetImageShowSize($next_service_image_path, $orig_width, $orig_height);
        $original_width= !empty($FilenameInfo['OriginalWidth']) ? $FilenameInfo['OriginalWidth'] : 0;
        $original_height= !empty($FilenameInfo['OriginalHeight']) ? $FilenameInfo['OriginalHeight'] : 0;
        $width=  !empty($FilenameInfo['Width']) ? $FilenameInfo['Width'] : 0;
        $height= !empty($FilenameInfo['Height']) ? $FilenameInfo['Height'] : 0;
    ?>

    <? $image_info= '<u>' . $next_service_image->si_image . '</u>' . ( $next_service_image->si_is_main == "Y"? " - <b>main</b>, ": "" ) . '&nbsp;&nbsp;<br>' . $filesize_label . ', ' . $original_width . '*' . $original_height ?>

<div class="col-sm-6 col-md-4 col-lg-3  " style="width: <?= $original_width ?>px; height: <?= $original_height +60 ?>px; padding: 30px; "  >
    <table>
        <tr>
            <td colspan="2">
                <img class="image_border" id="img_banner_preview" src="<?= $next_service_image_url ?>" width="<?= $width ?>" height="<?= $height ?>" >
            </td>
        </tr>
        <tr>
            <td>
                <a class="a_link" onclick="javascript:deleteServiceImage( <?= $next_service_image->si_id ?>, '<?= $service_id ?>', '<?= $next_service_image->si_image ?>' );" >             <img src="<?php echo base_url() ?>assets/img/delete.png" alt="" />
                </a>
            </td>
            <td>
                <span class="overflow_wrap_break_word"><?= $image_info ?></span>
            </td>
        </tr>
    </table>
</div>

<? endforeach; ?>

<? } ?>
</div>