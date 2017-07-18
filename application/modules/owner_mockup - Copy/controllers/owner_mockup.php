<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Owner_mockup extends CI_Controller {
	 public function __construct() {
         parent::__construct();
		 $this->load->model('users_mdl');
 		 $this->lang->load('ion_auth');
    	 $this->lang->load('auth');
 		 $this->lang->load('login');
	 }
 /**********************
 * owner_mockup page
 * access public
 * @params
 * return view
 *********************************/
	
    function index(){		
		 $this->load->view('main/owner_mockup');
    } 
	
}
