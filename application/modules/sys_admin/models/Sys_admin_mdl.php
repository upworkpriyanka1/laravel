<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Admin
 *
 * ****************************/
class Sys_admin_mdl extends CI_Model {
    private $m_users_clients_table;

    private $m_users_table;
    private $m_clients_table;
    private $m_clients_groups_table;
    private $m_clients_types_table;
    private $ClientActiveStatusLabelValueArray = Array('A' => 'Active', 'I' => 'Inactive', 'N' => 'New');
    private $UsersClientsActiveStatusLabelValueArray = Array('E' => 'Employee', 'O' => 'Out Of Staff', 'N' => 'Not Related');
    private $UserActiveStatusLabelValueArray = Array('N' => 'New', 'A' => 'Active', 'I' => 'Inactive');

    function __construct()
    {
        parent::__construct();
        $this->m_users_clients_table= 'users_clients';
        $this->m_users_table= 'users';
        $this->m_clients_table= 'clients';
        $this->m_clients_types_table= 'clients_types';
        $this->m_clients_groups_table= 'clients_groups';
    }


    public function getClientActiveStatusValueArray($ret_with_subarray= true)
    {
        $ResArray = array();
        foreach ($this->ClientActiveStatusLabelValueArray as $Key => $Value) {
            if ( $ret_with_subarray ) {
                $ResArray[] = array('key' => $Key, 'value' => $Value);
            }else {
                $ResArray[$Key]= $Value;

            }
        }
        return $ResArray;
    }

    public function getClientActiveStatusLabel($client_active_status)
    {
        if (!empty($this->ClientActiveStatusLabelValueArray[$client_active_status])) {
            return $this->ClientActiveStatusLabelValueArray[$client_active_status];
        }
        return '';
    }


    // uc_active_status
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

