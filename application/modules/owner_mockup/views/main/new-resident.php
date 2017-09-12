<style>.modal-backdrop{z-index:99;}</style>
<!-- New Location modal -->
<div class="modal fade newclient" id="new_owner_resident" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-top">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">New Resident</h3>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<form class="col s12">
							<div class="row">
								<div class="input-field col-md-6">
									<i class="material-icons prefix">account_circle</i>
									<input id="first_name" type="text" name="first_name" class="validate"/>
									<label for="first_name">First name</label>
								</div>
								<div class="input-field col-md-6">									
									<input id="last_name" type="text" name="last_name" class="validate"/>
									<label for="last_name">Last name</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">									
									<input id="dob" name="dob" type="text" class="validate"/>
									<label for="dob">Date of Birth</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">									
									<input id="ssn" type="text" class="validate"/>
									<label for="ssn">SSN</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">									
									<select name="location" class="validate">
										<option value="">Select Location</option>
										<option value="">Test Location</option>
									</select>								
								</div>
							</div>							
						</form>
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<div class="col-xs-12">                                
					<ul class ="md-foot-bot">
						<li data-dismiss="modal"><button class="btn" id="location_cancel">CANCEL</button> </li>
						<li class="create-contact-more"><button class="btn-flat btn-flat1">SAVE</button></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- New location modal end -->