function onuserSubmit() {

    var theForm = $("#form_user_edit");
    theForm.submit();

}
$(function() {
    $( "#form_user_edit" ).validate();
	$(".userphone").rules("add", { 
		required: true,
		phoneUS: true
	});
	$(".user_email_confirm").rules("add", { 
		equalTo: ".user_email"
	});
});