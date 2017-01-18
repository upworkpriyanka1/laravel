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
		$app_config = $this->config->config;
		$UriArray = $this->uri->uri_to_assoc(1);
		$activation_code= $this->common_lib->getParameter($this, $UriArray, array(), 'activation');

		$activated_user= $this->users_mdl->getUserRowByActivationCode($activation_code);

		$has_error= false;
		$error_message= '';
		$success_message= '';
		if (empty($activated_user)) {
			$error_message= 'Invalid activation code : user is not found !';
			$has_error= true;
		}

		if ( !$has_error and !empty($activated_user) and ( empty($activated_user->user_active_status) or $activated_user->user_active_status != 'W' ) ) {
			$error_message= 'Invalid activation code : user is not in waiting for activation status ! ';
			$has_error= true;
		}

		$data= array();

		if ( !$has_error ) {
			$password= $this->common_lib->generatePassword();
			$ret = $this->db->update( $this->users_mdl->m_users_table, array( 'user_active_status' => 'A', 'activation_code'=> '', 'password'=> $this->ion_auth->hash_password($password, false ) ), array( 'id' => $activated_user->id ) );
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

		}

		$data['page']		= 'main/activation';
		$data['menu']		= array();
		$data['has_error']= $has_error;
		$data['error_message']= $error_message;
		$data['success_message']= $success_message;

		$data['plugins'] 	= array();
		$data['javascript'] = array();
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	} // public function activation() {

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
		$data['has_error']= $has_error;
		$data['error_message']= $error_message;
		$data['success_message']= $success_message;

		$data['plugins'] 	= array();
		$data['javascript'] = array( );
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	} // public function forgotten_password() {

}