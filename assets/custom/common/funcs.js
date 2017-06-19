
function clearDDLBItems(field_name, clear_first_element ) {
    var ddlbObj= document.getElementById(field_name);
    try {
        var L= ddlbObj.length;
    }
    catch(e) {
        //alert( "ClearDDLBItems field_name::"+field_name )
    }
    for (var I= L-1; I>=1; I-- ) {
        ddlbObj.remove(I);
    }
    if ( clear_first_element ) ddlbObj.remove(0);
}

function AddDDLBItem( FieldName, id, text) {
    var ddlbObj= document.getElementById(FieldName);
    var OptObj = document.createElement("OPTION");
    OptObj.value= id;
    OptObj.text= text;
    ddlbObj.options.add(OptObj);
    return OptObj;
}

function SetDDLBActiveItem( FieldName, Value) {
    var ddlbObj= document.getElementById(FieldName);
    if ( !ddlbObj ) alert("Error::"+FieldName )
    for(var I=0;I<ddlbObj.options.length;I++) {
        //alert( ddlbObj.options[I].value+"::"+Value )
        if ( ddlbObj.options[I].value == Value ) {
            //alert("INSIDE: "+I)
            ddlbObj.options[I].selected = true;
            return;
        }
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
