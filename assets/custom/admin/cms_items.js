function cms_itemRemove( ci_id, ci_title ) {
    if ( confirm( "Do you want to remove '"+ci_title+"' cms item ? ") ) {
        document.location = "/sys-admin/cms_items/remove_cms_items/ci_id/" + ci_id;
    }
}
