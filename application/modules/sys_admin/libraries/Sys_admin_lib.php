<?php

class Sys_admin_lib {


    public function __construct() {
        $this->CI = & get_instance();
        //$this->CI->load->model('Admin_mdl');
    }
/*****************************
* Add client
* @params $_POST[data]
* access public
* return inserID or errors
************************************/
    public function client_add() {
        $this->CI->load->library('form_validation');
		$this->CI->form_validation->set_error_delimiters('<div>', '</div>');
	//Validate
		if (isset($_POST['data'])){
			$optional_array = array('client_notes','client_address2','client_fax');
			foreach($_POST['data'] as $key=>$value){
                $valid_email= is_valid_email($key);
                if (!in_array($key, $optional_array))://If NOT Optional
					$this->CI->form_validation->set_rules('data['.$key.']', '"<b>'.lang(str_replace("client_", "", $key)).'</b>"', 'trim|required'.$valid_email);
				endif;//end in array |required
			}//end for each
		}
         /******ValidationFAILED*******/
        if ($this->CI->form_validation->run() == FALSE) {
            if (isset($_POST['data'])): //SHOW ERRORS ON POST
                foreach($_POST['data'] as $key=>$value){
                    echo  form_error('data['.$key.']');
                }
            endif;
        }else{
            $ci = &get_instance();
            $_POST['data']['updated_at']= strftime( $ci->common_lib->getSettings('date_time_mysql_format') ); // fill date fields with current time
            $_POST['data']['created_at']= strftime( $ci->common_lib->getSettings('date_time_mysql_format') );
            $id=$this->CI->common_mdl->db_insert('clients',$_POST['data'], FALSE); //isert clients
//            $cid=$this->CI->admin_mdl->insert_client_types($id);//isert client types
            echo $id;
            $this->CI->db->trans_complete();
            return true;
//            redirect('./sys-admin/client/'.$id);
            // http://local-zntral.com/sys-admin/client/9
        }
    }


/*****************************
* Edit client
* @params $_POST[data]
* access public
* return inserID or errors
************************************/
    public function client_edit() {
        $this->CI->load->library('form_validation');
		$this->CI->form_validation->set_error_delimiters('<div>', '</div>');
	//Validate
		if (isset($_POST['data'])) {
			echo '<pre>$_FILES::'.print_r($_FILES,true).'</pre>';
			$optional_array = array('client_notes','client_address2','client_fax');
			foreach($_POST['data'] as $key=>$value){
                $valid_email= is_valid_email($key);
                if (!in_array($key, $optional_array))://If NOT Optional
					$this->CI->form_validation->set_rules('data['.$key.']', '"<b>'.lang(str_replace("client_", "", $key)).'</b>"', 'trim|required'.$valid_email);
				endif;//end in array |required
			}//end for each
		}
         /******ValidationFAILED*******/
        if ($this->CI->form_validation->run() == FALSE) {
            if (isset($_POST['data'])): //SHOW ERRORS ON POST
                foreach($_POST['data'] as $key=>$value){
                    echo  form_error('data['.$key.']');
                }
            endif;
        }else{
            $this->CI->db->trans_start();
            $ci = &get_instance();
            $_POST['data']['updated_at']= strftime( $ci->common_lib->getSettings('date_time_mysql_format') ); // fill date fields with current time
            $this->CI->common_mdl->db_update('clients',$_POST['data'], 'cid', $this->CI->uri->segment(3));
            $this->CI->db->trans_complete();
            return true;
        }
    }

/*****************************
* ADD CLIENT TYPE
* @params $_POST[data]
* access public
* return inserID or errors
************************************/
    public function client_type_add() {
        $this->CI->load->library('form_validation');
		$this->CI->form_validation->set_error_delimiters('<div>', '</div>');
	//Validate POST
		if (isset($_POST['data'])){
			$optional_array = array();
			foreach($_POST['data'] as $key=>$value){
                if (!in_array($key, $optional_array))://If NOT Optional
					$this->CI->form_validation->set_rules('data['.$key.']', '"<b>'.lang($key).'</b>"', 'trim|required');
				endif;//end in array |required
			}//end for each
		}
    /******ValidationFAILED*******/
        if ($this->CI->form_validation->run() == FALSE){
            if (isset($_POST['data'])): //SHOW ERRORS ON POST
                foreach($_POST['data'] as $key=>$value){
                    echo  form_error('data['.$key.']');
                }
            endif;
        }else{
            $data['type_name']= preg_replace("/[^A-Za-z-]/", '-', $_POST['data']['name']);
            $data['type_description']=$_POST['data']['description'];
			// Check if client type already exists or not.
			$client_type_check = $this->CI->common_mdl->get_records('clients_types','type_name',$data['type_name']);		
			if(sizeof($client_type_check) <= 0)
			{
            	echo $this->CI->common_mdl->db_insert('clients_types',$data,TRUE); //isert job
			}
			else
			{
				echo "Client type already exists.";
			}
        }
    }

/*****************************
* ADD CONTACT TYPE
* @params $_POST[data]
* access public
* return inserID or errors
************************************/
    public function contact_type_add() {
        $this->CI->load->library('form_validation');
		$this->CI->form_validation->set_error_delimiters('<div>', '</div>');
	//Validate POST
		if (isset($_POST['data'])){
			$optional_array = array();
			foreach($_POST['data'] as $key=>$value){
                if (!in_array($key, $optional_array))://If NOT Optional
					$this->CI->form_validation->set_rules('data['.$key.']', '"<b>'.lang('contact-type').'</b>"', 'trim|required');
				endif;//end in array |required
			}//end for each
		}
    /******ValidationFAILED*******/
        if ($this->CI->form_validation->run() == FALSE){
            if (isset($_POST['data'])): //SHOW ERRORS ON POST
                foreach($_POST['data'] as $key=>$value){
                    echo  form_error('data['.$key.']');
                }
            endif;
        }else{
            echo $this->CI->common_mdl->db_insert('contact_types',$_POST['data'],TRUE); //isert job
        }
    }

/*****************************
* USER EDIT
* @params $_POST[data]
* access public
* return True or errors
************************************/
    public function user_edit() {
        $this->CI->load->library('form_validation');
        $this->CI->form_validation->set_error_delimiters('<div>', '</div>');

        $optional_array = array('password','address2');
        foreach($_POST['data'] as $key=>$value){
            $valid_email= is_valid_email($key);
            if (!in_array($key, $optional_array))://If NOT Optional
                $this->CI->form_validation->set_rules('data['.$key.']', '"<b>'.lang($key).'</b>"', 'trim|required'.$valid_email);
            endif;//end in array |required
        }//end for each

        if ($this->CI->form_validation->run() == FALSE) {
            if (isset($_POST['data'])): //SHOW ERRORS ON POST
                foreach($_POST['data'] as $key=>$value){
                    echo  form_error('data['.$key.']');
                }
            endif;
            return false;
        }else{
            $user = $this->CI->ion_auth->user($this->CI->uri->segment(3))->row();
            $groups=array();
            $groups[] 		= $this->CI->input->post('data[groups]');
            $username 		= strtolower($this->CI->input->post('data[first_name]')) . '.' . strtolower($this->CI->input->post('data[last_name]'));
            $email    		= trim(strtolower($this->CI->input->post('data[email]')));
            $password 		= trim($this->CI->input->post('data[password]'));
            $additional_data = array(
                'email' 		=> $this->CI->input->post('data[email]'),
                'first_name' 	=> $this->CI->input->post('data[first_name]'),
                'last_name'  	=> $this->CI->input->post('data[last_name]'),
                'address1' 		=> $this->CI->input->post('data[address1]'),
                'address2'  	=> $this->CI->input->post('data[address2]'),
                'city' 			=> $this->CI->input->post('data[city]'),
                'state'  		=> $this->CI->input->post('data[state]'),
                'zip'    		=> $this->CI->input->post('data[zip]'),
                'phone'      	=> $this->CI->input->post('data[phone]'),
                'mobile'      	=> $this->CI->input->post('data[mobile]')
            );
             if ($user->email !=$email ){
                 if ($this->CI->ion_auth->identity_check($email)){
                echo lang("account_creation_duplicate_email");
                return false;
                }
            }
            $this->CI->db->trans_start();
            $this->CI->ion_auth->update($this->CI->uri->segment(3), $additional_data);
            $company_data['uc_client_id']= $_POST['data']['clients'];
            $this->CI->common_mdl->db_update('users_clients',$company_data, 'uc_user_id', $this->CI->uri->segment(3));

            $job_data['job_id']= $_POST['job_id'];
            $this->CI->common_mdl->db_update('users_jobs',$job_data, 'user_id', $this->CI->uri->segment(3));

            $group_data['group_id']= $_POST['data']['groups'];
            $this->CI->common_mdl->db_update('users_groups',$group_data, 'user_id', $this->CI->uri->segment(3));
            $this->CI->db->trans_complete();
            return true;
        }
    }
/**********************
* ADD USER
* access public
* @params
* return inserID or errors
*********************************/
    public function user_add(){
        $this->CI->load->library('form_validation');
        $this->CI->form_validation->set_error_delimiters('<div>', '</div>');
        
        $optional_array = array('address2');
        foreach($_POST['data'] as $key=>$value){
            $valid_email= is_valid_email($key);
            if (!in_array($key, $optional_array))://If NOT Optional
                $this->CI->form_validation->set_rules('data['.$key.']', '"<b>'.lang($key).'</b>"', 'trim|required'.$valid_email);
            endif;//end in array |required
        }//end for each
        
        if ($this->CI->form_validation->run() == FALSE) {
            if (isset($_POST['data'])): //SHOW ERRORS ON POST
                foreach($_POST['data'] as $key=>$value){
                    echo  form_error('data['.$key.']');
                }
            endif;
            return false;
        }else{
            $groups=array();
            $groups[] 		= $this->CI->input->post('data[groups]');
            $username = strtolower($this->CI->input->post('data[first_name]')) . '.' . strtolower($this->CI->input->post('data[last_name]'));
            $email    = strtolower($this->CI->input->post('data[email]'));
            $password = $this->CI->input->post('data[password]');
            $additional_data = array(
                'first_name' 	=> $this->CI->input->post('data[first_name]'),
                'last_name'  	=> $this->CI->input->post('data[last_name]'),
                'address1' 		=> $this->CI->input->post('data[address1]'),
                'address2'  	=> $this->CI->input->post('data[address2]'),
                'super_id'    	=> '0',
                'city' 			=> $this->CI->input->post('data[city]'),
                'state'  		=> $this->CI->input->post('data[state]'),
                'zip'    		=> $this->CI->input->post('data[zip]'),
                'phone'      	=> $this->CI->input->post('data[phone]'),
                'mobile'      	=> $this->CI->input->post('data[mobile]')
            );

            if ($this->CI->ion_auth->identity_check($email)){
                echo lang("account_creation_duplicate_email");
                return false;
            }

            $this->CI->db->trans_start();
            $UserID = $this->CI->ion_auth->register($username, $password, $email, $additional_data, $groups);
            if ($this->CI->ion_auth->errors()){
                echo $this->CI->ion_auth->errors();
                return false;
            }else{
                $super_data['super_id']= $UserID;
                $this->CI->common_mdl->db_update('users',$super_data, 'id', $UserID);
                $insert['user_id']= $UserID;
                $insert['job_id']= $this->CI->input->post('job_id');
                $insert_id=$this->CI->common_mdl->db_insert('users_jobs',$insert, TRUE);

                $insertClient['uc_user_id']= $UserID;
                $insertClient['uc_client_id']= $this->CI->input->post('data[clients]');
                $insert_id=$this->CI->common_mdl->db_insert('users_clients',$insertClient, TRUE);
                $this->CI->db->trans_complete();
                echo $UserID;
            }
        }
        return true;    
    }

}//end library