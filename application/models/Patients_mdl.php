<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Patients Db functions
 *
 * ****************************/
class Patients_mdl extends CI_Model
{
    public $m_patients_table;
    private $m_patient_bereavements_table;
    private $m_patient_contacts_table;
    private $m_patient_bereavements_grieving_process_table;
    private $PatientActiveStatusLabelValueArray = Array('A' => 'Active', 'I' => 'Inactive', 'N' => 'New'); // values/labels for enum field

    function __construct()
    {
        parent::__construct();
        $this->m_patients_table = 'patients';
        $this->m_patient_bereavements_table = 'patient_bereavements';
        $this->m_patient_contacts_table= 'patient_contacts';
        $this->m_patient_bereavements_grieving_process_table= 'patient_bereavements_grieving_process';
    }


    public function getPatientActiveStatusValueArray($ret_with_subarray= true)
    {
        $ResArray = array();
        foreach ($this->PatientActiveStatusLabelValueArray as $Key => $Value) {
            if ( $ret_with_subarray ) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            }else {
                $ResArray[$Key]= $Value;
            }
        }
        return $ResArray;
    }

    public function getPatientActiveStatusLabel($patient_active_status)
    {
        if (!empty($this->PatientActiveStatusLabelValueArray[$patient_active_status])) {
            return $this->PatientActiveStatusLabelValueArray[$patient_active_status];
        }
        return '';
    }


    ////////////// patients BLOCK START /////////////

    /**********************
     * Get patients list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of patient objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for patient_active_status, patient_zip, patient_type and between
     * created_at_from and created_at_till
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getPatientsList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty($sort))
            $sort = 'pt_patient_login';
//        echo '<pre>$filters::'.print_r($filters,true).'</pre>';
        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
        $is_patient_type_joined = false;
        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }
        if (!empty($items_per_page) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        if (!empty($filters['pt_patient_login'])) {
            $this->db->like( $this->m_patients_table . '.pt_patient_login', $filters['pt_patient_login'] );
        }
        if ( !empty($filters['patient_status']) ) {
            $this->db->where( $this->m_patients_table.'.patient_status', $filters['patient_status'] );
        }
        if (!empty($filters['pt_zip'])) {
            $this->db->where( $this->m_patients_table.'.pt_zip', $filters['pt_zip'] );
        }
        if (!empty($filters['pt_gender'])) {
            $this->db->where( $this->m_patients_table.'.pt_gender', $filters['pt_gender'] );

        }
        if (!empty($filters['pt_state'])) {
            $this->db->where( $this->m_patients_table.'.pt_state', $filters['pt_state'] );

        }
        if (!empty($filters['pt_ss_number'])) {
            $this->db->where( $this->m_patients_table.'.pt_ss_number', $filters['pt_ss_number'] );

        }
        if (!empty($filters['pt_birth_date_from'])) {
            $this->db->where($this->m_patients_table.'.pt_birth_date >= ' . "'" . $filters['pt_birth_date_from'] . "'");
        }
        if (!empty($filters['pt_birth_date_till'])) {
            $this->db->where($this->m_patients_table.'.pt_birth_date <= ' . "'" . $filters['pt_birth_date_till'] . " 23:59:59'");
        }

        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_patients_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_patients_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }


        $additive_fields_for_select = "";
        $fields_for_select = $this->m_patients_table . ".*";

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


//        echo '<pre>$fields_for_select::'.print_r($fields_for_select,true).'</pre>';
        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_patients_table);
        } else {
            $query = $this->db->from($this->m_patients_table);
            $ci = & get_instance();
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ret_array= $query->get()->result();
            foreach( $ret_array as $next_key=>$next_row ) {
                if (!empty($filters['show_patient_bereavements'])) {
                    $patient_bereavements= $this->getPatient_BereavementsList( false, 0, [ 'pb_patient_id'=> $next_row->pt_id, 'show_patient_bereavements_grieving_process'=> 1 ] );
                    $ret_array[$next_key]->patient_bereavements= $patient_bereavements;
                }

                if (!empty($filters['show_patient_contacts'])) {
                    $patient_contacts= $this->getPatient_ContactsList( false, 0, [ 'pc_patient_id'=> $next_row->pt_id ] );
                    $ret_array[$next_key]->patient_contacts= $patient_contacts;
                }

            }

            return $ret_array;
        }
    }

    public function checkIsPatient_Pt_LoginUnique($pt_patient_login, $patient_id='')
    {
        $config_data = $this->config->config;
        $this->db->like('pt_patient_login', $pt_patient_login);
        if (!empty($patient_id)) {
            $this->db->where('cid != ' . $patient_id);
        }
        $checkCount= $this->db->count_all_results($this->m_patients_table);
//        AppUtils::DebToFile(' checkIspt_patient_loginUnique $checkCount::' . print_r($checkCount, true), false);
        return $checkCount==0;
    }

    public function checkIsEmailUnique($patient_email, $patient_id='')
    {
        $config_data = $this->config->config;
        $this->db->like('patient_email', $patient_email);
        if (!empty($patient_id)) {
            $this->db->where('cid != ' . $patient_id);
        }
        $checkCount= $this->db->count_all_results($this->m_patients_table);
//        AppUtils::DebToFile(' checkIsemailUnique $checkCount::' . print_r($checkCount, true), false);
        return $checkCount==0;
    }


    public function getRowById( $id )
    {
        $this->db->where( $this->m_patients_table . '.cid', $id);
        $query = $this->db->from($this->m_patients_table);
        $ci = & get_instance();
        $resultRows = $query->get()->result();
        if ( !empty($resultRows[0]) ) {
            return $resultRows[0];
        }
        return false;
    }

    ////////////// patients BLOCK END /////////////


    ////////////// PATIENTS BEREAVEMENTS BLOCK START /////////////

    /**********************
     * Get patient bereavements list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of patient_bereavements objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for created_at,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getPatient_BereavementsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
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

        if (!empty($filters['pb_patient_id'])) {
            $this->db->where( $this->m_patient_bereavements_table.'.pb_patient_id', $filters['pb_patient_id'] );
        }

        if (!empty($filters['pb_patient_able_discuss'])) {
            $this->db->where( $this->m_patient_bereavements_table.'.pb_patient_able_discuss', $filters['pb_patient_able_discuss'] );
        }

        if (!empty($filters['pb_caregiver_able_discuss'])) {
            $this->db->where( $this->m_patient_bereavements_table.'.pb_caregiver_able_discuss', $filters['pb_caregiver_able_discuss'] );
        }
        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_patient_bereavements_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_patient_bereavements_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }

        $additive_fields_for_select= "";
        $fields_for_select= $this->m_patient_bereavements_table.".*";

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
            return $this->db->count_all_results($this->m_patient_bereavements_table);
        } else {
            $query = $this->db->from($this->m_patient_bereavements_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();

            foreach( $ret_array as $next_key=>$next_row ) {
                if (!empty($filters['show_patient_bereavements_grieving_process'])) {
                    $patient_bereavements_grieving_process= $this->getPatient_BereavementsGrieving_ProcessList( false, 0, [ 'pg_patient_bereavements_id'=> $next_row->pb_id ] );
                    $ret_array[$next_key]->patient_bereavements_grieving_process= $patient_bereavements_grieving_process;
                }
            }

            return $ret_array;
        }
    }

    ////////////// PATIENTS BEREAVEMENTS BLOCK END /////////////




    ////////////// PATIENTS BEREAVEMENTS GRIEVING_PROCESS BLOCK START /////////////

    /**********************
     * Get patient bereavements list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of patient_bereavements_grieving_process objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for created_at,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getPatient_BereavementsGrieving_ProcessList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty( $sort ))
            $sort = 'pg_id';
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

        if (!empty($filters['pg_patient_bereavements_id'])) {
            $this->db->where( $this->m_patient_bereavements_grieving_process_table.'.pg_patient_bereavements_id', $filters['pg_patient_bereavements_id'] );
        }

        if (!empty($filters['pg_grieving_process'])) {
            $this->db->where( $this->m_patient_bereavements_grieving_process_table.'.pg_grieving_process', $filters['pg_grieving_process'] );
        }
        $additive_fields_for_select= "";
        $fields_for_select= $this->m_patient_bereavements_grieving_process_table.".*";

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
            return $this->db->count_all_results($this->m_patient_bereavements_grieving_process_table);
        } else {
            $query = $this->db->from($this->m_patient_bereavements_grieving_process_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();

            $this->config->load('dictionary_items', true);
            $dictionary_items_list = $ci->config->item('dictionary_items');
            $patient_bereavements_grieving_process= !empty( $dictionary_items_list['patient_bereavements_grieving_process'] ) ? $dictionary_items_list['patient_bereavements_grieving_process'] : array();

            foreach( $ret_array as $next_key=>$next_row ) {
                $ret_array[$next_key]->pg_grieving_process_label= !empty($patient_bereavements_grieving_process[$next_row->pg_grieving_process]) ? $patient_bereavements_grieving_process[$next_row->pg_grieving_process] : '' ;
            }
            return $ret_array;
        }
    }

    ////////////// PATIENTS BEREAVEMENTS GRIEVING_PROCESS BLOCK END /////////////




    ////////////// PATIENTS CONTACTS BLOCK START /////////////

    /**********************
     * Get patient contacts list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of patient_contacts objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for created_at,
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getPatient_ContactsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
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
        if (!empty($filters['pc_patient_id'])) {
            $this->db->where( $this->m_patient_contacts_table.'.pc_patient_id', $filters['pc_patient_id'] );
        }

        if (!empty($filters['pc_power_of_attorney'])) {
            $this->db->where( $this->m_patient_contacts_table.'.pc_power_of_attorney', $filters['pc_power_of_attorney'] );
        }

        if (!empty($filters['pc_email'])) {
            $this->db->where( $this->m_patient_contacts_table.'.pc_email', $filters['pc_email'] );
        }

        if (!empty($filters['pc_state'])) {
            $this->db->where( $this->m_patient_contacts_table.'.pc_state', $filters['pc_state'] );
        }

        if (!empty($filters['pc_zip'])) {
            $this->db->where( $this->m_patient_contacts_table.'.pc_zip', $filters['pc_zip'] );
        }


        $additive_fields_for_select= "";
        $fields_for_select= $this->m_patient_contacts_table.".*";

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
            return $this->db->count_all_results($this->m_patient_contacts_table);
        } else {
            $query = $this->db->from($this->m_patient_contacts_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();
//            foreach( $ret_array as $next_key=>$next_row ) {
//                if (!empty($filters['show_patient_contacts'])) {
//                    $patient_bereavements_grieving_process= $this->getPatient_Contacts( false, 0, [ 'pg_patient_bereavements_id'=> $next_row->pb_id ] );
//                    $ret_array[$next_key]->patient_bereavements_grieving_process= $patient_bereavements_grieving_process;
//                }
//            }
            return $ret_array;
        }
    }

    ////////////// PATIENTS CONTACTS BLOCK END /////////////


}