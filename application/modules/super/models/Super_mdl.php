<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Super
 *
 * ****************************/
class Super_mdl extends CI_Model {

        function __construct()
        {
            parent::__construct();

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
    public function get_users($cid){
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
        $this->db->where('clients.cid', $cid);
        $this->db->where('users_groups.id !=', '1');
        $this->db->where('groups.id !=', '1');
        $query = $this->db->get();
        return $query->result();
    }
}