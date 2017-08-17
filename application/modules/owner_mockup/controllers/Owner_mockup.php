<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Owner_mockup extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->lang->load('owner');
		$this->config->load('owner_menu_new', true );
		$this->menu = $this->config->item( 'owner_menu_new' );
		$this->load->library('session');
	}

	public function index(){
		$data['meta_description'] = '';
        $data['menu'] = $this->menu;
		$data['user'] = $this->user; 
        $data['page'] = 'dashboard'; //page view to load   
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
	}
	public function locations_list(){		
		$data['meta_description']='';
        $data['menu'] = $this->menu;
		$data['user'] = $this->user; 
        $data['page'] = 'main/location_view';       
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
    }
	
	public function contacts_list(){		
		$data['meta_description']='';
        $data['menu'] = $this->menu;
		$data['user'] = $this->user; 	
        $data['page'] = 'main/contacts_list';        
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
    }
	public function residents_list(){
		$data['page_title']= 'residents';		
		$data['meta_description']='';
        $data['menu'] = $this->menu;
		$data['user'] = $this->user; 	
        $data['page'] = 'main/residents_list';        
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
    }
	public function edit_user_info(){
		$data['page_title']= 'residents';		
		$data['meta_description']='';
        $data['menu'] = $this->menu;
		$data['user'] = $this->user; 	
        $data['page'] = 'main/edit_user_info';        
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
	}
}	