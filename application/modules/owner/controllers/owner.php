<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class owner extends CI_Controller {
    public function __construct() {
        parent::__construct();               
		$this->lang->load('sys_admin');		
		$this->config->load('sys_admin_menu_new', true );
		$this->menu = $this->config->item( 'sys_admin_menu_new' );        
    }
  
    public function index(){   
		$data['meta_description']='';
        $data['menu'] = $this->menu;
        $data['user'] 		= $this->user;
        $data['group'] 		= $this->group->name;
        $data['page']		='dashboard'; //page view to load
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
    }
	
	 public function locations_list(){		
		$data['meta_description']='';
        $data['menu'] = $this->menu;
        $data['user'] 		= $this->user;      
        $data['page']		='main/location_view'; //page view to load
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
    }
	
	public function contacts_list(){		
		$data['meta_description']='';
        $data['menu'] = $this->menu;
        $data['user'] 		= $this->user;      
        $data['page']		='main/contacts_list'; //page view to load
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array(); //page javascript
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
    }
}

