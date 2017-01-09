<?php $ci = &get_instance();

//echo '<pre>$has_error::'.print_r($has_error,true).'</pre>';
//echo '<pre>$error_message::'.print_r($error_message,true).'</pre>';
//echo '<pre>$success_message::'.print_r($success_message,true).'</pre>';

?>

<script type="text/javascript">
	/*<![CDATA[*/
//	var base_url= '<?//= base_url() ?>//'

	/*]]>*/
</script>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit portlet-form bordered">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet light portlet-fit portlet-form bordered">

				<div class="portlet-body">

					<div class="page-bar padding_lg">

						<?php if ( $has_error and !empty($error_message) ): ?>
							<h3><center> Activation Error</center></h3>
							<p style="color: red; font-size: medium;"><?php echo $error_message ?></p>
						<?php endif ; ?>


						<?php if ( !$has_error and !empty($success_message) ): ?>
							<h3><center>Activation Success</center></h3>
							<p style="color: navy; font-size: medium;"><?php echo $success_message ?></p>
						<?php endif ; ?>

					</div>

				</div>

			</div>
			<!-- END VALIDATION STATES-->

		</div>

	</div>

</div><!-- ./row -->