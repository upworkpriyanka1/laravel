<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function client_overview(){

        $this->load->view('main_system_admin/client-overview');
    }

}