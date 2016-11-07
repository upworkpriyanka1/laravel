<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_md extends CI_Controller {
	public function __construct() {
	   parent::__construct();

	   $job = array('doctor-md');
	/*check if logged in */
			if (!$this->ion_auth->logged_in()){
				redirect('./', 'refresh');
			}
		/*check if allowed to access page */
			if (!$this->common_mdl->in_job($job)){
				echo "Not allowed";
				return die();
			}
	/* load library & model with aliases, config and language */
			$this->load->library('Doctor_md_lib',NULL, 'doctor_lib');
			$this->load->model('doctor_md_mdl','nurse_mdl');
			$this->lang->load('doctor_md');
			$this->config->load('doctor_md_menu', true );
			$this->menu    			= $this->config->item( 'doctor_md_menu' );

			$this->user 			= $this->common_mdl->get_user();
			$this->superviser 		=  $this->ion_auth->user($this->user->super_id)->row();
			$this->superviser_name 	= $this->superviser->first_name." ".$this->superviser->last_name;
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
		$data['menu']= $this->menu;
		$data['user'] = $this->user;
		$data['group'] = $this->group->name;
		$data['superviser']=$this->superviser_name;;

		$data['page']='dashboard'; //page view to load
		$data['pls'] = array(); //page level scripts
		$data['plugins'] = array(); //plugins
		$data['javascript'] = array(); //javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* View patients
* access public
* @params
* return view
*********************************/
	public function patients_view(){
		$data['meta_description']='';
		$data['menu']= $this->menu;

		$data['user'] = $this->user;
		$data['group'] = $this->group->name;
		$data['superviser']=$this->superviser_name;;

		$data['page']='patients/patients-view'; //page view to load
		$data['pls'] = array(); //page level scripts
		$data['plugins'] = array(); //plugins
		$data['javascript'] = array(); //javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
	}

/**********************
* Add patients
* access public
* @params
* return view
*********************************/
	public function patients_add(){
		$data['meta_description']='';
		$data['menu']= $this->menu;

		$data['user'] = $this->user;
		$data['group'] = $this->group->name;
		$data['superviser']=$this->superviser_name;;

		$data['page']='patients/patients-add'; //page view to load
		$data['pls'] = array(); //page level scripts
		$data['plugins'] = array(); //plugins
		$data['javascript'] = array(); //javascript
		$views=  array('design/html_topbar','sidebar','design/page','design/html_footer');
		$this->layout->view($views, $data);
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
