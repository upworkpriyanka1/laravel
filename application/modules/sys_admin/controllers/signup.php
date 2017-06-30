<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function index(){
		$data['page']		= 'Signup';
        $views=  array('design/page' );
        $this->layout->view($views, $data);
    }
}