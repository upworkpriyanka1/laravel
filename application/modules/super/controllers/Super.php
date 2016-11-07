<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

	public function __construct() {
		parent::__construct();
	/*check if logged in */
		if (!$this->ion_auth->logged_in()){
			redirect('./', 'refresh');
		}
	/*check if allowed to access page */
		$group = array('super'); //allowed group admin,super etc
		if (!$this->ion_auth->in_group($group)){
			echo "Not allowed";
			die();
		}
		$this->load->library('Super_lib',NULL,'super_lib');
		$this->load->model('super_mdl','super_mdl');
		$this->lang->load('super');
		$this->config->load('super_menu', true );
		$this->menu    			= $this->config->item( 'super_menu' );

		$this->user 			= $this->common_mdl->get_user();
		$this->superviser 		=  $this->ion_auth->user($this->user->super_id)->row();
		$this->superviser_name 	= $this->superviser->first_name." ".$this->superviser->last_name;
		$this->group 			= $this->ion_auth->get_users_groups()->row();
		//$this->job 				= $this->common_mdl->get_users_jobs()->row();

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
		//$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;
		$data['superviser']	=$this->superviser_name;;

		$data['page']		='dashboard'; //page view to load
		$data['pls'] 		= array(); //page level scripts
		$data['plugins'] 	= array(); //plugins
		$data['javascript'] = array(); //javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view users
* access public
* @params $this->user->cid
* return view
*********************************/
	public function users_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		//$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['users']		= $this->super_mdl->get_users($this->user->cid);

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
			$this->super_lib->user_edit();
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['usertoedit'] = $this->common_mdl->user_to_edit($this->uri->segment(3),$this->user->cid,FALSE, FALSE);
		$data['clients']	= $this->common_mdl->get_records('clients', 'cid !=', '1');
		$data['groups']		= $this->common_mdl->get_records('groups', 'id !=', '1');
		$data['jobs']		= $this->common_mdl->get_records('jobs', 'id !=', '1');

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
			$this->super_lib->user_add();
			return true;

		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		//$data['clients']	= $this->common_mdl->get_records('clients', 'cid !=', '1');
		$data['groups']		= $this->common_mdl->get_records('groups', 'id !=', '1');
		$data['jobs']		=  $this->common_mdl->get_records('jobs', 'id !=', '1');
		$data['page']		= 'users/users-add';
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/admin/user-add-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* view contacts
* access public
* @params $clkint_id
* return view
*********************************/
	public function contacts_view(){
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		//$data['job'] 		= $this->job;
		$data['group'] 		= $this->group->name;

		$data['contacts']		= $this->common_mdl->get_contacts($this->user->cid);

	    $data['page']		= 'contacts/contacts-view';
	    $data['menu']		= $this->menu;
	    $data['plugins'] 	= array('datatables');
	    $data['javascript'] = array('assets/custom/super/contacts-view.js');
	    $views				= array('design/html_topbar','sidebar','design/page','design/html_footer');
	    $this->layout->view($views, $data);
	}

/**********************
* Edit contacts
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function contacts_edit(){
		if (isset($_POST['ajaxpost'])){
			$this->common_mdl->db_update('contacts',$_POST['data'], 'contact_id', $this->uri->segment(3));
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['contact'] = $this->common_mdl->contact_to_edit($this->uri->segment(3),$this->user->cid);
		$data['contacts_type']	= $this->common_mdl->get_records('contact_types');

		$data['page']		= 'contacts/contacts-edit'; //page view to load
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/super/contact-add-edit-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Add Contact
* access public
* @params
* return view
*********************************/
	public function contacts_add(){
		if (isset($_POST['ajaxpost'])){
			$_POST['data']['contact_client_id'] = $this->user->cid;
			$this->common_mdl->db_insert('contacts',$_POST['data']);
			return true;

		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['contacts_type']	= $this->common_mdl->get_records('contact_types');
		//$data['groups']		= $this->common_mdl->get_records('groups', 'id !=', '1');
		//$data['jobs']		=  $this->common_mdl->get_records('jobs', 'id !=', '1');
		$data['page']		= 'contacts/contacts-add';
		$data['plugins'] 	= array('validation');
		$data['javascript'] = array( 'assets/custom/super/contact-add-edit-validation.js');
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Edit company
* access public
* @params usr_segment->3 (client id)
* return view
*********************************/
	public function profile_company()
	{
		if (isset($_POST['ajaxpost'])){
			$this->super_lib->company_edit($this->user->cid);
			return true;
		}
		$data['meta_description']='';
		$data['menu']		= $this->menu;
		$data['user'] 		= $this->user;
		$data['group'] 		= $this->group->name;

		$data['client']		= $this->common_mdl->get_client($this->user->cid, TRUE);
		$data['page']		= 'company/my-company'; //page view to load
		$data['plugins'] 	= array('validation'); //page plugins
	  	$data['javascript'] = array( 'assets/custom/admin/client-add-validation.js');//page javascript
		$views				=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}


/**********************
* View Activity log
* access public
* @params
* return view
*********************************/
	public function activity_logs(){
		$this->common_lib->activity_log($this->menu,$this->user,$this->group->name);
	}


/**********************
* Edit MY PROFILE
* access public
* @params
* return view
*********************************/
	public function profile(){
		$this->common_lib->profile($this->user,$this->menu,$this->group->name);
	}
}
