<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*****************************
 * Class for Database and common functions
 *
 * ****************************/
class Common_mdl extends CI_Model {

        function __construct()
        {
            parent::__construct();
        }



    /*********************************
* Get user Info
* Access public
* @params user_id
* join multiple tables, ignore id=1 (admin)
* return array row
******************************/
    public function get_user($id=false){
        $id || $id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->select('users.id AS MyID', FALSE);
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
//        $this->db->join('users_jobs', 'users_jobs.user_id = users.id');
//        $this->db->join('jobs', 'jobs.id = users_jobs.job_id');
        $this->db->join('users_clients', 'users_clients.uc_user_id = users.id','right');
        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
        $this->db->where('users.id', $id);
        $this->db->where('clients.cid !=', '1');
        $query = $this->db->get();
        return $query->row();
    }


 /*********************************
* Get logged in user Info for dashboard
* Access public
* @params user_id
* join multiple tables, ignore id=1 (admin)
* return array row
******************************/
    public function get_user_dashboard_info($id=false){
        $id || $id = $this->session->userdata('user_id');
		$client_id = $this->session->userdata('logged_user_client_id');
		$group_name = $this->session->userdata('logged_user_title_name');
        $this->db->select('*');
        $this->db->select('users.id AS MyID', FALSE);
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
//        $this->db->join('users_jobs', 'users_jobs.user_id = users.id');
//        $this->db->join('jobs', 'jobs.id = users_jobs.job_id');
        $this->db->join('users_clients', 'users_clients.uc_user_id = users.id','right');
        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
        $this->db->where('users.id', $id);
		//$this->db->where('users_clients.uc_client_id', $client_id);
		$this->db->where('clients.cid', $client_id);
		$this->db->where('groups.name', $group_name);
        $this->db->where('clients.cid !=', '1');
        $query = $this->db->get();
        return $query->row();
    }



/*********************************
* Get user to edit Info
* Access public
* @params user_id
* join multiple tables, ignore id=1 (admin)
* return array row
******************************/
    public function user_to_edit($id=false, $client_id=false, $self=false, $admin=false){
        if ($self){
            $id=$this->session->userdata('user_id');
        }
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
//        $this->db->join('users_jobs', 'users_jobs.user_id = users.id');
//        $this->db->join('jobs', 'jobs.id = users_jobs.job_id');
        $this->db->join('users_clients', 'users_clients.uc_user_id = users.id','right');
        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
        $this->db->where('users.id', $id);
        if (!$admin){
            $this->db->where('clients.cid', $client_id);
            $this->db->where('users.super_id', $this->session->userdata('user_id'));

        }
        $query = $this->db->get();
        return $query->row();
    }


/*********************************
* Get admin Info
* Access public
* @params user_id
* join multiple tables, ignore id=1 (admin)
* return array row
******************************/
    public function get_admin_user($id=false){
        $id || $id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->select('users.id AS MyID', FALSE);
        $this->db->from('users');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id = users_groups.group_id');
//        $this->db->join('users_jobs', 'users_jobs.user_id = users.id' /* , 'left' */ );
//        $this->db->join('jobs', 'jobs.id = users_jobs.job_id');
//        $this->db->join('users_clients', 'users_clients.uc_user_id = users.id','right');
//        $this->db->join('clients', 'clients.cid = users_clients.uc_client_id');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

/*********************************
* Get Client info for user
* Access public
* @params user_id
* join multiple tables
* return array row
******************************/
    public function get_client_type($id){
        $this->db->select('*');
        $this->db->from('clients_types');
//        $this->db->join('clients_groups', 'clients_groups.client_id = clients.cid');
        $this->db->where('clients_types.type_id', $id); //if not admin, only their ID
        $query = $this->db->get();
        return $query->row();
    }

/*********************************
* Get Client info for user
* Access public
* @params user_id
* join multiple tables
* return array row
******************************/
//    public function get_client( $id=false, $admin=false, $additive_params= array() ) {
//        if (!$admin){$id=$this->session->userdata('user_id');}
//        $this->db->select('*');
//        $this->db->from('clients');
////        $this->db->join('clients_groups', 'clients_groups.client_id = clients.cid');
//        $this->db->join('clients_types', 'clients_types.type_id = clients.clients_types_id');
////        $this->db->join('clients_groups', 'clients_groups.client_id = clients.cid');
////        $this->db->join('clients_types', 'clients_types.type_id = clients_groups.client_group_id');
//        $this->db->where('clients.cid', $id); //if not admin, only their ID
//        $query = $this->db->get();
//
//	    $clientRow= $query->row();
//	    $orig_width= !empty($additive_params['image_width']) ? $additive_params['image_width'] : 64;
//	    $orig_height= !empty($additive_params['image_height']) ? $additive_params['image_height'] : 64;
////	    echo '<pre>$clientRow::'.print_r($clientRow,true).'</pre>';
//	    if (!empty($additive_params['show_file_info']) and !empty($clientRow->img )) {
//		    $client_img = $this->getClientDir($id) . $clientRow->img;
////		    echo '<pre>$client_img::'.print_r($client_img,true).'</pre>';
//		    $clientRow->file_info = '';
//		    if ( file_exists($client_img) ) {
//			    $file_info= $clientRow->img;
//			    $file_info.= ', '.$this->common_lib->getFileSizeAsString( filesize($client_img) );
//			    $fileArray = @getimagesize($client_img);
//			    if (!empty($fileArray)) {
//				    $file_info.= ', '.$fileArray[0].'x'.$fileArray[1];
//			    }
//			    $clientRow->file_info = $file_info;
//			    $clientRow->image_url = $this->getClientImageUrl($id, $clientRow->img);
//			    $clientRow->image_path = $this->getClientImagePath($id, $clientRow->img);
//			    $filenameInfo = $this->common_lib->GetImageShowSize($clientRow->image_path, $orig_width, $orig_height);
//			    echo '<pre>$filenameInfo::'.print_r($filenameInfo,true).'</pre>';
//			    $clientRow->image_path_width= !empty($filenameInfo['Width']) ? $filenameInfo['Width'] : 0 ;
//			    $clientRow->image_path_height= !empty($filenameInfo['Height']) ? $filenameInfo['Height'] : 0 ;
//			    $clientRow->image_path_original_width= !empty($filenameInfo['OriginalWidth']) ? $filenameInfo['OriginalWidth'] : 0 ;
//			    $clientRow->image_path_original_height= !empty($filenameInfo['OriginalHeight']) ? $filenameInfo['OriginalHeight'] : 0 ;
//
//		    }
//	    }
//        return $clientRow;
//    }


/*********************************
* Get Client info for user
* Access public
* @params user_id
* join multiple tables
* return array row
******************************/
    public function get_contacts($cid,$array=false){
        $this->db->from('contacts');
        $this->db->join('contact_types', 'contact_types.con_type_id = contacts.contact_type_id');
        $this->db->where('contacts.contact_client_id', $cid);
        if ($array)
        $this->db->where_in('contacts.contact_type_id', $array);
        $query = $this->db->get();
        return $query->result();
    }


/*********************************
* Get contact to edit Info
* Access public
* @params contact id, client id
* return array row
******************************/
    public function contact_to_edit($id, $cid){
        $this->db->from('contacts');
        $this->db->where('contact_id', $id);
        $this->db->where('contact_client_id', $cid);
        $query = $this->db->get();
        return $query->row();
    }
/*********************************
* Check if user is allowed to view page (in job)
* Access public
* @params $job
* return array row
******************************/
//    public function in_job($check_job, $id=false, $check_all = false){
//        $id || $id = $this->session->userdata('user_id');
//        if (!is_array($check_job)){
//			$check_job = array($check_job);
//		}
//
//
//			$users_job = $this->get_users_jobs($id)->result();
//			$groups_array = array();
//			foreach ($users_job as $group)			{
//				$groups_array[$group->id] = $group->job_name;
//			}
//            foreach ($check_job as $key => $value)		{
//			$groups = (is_string($value)) ? $groups_array : array_keys($groups_array);
//			if (in_array($value, $groups) xor $check_all){
//				return !$check_all;
//			}
//		}
//		return $check_all;
//	}

/*********************************
* Gert user Job
* Access public
* @params $id
* return array
******************************/
/*	public function get_users_jobs($id=FALSE){
		// if no id was passed use the current users id
		$id || $id = $this->session->userdata('user_id');
        return $this->db->select('*')
		                ->where('users_jobs.user_id', $id)
		                ->join('jobs', 'users_jobs.job_id=jobs.id')
		                ->get('users_jobs');
	}*/



/*****************************
 * Global function to get a record
 * @params $table, $key='', $keyValue='', $orderBy='',$order='DESC'
 * return $query->result()
 *
 * ****************************/
    public function get_records($table, $key='', $keyValue='', $orderBy='',$order='DESC',$limit=''){
    	if ($key !='')
    		$this->db->where($key, $keyValue);
    	if ($orderBy !='')
    		$this->db->order_by($orderBy, $order);
        $query = $this->db->get($table,$limit);
        return $query->result();
    }

/*****************************
 * Insert POST data in table
 * @params POST, table
 * return insertID or error
 *
 * ****************************/
    public function db_insert($table='unknown',$data, $complete=TRUE){
        $this->db->trans_start();
        $this->db->insert($table, $data);
        if ($this->db->trans_status() === FALSE){
    	    $error = $this->db->error();
    	    return $table."-> ".lang('error')." #:".$error['code']." => ".$error['message'];
        }else{
    	    if ($complete)
                $this->db->trans_complete();
            return $this->db->insert_id();
            }
    }

	public function db_update($table='unknown',$data, $field='unknown', $id){
		$this->db->trans_start();
		$this->db->where($field, $id);
		$this->db->update($table, $data);
		if ($this->db->trans_status() === FALSE){
			$error = $this->db->error();
			return $table."-> ".lang('error')." #:".$error['code']." => ".$error['message'];
		}else{
			$this->db->trans_complete();
			return "1";
		}
	}

	// Function to get list of all groups
	public function get_all_groups()
	{
		$this->db->select('*');
		$groups = $this->db->from('groups');
		echo "groups are : ";
		print_r($groups);
		exit(0);
	}

}