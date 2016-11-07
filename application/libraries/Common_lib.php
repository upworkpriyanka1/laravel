<?php

class Common_lib {

    private $CI;
    public function __construct() {
        $this->CI = & get_instance();
    }



/************************
* Common function for users to edit their profile
* Params, user_id, client_id (cid for security)
* access public
* return row array
******************************************/
    public function profile($user,$menu,$group,$admin=FALSE){
        $this->CI->lang->load('auth');
        $this->CI->lang->load('ion_auth');
        if (isset($_POST['ajaxpost'])){ //save
            $username 		= strtolower($this->CI->input->post('data[first_name]')) . '.' . strtolower($this->CI->input->post('data[last_name]'));
            $email    		= trim(strtolower($this->CI->input->post('data[email]')));
            $password 		= trim($this->CI->input->post('data[password]'));
            $avatar = ($this->CI->input->post('data[avatar]') !='') ? $this->CI->input->post('data[avatar]') : 'avatar.png';
            $avatar_original = ($this->CI->input->post('data[avatar_original]') !='') ? $this->CI->input->post('data[avatar_original]') : 'avatar.png';
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
                'mobile'      	=> $this->CI->input->post('data[mobile]'),
                'avatar'      	=> $this->CI->input->post('data[avatar]'),
                'avatar_original' => $this->CI->input->post('data[avatar_original]')
            );
             if ($user->email !=$email ){ //make sure email is unique
                if ($this->CI->ion_auth->identity_check($email)){
                    echo lang("account_creation_duplicate_email");
                    return false;
                }
            }
            $this->CI->db->trans_start();
            $this->CI->ion_auth->update($user->id, $additional_data);
            $this->CI->db->trans_complete();
            return true;
        }
    //show form
        $data['meta_description']='';
        $data['menu']		= $menu;
        $data['user'] 		= $user;
        $data['group'] 		= $group;

        $data['usertoedit'] = $this->CI->common_mdl->user_to_edit($user->MyID,$user->cid,TRUE, $admin);

        $data['page']		= 'common/profile'; //page view to load
        $data['plugins'] 	= array('validation');
        $data['javascript'] = array( 'assets/custom/admin/user-edit-validation.js','assets/custom/common/upload.js');
        $views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->CI->layout->view($views, $data);
    }

/**********************
* View Activity log
* access public
* @params $menu,$user,$admin=FALSE)
* return view
*********************************/
    function activity_log($menu,$user,$group,$admin=FALSE){
        $data['meta_description']='';
        $data['menu']		= $menu;
        $data['user'] 		= $user;
        $data['group'] 		= $group;
        if ($admin){
            $data['activity']		= $this->CI->common_mdl->get_records('activity_logs', '','','activity_time');
        }else{
            $data['activity']		= $this->CI->common_mdl->get_records('activity_logs', 'super_id', $user->MyID,'activity_time');

        }

        $data['page']		= 'common/activity-log';
        //$data['plugins'] 	= array();
        //$data['javascript'] = array();
        $data['plugins'] 	= array('datatables');
        $data['javascript'] = array('assets/custom/common/activity-view.js');
        $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
        $this->CI->layout->view($views, $data);
    }

}