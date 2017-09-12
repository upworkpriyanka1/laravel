<style>.modal-backdrop{z-index:99;}</style>
<!-- New Location modal -->
<div class="modal fade newclient" id="new_owner_contact" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-top">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">New Contact</h3>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<form class="col s12">
							<div class="row">
								<div class="input-field col s12">									
									<i class="material-icons prefix">assignment_ind</i>
									<input id="company_name" type="text" name="company_name" class="validate"/>
									<label for="company_name">Company Name</label>
								</div>
							</div>
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
									<input id="title" name="title" type="text" class="validate"/>
									<label for="dob">Title</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">									
									<select name="location" class="validate">
										<option value="">Select Type</option>
										<option value="person">Person</option>
										<option value="home_health">Home Health</option>
										<option value="hospice">Hospice</option>
										<option value="other">Other</option>
									</select>								
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">email</i>
									<input id="email" type="text" name="email" class="validate"/>
									<label for="email">Email</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">phone</i>								
									<input id="phone1" type="text" name="phone1" class="validate"/>
									<label for="phone1">Phone 1</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col-md-6">
									<i class="material-icons prefix">business</i>									
									<input id="address1" type="text" name="address1" class="validate"/>
									<label for="address1">Address1</label>
								</div>
								<div class="input-field col-md-6">									
									<input id="address2" type="text" name="address2" class="validate"/>
									<label for="address1">Address2</label>
								</div>
							</div>							
							<div class="row">
								<div class="input-field col-md-4">
									<i class="material-icons prefix">location_on</i>
									<input id="city" type="text" name="city" class="validate"/>
									<label for="city">City</label>
								</div>
								<div class="input-field col-md-4">									
									<input id="state" type="text" name="state" class="validate"/>
									<label for="state">State</label>
								</div>
								<div class="input-field col-md-4">									
									<input id="zip" type="text" name="zip" class="validate"/>
									<label for="zip">Zip</label>
								</div>
							</div>				
							
							<div class="row">
								<div class="input-field col s12">
									<label for="note">Note</label>								
									<textarea id="note" type="text" name="note" class="form-control" rows="5"></textarea>
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