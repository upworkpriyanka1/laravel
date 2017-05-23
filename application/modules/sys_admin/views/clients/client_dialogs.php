<div class="modal fade newclient" id="create-contact" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">New Client</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <form action="" method="post" id="form_create_contact" name="form_create_contact" class="form-horizontal">

                                <div class="input-field col-xs-12 name-rem">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="icon_prefix" type="text" class="validate" name="name" value="">
                                    <label for="icon_prefix">Name</label>
                                    <div class="btn-rem-name">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="input-field col-md-6">
                                    <i class="material-icons prefix">business</i>
                                    <input id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Company</label>
                                </div>
                                <div class="input-field col-md-6">
                                    <select>
                                        <option value="" disabled selected>Job title</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                </div>


                                <div class="input-field col-md-12 email-add">
                                    <div class="input-field col-md-6 email-add">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" type="email" class="validate">
                                        <label for="email">Email</label>

                                    </div>
                                    <!-- <div class="input-field col-md-6">
                                         <input id="icon_prefix" type="text" class="validate">
                                         <label for="icon_prefix">Job title</label>
                                     </div>-->
                                    <div class="input-field col-md-6">
                                        <select>
                                            <option value="" disabled selected>Job title</option>
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                            <option value="3">Option 3</option>
                                        </select>
                                    </div>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="input-field col-md-12 email-add">
                                    <div class="input-field col-md-6 email-add">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="icon_telephone" type="tel" class="validate">
                                        <label for="icon_telephone">Phone</label>

                                    </div>
                                    <div class="input-field col-md-6">
                                        <input id="icon_prefix" type="text" class="validate">
                                        <label for="icon_prefix">Job title</label>
                                    </div>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="input-field col-md-12 email-add">
                                    <div class="col-md-4">
                                        <input type="text" name="data[client_city]" id="client_city" value="" class="form-control">
                                        <label for="client_city" class="control-label col-md-2">City</label>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" name="data[client_state]" id="client_state" value="" class="form-control">
                                        <label for="client_state" class="control-label col-md-2">State</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="data[client_zip]" id="client_zip" value="" class="form-control" maxlength="5">
                                        <label for="client_zip" class="control-label col-md-2">Zip</label>
                                    </div>


                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="input-field col-md-6">
                                        <select name="data[clients_types_id]" class="form-control" id="clients_types_id">
                                            <option value=""> -Client Type- </option>
                                            <option value="1">Adult Day Care</option>
                                            <option value="2">Assisted /Senior Living Facilities</option>
                                            <option value="4">Home Health</option>
                                            <option value="5">SYS Admin</option>
                                            <option value="6">testing description</option>
                                            <option value="7">a home providing care for the sick, especially the terminally ill.</option>
                                        </select>
                                    </div>

                                    <input name="group1" type="radio" id="test1" />
                                    <label for="test1">Client Type</label>
                                    <input name="group1" type="radio" id="test2" />
                                    <label for="test2">Business Type</label>

                                </div>
                                <div class="input-field col s12">
                                    <select>
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>

                                </div>










                                <!--<div class="input-field col-xs-12 email-add">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" class="validate">
                                    <label for="email">Email</label>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>
--><!--
                                <div class="input-field col-xs-12">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="icon_telephone" type="tel" class="validate">
                                    <label for="icon_telephone">Phone</label>
                                    <div class="btn-add">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>-->

                                <div class="input-field col-xs-12">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                                    <label for="icon_prefix2">Notes</label>

                                    <div class="btn-rem">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="input-field col-xs-12">
                                    <div class="col-md-2">
                                        <span class="create-contact-more"><a href="#">MORE</a></span>

                                    </div>

                                    <div class="col-md-10 text-right">
                                        <span data-dismiss="modal" role="button">CANCEL </span>
                                        <span class="create-contact-save" data-action="save" role="button"> SAVE </span>
                                    </div>
                                </div>
                            </form>





                        </div>


                    </div>

                </div>

            </div><!-- ./row -->








        </div>


    </div>
</div>  <!-- <div class="modal fade newclient" id="create-contact" -->
