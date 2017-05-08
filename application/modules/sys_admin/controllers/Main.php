<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Main extends CI_Controller {



	public function __construct() {

		parent::__construct();

		$this->load->library('Sys_admin_lib', NULL, 'admin_lib');

		$this->load->model('sys_admin_mdl', 'admin_mdl');

		$this->load->model('users_mdl');

		$this->load->model('cms_items_mdl');

		$this->load->model('activity_logs_mdl');

		$this->lang->load('sys_admin');

		$this->config->load('sys_admin_menu', true);

	}



	public function activation() {

		//echo "here in activation function...";

		$app_config = $this->config->config;

		$UriArray = $this->uri->uri_to_assoc(1);

		$activation_code= $this->common_lib->getParameter($this, $UriArray, array(), 'activation');



		$activated_user= $this->users_mdl->getUserRowByActivationCode($activation_code);


		$has_error= false;

		$error_message= '';

		$success_message= '';
		
		if(!empty($activated_user))
		{
			$check_code_validity = $this->users_mdl->checkActivationCodeValidity($activation_code);
			
			if(empty($check_code_validity))
			{
			
				$error_message= 'Actication code expired.';
	
				$has_error= true;
			}
		}

		if (empty($activated_user)) {

			$error_message= 'Invalid activation code : user is not found !';

			$has_error= true;

		}



		if ( !$has_error and !empty($activated_user) and ( empty($activated_user->user_active_status) or $activated_user->user_active_status != 'W' ) ) {

			$error_message= 'Invalid activation code : user is not in waiting for activation status ! ';

			$has_error= true;

		}
		

		$data= array();

		$data['page']		= 'main/activation';

		if ( !$has_error ) {
		
			if($activated_user->is_multi_auth == '1')

			{
			
				$data['auth_user_id'] = $activated_user->id;

				// Redirect user to validation screen to validate some information like lastname and phone nu,ber

				$data['page']		= 'main/authenticity';
				$data['error_message']= '';
				$data['success_message']= '';

			}
			else
			{
				$user_data= $this->users_mdl->getUserRowById($activated_user->id);
				$data = (array)$user_data;
				/*echo "here we are...";
				echo "u data is : ";
				print_r($user_data);*/
				$data['page']		= 'main/new_user_form';
				$data['error_message']= '';
				$data['success_message']= '';
			}
			/*else {


			$password= $this->common_lib->generatePassword();

			$ret = $this->db->update( $this->users_mdl->m_users_table, array( 'user_active_status' => 'A', 'activation_code'=> '', 'password'=> $this->ion_auth->hash_password($password, false ) , 'plain_password'=> $password), array( 'id' => $activated_user->id ) );

			$success_message= 'Your account was activated successfully. Your password and new login was sent to you. Now you can login into the system!';

			$title= 'Your account was activated at ' . $app_config['site_name'] . ' site';



			$content = $this->cms_items_mdl->getBodyContentByAlias('account_activated',

				array('username' => $activated_user->username,

				      'password' => $password,

				      'first_name' => $activated_user->first_name,

				      'last_name' => $activated_user->last_name,

				      'site_name' => $app_config['site_name'],

				      'support_signature' => $app_config['support_signature'],

				      'site_url' => $app_config['base_url'],

				      'email' => $activated_user->email

				), true);

				

//			$this->common_lib->DebToFile( 'sendEmail $content::'.print_r($content,true));

			$EmailOutput = $this->common_lib->SendEmail($activated_user->email, $title, $content );


			}*/
		}

		/*if($activated_user->is_multi_auth == '0')
		{*/

			
			$data['error_message']= $error_message;
			$data['success_message']= $success_message;
		//}
		
		$data['menu']		= array();

		$data['has_error']= $has_error;

		



		$data['plugins'] 	= array();

		$data['css'] = array('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css');
			
			$data['javascript'] = array('assets/custom/admin/user-edit.js','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js');
		
		
		// For Authenticity step 2
		if(!$has_error )
		{
			//echo "in not has error...";
			// Check if authenticity is 1 then user need to provide some information for validity

			// Check is_multi_auth status for user
			//echo "multi auth is : " . $activated_user->is_multi_auth;
			
		}

		

		$views	= array('design/html_topbar','sidebar','design/page','design/html_footer');

		$this->layout->view($views, $data);

	} // public function activation() {


	// Function to check 2nd level authenticity to verify lastname and email of user
	public function authenticate_user() {
		// Get input data
		$post_array = $this->input->post();
		
		$user_id = $post_array['auth_user_id'];
		$post_last_name = $post_array['data']['lastname'];
		$post_email = $post_array['data']['email'];
		
		// Get DB data
		$user_data= $this->users_mdl->getUserRowById( $user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
		$db_last_name = $user_data->last_name;
		$db_email = $user_data->email;
		$activation_code = $user_data->activation_code;
		
		// Compare input data and DB data to authenticate user
		if(($post_last_name == $db_last_name) && ($post_email == $db_email))
		{
			// Process for logging in authenticated user
			 $this->load->model('users_mdl');
			 $this->lang->load('ion_auth');
			 $this->lang->load('auth');
			 //$this->lang->load('login');
			
			// storing user data in session for logging 
			$data=array();
			$data['username']= $user_data->username;
			$data['super_id']= $user_data->super_id;
			
			foreach ($data as $key => $value) {
				$this->session->set_userdata($key, $value);
			}
			//$id || $id = $this->session->userdata('user_id');
			
			// Adding password and updating user status
			$password= $this->common_lib->generatePassword();

			////HIMISHA////$ret = $this->db->update( $this->users_mdl->m_users_table, array( 'user_active_status' => 'A', 'activation_code'=> '', 'password'=> $this->ion_auth->hash_password($password, false ) , 'plain_password'=> $password), array( 'id' => $user_id ) );
			
			$success_message= 'Your account was activated successfully. Your password and new login was sent to you. Now you can login into the system!';

			$title= 'Your account was activated at ' . $app_config['site_name'] . ' site';



			$content = $this->cms_items_mdl->getBodyContentByAlias('account_activated',

				array('username' => $user_data->username,

				      'password' => $password,

				      'first_name' => $user_data->first_name,

				      'last_name' => $user_data->last_name,

				      'site_name' => $app_config['site_name'],

				      'support_signature' => $app_config['support_signature'],

				      'site_url' => $app_config['base_url'],

				      'email' => $db_email

				), true);

			
			
			////HIMISHA////$EmailOutput = $this->common_lib->SendEmail($db_email, $title, $content );
			
			//echo "last query is : " . $this->db->last_query();
			
			$module = $this->ion_auth->get_users_groups($user_id)->row()->name;
			// Redirect to dashboard
			//redirect('/'.$module, 'refresh');
			redirect('/newUserDetails/' . $user_id, 'refresh');
		}
		else
		{
			//$data['validation_errors_text'] = 'Please add correct details';
			$this->session->set_flashdata('validation_errors_text','Please add correct details');
			$data['page']		= 'main/authenticity';
			$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');

			//$this->layout->view($views, $data);
			redirect('/activation/'.$activation_code, 'refresh');
		}
		
		
		
	}
	//function to add new user form data
	public function newUserDetails($u_id)
	{
		//echo "user id is : " . $u_id;
		$user_data= $this->users_mdl->getUserRowById($u_id);
		/*$db_last_name = $user_data->last_name;
		$db_email = $user_data->email;
		$activation_code = $user_data->activation_code;*/
		
		/*echo "user data is : ";
		print_r($user_data);*/
		$data = (array)$user_data;
		
		if($user_data->activation_code != '')
		{
		
		
			$data['page']		= 'main/new_user_form';
			$data['error_message']= '';
			$data['success_message']= '';
			
			$data['menu']		= array();
			
			$data['has_error']= $has_error;
			
			$data['plugins'] 	= array();
			
			$data['css'] = array('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css');
			
			$data['javascript'] = array('assets/custom/admin/user-edit.js','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js');
			
			$views	= array('design/html_topbar','sidebar','design/page','design/html_footer');
			
			$this->layout->view($views, $data);
			
		}
		else
		{
			$module = $this->ion_auth->get_users_groups($id)->row()->name;
			// Redirect to dashboard
			redirect('/'.$module, 'refresh');
		}
	}
	
	//function to add new user form data
	public function AddNewUserDetails($id)
	{
			/*echo "here we are...";
			echo "id is : " . $id;
			echo "post data is : ";
			print_r($this->input->post());*/
			//exit(0);
			
			 /*[username] => himisha [first_name] => Himisha [middle_name] => mahendrabhai [last_name] => Patel [email] => himisha.patel@bbitsol.com [address1] => AMD [address2] => 208 [city] => AMD [state] => GUJ [zip] => 380015 [mobile] => 9876543210 [phone] => 1234567890 [user_title] => superuser [licence_number] => 12345 [licence_from] => 2017-01-02 [licence_to] => 2017-04-03 ) [user_employment] => full_time*/
			 
			 
			 $this->new_user_form_validation($id);
			 $validation_status = $this->form_validation->run();
			//echo "validation status is : " . $validation_status ;
			if ($validation_status != FALSE) {
			 
				 $u_data = array(
								"first_name" => $this->input->post('data[first_name]'),
								"middle_name" => $this->input->post('data[middle_name]'),
								"last_name" => $this->input->post('data[last_name]'),
								"email" => $this->input->post('data[email]'),
								"address1" => $this->input->post('data[address1]'),
								"address2" => $this->input->post('data[address2]'),
								"city" => $this->input->post('data[city]'),
								"state" => $this->input->post('data[state]'),
								"zip" => $this->input->post('data[zip]'),
								"mobile" => $this->input->post('data[mobile]'),
								"phone" => $this->input->post('data[phone]'),
								"user_title" => $this->input->post('data[user_title]'),
								"licence_number" => $this->input->post('data[licence_number]'),
								"licence_from" => $this->input->post('data[licence_from]'),
								"licence_to" => $this->input->post('data[licence_to]'),
								"user_employment" => $this->input->post('user_employment'),
								"updated_at" => date('Y-m-d H:i:s'),
							);
				 
				 
				
				// Change pass word and send activation mail to user
	
				$password= $this->common_lib->generatePassword();
				
				$u_data['password'] = $this->ion_auth->hash_password($password, false );
				//$u_data['plain_password'] = $password;
				$p_password = $password;
				$u_data['activation_code'] = '';
				$u_data['user_active_status'] = 'A';
	
				$ret = $this->db->update( $this->users_mdl->m_users_table, $u_data, array( 'id' => $id ) );
	
				if($ret)
				{
				
					// Get user's all data
					$u_data = $this->users_mdl->getUserRowById($id);
					
					$success_message= 'Your information is stored into the system. Now you can login into the system!';
		
					$title= 'Your account was activated at ' . $app_config['site_name'] . ' site';
		
		/*echo "u data is : ";
		print_r($u_data);*/
		//exit(0);
					$content = $this->cms_items_mdl->getBodyContentByAlias('account_activated',
		
						array('username' => $u_data->username,
		
							  'password' => $p_password,
		
							  'first_name' => $u_data->first_name,
		
							  'last_name' => $u_data->last_name,
		
							  'site_name' => $app_config['site_name'],
		
							  'support_signature' => $app_config['support_signature'],
		
							  'site_url' => $app_config['base_url'],
		
							  'email' => $u_data->email
		
						), true);
		
						
		
		//			$this->common_lib->DebToFile( 'sendEmail $content::'.print_r($content,true));
		
					$EmailOutput = $this->common_lib->SendEmail($u_data->email, $title, $content );
	
				}
				
				
				$module = $this->ion_auth->get_users_groups($id)->row()->name;
				// Redirect to dashboard
				redirect('/', 'refresh');
		}
		else
		{
			$user_data= $this->users_mdl->getUserRowById($id);
			/*$db_last_name = $user_data->last_name;
			$db_email = $user_data->email;
			$activation_code = $user_data->activation_code;*/
			
			/*echo "user data is : ";
			print_r($user_data);*/
			$data = (array)$user_data;
			
			if($user_data->activation_code != '')
			{
				$this->session->set_flashdata('validation_errors_text','Please correct details');
			
				$data['page']		= 'main/new_user_form';
				$data['error_message']= '';
				$data['success_message']= '';
				
				$data['menu']		= array();
				
				$data['has_error']= $has_error;
				
				$data['plugins'] 	= array();
				
				$data['css'] = array('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css');
				
				$data['javascript'] = array('assets/custom/admin/user-edit.js','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js');
				
				$views	= array('design/html_topbar','sidebar','design/page','design/html_footer');
				
				$this->layout->view($views, $data);
			}
		}
	}
	
	public function user_check_username_is_unique()
	{
		$username = $this->input->post('data[username]', '');
		if (empty($username)) {
			$this->form_validation->set_message('user_check_username_is_unique', " The ".lang('username')." field is required ! ");
			return FALSE;
		}
		$user_id = $this->input->post('data[user_id]', 0);
		if ( $user_id == 'new' ) $user_id= 0;
		$similarUser= $this->users_mdl->getSimilarUserByUsername( $username, $user_id );
		if (!empty($similarUser)) {
			$this->form_validation->set_message('user_check_username_is_unique', lang('username') . " '".$username."' must be unique ! ");
			return FALSE;
		}
		return TRUE;
	}
	
	private function new_user_form_validation($id)
	{
//		$this->form_validation->set_rules( 'data[username]', lang('user'), 'callback_user_check_username_is_unique' );
		$this->form_validation->set_rules( 'data[username]', lang('username'), 'trim|required|callback_user_check_username_is_unique' );

//		$this->form_validation->set_rules( 'data[user_active_status]', lang('user_active_status'), 'required' );
		$this->form_validation->set_rules( 'data[first_name]', lang('first_name'), 'required' );
		$this->form_validation->set_rules( 'data[last_name]', lang('last_name'), 'required' );
		//$this->form_validation->set_rules( 'data[middle_name]', lang('middle_name'), 'required' );
		//$this->form_validation->set_rules( 'data[city]', lang('city'), 'required' );
		//$this->form_validation->set_rules( 'data[state]', lang('state'), 'required' );
		//$this->form_validation->set_rules( 'data[zip]', lang('zip'), 'required' );
		//$this->form_validation->set_rules( 'data[address1]', lang('address1'), 'required' );
		//$this->form_validation->set_rules( 'data[address2]', lang('address2'), '' );
//		$this->form_validation->set_rules( 'data[mobile]', lang('mobile'), '' );
		$this->form_validation->set_rules( 'data[phone]', lang('phone'), '' );
//		$this->form_validation->set_rules( 'user_has_groups_label', lang('user_has_groups_label'), 'callback_user_has_groups_label');
	}

	public function forgotten_password() {

		$app_config = $this->config->config;

		$UriArray = $this->uri->uri_to_assoc(1);

		$forgotten_password_code= $this->common_lib->getParameter($this, $UriArray, array(), 'forgotten_password');



		$activated_user= $this->users_mdl->getUserRowByForgottenPasswordCode($forgotten_password_code);

		$has_error= false;

		$error_message= '';

		$success_message= '';

		if (empty($activated_user)) {

			$error_message= 'Invalid forgotten password code : user is not found !';

			$has_error= true;

		}



		if ( !$has_error and !empty($activated_user) and ( empty($activated_user->user_active_status) or $activated_user->user_active_status != 'A' ) ) {

			$error_message= 'Invalid forgotten password code : user is not in waiting for forgotten password activation ! ';

			$has_error= true;

		}



		$data= array();



		if ( !$has_error ) {

			$password= $this->common_lib->generatePassword();

			$ret = $this->db->update( $this->users_mdl->m_users_table, array( 'forgotten_password_code'=> '', 'password'=> $this->ion_auth->hash_password($password, false ) ), array( 'id' => $activated_user->id ) );

			$success_message= 'New password for your account was generated successfully. Your new password was sent to you. Now you can login into the system!';

			$title= 'Your account was activated at ' . $app_config['base_url'] . ' site';

			$content= '  Dear '.$activated_user->username. ', new password for your account was generated at <a href="'.$app_config['base_url'].'">' . $app_config['base_url'] . ' </a> site. Now you can login into the system with email '. $activated_user->email .  ' and password ' . $password;

			$EmailOutput = $this->common_lib->SendEmail($activated_user->email, $title, $content );



		}



		$data['page']		= 'main/forgotten_password';

		$data['menu']		= array();

		$data['has_error']  = $has_error;

		$data['error_message'] = $error_message;

		$data['success_message'] = $success_message;



		$data['plugins'] 	= array();

		$data['javascript'] = array( );

		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');

		$this->layout->view($views, $data);

	} // public function forgotten_password() {

	public function send_mail()
	{
	
		$data['page']		= 'main/send_mail';

		$data['menu']		= array();

		$data['has_error']  = $has_error;

		$data['error_message'] = $error_message;

		$data['success_message'] = $success_message;



		$data['plugins'] 	= array();

		$data['javascript'] = array( );

		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');

		$this->layout->view($views, $data);
	
	}
	
	public function send_user_mail()
	{
		$email = $this->input->post('data[email]');
		
		$ci = & get_instance();
        $ci->load->library('email');
        $ci->email->from('himisha.patel@bbitsol.com', 'No Reply');
        //$ci->email->to('ankita.vasanani@bbitsol.com');
		//$ci->email->to('himisha.patel@bbitsol.com');
		$ci->email->to($email);
        $ci->email->subject('Test mail');
        $ci->email->message('This a test mail from zntral.');
        $ci->email->send();
		redirect('/sys-admin/main/send_mail', 'refresh');
		
	}

}