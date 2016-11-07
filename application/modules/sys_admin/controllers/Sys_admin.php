<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_admin extends CI_Controller {

	 public function __construct() {
        parent::__construct();
		$group = array('sys-admin');
		if (!$this->ion_auth->in_group($group)){
			redirect('./');
		}
		if (!$this->ion_auth->in_group($group)){
			echo "Not allowed";
			die();
		}
		$this->load->library('Sys_admin_lib',NULL,'admin_lib');
		$this->load->model('sys_admin_mdl','admin_mdl');
		$this->lang->load('sys_admin');
		$this->config->load('sys_admin_menu', true );
        $this->menu    			= $this->config->item( 'sys_admin_menu' );

		$this->user 			= $this->common_mdl->get_admin_user();
		$this->group 			= $this->ion_auth->get_users_groups()->row();
		$this->job 				= $this->common_mdl->get_users_jobs()->row();
	 }

 /**********************
 * View Dashboard Home
 * access public
 * @params
 * return view
 *********************************/
	public function index(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;

		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['page']		='dashboard'; //page view to load
		$data['pls'] 		= array(); //page level scripts optional
		$data['plugins'] 	= array(); //page plugins
		$data['javascript'] = array(); //page javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view clients
* access public
* @params
* return view
*********************************/
	public function clients_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['clients']= $this->admin_mdl->get_clients();

		$data['page']		='clients/clients-view';
		$data['plugins'] 	= array('datatables');
		$data['javascript'] = array( 'assets/custom/admin/clients-view.js');
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Add client
* access public
* @params
* return view
*********************************/
	public function clients_add()
	{
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->client_add();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id', 'activity_time', 'DESC');

		$data['page']		= 'clients/clients-add'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
	  	$data['javascript'] = array( 'assets/custom/admin/client-add-validation.js');//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}



/**********************
* Edit client
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function clients_edit()
	{
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->client_edit();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['client']		= $this->common_mdl->get_client($this->uri->segment(3), TRUE);
		$data['client_types']= object_to_array($this->common_mdl->get_records('clients_types'),'type_id');

		$data['page']		= 'clients/client-edit'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
	  	$data['javascript'] = array( 'assets/custom/admin/client-add-validation.js');//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view users
* access public
* @params
* return view
*********************************/
	public function users_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['users']		= $this->admin_mdl->get_users();

	    $data['page']		= 'common/users-view';
	    $data['menu']		= $this->menu;
	    $data['plugins'] 	= array();
	    $data['javascript'] = array();
	    $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
	    $this->layout->view($views, $data);
	}

/**********************
* Edit User
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function users_edit(){
		$this->lang->load('ion_auth');
		$this->lang->load('auth');
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->user_edit();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['usertoedit'] = $this->common_mdl->user_to_edit($this->uri->segment(3),FALSE,FALSE, TRUE);
		$data['clients']	= $this->common_mdl->get_records('clients');
		$data['groups']		= $this->common_mdl->get_records('groups');
		$data['jobs']		= $this->common_mdl->get_records('jobs');

		$data['page']		= 'users/users-edit'; //page view to load
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/admin/user-edit-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Add User
* access public
* @params
* return view
*********************************/
	public function users_add(){
		$this->lang->load('ion_auth');
		$this->lang->load('auth');
		if (isset($_POST['ajaxpost'])){
			$this->admin_lib->user_add();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['clients']= $this->common_mdl->get_records('clients');
		$data['groups']= $this->common_mdl->get_records('groups');
		$data['jobs']=  $this->common_mdl->get_records('jobs');
		$data['page']		= 'users/users-add';
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/admin/user-add-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view  user job (title)
* access public
* @params
* return view
*********************************/
	public function users_jobs(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['jobs']= $this->admin_mdl->get_jobs();


		$data['page']		='users/users-jobs';
		$data['plugins'] 	= array(); //page plugins
		$data['javascript'] = array(); //page javascript
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}


/**********************
* view  user role(group)
* access public
* @params
* return view
*********************************/
	public function users_role(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['groups']		= $this->admin_mdl->get_groups();

		$data['page']		='users/users-role';
		$data['plugins'] 	= array(); //page plugins
		$data['javascript'] = array(); //page javascript
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view and add Client Types
* access public
* @params
* return view
*********************************/
		public function clients_type(){
			if (isset($_POST['ajaxpost'])){
				$this->admin_lib->client_type_add();
				return true;
			}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['client_types']= $this->admin_mdl->get_client_types();


		$data['page']		='clients/clients-types';
		$data['plugins'] 	= array('validation');
	  	$data['javascript'] = array( 'assets/custom/admin/client-type-add-validation.js');
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view and add Contact Types
* access public
* @params
* return view
*********************************/
		public function contact_type(){
			if (isset($_POST['ajaxpost'])){
				$this->admin_lib->contact_type_add();
				return true;
			}
			if (isset($_POST['pk'])){ //edit inline
				$data['con_type_name'] = $_POST['value'];
				$this->common_mdl->db_update('contact_types',$data, 'con_type_id', $_POST['pk']);
				return true;
			}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['contact_types']= $this->admin_mdl->get_contact_types();


		$data['page']		='contacts/contacts-types';
		$data['plugins'] 	= array('validation','xeditable');
	  	$data['javascript'] = array( 'assets/custom/admin/contacts-type-add-validation.js');
		$views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Edit MY PROFILE
* access public
* @params
* return view
*********************************/
	public function profile(){
		$this->common_lib->profile($this->user,$this->menu,$this->group->name,TRUE);
	}

/**********************
* View Activity log
* access public
* @params
* return view
*********************************/
	public function activity_logs(){
		$this->common_lib->activity_log($this->menu,$this->user, $this->group->name,TRUE);
	}
}
