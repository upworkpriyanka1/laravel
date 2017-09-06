<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Super
 *
 * ****************************/
class Super_mdl extends CI_Model {

    public $m_users_table;
    private $m_users_clients_table;
    private $m_clients_table;
    public $m_jobs_table;
    public $m_users_groups_table;
    public $m_groups_table;

    function __construct()
        {
            parent::__construct();
            $this->m_users_table = 'users';
            $this->m_users_clients_table= 'users_clients';
            $this->m_clients_table= 'clients';
            $this->m_jobs_table= 'jobs';
            $this->m_users_groups_table= 'users_groups';
            $this->m_groups_table= 'groups';


        }
/**********************
* Allways comment function
* access public
* @ params
* return 
*********************************/

/**********************
* Get all users
* First row is admin client
* access public
* @ params
* return query array
*********************************/
//    public function get_users($cid){ // $cid - client id
     public function getUsersClientsList( $OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '') {

//         echo '<pre>getUsersClientsList  $filters::'.print_r($filters,true).'</pre>';
//        echo '<pre>get_users $cid::'.print_r($cid,true).'</pre>';
//        $this->db->select('*');
//        $this->db->select('users.id AS UserID', FALSE);
//        $this->db->from('users');
//        $this->db->join('users_groups', 'users_groups.user_id = users.id');
//        $this->db->join('groups', 'groups.id = users_groups.group_id');
//        //$this->db->join('users_jobs', 'users_jobs.user_id = users.id');
//        //$this->db->join('jobs', 'jobs.id = users_jobs.job_id');
//        $this->db->join('users_clients', 'users_clients.uc_user_id = users.id');
//        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
//        $this->db->where('users.id !=', '1');
//        //$this->db->where('users.is_patient', '0');
//        $this->db->where('users_clients.uc_client_id', $cid);
//        $this->db->where('users_clients.uc_active_status', 'A' );
////        $this->db->where('users_clients`.`uc_user_id`', $cid);
//        $this->db->where('users_groups.id !=', '1');
//        $this->db->where('groups.id !=', '1');


/*        $this->db->select(' users_clients.*, users.username, users.user_status, users.email as user_email, users.id as user_id, groups.name as relation_group_name, users.*, groups.*, clients_types.type_description ');
        $this->db->from('users_clients');
        $this->db->join('users', 'users.id = users_clients.uc_user_id');
        $this->db->join('groups', 'groups.id = users_clients.uc_group_id');
        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
        $this->db->join('clients_types', 'clients_types.type_id = clients.clients_types_id');
        $this->db->where('users_clients.uc_client_id', $cid);
        $query = $this->db->get();
//		echo "last query is : " . $this->db->last_query();

        return $query->result();*/

        if (empty( $sort ))
            $sort = 'users.username';
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

         $this->db->join('users', 'users.id = users_clients.uc_user_id');
         $this->db->join('groups', 'groups.id = users_clients.uc_group_id');
         $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
         $this->db->join('clients_types', 'clients_types.type_id = clients.clients_types_id');

         if (!empty($filters['created_at_from'])) {
            $this->db->where($this->m_users_clients_table.'.created_at >= ' . "'" . $filters['created_at_from'] . "'");
        }
        if (!empty($filters['created_at_till'])) {
            $this->db->where($this->m_users_clients_table.'.created_at <= ' . "'" . $filters['created_at_till'] . " 23:59:59'");
        }


        if (!empty($filters['user_id'])) {
            $this->db->where( $this->m_users_clients_table.'.uc_user_id', $filters['user_id'] );
        }

        if (!empty($filters['client_id'])) {
            $this->db->where( $this->m_users_clients_table.'.uc_client_id', $filters['client_id'] );
        }

        if (!empty($filters['group_id'])) {
            $this->db->where( $this->m_users_clients_table.'.uc_group_id', $filters['uc_group_id'] );
        }

        if (!empty($filters['active_status'])) {
            $this->db->where( $this->m_users_clients_table.'.uc_active_status', $filters['active_status'] );
        }

//        $additive_fields_for_select= '';
/*        $is_user_joined= false;
        if (!empty($filters['show_user_username'])) {
            if ( !$is_user_joined ) {
                $this->db->join( $this->m_users_table, $this->m_users_table . '.id = ' . $this->m_users_clients_table . '.uc_user_id' );
            }
            $is_user_joined= true;
        }*/


        $is_group_joined= false;
        if (!empty($filters['show_group_name'])) {
            if ( !$is_group_joined ) {
                $this->db->join( $this->m_groups_table, $this->m_groups_table . '.id = ' . $this->m_users_clients_table . '.uc_group_id' );
            }
//            $additive_fields_for_select.= ', '.$this->m_groups_table.".name as relation_group_name";
            $is_group_joined= true;
        }

        $fields_for_select= ' users_clients.*, users.username, users.user_status, users.email as user_email, users.id as user_id, groups.name as relation_group_name, users.*, groups.*, clients_types.type_description ';
        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) and ( !empty($offset) and $ci->common_lib->is_positive_integer($offset) ) ) {
            $this->db->limit($limit, $offset);
        }

        if ( ( !empty($limit) and $ci->common_lib->is_positive_integer($limit) ) ) {
            $this->db->limit($limit);
        }
//        $fields_for_select.= ' ' . $additive_fields_for_select;

        if (!empty($sort)) {
            $this->db->order_by($sort, ((strtolower($sort_direction) == 'desc' or strtolower($sort_direction) == 'asc') ? $sort_direction : ''));
        }

        if ($OutputFormatCount) {
            return $this->db->count_all_results($this->m_users_clients_table);
        } else {
            $query = $this->db->from($this->m_users_clients_table);
            if (strlen(trim($fields_for_select)) > 0) {
                $query->select($fields_for_select);
            }
            $ci = & get_instance();
            $ret_array= $query->get()->result();

            return $ret_array;
        }

    }
}