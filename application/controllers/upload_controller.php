<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_Controller extends CI_Controller {    
	public function __construct() {
	    parent::__construct();
	    $this->load->helper(array('form', 'url'));
	} 
	public function do_upload(){
	    $upload_folder = $this->config->item('avatar-folder');
	    $allowed_types = $this->config->item('image_allowed_types');

	    $data = array();
	    $filename= $_FILES['userfile']['name'];
	    $config =  array(
	      'upload_path'     => $upload_folder,
	      'allowed_types'   => $allowed_types,
          'max_size'        => "2048000",  // Can be set to particular file size
	      'overwrite'       => TRUE,
	      'file_name'       => $filename 
	    );  
	    $this->load->library('upload', $config);
        $this->upload->initialize($config);
        //var_dump($this->upload->do_upload());
		if($this->upload->do_upload())
		{
			$query = $this->db->get('upload_bg');
			if($query->num_rows() > 0)
			{
				$data = array("filename" => $this->upload->data("orig_name"));
				$this->db->update('upload_bg', $data);	
			} 
			else 
			{
				$data = array("filename" => $this->upload->data("orig_name"));
				$this->db->insert('upload_bg', $data);
			}
			
			redirect("/sys-admin");
 		}
		else
		{
			redirect("/sys-admin");
		}    
	}

	public function delete_bg($id){
		$this->db->where("id", $id);
		$this->db->delete("upload_bg");
		redirect("/sys-admin");
	}
}
?>