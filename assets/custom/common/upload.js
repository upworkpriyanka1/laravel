//creates console functions if it don't exist
if (!window.console) console = {};
console.log = console.log || function(){};
/**********************
* Show console debug
* param debug
**********************/
function do_debug(msg) {
    if (debug){
        console.log(msg);
    }
}
/****************
 *FILE UPLOAD
 ****************/
	var UploadScriptURL = '/upload';
	var files;// Variable to store your files
    $(document).on('click', '.modalshow', function(e){
        console.log($(this).attr('data-id'));
        $('#TheFile').val(""); //clear filename
        $('#modal').data('field', $(this).attr('data-id'));
        $('#modal').data('filename', $(this).attr('data-filename'));
        $('#modal').data('folder', $(this).attr('data-folder'));
		$('#modal').modal(); //show modal
		$('.modalButton').attr('disabled','disabled'); //disable btn
        return false;
    });

// Add events
	$('input[type=file]').on('change', prepareUpload);
	$('#FileForm').on('submit', uploadFiles);

//Show file name in input
	$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
	});
//Validate file on select
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        var DoUpload = true;
        if (this.files[0].size> MaxUpladSize){ //validate size
		    ShowAlert(TXT_TooBig,'err'); //file is large
			$('input[type=file]').val("");
			$('.modalButton').attr('disabled','disabled');
            DoUpload = false;
            return;
		}
        var regex = new RegExp("\.(" + AllowedTypes + ")$", "i");
        // at this point, the line above is the same as: var regex = /#abc#/g;
        if (!(regex).test(this.files[0].name.toLowerCase())) { //validate allowewd type
            ShowAlert(TXT_Allowed,'err');
			$('input[type=file]').val("");
            DoUpload = false;
            return;
        }
        if ( DoUpload) {
            RemoveAlert();
            var input = $(this).parents('.input-group').find(':text'),
            SelectedFile = numFiles > 1 ? numFiles + ' files selected' : label;
            $('.modalButton').removeAttr('disabled');
            if(input.length ) {
                input.val(SelectedFile);
            }else {
                if( SelectedFile ){ do_debug(SelectedFile);};
            }
        }
    });


// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}

// Catch the form submit and upload the files
	function uploadFiles(event){
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
        ShowAlert(TXT_Uploading,'ok'); //show uploading
        var field = $('#modal').data('field');
		var filename= $('#modal').data('filename');
        var folder= $('#modal').data('folder');
   		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);

		});

        $.ajax({
            url: UploadScriptURL +'?files&filename='+filename+'&folder='+folder,
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // false because jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {

                do_debug(data.error);
                if(typeof data.error === 'undefined') //No errors
            	{
                    var originalFile = $('input[type=file]').val();
                    var newValue = originalFile.replace('C:\\fakepath\\', '');
                    do_debug(originalFile);
                    $('#'+field+'_original').val(newValue);
                    $('#'+field).val(data.formData);
                    $('input[type=file]').val("");
					$('.modal').modal('hide');
                    $('#'+field).valid();
            	}
            	else
            	{ // errors here
            		do_debug('ERRORS: ' + data.error);
            	    ShowAlert(data.error,'err');
                    $('.modalButton').removeAttr('disabled');
            	}
            },
           error: function(jqXHR, textStatus, errorThrown)
           {
           	//AJAX Post errors here
                do_debug('AJAX POST ERRORS: ' + textStatus);
				ShowAlert(LngAjaxError+': '+data.error,'err');
                $('.modalButton').removeAttr('disabled');
           },

        });
    }

    //show ajax messages
    	function ShowAlert(msg,type) {
    		$( "#output" ).removeClass();
    		$( "#output" ).addClass("alert alert-info");
    		if (type=='err') {
    		   $( "#output" ).addClass("alert alert-danger");
    		}
    		$("#output").html(msg);
    		$("#output").delay(200).fadeIn().delay(2000).fadeOut();
    	}
    //remove ajax messages
    	function RemoveAlert(){
    		$( "#output" ).removeClass();
    		$( "#output" ).html('');
    	}
//End File uplaod
