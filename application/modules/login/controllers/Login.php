<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	 public function __construct() {
        parent::__construct();
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
		// setting validation rules by checking wheather identity is username or email
		$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'trim|required|valid_email');
		if ($this->form_validation->run() == false){
			$this->data['type'] = $this->config->item('identity','ion_auth');
				// set any errors and display the form
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->layout->view('login/reset', $data, 'default');
		}else{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();
 			if (empty($identity)){
            	$this->ion_auth->set_error('forgot_password_email_not_found');
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("login/reset", 'refresh');
            }
			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
			if ($forgotten){
			// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("login/reset", 'refresh'); //we should display a confirmation page here instead of the login page
			}else{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("login/reset", 'refresh');
			}
		}
	}


	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}
		$data['pls'] = array('login');
		$data['plugins'] = array();
		$data['javascript'] = array();
		$user = $this->ion_auth->forgotten_password_check($code);
		if ($user)
		{
			// if the code is valid then display the password reset form
			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');
			if ($this->form_validation->run() == false)
			{
				// display the form
				// set the flash data error message if there is one
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
                                        'class'   => 'form-control',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
                                        'class'   => 'form-control',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				//$data['csrf'] = $this->_get_csrf_nonce();
				$data['code'] = $code;
				// render
				$this->layout->view('login/reset_password', $data, 'default');
				//$this->_render_page('login/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($user->id != $this->input->post('user_id'))
				{
					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);
					show_error($this->lang->line('error_csrf'));
				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('login/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("login/reset", 'refresh');
		}
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
