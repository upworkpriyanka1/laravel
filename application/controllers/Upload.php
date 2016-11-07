<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function __construct() {
	   parent::__construct();
	/*check if logged in */
			if (!$this->ion_auth->logged_in()){
				redirect('./', 'refresh');
			}

	/* load library & model with aliases, config and language */

	}
    /******************
    * Public function upload Files
    * Params, GET files, new filename
    * return jason response
    **************************/
    public function index(){
        //load config items
        $upload_folder = $this->config->item('avatar-folder');
        $allowed_types = $this->config->item('image_allowed_types');

        $data = array();
        $filename= $_GET['filename'];

        if(isset($_GET['folder']) && $_GET['folder'] !=''){
            $x=0;
            foreach($_FILES as $file){
                $config['upload_path'] = $upload_folder;
                $config['file_name']    = $filename;
                $config['overwrite'] = TRUE; //important we need tyhis to preserve the filename
                $config['allowed_types'] = ''.$allowed_types.'';
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ( ! $this->upload->do_upload($x)){
                $data = array('error' => $this->upload->display_errors('', ''));
                echo json_encode($data);
                return FALSE;
                }else{
                $data = array('success' => 'Form was submitted', 'formData' => $this->upload->data('file_name'));
                echo json_encode($data);
                return FALSE;
                }
                $x++;
            }
        }else{
            $data = array('error' => 'No files');
        }
        echo json_encode($data);
        return FALSE;
    }

    
}
