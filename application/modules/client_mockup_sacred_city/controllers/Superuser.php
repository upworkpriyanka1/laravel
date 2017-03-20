<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function client_overview(){

        $this->load->view('main/client-overview');
    }

    public function client_overview_patient_new(){

        $this->load->view('main/client-overview-patient-new');
    }

    public function client_overview_patient_manage(){

        $this->load->view('main/client-overview-patient-manage');
    }
    public function client_overview_settings_theme(){

        $this->load->view('main/client-overview-settings-theme');
    }
}