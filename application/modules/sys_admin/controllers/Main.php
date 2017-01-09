<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('Sys_admin_lib', NULL, 'admin_lib');
		$this->load->model('sys_admin_mdl', 'admin_mdl');
		$this->load->model('users_mdl');
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
			$ret = $this->db->update( $this->users_mdl->m_users_table, array( 'user_active_status' => 'A' ), array( 'id' => $activated_user->id ) );
			$success_message= 'Your account was activated successfully. Now you can login into the system!';
			$title= 'Your account was activated at ' . $app_config['base_url'] . ' site';
			$content= '  Dear '.$activated_user->username. ', your account was activated at <a href="'.$app_config['base_url'].'">' . $app_config['base_url'] . ' </a> site. Now you can login into the system with email '. $activated_user->email .  ' and password sent to you before.';
			$EmailOutput = $this->common_lib->SendEmail($activated_user->email, $title, $content );

		}

		$data['page']		= 'main/activation';
		$data['menu']		= array();
		$data['has_error']= $has_error;
		$data['error_message']= $error_message;
		$data['success_message']= $success_message;

		$data['plugins'] 	= array();
		$data['javascript'] = array( /*'assets/custom/admin/users.js', 'assets/global/plugins/picker/picker.js', 'assets/global/plugins/picker/picker.date.js', 'assets/global/plugins/picker/picker.time.js' */); // add picker.date pluging for date selection in fileters form
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);


	}

}