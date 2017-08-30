<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->library('Sys_admin_lib',NULL,'admin_lib');
        $this->load->model('sys_admin_mdl','admin_mdl');
        $this->load->model('clients_mdl','clients_mdl');
        $this->load->model('users_mdl');
        $this->load->model('cms_items_mdl');
        $this->lang->load('sys_admin');
		$this->lang->load('sys_admin_pt');
		//$this->config->load('sys_admin_menu', true );
		//$this->menu = $this->config->item( 'sys_admin_menu' );

        $this->config->load('sys_admin_menu_new', true );
        $this->menu    			= $this->config->item( 'sys_admin_menu_new' );

        $eh_url = base_url() . 'sys-admin/eh';
        if(current_url()!=$eh_url){
            $group = array('sys-admin');
            if (!$this->ion_auth->in_group($group)){
                redirect( base_url() . "login/logout" );
            }
            $this->user 			= $this->common_mdl->get_admin_user();
            if ( $this->user->user_status != 'A' ) {    // Only active user can access admin pages
                redirect( base_url() . "login/logout" );
            }
            $logged_user_title_name= $this->session->userdata['logged_user_title_name'];
//            echo '<pre>$logged_user_title_name::'.print_r($logged_user_title_name,true).'</pre>';
//            if ( $logged_user_title_name != 'sys-admin' ) {
//                redirect('/msg/' . urldecode(lang("title_has_no_access_page")) . '/sign/danger');
//            }
            $this->group 			= $this->ion_auth->get_users_groups()->row(); 
        }




//		$this->job = $this->common_mdl->get_users_jobs()->row();
    }
    public function index(){
		$data['page']		= 'signup/signup'; 
       $views = array('','','design/page','', '');
        $this->layout->view($views, $data);
    }
}