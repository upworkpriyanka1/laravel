<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Admin
 *
 * ****************************/
class Sys_admin_mdl extends CI_Model {

        function __construct()
        {
            parent::__construct();

        }
/**********************
* Get all clients
* First row is admin client
* access public
* @ params
* return query array
*********************************/
    public function get_clients(){
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->join('clients_groups', 'clients_groups.client_id = clients.cid');
        $this->db->join('clients_types', 'clients_types.type_id = clients_groups.client_group_id');
        //$this->db->where('clients.cid !=', '1');
        $query = $this->db->get();
        return $query->result();
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