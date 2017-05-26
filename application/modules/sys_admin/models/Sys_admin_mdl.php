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

    function __construct()
    {
        parent::__construct();
        $this->m_users_clients_table= 'users_clients';
        $this->m_users_table= 'users';
        $this->m_clients_table= 'clients';
        $this->m_clients_groups_table= 'clients_groups';
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
        if (!empty($filters['client_id'])) {
            if ( !$are_clients_joined ) {
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id' . ' AND ' .
                    $this->m_users_clients_table.'.uc_client_id = ' . "'" . $filters['client_id'] . "'", '');
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

/*         if (!empty($filters['show_uc_active_status'])) {
            $cond_1= '';
            if ( !empty($filters['uc_active_status']) ) {
                $cond_1= ' and ' . $this->m_users_clients_table.'.uc_active_status = ' . "'" . $filters['uc_active_status'] . "'";
            }
            if ( !$are_clients_joined ) {
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id' . $cond_1, 'left');
            }

            $additive_fields_for_select.= ', '.$this->m_users_clients_table.".uc_active_status as uc_active_status, " .
                ', '.$this->m_users_clients_table.".uc_client_id as uc_client_id, " .
                ', '.$this->m_users_clients_table.".created_at as uc_created_at" . ', '.$this->m_users_clients_table.".updated_at as uc_updated_at";
            $are_clients_joined= true;
        }

        if ( !empty($filters['uc_active_status']) and empty($filters['show_uc_active_status']) ) {
            if ( !$are_clients_joined ) {
                $this->db->join($this->m_users_clients_table, $this->m_users_clients_table . '.uc_user_id = ' . $this->m_users_table . '.id', 'left');
            }
//            $additive_fields_for_select.= ', '.$this->m_users_clients_table.".uc_active_status as uc_active_status, " . ', '.$this->m_users_clients_table.".created_at as uc_created_at" . ', '.$this->m_users_clients_table.".updated_at as uc_updated_at";
            $this->db->where($this->m_users_clients_table.'.uc_active_status = ' . "'" . $filters['uc_active_status'] . "'");

            $are_clients_joined= true;
        }
 */
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
    public function get_groups() {
        $this->db->from('groups');
        $this->db->where('id !=', '1');
	    $this->db->order_by('id', 'asc' );
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