var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#contact-type-add');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                //ignore: "",  // validate all fields including form hidden input
                    rules: {
                    'data[name]': {
                        minlength: 2,
                        required: true
                    },
                    'data[description]': {
                        minlength: 2,
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
     $('.editableTxt').editable();
});

function post_form(){
    var form1 = $('#contact-type-add');

    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    var formURL = $('#contact-type-add').attr("action");
    var inputs = $('#contact-type-add :input');
    var values = inputs.serialize() + '&ajaxpost=1';
    console.log(inputs.serialize());
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

                    var name = $( "#name" ).val();
                    $('#contact_types tbody').append('<tr><td> </td><td>'+name.replace(/[\W-]+/g,"-")+'</td></tr>');
                    $(form1)[0].reset();

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