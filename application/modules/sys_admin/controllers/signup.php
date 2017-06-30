<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function index(){
		$data['page']		= 'Signup'; 
        array('design/html_topbar','sidebar','design/page','design/html_footer', 'common_dialogs.php');
        $this->layout->view($views, $data);
    }
}