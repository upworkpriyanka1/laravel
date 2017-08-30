<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

       
    }
    
    public function grid(){
        
    }
	
	 public function grid_without_shortcuts(){
        
    }
    public function col3(){
      
    }
    public function newuserform(){
       
    }
    public function eh(){
        $this->load->view('main/eh');
    }
	public function pt(){
        $this->load->view('main/pt');
    }
	
	public function sign_up(){
       
    }
	
	public function locations_types(){
      
    }
	
	public function locations_view(){
     
    }
	public function sign_dashboard()
    {		
       

    }
	
    public function client_overview(){
        $this->load->view('main/client_overview');
    }

    public function index(){
		echo 'Test';
    }

    
    public function clients_view(){

    }


    public function clients_view_new(){

    }



   
    function get_client_info() {
       
    }

   
    function save_client_info() {
        
    }


    public function client_edit(){
        

    } 

}

