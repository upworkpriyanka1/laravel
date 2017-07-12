function onuserSubmit() {

    var theForm = $("#form_user_edit");
    theForm.submit();

}
$(document).ready(function() {
	$(".user_client_title").click(function() {
		var client_id = $(this).attr('data-client_id');
		var title_id = $(this).attr('data-title_id');
		
		//alert("client : " + client_id + " title is : " + title_id);
		
		// Ajax call to set login parameters for selected client and title
		var href= "login/set_client_title_session/client/"+client_id+"/title/"+title_id;
		$.ajax({
			url: href,
			type: 'GET',
			//dataType: 'json',
			success: function(result) {
				 //alert( "result::"+var_dump(result.client) )
				/*console.log("========= result is : =========");
				console.log(result);*/
				//alert(result);
				if(result != '')
				{
					//alert('here in if...');
					window.location.href = BASE_URL + result;
				}
				/*if (result.ErrorCode == 0) {
					$('#span_client_client_name_logo_first').html(result.client.formatted_client_logo_first);
					$('#span_client_client_name').html(result.client.client_name);
	
					if ( result.client.client_owner == "" ) {
						$('#div_client_client_owner').css("display", "none");
					} else {
						$('#div_client_client_owner').css("display", "block");
						$('#span_client_client_owner').html(result.client.client_owner)
					}
	
					if ( result.client.client_email == "" ) {
						$('#div_client_client_email').css("display", "none");
					} else {
						$('#div_client_client_email').css("display", "block");
						$('#span_client_client_email').html(result.client.client_email)
					}
	
					if ( result.client.formatted_client_city == "" ) {
						$('#div_client_client_city').css("display", "none");
					} else {
						$('#div_client_client_city').css("display", "block");
						$('#span_client_client_city').html(result.client.formatted_client_city)
					}
	
					if ( result.client.formatted_client_type_label == "" ) {
						$('#div_client_client_type_label').css("display", "none");
					} else {
						$('#div_client_client_type_label').css("display", "block");
						$('#span_client_client_type_label').html(result.client.formatted_client_type_label)
					}
	
					if ( result.client.formatted_client_address == "" ) {
						$('#div_client_client_address1').css("display", "none");
					} else {
						$('#div_client_client_address1').css("display", "block");
						$('#span_client_client_address1').html(result.client.formatted_client_address)
					}
					if ( result.client.formatted_client_phone == "" ) {
						$('#div_client_client_phone').css("display", "none");
					} else {
						$('#div_client_client_phone').css("display", "block");
						$('#span_client_client_phone').html(result.client.formatted_client_phone)
					}
				}*/
			}
		});
		
	});
});