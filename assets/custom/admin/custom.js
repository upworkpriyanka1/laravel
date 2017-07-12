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
					//window.location.href = BASE_URL + result;
					window.location.href = result;
				}
				
			}
		});
		
	});
});