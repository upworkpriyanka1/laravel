<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Vendors Db functions
 *
 * ****************************/
class Vendors_mdl extends CI_Model
{
    public $m_vendor_types_table;
    public $m_vendors_table;
    public $m_vendors_have_types_table;
    public $m_vendor_contacts_table;

    function __construct()
    {
        parent::__construct();
        $this->m_vendor_types_table= 'vendor_types';
        $this->m_vendors_table= 'vendors';
        $this->m_vendors_have_types_table= 'vendors_have_types';
        $this->m_vendor_contacts_table= 'vendor_contacts';
    }


    ////////////// VENDORS-TYPES BLOCK START /////////////
    public function getVendorTypesSelectionList( $filters = array(), $sort = 'vt_name',  $sort_direction = 'asc')
    {
        $ci = & get_instance();
        $vendor_typesList = $ci->vendors_mdl->getVendor_TypesList(false, 0, $filters, $sort, $sort_direction);
        $ResArray = array();
        foreach ($vendor_typesList as $lvendor_type) {
            $ResArray[] = array('key' => $lvendor_type->vt_id, 'value' => $lvendor_type->vt_name);
        }
        return $ResArray;
    }

    /**********************
     * Get vendor_types Types list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of vendor_types types objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for vt_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getVendor_TypesList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort ))
            $sort = 'vt_name';
        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }
        if (!empty($config_data) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['vt_name'])) {
            $this->db->like( $this->m_vendor_types_table.'.vt_name', $filters['vt_name'] );
        }
        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_vendor_types_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_vendor_types_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }

        $additive_fields_for_select= "";
        $fields_for_select= $this->m_vendor_types_table.".*";

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {
            $this->db->limit($limit, $offset);
        }

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {
            $this->db->limit($limit);
        }

	    if ( !empty($filters['show_vendors_count']) ) {
		    if ( empty($filters['product_status']) ) {
			    $additive_fields_for_select .= ', ( select count(*) from ' . $this->m_vendors_have_types_table . ' where ' . $this->m_vendors_have_types_table . '.vh_vendor_type_id = ' . $this->m_vendor_types_table . '.vt_id ) as vendors_count ';
		    }
	    }

        $fields_for_select.= ' ' . $additive_fields_for_select;

        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_vendor_types_table);
        } else {
            $query = $this->db->from($this->m_vendor_types_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

    public function getVendor_TypeRowById( $id )
    {
        $this->db->where( $this->m_vendor_types_table . '.vt_id', $id);
        $query = $this->db->from($this->m_vendor_types_table);
        $ci = & get_instance();
        $resultRows = $query->get()->result();
        if ( !empty($resultRows[0]) ) {
            return $resultRows[0];
        }
        return false;
    }

    public function getSimilarVendor_TypeByVt_Name($vt_name, $vt_id='')
    {
        $config_data = $this->config->config;
        $this->db->where('vt_name', $vt_name);
        $this->db->from($this->m_vendor_types_table);
        if (!empty($vt_id)) {
            $this->db->where('vt_id != ' . $vt_id);
        }
        $row= $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }


	public function deleteVendor_Type($id)
	{
		if (!empty($id)) {
			$this->db->where('vt_id', $id);
			$Res = $this->db->delete( $this->m_vendor_types_table );
			return $Res;
		}
	}

    ////////////// VENDORS-TYPES BLOCK END /////////////


    ////////////// VENDORS BLOCK START /////////////
    /**********************
     * Get vendors Types list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of vendors types objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for vn_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/

    public function getVendorsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort ))
            $sort = 'vn_name';

//	    echo '<pre>++::'.print_r($filters,true).'</pre>';
//	    die("-1 XXZ");
        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }
        if (!empty($config_data) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        $is_vendors_have_types_joined = false;
        if (!empty($filters['vn_name'])) {
            $this->db->like( $this->m_vendors_table.'.vn_name', $filters['vn_name'] );
        }
        if (!empty($filters['vendor_type_id'])) {
            if ( !$is_vendors_have_types_joined ) {
                $this->db->join($this->m_vendors_have_types_table, $this->m_vendors_have_types_table . '.vh_vendor_id = ' . $this->m_vendors_table . '.vn_id' . ' AND ' .
                    $this->m_vendors_have_types_table.'.vh_vendor_type_id = ' . "'" . $filters['vendor_type_id'] . "'"/*, 'right'*/);
            }
            $is_vendors_have_types_joined= true;
        }

        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_vendors_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_vendors_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }

        $additive_fields_for_select= "";
        $fields_for_select= $this->m_vendors_table.".*";
        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {
            $this->db->limit($limit, $offset);
        }

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {
            $this->db->limit($limit);
        }
        $fields_for_select.= ' ' . $additive_fields_for_select;

        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_vendors_table);
        } else {
            $query = $this->db->from($this->m_vendors_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

    public function getVendorRowById( $id )
    {
        $this->db->where( $this->m_vendors_table . '.vn_id', $id);
        $query = $this->db->from($this->m_vendors_table);
        $ci = & get_instance();
        $resultRows = $query->get()->result();
        if ( !empty($resultRows[0]) ) {
            return $resultRows[0];
        }
        return false;
    }

    public function getSimilarVendorByVn_Name($vn_name, $vn_id='')
    {
        $config_data = $this->config->config;
        $this->db->where('vn_name', $vn_name);
        $this->db->from($this->m_vendors_table);
        if (!empty($vn_id)) {
            $this->db->where('vn_id != ' . $vn_id);
        }
        $row= $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }

    public function getSimilarVendorByVn_Email($vn_email, $vn_id='')
    {
        $config_data = $this->config->config;
        $this->db->where('vn_email', $vn_email);
        $this->db->from($this->m_vendors_table);
        if (!empty($vn_id)) {
            $this->db->where('vn_id != ' . $vn_id);
        }
        $row= $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }

    ////////////// VENDORS BLOCK END /////////////



    ////////////// VENDOR-CONTACTS BLOCK START /////////////
    public function getVendorContactsSelectionList( $filters = array(), $sort = 'vt_name',  $sort_direction = 'asc')
    {
        $ci = & get_instance();
        $vendor_contactsList = $ci->vendors_mdl->getVendor_ContactsList(false, 0, $filters, $sort, $sort_direction);
        $ResArray = array();
        foreach ($vendor_contactsList as $lvendor_contact) {
            $ResArray[] = array('key' => $lvendor_contact->vc_id, 'value' => $lvendor_contact->vc_person_name);
        }
        return $ResArray;
    }

    /**********************
     * Get vendor_contacts list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of vendor_contacts objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for vt_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getVendor_ContactsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort ))
            $sort = 'vc_person_name';
        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }
        if (!empty($config_data) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['vc_person_name'])) {
            $this->db->like( $this->m_vendor_contacts_table.'.vc_person_name', $filters['vc_person_name'] );
        }
        if (!empty($filters['vc_vendor_id'])) {
            $this->db->where( $this->m_vendor_contacts_table.'.vc_vendor_id', $filters['vc_vendor_id'] );
        }
        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_vendor_contacts_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_vendor_contacts_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }

        $additive_fields_for_select= "";
        $fields_for_select= $this->m_vendor_contacts_table.".*";

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {
            $this->db->limit($limit, $offset);
        }

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {
            $this->db->limit($limit);
        }
        $fields_for_select.= ' ' . $additive_fields_for_select;

        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_vendor_contacts_table);
        } else {
            $query = $this->db->from($this->m_vendor_contacts_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

    public function getVendor_ContactRowById( $id )
    {
        $this->db->where( $this->m_vendor_contacts_table . '.vc_id', $id);
        $query = $this->db->from($this->m_vendor_contacts_table);
        $ci = & get_instance();
        $resultRows = $query->get()->result();
        if ( !empty($resultRows[0]) ) {
            return $resultRows[0];
        }
        return false;
    }

    public function getSimilarVendor_ContactByVt_Name($vt_name, $vc_id='')
    {
        $config_data = $this->config->config;
        $this->db->where('vt_name', $vt_name);
        $this->db->from($this->m_vendor_contacts_table);
        if (!empty($vc_id)) {
            $this->db->where('vc_id != ' . $vc_id);
        }
        $row= $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }


    public function updateVendorContact($id, $DataArray)
    {
        if (empty($id)) {
            $Res = $this->db->insert($this->m_vendor_contacts_table, $DataArray);
            if ($Res)
                return $this->db->insert_id();
        } else {
            $Res = $this->db->update($this->m_vendor_contacts_table, $DataArray, array('vc_id' => $id));
            if ($Res)
                return $id;
        }
    }

    /**********************
     * Get vendors_have_types list/rows count depending of filters parameters
     * acces public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of vendors_have_types objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : asoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for vt_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getVendors_Have_TypesList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort ))
            $sort = 'created_at';
        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }
        if (!empty($config_data) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['vh_vendor_id'])) {
            $this->db->where( $this->m_vendors_have_types_table.'.vh_vendor_id', $filters['vh_vendor_id'] );
        }
        if (!empty($filters['vh_vendor_type_id'])) {
            $this->db->where( $this->m_vendors_have_types_table.'.vh_vendor_type_id', $filters['vh_vendor_type_id'] );
        }

        $fields_for_select= $this->m_vendors_have_types_table.".*";

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {
            $this->db->limit($limit, $offset);
        }

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {
            $this->db->limit($limit);
        }

        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_vendors_have_types_table);
        } else {
            $query = $this->db->from($this->m_vendors_have_types_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

    public function updateVendorHave_Types($vendor_id, $DataArray)
    {
        if (empty($vendor_id)) return;

        $this->db->where('vh_vendor_id', $vendor_id);
        $this->db->delete($this->m_vendors_have_types_table);

        foreach( $DataArray as $next_key=>$next_vendor_have_type_id ) {
            $Res = $this->db->insert($this->m_vendors_have_types_table, array( 'vh_vendor_id'=> $vendor_id, 'vh_vendor_type_id'=> $next_vendor_have_type_id ) );
        }

    }

    ////////////// VENDOR-CONTACTS BLOCK END /////////////



}