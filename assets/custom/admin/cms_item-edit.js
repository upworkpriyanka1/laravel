jQuery(document).ready(function ($) {
    set_error_keypress()
    $("#ci_title").focus();
    CKEditorInit()
});


function onSubmit() {
    var theForm = $("#form_cms_item_edit");
    theForm.submit();
}

function set_error_keypress() {
    $(".has-error").bind('change keypress', function () {
        $(this).removeClass("has-error");
    });
}

function CKEditorInit()         // http://docs.ckeditor.com/#!/guide/dev_configuration
{
    CKEDITOR.replace( 'ci_content', {
        language: 'eb',
        uiColor: '#9AB8F3',
        width: "auto",
        height : '400'
    });
}


function cms_itemRemove( ci_id, ci_title ) {
    if ( confirm( "Do you want to remove '"+ci_title+"' cms item ? ") ) {
        document.location = "/sys-admin/cms_items/remove_cms_items/ci_id/" + ci_id;
    }
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
