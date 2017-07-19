<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function __construct() {
		parent::__construct();	
	}

	public function index(){
		$data['meta_description'] = '';
        $data['menu'] = $this->menu;
        $data['page']		='dashboard'; //page view to load   
        $views=  array('design-mockup/html_topbar','sidebar','design-mockup/page','design-mockup/html_footer');
        $this->layout->view($views, $data);
	}		
}

?>	