<?php $ci = &get_instance();  ?>

<script type="text/javascript">
    /*<![CDATA[*/
    var base_url= '<?= base_url() ?>'

    /*]]>*/
</script>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet light portlet-fit portlet-form bordered">
                <h3><center>Information </center></h3>

                <?php if ( empty($sign) or $sign == 'success' ) : ?>
                <div class="alert alert-success display-hide" style="display: block;">
                    <div class="glyphicon glyphicon-info-sign middle_icon pull-left " style = "font-size: large; padding-bottom: 5px;line-height: 1.8em;" >
                        <?= $msg ?>
                    </div>&nbsp;
                </div>
                <?php endif; ?>

                <?php if ( !empty($sign) and $sign == 'danger' ) : ?>
                <div class="alert alert-danger display-hide" style="display: block;">
                    <div class="glyphicon glyphicon-info-sign middle_icon pull-left " style = "font-size: large; padding-bottom: 5px;line-height: 1.8em" >
                        <?= $msg ?>
                    </div>&nbsp;
                </div>
                <?php endif; ?>

            </div>

        </div>

    </div>

</div><!-- ./row -->

