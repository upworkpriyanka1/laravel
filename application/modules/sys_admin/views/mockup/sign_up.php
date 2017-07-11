<div class="row">
    <div class="col-md-12"> 
		<div class="row">
			<div class="col-md-12"><h3>Sign Up Form</h3></div>
		</div>		
       <form action="" id="new_user_form" method="POST" enctype="multipart/form-data">
			<?php echo validation_errors(); ?>			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-field">
							<input id="us-name" type="text" class="validate" value="" name="data[name]" required>

							<label for="us-name" class="control-label"><?php echo lang('name') ?>
								<span class="required"> * </span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-field">
							<input id="us-email" type="email" class="validate" name="data[email]" autocomplete="off" required>
							<label for="us-email" class="control-label"><?php echo lang('email') ?>
								<span class="required"> * </span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-field">
							<input id="us-email-conf" type="email" class="" name="data[email_confirm]" autocomplete="off" required>
							<label data-error="wrong" data-success="right" for="us-pass-conf" class="control-label"><?php echo lang('email_confirm') ?>
								<span class="required"> * </span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-12">					
					<button class="btn" name="cancel" type="reset">Reset</button>
					<button class="btn" name="submit" type="submit">Send</button>					
				</div>
			</div>
	   </form>
	</div>
</div>

