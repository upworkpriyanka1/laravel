<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Clients Db functions
 *
 * ****************************/
class Clients_mdl extends CI_Model
{
    public $m_clients_vendors_table;
    public $m_clients_table;
    private $m_clients_types_table;
    public $m_vendor_table;     // P-Provides; N-Does Not Provides
    private $ClientStatusLabelValueArray = Array('A' => 'Active', 'I' => 'Inactive', 'P' => 'Pending');  // values/labels for enum field
    private $UsersClientsActiveStatusLabelValueArray = Array('E' => 'Employee', 'O' => 'Out Of Staff', 'N' => 'Not Related');
    private $UserActiveStatusLabelValueArray = Array('N' => 'New', 'A' => 'Active', 'I' => 'Inactive');
    private $ClientsVendorsActiveStatusLabelValueArray = Array('P' => 'Provides', 'N' => 'Does Not Provides');

    function __construct()
    {
        parent::__construct();
        $this->m_clients_vendors_table = 'clients_vendors';
        $this->m_clients_table = 'clients';
        $this->m_clients_types_table= 'clients_types';
        $this->m_vendor_table = 'vendors';
    }


    public function getClientStatusValueArray($ret_with_subarray= true)
    {
        $ResArray = array();
        foreach ($this->ClientStatusLabelValueArray as $Key => $Value) {
            if ( $ret_with_subarray ) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            }else {
                $ResArray[$Key]= $Value;

            }
        }
        return $ResArray;
    }

    public function getClientStatusLabel($client_status)
    {
        if (!empty($this->ClientStatusLabelValueArray[$client_status])) {
            return $this->ClientStatusLabelValueArray[$client_status];
        }
        return '';
    }


    public function getUsersClientsActiveStatusValueArray($ret_with_subarray= true)
    {
        $ResArray = array();
        foreach ($this->UsersClientsActiveStatusLabelValueArray as $Key => $Value) {
            if ( $ret_with_subarray ) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            }else {
                $ResArray[$Key]= $Value;

            }
        }
        return $ResArray;
    }

    public function getUsersClientsActiveStatusLabel($active_status)
    {
        if (!empty($this->UsersClientsActiveStatusLabelValueArray[$active_status])) {
            return $this->UsersClientsActiveStatusLabelValueArray[$active_status];
        }
        return '';
    }


    public function getUserActiveStatusValueArray($ret_with_subarray= true)
    {
        $ResArray = array();
        foreach ($this->UserActiveStatusLabelValueArray as $Key => $Value) {
            if ( $ret_with_subarray ) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            }else {
                $ResArray[$Key]= $Value;
            }
        }
        return $ResArray;
    }

    public function getUserActiveStatusLabel($user_active_status)
    {
        if (!empty($this->UserActiveStatusLabelValueArray[$user_active_status])) {
            return $this->UserActiveStatusLabelValueArray[$user_active_status];
        }
        return '';
    }

    public function getClientsVendorsActiveStatusValueArray($ret_with_subarray= true)
    {
        $ResArray = array();
        foreach ($this->ClientsVendorsActiveStatusLabelValueArray as $Key => $Value) {
            if ( $ret_with_subarray ) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            }else {
                $ResArray[$Key]= $Value;

            }
        }
        return $ResArray;
    }

    public function getClientsVendorsActiveStatusLabel($active_status)
    {
        if (!empty($this->ClientsVendorsActiveStatusLabelValueArray[$active_status])) {
            return $this->ClientsVendorsActiveStatusLabelValueArray[$active_status];
        }
        return '';
    }



    ////////////// CLIENTS BLOCK START /////////////

    /**********************
     * Get clients list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of client objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for client_status, client_zip, client_type and between
     * created_at_from and created_at_till
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getClientsList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty($sort))
            $sort = 'client_name';
//        echo '<pre>$filters::'.print_r($filters,true).'</pre>';
        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
        $is_client_type_joined = false;
        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }
        if (!empty($items_per_page) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['client_name'])) {
            $this->db->like( $this->m_clients_table . '.client_name', $filters['client_name'] );
        }
        if (!empty($filters['client_status']) or strlen($filters['client_status']) > 0) {
            $this->db->where($this->m_clients_table.'.client_status = ' . "'" . $filters['client_status'] . "'");
        }
        if (!empty($filters['client_zip'])) {
            $this->db->where($this->m_clients_table.'.client_zip = ' . "'" . $filters['client_zip'] . "'");
        }
        if (!empty($filters['client_type'])) {
            $this->db->where($this->m_clients_table.'.clients_types_id = ' . "'" . $filters['client_type'] . "'");

        }
        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_clients_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_clients_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }

        $additive_fields_for_select = "";
        $fields_for_select = $this->m_clients_table . ".*";
        if ( !empty($filters['show_client_type_description']) ) {
            $additive_fields_for_select .= ", type_description as type_description ";
            if ( !$is_client_type_joined ) {
                $is_client_type_joined= true;
                $this->db->join($this->m_clients_types_table, $this->m_clients_types_table . '.type_id = ' . $this->m_clients_table . '.clients_types_id', 'left');
            }
        }

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
            return $this->db->count_all_results($this->m_clients_table);
        } else {
            $query = $this->db->from($this->m_clients_table);
            $ci = & get_instance();
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

    public function checkIsClient_NameUnique($client_name, $client_id='')
    {
        $config_data = $this->config->config;
        $this->db->like('client_name', $client_name);
        if (!empty($client_id)) {
            $this->db->where('cid != ' . $client_id);
        }
        $checkCount= $this->db->count_all_results($this->m_clients_table);
//        AppUtils::DebToFile(' checkIsclient_nameUnique $checkCount::' . print_r($checkCount, true), false);
        return $checkCount==0;
    }

//    public function checkIsEmailUnique($client_email, $client_id='')
//    {
//        $config_data = $this->config->config;
//        $this->db->like('client_email', $client_email);
//        if (!empty($client_id)) {
//            $this->db->where('cid != ' . $client_id);
//        }
//        $checkCount= $this->db->count_all_results($this->m_clients_table);
//        return $checkCount==0;
//    }


    public function getRowById( $id, $additive_params= array() )
    {
        $this->db->where( $this->m_clients_table . '.cid', $id);
        $query = $this->db->from($this->m_clients_table);
        $ci = & get_instance();

	    $clientRow= $this->db->get()->row();
	    $orig_width= !empty($additive_params['image_width']) ? $additive_params['image_width'] : 64;
	    $orig_height= !empty($additive_params['image_height']) ? $additive_params['image_height'] : 64;
	    if (!empty($additive_params['show_file_info']) and !empty($clientRow->client_img )) {
		    $client_img = $this->getClientDir($id) . $clientRow->client_img;
		    $clientRow->file_info = '';
		    if ( file_exists($client_img) ) {
			    $file_info= $clientRow->client_img;
			    $file_info.= ', '.$this->common_lib->getFileSizeAsString( filesize($client_img) );
			    $fileArray = @getimagesize($client_img);
			    if (!empty($fileArray)) {
				    $file_info.= ', '.$fileArray[0].'x'.$fileArray[1];
			    }
			    $clientRow->file_info = $file_info;
			    $clientRow->image_url = $this->getClientImageUrl($id, $clientRow->client_img);
			    $clientRow->image_path = $this->getClientImagePath($id, $clientRow->client_img);
			    $filenameInfo = $this->common_lib->GetImageShowSize($clientRow->image_path, $orig_width, $orig_height);
			    $clientRow->image_path_width= !empty($filenameInfo['Width']) ? $filenameInfo['Width'] : 0 ;
			    $clientRow->image_path_height= !empty($filenameInfo['Height']) ? $filenameInfo['Height'] : 0 ;
			    $clientRow->image_path_original_width= !empty($filenameInfo['OriginalWidth']) ? $filenameInfo['OriginalWidth'] : 0 ;
			    $clientRow->image_path_original_height= !empty($filenameInfo['OriginalHeight']) ? $filenameInfo['OriginalHeight'] : 0 ;
		    }
	    }
	    return $clientRow;
    }

	public function getClientsDir()
	{
		$ci = & get_instance();
		return $ci->config->config['document_root'] . $ci->config->config['image_clients_directory'];
//		return $ci->config->config['document_root'] . 'uploads/clients/';
	}

	public function getClientDir($client_id= '')
	{
		$ci = & get_instance();
		return $ci->config->config['document_root'] . $ci->config->config['image_client_directory'] . $client_id.DIRECTORY_SEPARATOR;
	}

	public function getClientImageUrl($client_id, $img)
	{
		$ci = & get_instance();
		return $ci->config->config['base_url'] .'/'. $ci->config->config['image_client_directory'] . $client_id.'/' . $img;
	}

	public function getClientImagePath($client_id, $img)
	{
		$ci = & get_instance();
		return $ci->config->config['document_root'] . $ci->config->config['image_client_directory']. $client_id.'/' . $img;
	}

    ////////////// CLIENTS BLOCK END /////////////


    ////////////// CLIENTS TYPES BLOCK START /////////////

    /**********************
     * Get client types in assoc array as key->value
     * access public
     * $filters : assoc keys of fieldname => fieldvalue, if field value is not empty filter is set by this value for client_status, client_zip, client_type and between created_at_from and created_at_till
     * Does not depend on $OutputFormatCount
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort
     * return query array  in assoc array as key->value
     *********************************/
    //public function getClient_TypesSelectionList( $filters = array(), $sort = 'type_name',  $sort_direction = 'asc') : array
    public function getClient_TypesSelectionList( $filters = array(), $sort = 'type_name',  $sort_direction = 'asc')
    {
        $ci = & get_instance();
        $client_typesList = $ci->clients_mdl->getClient_TypesList(false, 0, $filters, $sort, $sort_direction);
        $ResArray = array();
        foreach ($client_typesList as $lclient_type) {
            $ResArray[] = array('key' => $lclient_type->type_id, 'value' => $lclient_type->type_description);
        }
        return $ResArray;
    }

    /**********************
     * Get client Types list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of client types objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for type_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getClient_TypesList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort ))
            $sort = 'type_name';
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

        if (!empty($filters['type_name'])) {
            $this->db->like( $this->m_clients_types_table.'.type_name', $filters['type_name'] );
        }

        $additive_fields_for_select= "";
        $fields_for_select= $this->m_clients_types_table.".*";

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
            return $this->db->count_all_results($this->m_clients_types_table);
        } else {
            $query = $this->db->from($this->m_clients_types_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

	public function getClient_TypesRowById( $id )
	{
		$this->db->where( $this->m_clients_types_table . '.type_id', $id);
		$query = $this->db->from($this->m_clients_types_table);
		$ci = & get_instance();
		$clientTypesRow= $this->db->get()->row();
		return $clientTypesRow;
	}


	public function getClientPhoneTypeArray()
	{
		$query = $this->db->query("SELECT distinct client_phone_type FROM ".$this->m_clients_table." WHERE client_phone_type is not null and TRIM(client_phone_type) != '' order by client_phone_type " );
		$arr= $query->result();
		$ret_array= array();
		foreach( $arr as $next_key=>$next_value ) {
			$ret_array[]= trim($next_value->client_phone_type);
		}
		return $ret_array;
	}

    ////////////// CLIENTS TYPES BLOCK END /////////////



    ////////////// CLIENT-VENDORS BLOCK START /////////////
    /**********************
     * Get clients_vendors list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of clients_vendors objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for vt_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getClients_VendorsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
//        echo '<pre>$filters::'.print_r($filters,true).'</pre>';
        if (empty( $sort ))
            $sort = 'cv_active_status';
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

        if (!empty($filters['cv_active_status']) and empty($filters['join_vendors_right'] ) ) {
            $this->db->where( $this->m_clients_vendors_table.'.cv_active_status', $filters['cv_active_status'] );
        }

        if (!empty($filters['cv_client_id'])) {
            $this->db->where( $this->m_clients_vendors_table.'.cv_client_id', $filters['cv_client_id'] );
        }
        if (!empty($filters['cv_vendor_id'])) {
            $this->db->where( $this->m_clients_vendors_table.'.cv_vendor_id', $filters['cv_vendor_id'] );
        }

        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_clients_vendors_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_clients_vendors_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }


        $additive_fields_for_select= "";
        $is_vendor_joined= false;
        if (!empty($filters['show_vendor_name'])) {
            if ( !$is_vendor_joined ) {
                $join_direction= '';
                $cond_1= '';
                if ( !empty($filters['join_vendors_right'] ) ) {
                    if (!empty($filters['cv_active_status']) ) {
                        $cond_1= ' AND '.$this->m_clients_vendors_table.".cv_active_status = '" . $filters['cv_active_status'] . "' ";
                    }
                    $join_direction= ' right ';
                }
                $this->db->join( $this->m_vendor_table, $this->m_vendor_table . '.vn_id = ' . $this->m_clients_vendors_table . '.cv_vendor_id' . $cond_1, $join_direction );
            }
            $additive_fields_for_select.= ', '.$this->m_vendor_table.".vn_name" . ", " . $this->m_vendor_table.".vn_id" . ", " . $this->m_vendor_table.".vn_email" . ", " . $this->m_vendor_table.".vn_website";
            $is_vendor_joined= true;
        }

        $fields_for_select= $this->m_clients_vendors_table.".*";

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
            return $this->db->count_all_results($this->m_clients_vendors_table);
        } else {
            $query = $this->db->from($this->m_clients_vendors_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

//setProvidesVendorsEnabled vendor_name::vendor_1  provides_vendors_cv_active_status_label::Provides  related_vendor_id::1
    /**********************
     * update/insert clients_vendors table with new_status
     * depending if there is such row
     * access public
     * @ params
     * return clients_vendors.cv_id
     *********************************/
    public function update_clients_vendors( $client_id, $related_vendor_id, $new_status ) {
        $date_time_mysql_format= $this->common_lib->getSettings('date_time_mysql_format', '%Y-%m-%d %H:%M:%S');
        $this->db->where( $this->m_clients_vendors_table . '.cv_client_id', $client_id);
        $this->db->where( $this->m_clients_vendors_table . '.cv_vendor_id', $related_vendor_id);
        $query = $this->db->from($this->m_clients_vendors_table);
        $row = $query->get()->result();
        if ( !empty($row) and !empty($row[0]->cv_id) ) {
            $this->db->where( $this->m_clients_vendors_table . '.cv_id', $row[0]->cv_id);
            $data = array(
                'cv_client_id' => $client_id ,
                'cv_vendor_id' => $related_vendor_id,
                'cv_active_status'=> $new_status,
                'updated_at'=> strftime($date_time_mysql_format)
            );
            $this->db->update($this->m_clients_vendors_table, $data);
            return $row[0]->cv_id;
        } else {
            $data = array(
                'cv_client_id' => $client_id ,
                'cv_vendor_id' => $related_vendor_id,
                'cv_active_status'=> $new_status,
                'updated_at'=> strftime($date_time_mysql_format)
            );
            $this->db->insert($this->m_clients_vendors_table, $data);
            return $this->db->insert_id();
        }
    }


	public function getSimilarClientByClient_Email($client_email, $cid='')
	{
		$config_data = $this->config->config;
		$this->db->where('client_email', $client_email);
		$this->db->from($this->m_clients_table);
		if (!empty($cid)) {
			$this->db->where('cid != ' . $cid);
		}
		$row= $this->db->get()->result();
		if (empty($row[0])) return false;
		return $row[0];
	}

    ////////////// CLIENT-VENDORS BLOCK END /////////////



    public function get_clients_type ()
    {

        $this->db->from('clients_types');
        $query = $this->db->get();
        return $query->result();
//        $result = $query->result_array();
    }

}