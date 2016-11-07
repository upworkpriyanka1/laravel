var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#client-add');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                //ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                    'data[client_name]': {
                        required: true
                    },
                    'data[client_owner]': {
                        required: true
                    },
                    'data[client_address1]': {
                        required: true
                    },
                    'data[client_city]': {
                        required: true
                    },
                    'data[client_state]': {
                        required: true
                    },

                    'data[client_zip]': {
                        required: true
                    },
                    'data[client_phone]': {
                        required: true
                    },
                    'data[client_email]': {
                        required: true,
                        email: true
                    },
                    'data[client_website]': {
                        required: true,
                        url: true
                    },
                    'client_type[]': {
                        required: true
                    }

                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight

                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success1.show();

                    error1.hide();

                    post_form();
                    App.scrollTo(error1, -200);
                }
            });


    }
    return {
        //main function to initiate the module
        init: function () {


            handleValidation1();

        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});

function post_form(){
    var form1 = $('#client-add');

    var error1      = $('.alert-danger', form1);
    var success1    = $('.alert-success', form1);
    var action      = $( "#BtnSave" ).data( "action");
    var formURL     = $('#client-add').attr("action");
    var inputs      = $('#client-add :input');
    var values      = inputs.serialize() + '&ajaxpost=1';
      $.ajax({
            type: "POST",
            cache: false,
            url: formURL,
            data: values
        })
       .done(function( msg ) {
            //console.log(msg);
            if (msg) {//get server msg
                var res =  msg.substr(0, msg.indexOf('-'));
                if ($.isNumeric(msg)){ //if msg starts numeric, ie last db insert id
                    var msg1 = msg.substr(msg.indexOf("-") + 1)

                    success1.show();
                    if (action == 'add')
                        {$(form1)[0].reset();}


                }else{//if msg NOT numeric, ie error msg from server
                    success1.hide();
                    error1.show();
                    error1.html(msg);
                }
            }
        })
        .fail(function() { //For some reason Ajax post failed
            success1.hide();
            error1.show();
            error1.html('Critical Error: Ajax Post failed');



        });


}