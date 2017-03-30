        <!-- BEGIN FOOTER -->
        <div class="clearfix"></div>
        <div class="page-footer">
            <div class="container">

                    <div class="col-lg-6 col-md-12 text-center">
                        <ul class="footer-list">
                            <li><a href="#">About</a> |</li>
                            <li><a href="#">Terms & Conditions</a> |</li>
                            <li><a href="#"> Privacy Policy </a> |</li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-12 text-right pg-footer-center">
                        <div class="page-footer-inner">
                            Copyright &copy; Zentral <?php echo date('Y'); ?>
                        </div>
                        <div class="scroll-to-top">
                            <i class="icon-arrow-up"></i>
                        </div>
                    </div>
            </div>

        </div>
        <div class="modal fade newclient" id="newclient" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-top">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">New Client</h3>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">

                        <div class="col-xs-12">

                                <ul class="md-foot-top">
                                    <li class="create-contact-more"><button class="btn-flat disable_form_id_form_client_edit" disabled>+CONTACT</button></li>
                                    <li class="create-contact-more"><button class="btn-flat  disable_form_id_form_client_edit supuser" disabled>+SUPERUSER</button></li>
                                </ul>

                                <ul class ="md-foot-bot">
                                    <li data-dismiss="modal"> <button class="btn" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'">CANCEL</button> </li>
                                    <li class="create-contact-save " data-action="save"> <button class="btn-flat  disable_form_id_form_client_edit" disabled> SAVE</button> </li>
                                </ul>


                        </div>
                    </div>
                </div>
                <div class=" modal-content modal-content1"  style="display: none">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">Company Name</h3>
                    </div>


                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="icon_prefix" type="text" class="validate"/>
                                    <label for="icon_prefix">First Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">supervisor_account</i>
                                    <input id="last_name" type="text" class="validate"/>
                                    <label for="last_name">Last Name</label>
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
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" class="validate required_form"  onchange="validateFormEnableOrDisable('form_client_edit2');"/>
                                    <label for="email">Email address</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" class="validate required_form" onchange="validateFormEnableOrDisable('form_client_edit2');"/>
                                    <label for="email">Verify email address</label>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="modal-footer">

                        <div class="col-xs-12">


                            <ul class ="md-foot-bot">

                                <li data-dismiss="modal"> <button class="btn" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'">CANCEL</button> </li>
                                <li class="create-contact-save " data-action="save"> <button class="btn-flat  disable_form_id_form_client_edit2" disabled> VERIFY </button> </li>


                            </ul>


                        </div>
                    </div>

                </div>
            </div>
    </div>