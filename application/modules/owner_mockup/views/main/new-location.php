<style>.modal-backdrop{z-index:99;}</style>
<!-- New Location modal -->
<div class="modal fade newclient" id="new_user_modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="z-index:99;">
	<div class="modal-dialog">
		<div class="modal-content modal-top">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">New Location</h3>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="row">
						<form class="col s12">
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" name="name" class="validate"/>
									<label for="icon_prefix">Name</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">supervisor_account</i>
									<input id="ltype" name="ltype" type="text" class="validate"/>
									<label for="ltype">Type</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">business</i>
									<input id="address" type="text" class="validate"/>
									<label for="address">Address</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">business</i>
									<input id="address2" type="text" class="validate"/>
									<label for="address2">Address 2</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col-md-4">
									<i class="material-icons prefix">location_on</i>
									<input id="city" type="text" class="validate"/>
									<label for="city">City</label>
								</div>
								<div class="input-field col-md-4">                          
									<input id="state" type="text" class="validate"/>
									<label for="state">State <span class="required">&nbsp;*&nbsp;</span></label>
								</div>
								 <div class="input-field col-md-4"><input id="zip" type="text" class="validate"/>
									<label for="zip">Zip <span class="required">&nbsp;*&nbsp;</span></label>
								</div>
							</div>										
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">phone</i>
									<input id="icon_telephone" type="tel" class="validate"/>
									<label for="icon_telephone">Telephone</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<i class="material-icons prefix">Fax</i>
									<input id="fax" type="text" class="validate" />
									<label for="fax">Fax</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">                            
									<input id="lic_no" type="text" class="validate" />
									<label for="lic_no">Lic #</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12"> 
									<input id="nlicence" type="text" class="validate" />
									<label for="nlicence">Name of Licensee</label>
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