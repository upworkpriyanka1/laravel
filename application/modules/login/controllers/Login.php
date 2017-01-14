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
	public function index(){
		if ($this->ion_auth->logged_in()){
			$module = @$this->common_mdl->get_users_jobs()->row()->job_name;
			if (!$module)
				$module = $this->ion_auth->get_users_groups()->row()->name;
			redirect('/'.$module, 'refresh');
			return true;
		}
		$data['pls'] = array('login');
		$data['plugins'] = array();
	  	$data['javascript'] = array();
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == true){
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)){
				//if the login is successful
				//redirect them back to the home page
				//$this->session->set_flashdata('message', $this->ion_auth->messages());
				
				$this->custome_session();
				$module = @$this->common_mdl->get_users_jobs()->row()->job_name;
				 //echo $group;
				 //die();
				if (!$module)
		 			$module = $this->ion_auth->get_users_groups()->row()->name;
				redirect('/'.$module, 'refresh');
			}else{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
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
		if ( $similarUser->user_active_status != 'A' ) {
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