    /**********************
     * Get users list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of user objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for user_active_status, user_zip, user_type and between
     * created_at_from and created_at_till
     * filters work independently on $OutputFormatCount returning list(FALSE) or rows count(TRUE).
     * Sense of using $OutputFormatCount with $filters is to have common function with same filter parameters
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort Both have sense if $OutputFormatCount= false
     * return query array
     *********************************/
    public function getUsersList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
    {
        if (empty($sort))
            $sort = 'username';
        $config_data = $this->config->config;
        $ci = & get_instance();
        $items_per_page= $ci->common_lib->getSettings('items_per_page');
        $limit = !empty($filters['limit']) ? $filters['limit'] : '';
        $offset = !empty($filters['offset']) ? $filters['offset'] : '';
        $is_page_positive_integer= $ci->common_lib->is_positive_integer($page);
        $is_user_type_joined = false;
        if ( !empty($page) and $is_page_positive_integer ) {
            $limit = '';
            $offset = '';
        }
        if (!empty($items_per_page) and $is_page_positive_integer) {
            $per_page= ( !empty($filters['per_page']) and $ci->common_lib->is_positive_integer($filters['per_page']) ) ? $filters['per_page'] : $items_per_page;
            $limit = $per_page;
            $offset = ($page - 1) * $per_page;
        }

        $are_clients_joined= false;
        $additive_fields_for_select = "";
        $fields_for_select = $this->m_users_table . ".*";
        if (!empty($filters['username'])) {
            $this->db->like( $this->m_users_table . '.username', $filters['username'] );
        }
        if (!empty($filters['user_active_status']) ) {
            $this->db->where($this->m_users_table.'.user_active_status ', $filters['user_active_status'] );
        }
        if (!empty($filters['email'])) {
            $this->db->where($this->m_users_table.'.email', $filters['email'] );
        }
        if ( isset($filters['is_patient']) and strlen($filters['is_patient']) > 0 ) {
            $this->db->where($this->m_users_table.'.is_patient', $filters['is_patient'] );

        }
        if (!empty($filters['client_id'])) {
            if ( !$are_clients_joined ) {
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id' . ' AND ' .
                    $this->m_users_clients_table.'.uc_client_id = ' . "'" . $filters['client_id'] . "'", 'left');
            }
//            $this->db->where($this->m_users_clients_table.'.uc_client_id = ' . "'" . $filters['client_id'] . "'");
//                $additive_fields_for_select.= ', '.$this->m_users_clients_table.".uc_active_status as uc_is_active";
            $are_clients_joined= true;
        }
        if (!empty($filters['show_uc_active_status'])) {
            if ( !$are_clients_joined ) {
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id', 'left');
            }
            $additive_fields_for_select.= ', '.$this->m_users_clients_table.".uc_active_status as uc_active_status, " .
                ', '.$this->m_users_clients_table.".uc_client_id as uc_client_id, " .
                ', '.$this->m_users_clients_table.".created_at as uc_created_at" . ', '.$this->m_users_clients_table.".updated_at as uc_updated_at";
            $are_clients_joined= true;
        }
        if (!empty($filters['uc_active_status'])) {
            if ( !$are_clients_joined ) {
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id', 'left');
            }
//            $additive_fields_for_select.= ', '.$this->m_users_clients_table.".uc_active_status as uc_active_status, " . ', '.$this->m_users_clients_table.".created_at as uc_created_at" . ', '.$this->m_users_clients_table.".updated_at as uc_updated_at";
            $this->db->where($this->m_users_clients_table.'.uc_active_status = ' . "'" . $filters['uc_active_status'] . "'");

            $are_clients_joined= true;
        }
        if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_users_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_users_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
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
            return $this->db->count_all_results($this->m_users_table);
        } else {
            $query = $this->db->from($this->m_users_table);
            $ci = & get_instance();
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ret_array= $query->get()->result();
            return $ret_array;
        }
    }

    /**********************
     * update/insert users_clients table with new_status
     * depending if there is such row
     * access public
     * @ params
     * return users_clients.uc_id
     *********************************/
    public function update_users_clients( $client_id, $related_user_id, $new_status ) {
        $date_time_mysql_format= $this->common_lib->getSettings('date_time_mysql_format', '%Y-%m-%d %H:%M:%S');
        $this->db->where( $this->m_users_clients_table . '.uc_client_id', $client_id);
        $this->db->where( $this->m_users_clients_table . '.uc_user_id', $related_user_id);
        $query = $this->db->from($this->m_users_clients_table);
        $row = $query->get()->result();
        if ( !empty($row) and !empty($row[0]->uc_id) ) {
            $this->db->where( $this->m_users_clients_table . '.uc_id', $row[0]->uc_id);
            $data = array(
                'uc_client_id' => $client_id ,
                'uc_user_id' => $related_user_id,
                'uc_active_status'=> $new_status,
                'updated_at'=> strftime($date_time_mysql_format)
            );
            $this->db->update($this->m_users_clients_table, $data);
            return $row[0]->uc_id;
        } else {
            $data = array(
                'uc_client_id' => $client_id ,
                'uc_user_id' => $related_user_id,
                'uc_active_status'=> $new_status,
                'updated_at'=> strftime($date_time_mysql_format)
            );
            $this->db->insert($this->m_users_clients_table, $data);
            return $this->db->insert_id();
        }
    }

    /**********************
* Get all clients
* First row is admin client
* access public
* @ params
* return query array
*********************************/
    public function get_clients(){
//        $this->db->select('*');
//        $this->db->select('clients.client_name, clients.client_email, clients.client_owner, clients.client_phone, clients_types.type_description, clients.cid');
//        $this->db->from('clients');
//        $this->db->join('clients_groups', 'clients_groups.client_id = clients.cid');
//        $this->db->join('clients_types', 'clients_types.type_id = clients_groups.client_group_id');
//        //$this->db->where('clients.cid !=', '1');
//        $query = $this->db->get();
//        return $query->result();
    }

    /**********************
     * Get clients list/rows count depending of filters parameters
     * access public
     * @ params : $OutputFormatCount = TRUE- returns number of rows, FALSE- returns array of client objects; $page - page number($OutputFormatCount must be = FALSE)
     * $filters : assoc keys of fieldname=>fieldvalue, if field value is not empty filter is set by this value for client_active_status, client_zip, client_type and between
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
        if (!empty($filters['client_active_status']) or strlen($filters['client_active_status']) > 0) {
            $this->db->where($this->m_clients_table.'.client_active_status = ' . "'" . $filters['client_active_status'] . "'");
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


//        echo '<pre>$fields_for_select::'.print_r($fields_for_select,true).'</pre>';
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

    public function checkIsEmailUnique($client_email, $client_id='')
    {
        $config_data = $this->config->config;
        $this->db->like('client_email', $client_email);
        if (!empty($client_id)) {
            $this->db->where('cid != ' . $client_id);
        }
        $checkCount= $this->db->count_all_results($this->m_clients_table);
//        AppUtils::DebToFile(' checkIsemailUnique $checkCount::' . print_r($checkCount, true), false);
        return $checkCount==0;
    }


    public function getRowById( $id )
    {
        $this->db->where( $this->m_clients_table . '.cid', $id);
        $query = $this->db->from($this->m_clients_table);
        $ci = & get_instance();
        $resultRows = $query->get()->result();
        if ( !empty($resultRows[0]) ) {
            return $resultRows[0];
        }
        return false;
    }

/**********************
* Get client types
* First row is admin
* access public
* @ params
* return query array
*********************************/
    public function get_client_types(){
        $this->db->from('clients_types');
        $query = $this->db->get();
        return $query->result();
    }

    /**********************
     * Get client types in assoc array as key->value
     * access public
     * $filters : assoc keys of fieldname => fieldvalue, if field value is not empty filter is set by this value for client_active_status, client_zip, client_type and between created_at_from and created_at_till
     * Does not depend on $OutputFormatCount
     * $sort_direction - current sort direction(asc/desc) and $sort - current sort
     * return query array  in assoc array as key->value
     *********************************/
    //public function getClient_TypesSelectionList( $filters = array(), $sort = 'type_name',  $sort_direction = 'asc') : array
    public function getClient_TypesSelectionList( $filters = array(), $sort = 'type_name',  $sort_direction = 'asc')
    {
        $ci = & get_instance();
        $client_typesList = $ci->admin_mdl->getClient_TypesList(false, 0, $filters, $sort, $sort_direction);
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

/**********************
* Get contacts types
* access public
* @ params
* return query array
*********************************/
    public function get_contact_types(){
        $this->db->from('contact_types');
        $query = $this->db->get();
        return $query->result();
    }

/**********************
* Get all users
* First row is admin client
* access public
* @ params
* return query array
*********************************/
    public function clients_count_in_db()
    {
//        return '09 clients_in_db';
        $this->db->select('count(*) as clients_count ');
//        $this->db->select('users.id AS UserID', FALSE);
        $this->db->from('clients');
//        $this->db->join('users_groups', 'users_groups.user_id = users.id');
//        $this->db->join('groups', 'groups.id = users_groups.group_id');
//        $this->db->join('users_jobs', 'users_jobs.user_id = users.id');
//        $this->db->join('jobs', 'jobs.id = users_jobs.job_id');
//        $this->db->join('users_clients', 'users_clients.uc_user_id = users.id');
//        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
//        $this->db->where('users.id !=', '1');
//        $this->db->where('users.is_patient', '0');
//        $this->db->where('clients.cid !=', '1');
//        $this->db->where('users_groups.id !=', '1');
//        $this->db->where('groups.id !=', '1');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_users(){
        $this->db->select('*');
        $this->db->select('users.id AS UserID', FALSE);
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
        $this->db->join('users_jobs', 'users_jobs.user_id = users.id');
        $this->db->join('jobs', 'jobs.id = users_jobs.job_id');
        $this->db->join('users_clients', 'users_clients.uc_user_id = users.id');
        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
        $this->db->where('users.id !=', '1');
        $this->db->where('users.is_patient', '0');
        $this->db->where('clients.cid !=', '1');
        $this->db->where('users_groups.id !=', '1');
        $this->db->where('groups.id !=', '1');
        $query = $this->db->get();
        return $query->result();
    }

/**********************
* Get all users role(group)
* First row is admin client
* access public
* @ params
* return query array
*********************************/
    public function get_groups(){
        $this->db->from('groups');
        $this->db->where('id !=', '1');
        $query = $this->db->get();
        return $query->result();
    }

/**********************
* Get all users job(title)
* First row is admin
* access public
* @ params
* return query array
*********************************/
    public function get_jobs(){
        $this->db->from('jobs');
        $this->db->where('id !=', '1');
        $query = $this->db->get();
        return $query->result();
    }
/*****************************
 * Insert POST data in table
 * @params POST, table
 * return insertID or error
 *
 * ****************************/
    public function insert_client_types($id){
        foreach($_POST['client_type'] as $key=>$value){
            $data = array(
                'client_group_id' => $value ,
                'client_id' => $id
            );
            $this->db->insert('clients_groups', $data);
            if ($this->db->trans_status() === FALSE){
                $error = $this->db->error();
                return "Error #:".$error['code']." => ".$error['message'];
            }else{
                $this->db->trans_complete();
                $cid = $this->db->insert_id();
            }
        }
        return $cid;
    }

}