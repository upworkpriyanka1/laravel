jQuery(document).ready(function ($) {
    set_error_keypress()
    $("#sv_title").focus();
    // alert( "is_insert::"+is_insert )
    if (is_insert == '') {
        load_service_images()
    }
});

/**********************
 * List of service images reloading
 * access public
 * params : service_id - service id of loaded images.
 * return none
 *********************************/
function load_service_images() {
    var HRef = base_url+"sys-admin/services/upload_image_to_tmp_service/service_id/" + sv_id
    $('.service_image_fileupload').fileupload({
        url: HRef,
        type: "POST",
        // 'csrf_test_name': $.cookie('csrf_cookie_name'), // TODO : UNCOMMENT ON LIVE
        dataType: 'json',
        done: function (e, data) {
            $("#div_upload_image").css("display", "none");
            $("#div_save_upload_image").css("display", "block");
            $("#img_preview_image").attr("src", data.result.files.url);

            $("#img_preview_image").attr("width", data.result.files.FilenameInfo.Width);
            $("#img_preview_image").attr("height", data.result.files.FilenameInfo.Height);
            var info = data.result.files.short_name + ", " + data.result.files.FilenameInfo.Width + "x" + data.result.files.FilenameInfo.Height + ", " + data.result.files.sizeLabel
            $("#img_preview_image_info").html(info);
            $("#is_main_image").prop('checked', false);
            $("#is_main_image").removeAttr("checked");
            $("#hidden_selected_image").val(data.result.files.name);
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    $("#is_main_image").prop('checked', false);
    $("#is_main_image").removeAttr("checked");


    var href= base_url+"sys-admin/services/load_service_images/service_id/"+sv_id
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                $('#div_load_service_images').html(result.html)
                if ( result.service_max_images_limit_error != "") {
                    $("#div_upload_image").css("display", "none");
                    $("#div_upload_image_info").html(result.service_max_images_limit_error);
                } else {
                    $("#div_upload_image_info").html("");
                }
            }
        }
    });
}

function UploadImage() {
    var hidden_selected_image= $("#hidden_selected_image").val();
    var is_main_image= $("#is_main_image").is(':checked')
    var HRef=  base_url+"sys-admin/services/upload_image_to_service/service_id/"+sv_id+"/service_image/"+tbUrlEncode(hidden_selected_image)+"/is_main_image/"+(is_main_image==1?"Y":"N")
    jQuery.ajax({
        url: HRef,
        type: 'POST',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                load_service_images()
                CancelUploadImage()
            }
            if (result.ErrorCode > 0) {
                alert( result.ErrorMessage )
            }
        }
    });
}
function CancelUploadImage() {
    $("#div_upload_image").css("display", "block");
    $("#div_save_upload_image").css("display", "none");
    $("#img_preview_image").attr( "src","" );
    $("#hidden_selected_image" ).val( "" );
    $("#is_main_image").prop('checked', false);
    $("#is_main_image").removeAttr("checked");
}

function deleteServiceImage(si_id, service_id, si_image){
    if ( !confirm("Do you want to delete "+si_image+" image ?") ) return;
    var HRef=  base_url+"sys-admin/services/delete_service_image/service_image_id/"+si_id+"/service_image/"+tbUrlEncode(si_image)+"/service_id/"+service_id
    jQuery.ajax({
        url: HRef,
        type: 'POST',
        dataType: 'json',
        success: function(result) {
            if (result.ErrorCode == 0) {
                load_service_images()
                CancelUploadImage()
            }
            if (result.ErrorCode > 0) {
                alert( result.ErrorMessage )
            }
        }
    });

}

function onSubmit() {
    var theForm = $("#form_service_edit");
    theForm.submit();
}

function set_error_keypress() {
    $(".has-error").bind('change keypress', function () {
        $(this).removeClass("has-error");
    });
}
/**********************
 * Debugging function of different scalar/object value
 * params : oElem - scalar/object value. When oElem is too big(say in alert function) number values for from_line and till_line could be given to show big value by parts
 * access public
 * return none
 *********************************/
function var_dump(oElem, from_line, till_line) {
    var sStr = '';
    if (typeof(oElem) == 'string' || typeof(oElem) == 'number')     {
        sStr = oElem;
    } else {
        var sValue = '';
        for (var oItem in oElem) {
            sValue = oElem[oItem];
            if (typeof(oElem) == 'innerHTML' || typeof(oElem) == 'outerHTML') {
                sValue = sValue.replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }
            sStr += 'obj.' + oItem + ' = ' + sValue + '\n';
        }
    }
    //alert( "from_line::"+(typeof from_line) )
    if ( typeof from_line == "number" && typeof till_line == "number" ) {
        return sStr.substr( from_line, till_line );
    }
    if ( typeof from_line == "number" ) {
        return sStr.substr( from_line );
    }
    return sStr;
}

function tbUrlEncode(str)
{
    str = str.replace(/\//g, "ZZZZZ");
    str = str.replace(/\./g, "XXXXX");
    str = str.replace(/\-/g, "YYYYY");
    str = str.replace(/\_/g, "WWWWW");

    return str;
}
