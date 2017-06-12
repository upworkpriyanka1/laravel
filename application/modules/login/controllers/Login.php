<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	 public function __construct() {
         parent::__construct();
		 $this->load->model('users_mdl');
 		 $this->lang->load('ion_auth');
    	 $this->lang->load('auth');
 		 $this->lang->load('login');
	 }
 /**********************
 * View login page
 * access public
 * @params
 * return view
 *********************************/
	public function select_active_title()
    {
        if ( !$this->ion_auth->logged_in() ) {
            $this->session->set_flashdata('message', "Must be be logged to the system ");
            redirect('/login');
        }
        $user = $this->ion_auth->user()->row();
        $groupsList = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user->id, 'status'=>'A', 'show_groups_description'=> 1) );
        if ( count($groupsList) == 0 ) {
            redirect('/msg/' . urldecode(lang("account_has_no_active_titles")) . '/sign/danger');
        }
        $data['groupsList'] = $groupsList;
        $data['pls'] = array('login');
        $data['plugins'] = array();
        $data['javascript'] = array();
        $data['page'] = 'select_active_title';
        $views=array( 'select_active_title','design/html_footer' );
        $this->layout->view($views, $data, 'default');
    }

	public function switch_active_title()
    {
        $UriArray = $this->uri->uri_to_assoc(3);
        $post_array = $this->input->post();

        if ( !$this->ion_auth->logged_in() ) {
            $this->session->set_flashdata('message', "Must be be logged to the system ");
            redirect('/login');
        }
        $active_title_id = $this->common_lib->getParameter($this, $UriArray, $post_array, 'active_title_id' );

/*        echo '<pre>$UriArray::'.print_r($UriArray,true).'</pre>';
        echo '<pre>$active_title_id::'.print_r($active_title_id,true).'</pre>';
        die("-1 XXZ");  */
        if ( empty($active_title_id) ) {
            $this->session->set_flashdata('message', "Select active title ");
            redirect('/login/select_active_title');
        }


        $user = $this->ion_auth->user()->row();
        $groupsList = $this->users_mdl->getUsersGroupsList( false, 0, array('user_id'=> $user->id, 'status'=>'A', 'show_groups_description'=> 1) );
        if ( count($groupsList) == 0 ) {
            redirect('/msg/' . urldecode(lang("account_has_no_active_titles")) . '/sign/danger');
        }
        $has_access_to_select_active_title= false;
        $logged_user_title_name = '';
        foreach( $groupsList as $nextGroup ) {
            if ($nextGroup->group_id == $active_title_id) {
                $has_access_to_select_active_title= true;
                $logged_user_title_name = $nextGroup->group_name;
                break;
            }
        }
        if ( !$has_access_to_select_active_title or empty($logged_user_title_name) ) {
            redirect('/msg/' . urldecode(lang("have_no_access_to_this_title")) . '/sign/danger');
        }
        $this->ion_auth->set_session($user, $logged_user_title_name);
    	redirect('/'.$logged_user_title_name, 'refresh');
    }

	public function index(){
		if ($this->ion_auth->logged_in()){
			//echo "in if...";
//			$module = @$this->common_mdl->get_users_jobs()->row()->job_name;
//			if (!$module)
			$module = $this->ion_auth->get_users_groups()->row()->name;
			redirect('/'.$module, 'refresh');
			return true;
		}
		//echo "after if";
		$data['pls'] = array('login');
		$data['plugins'] = array();
	  	$data['javascript'] = array();
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
//		echo '<pre>$this->form_validation->run()::'.print_r($this->form_validation->run(),true).'</pre>';
//		die("-1 XXZ");
		//echo "before form validation...";
		if ($this->form_validation->run() == true){
			//echo "form validation true...";
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)){
				//echo "in login success...";
				//if the login is successful
				//redirect them back to the home page
				//$this->session->set_flashdata('message', $this->ion_auth->messages());
				
				$this->custome_session();
//				$module = @$this->common_mdl->get_users_jobs()->row()->job_name;
				 //echo $group;
				 //die();
//				if (!$module)
//				$module = $this->ion_auth->get_users_groups()->row()->name;
                $logged_user_title_name= $this->session->userdata['logged_user_title_name'];

                if ( !empty($logged_user_title_name) ) {
                    redirect('/' . $logged_user_title_name, 'refresh');
                }
                redirect('/msg/' . urldecode(lang("account_has_no_active_titles")) . '/sign/danger');

			}else{
				//echo "login un-success...";
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('/login'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}else{
			$views=array('login','design/html_footer');
			$this->layout->view($views, $data, 'default');
		}
	}
	
	
