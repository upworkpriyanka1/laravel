<?php
/**********************
* Allways comment function
* access public
* @ params
* return 
*********************************/
class Super_lib {

    public function __construct() {
        $this->CI = & get_instance();
    }

/*****************************
* USER ADD
* @params $_POST[data]
* access public
* return True or errors
************************************/
    function user_add(){
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
            $user = $this->CI->ion_auth->user()->row();
            $groups=array();
            $groups[] 	= $this->CI->input->post('data[groups]');
            $username   = strtolower($this->CI->input->post('data[first_name]')) . '.' . strtolower($this->CI->input->post('data[last_name]'));
            $email      = strtolower($this->CI->input->post('data[email]'));
            $password   = $this->CI->input->post('data[password]');
            $additional_data = array(
                'first_name' 	=> $this->CI->input->post('data[first_name]'),
                'last_name'  	=> $this->CI->input->post('data[last_name]'),
                'address1' 		=> $this->CI->input->post('data[address1]'),
                'address2'  	=> $this->CI->input->post('data[address2]'),
                'super_id'    	=> $user->MyID,
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
                $insert['user_id']= $UserID;
                $insert['job_id']= $this->CI->input->post('job_id');
                $insert_id=$this->CI->common_mdl->db_insert('users_jobs',$insert, TRUE);

                $insertClient['uc_user_id']= $UserID;
                $insertClient['uc_client_id']= $this->CI->user->cid;
                $insert_id=$this->CI->common_mdl->db_insert('users_clients',$insertClient, TRUE);
                echo $UserID;
                $this->CI->db->trans_complete();
            }
        return true;
        }
        
    }
/*****************************
* USER EDIT
* @params $_POST[data]
* access public
* return True or errors
************************************/
    function user_edit(){
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
        //Update user
            $this->CI->ion_auth->update($this->CI->uri->segment(3), $additional_data);
        //update job
            $job_data['job_id']= $_POST['job_id'];
            $this->CI->common_mdl->db_update('users_jobs',$job_data, 'user_id', $this->CI->uri->segment(3));
        //update group
            $group_data['group_id']= $_POST['data']['groups'];
            $this->CI->common_mdl->db_update('users_groups',$group_data, 'user_id', $this->CI->uri->segment(3));
            $this->CI->db->trans_complete();
            return true;
        }
    }
    
/*****************************
* COMPANY EDIT
* @params $_POST[data]
* access public
* return True or errors
************************************/
    public function company_edit($cid){
        $this->CI->load->library('form_validation');
        $this->CI->form_validation->set_error_delimiters('<div>', '</div>');
        $optional_array = array('client_notes','client_address2','client_fax');
        foreach($_POST['data'] as $key=>$value){
            $valid_email= is_valid_email($key);
            if (!in_array($key, $optional_array))://If NOT Optional
                $this->CI->form_validation->set_rules('data['.$key.']', '"<b>'.lang(str_replace("client_", "", $key)).'</b>"', 'trim|required'.$valid_email);
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
            $this->CI->common_mdl->db_update('clients',$_POST['data'], 'cid', $cid);
            return true;
        }
    }
    
    
    
    
    
}//end library

?>