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
                    <div class="col-lg-6 col-md-12 text-center">
                        <div class="page-footer-inner" style="padding-left: 30px;">
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
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">New Client</h3>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">

                        <div class="col-xs-12">
                            <div class="col-md-6">
                                <ul>
                                    <li class="create-contact-more"><a href="#">+CONTACT</a> </li>
                                    <li class="create-contact-more"><a href="#">+SUPERUSER</a></li>
                                </ul>


                            </div>

                            <div class="col-md-6 ">
                                <ul>
                                    <li data-dismiss="modal" role="button"><a href="#" onclick="javascript:document.location='<?=base_url()?>sys-admin/clients-view<?=$page_parameters_with_sort?>'">CANCEL</a>  </li>
                                    <li class="create-contact-save" data-action="save" role="button"><a href="#"> SAVE</a> </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>