/**********************
* Custom session
* access private
* @params
* return session
*********************************/	
	private function custome_session() {
		$user = $this->ion_auth->user()->row();
		$data=array();
		$data['username']= $user->username;
		$data['super_id']= $user->super_id;
		foreach ($data as $key => $value) {
			$this->session->set_userdata($key, $value);
		}
	}
	
/**********************
* Reset password
* access public
* @params
* return view
*********************************/	 	
	public function reset(){
		$data['pls'] = array('login');
		$data['plugins'] = array();
	  	$data['javascript'] = array();
		$app_config = $this->config->config;
		$this->form_validation->set_rules( 'email', lang('email'), 'trim|required|valid_email|callback_user_check_email_is_valid' );
		if ( !empty($_POST) ) {
			if ( $this->form_validation->run() == false ) {
				$this->data['type'] = $this->config->item( 'identity', 'ion_auth' );
			} else {
				$forgotten_password_code= $this->common_lib->generateActivationCode();

				$similarUser= $this->users_mdl->getSimilarUserByEmail( $_POST['email'] );
				$update_data['forgotten_password_code']= $forgotten_password_code;
				$this->db->update( $this->users_mdl->m_users_table, $update_data, array('id' => $similarUser->id ) );

				$forgotten_password_page_url= $app_config['base_url']."/forgotten_password/".$forgotten_password_code;
				$title= 'You reset your password at ' . $app_config['base_url'] . ' site';
				$content= '  Dear '.$similarUser->username. ', You reset your password at <a href="'.$app_config['base_url'].'">' . $app_config['base_url'] . ' </a> site, with email '. $similarUser->email . '.  To confirm resetting of your password open at <a href="' . $forgotten_password_page_url .'">Forgotten Password page '.$forgotten_password_page_url.' </a> and you will receive your new password. ';
				$EmailOutput = $this->common_lib->SendEmail( $similarUser->email, $title, $content );
				$this->session->set_flashdata( 'message', 'Forgotten password code was sent at entered emal !' );
				redirect( "login/reset", 'refresh' );
			}
		}

		$data['message'] = ( validation_errors() ) ? validation_errors() : $this->session->flashdata( 'message' );
		$this->layout->view( 'login/reset', $data, 'default' );
	}

	public function user_check_email_is_valid()
	{
		$email = $this->input->post('email', '');
		if (empty($email)) {
			$this->form_validation->set_message('user_check_email_is_valid', " The ".lang('user')." field is required ! ");
			return FALSE;
		}
		$similarUser= $this->users_mdl->getSimilarUserByEmail( $email );
		if (empty($similarUser)) {
			$this->form_validation->set_message('user_check_email_is_valid', lang('user') . " with email '".$email."' not found ! ");
			return FALSE;
		}
		if ( $similarUser->user_status != 'A' ) {
			$this->form_validation->set_message('user_check_email_is_valid', " Password can be reset only to active user ! ");
			return FALSE;

		}
		return TRUE;
	}


/**********************
* Logout
* access public
* @params
* return view
*********************************/	 
	public function logout(){
	// log the user out
		$logout = $this->ion_auth->logout();
		redirect('./', 'refresh');
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);
		return array($key => $value);
	}
	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
