<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Services Db functions
 *
 * ****************************/
class Services_mdl extends CI_Model
{
    public $m_services_table;
    public $m_service_images_table;
    public $m_vendor_types_table;
    private $ServiceActiveStatusLabelValueArray = Array('A' => 'Active', 'I' => 'Inactive');   // values/labels for enum field

    function __construct()
    {
        parent::__construct();
        $this->m_services_table= 'services';
        $this->m_service_images_table= 'service_images';
        $this->m_vendor_types_table= 'vendor_types';
    }


    public function getServiceActiveStatusValueArray($ret_with_subarray= true)
    {
        $ResArray = array();
        foreach ($this->ServiceActiveStatusLabelValueArray as $Key => $Value) {
            if ( $ret_with_subarray ) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            }else {
                $ResArray[$Key]= $Value;

            }
        }
        return $ResArray;
    }

    public function getServiceActiveStatusLabel($client_active_status)
    {
        if (!empty($this->ServiceActiveStatusLabelValueArray[$client_active_status])) {
            return $this->ServiceActiveStatusLabelValueArray[$client_active_status];
        }
        return '';
    }

    ////////////// SERVICES BLOCK START /////////////
    /**********************
     * Get services Types list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of services types objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for sv_title,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/

    public function getServicesList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort ))
            $sort = 'sv_title';
//        echo '<pre>$filters::'.print_r($filters,true).'</pre>';
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

        if (!empty($filters['sv_title'])) {
            $this->db->like( $this->m_services_table.'.sv_title', $filters['sv_title'] );
        }
        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_services_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_services_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }


        if (!empty($filters['vendor_type_id'])) {
            $this->db->where( $this->m_services_table.'.sv_vendor_type_id', $filters['vendor_type_id'] );
        }

        if (!empty($filters['active_status'])) {
            $this->db->where( $this->m_services_table.'.sv_active_status', $filters['active_status'] );
        }

        $additive_fields_for_select= '';
        $is_vendor_types_joined= false;
        if (!empty($filters['show_vendor_type_name'])) {
            if ( !$is_vendor_types_joined ) {
                $this->db->join( $this->m_vendor_types_table, $this->m_vendor_types_table . '.vt_id = ' . $this->m_services_table . '.sv_vendor_type_id' );
            }
            $additive_fields_for_select.= ', '.$this->m_vendor_types_table.".vt_name";
            $is_vendor_types_joined= true;
        }



        $fields_for_select= $this->m_services_table.".*";
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
            return $this->db->count_all_results($this->m_services_table);
        } else {
            $query = $this->db->from($this->m_services_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

    public function getServiceRowById( $id )
    {
        $this->db->where( $this->m_services_table . '.sv_id', $id);
        $query = $this->db->from($this->m_services_table);
        $ci = & get_instance();
        $resultRows = $query->get()->result();
        if ( !empty($resultRows[0]) ) {
            return $resultRows[0];
        }
        return false;
    }

    public function getSimilarServiceBySv_Title($sv_title, $sv_id='')
    {
        $config_data = $this->config->config;
        $this->db->where('sv_title', $sv_title);
        $this->db->from($this->m_services_table);
        if (!empty($sv_id)) {
            $this->db->where('sv_id != ' . $sv_id);
        }
        $row= $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }

    public function getSimilarServiceByVn_Email($vn_email, $sv_id='')
    {
        $config_data = $this->config->config;
        $this->db->where('vn_email', $vn_email);
        $this->db->from($this->m_services_table);
        if (!empty($sv_id)) {
            $this->db->where('sv_id != ' . $sv_id);
        }
        $row= $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }

    ////////////// SERVICES BLOCK END /////////////


    ////////////// SERVICE'S IMAGES BLOCK START /////////////

    /**********************
     * Get service_images list/rows count depending of filters parameters
     * acces public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of service_images objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : asoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for vt_name,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getService_ImagesList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
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

        if (!empty($filters['si_service_id'])) {
            $this->db->where( $this->m_service_images_table.'.si_service_id', $filters['si_service_id'] );
        }
        if (!empty($filters['si_is_main'])) {
            $this->db->where( $this->m_service_images_table.'.si_is_main', $filters['si_is_main'] );
        }

        $fields_for_select= $this->m_service_images_table.".*";

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
            return $this->db->count_all_results($this->m_service_images_table);
        } else {
            $query = $this->db->from($this->m_service_images_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }


    public function getSimilarService_ImageByImage($si_image, $service_id, $si_id='')
    {
        $config_data = $this->config->config;
        $this->db->where('si_image', $si_image);
        $this->db->from($this->m_service_images_table);
        $this->db->where( 'si_service_id = ' . $service_id );
        if (!empty($si_id)) {
            $this->db->where( 'si_id != ' . $si_id );
        }
        $row= $this->db->get()->result();
        if (empty($row[0])) return false;
        return $row[0];
    }


    public function updateService_Images($si_id, $DataArray)
    {
        if ( $DataArray['si_is_main']== 'Y' and !empty( $DataArray['si_service_id'] ) ) {
            $this->db->where( $this->services_mdl->m_service_images_table . '.si_service_id', $DataArray['si_service_id'] );
            $this->db->update($this->services_mdl->m_service_images_table, ['si_is_main' => 'N' ] );

        }
        $this->db->insert($this->m_service_images_table, $DataArray );
        return $this->db->insert_id();
    }


    public function deleteService_Image($si_id)
    {
        if ( !empty($si_id) ) {
            $this->db->where( 'si_id', $si_id );
            return $this->db->delete($this->services_mdl->m_service_images_table);
        }
    }


    ////////////// SERVICE'S IMAGES BLOCK END /////////////



//getService_ImagesList

}