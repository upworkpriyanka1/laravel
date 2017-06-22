<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_mdl');
        $this->config->load('sys_admin_menu_new', true);
        $this->menu = $this->config->item('sys_admin_menu_new');


    }
    public function index(){
        $data['page']		= 'main_superuser/dasboard';
        $data['title']		= 'dashboard';
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array('/assets/global/js/client-overview.js'); //page javascript
        $views				= array('layout/topbar_superuser','layout/sidebar_superuser','layout/page_superuser','layout/footer_superuser');

        $this->layout->view($views,$data);
//        $this->load->view('main_superuser/dasboard');
    }
    public function client_overview(){

        $this->load->view('main_superuser/client-overview');
    }

    public function new_patient(){
        $data['page']		= 'main_superuser/new-patient';
        $data['title']		= 'new-patient';
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array('/assets/global/js/client-overview.js'); //page javascript
        $views				= array('layout/topbar_superuser','layout/sidebar_superuser','layout/page_superuser','layout/footer_superuser');

        $this->layout->view($views,$data);

//        $this->load->view('main_superuser/new-patient');
    }

    public function new_patient_verification(){
        $data['page']		= 'main_superuser/new-patient-verification';
        $data['title']		= 'new-patient';
        $data['pls'] 		= array(); //page level scripts optional
        $data['plugins'] 	= array(); //page plugins
        $data['javascript'] = array('/assets/global/js/client-overview.js'); //page javascript
        $views				= array('layout/topbar_superuser','layout/sidebar_superuser','layout/page_superuser','layout/footer_superuser');

        $this->layout->view($views,$data);

//        $this->load->view('main_superuser/new-patient');
    }

    public function client_overview_patient_manage(){

        $this->load->view('main_superuser/client-overview-patient-manage');
    }
    public function client_overview_settings_theme(){

        $this->load->view('main_superuser/client-overview-settings-theme');
    }

    public function client_overview_profile_form(){
        $UriArray = $this->uri->uri_to_assoc(3);
        $user_id=$UriArray['client-overview-profile-form'];
        $editable_user= $this->users_mdl->getUserRowById( $user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
        if ($this->input->server('REQUEST_METHOD') == 'GET'){
            $data['page']		= 'main_superuser/client-overview-profile-form';
            $data['menu']		= $this->menu;
            $data['title']		= 'new-patient';
            $data['pls'] 		= array(); //page level scripts optional
            $data['plugins'] 	= array(); //page plugins
            $data['javascript'] = array('/assets/global/js/client-overview.js'); //page javascript
            $views				= array('layout/html_topbar','layout/sidebar','design/page','design/html_footer');
            $data['user']       = $editable_user;
            $this->layout->view($views,$data);
        }else if ($this->input->server('REQUEST_METHOD') == 'POST'){
            if(isset($_POST['submit'])){
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');


                $this->form_validation->set_rules( 'data[username]', lang('username'), 'required' );
                $this->form_validation->set_rules( 'data[password]', lang('password'), 'required' );
                $this->form_validation->set_rules( 'data[password_confirm]', lang('password_confirm'), 'required|matches[data[password]]' );
                $this->form_validation->set_rules( 'data[first_name]', lang('first_name'), 'required' );
                $this->form_validation->set_rules( 'data[last_name]', lang('last_name'), 'required' );
                $this->form_validation->set_rules( 'data[phone]', lang('phone'), 'required' );


                $id = $this->input->post('data[id]');

                $data = array(
                    'username' => $this->input->post('data[username]'),
                    'password' => password_hash($this->input->post('data[password]'), PASSWORD_BCRYPT),
                    'first_name' => $this->input->post('data[first_name]'),
                    'middle_name' => $this->input->post('data[middle_name]'),
                    'last_name' => $this->input->post('data[last_name]'),
//            'birth_date' => $this->input->post('data[birth_date]'),
                    'avatar' => $this->input->post('data[avatar]'),
//            'ethnicity' => $this->input->post('data[ethnicity]'),
                    'address1' => $this->input->post('data[address1]'),
                    'city' => $this->input->post('data[city]'),
                    'state' => $this->input->post('data[state]'),
                    'zip' => $this->input->post('data[zip]'),
                    'phone' => $this->input->post('data[phone]'),
                    'phone_type' => $this->input->post('data[phone_type]'),
                    'username' => $this->input->post('data[username]'),
                    'email' => $this->input->post('data[email]'),
//            'lic-title' => $this->input->post('data[lic-title]'),
//            'us-lic' => $this->input->post('data[us-lic]'),
//            'start-date' => $this->input->post('data[start-date]'),
//            'end_date' => $this->input->post('data[end_date]'),
//            'lang' => $this->input->post('data[lang]'),
//            'lang1' => $this->input->post('data[lang1]'),
//            'us-profic' => $this->input->post('data[us-profic]'),
//            'us-text' => $this->input->post('data[us-text]'),
//            'us-code' => $this->input->post('data[us-code]'),
//            'us-code-conf' => $this->input->post('data[us-code-conf]'),
                );


                if ($this->form_validation->run() == FALSE)
                {
                    $data['page']		= 'main_superuser/client-overview-profile-form';
                    $data['menu']		= $this->menu;
                    $data['title']		= 'new-patient';
                    $data['pls'] 		= array(); //page level scripts optional
                    $data['plugins'] 	= array(); //page plugins
                    $data['javascript'] = array('/assets/global/js/client-overview.js'); //page javascript
                    $views				= array('layout/html_topbar','layout/sidebar','design/page','design/html_footer');
                    $data['user']       = $editable_user;
                    $this->layout->view($views,$data);
                }
                else
                {
                    $this->db->where('id', $id);
                    $this->db->update('users', $data);
                    $this->session->set_flashdata('massege', 'Updated successfully');
                    redirect('sys-admin/users/users-overview/'.$id.'/');

                }

            }
        }
//        echo "<pre>";
//		print_r($editable_user);
//		die;

    }

//    public function client_overview_profile_form(){
//        $UriArray = $this->uri->uri_to_assoc(3);
//        $user_id=$UriArray['client-overview-profile-form'];
//        $editable_user= $this->users_mdl->getUserRowById( $user_id, array('show_file_info'=> 1, 'image_width'=> 128, 'image_height'=> 128) );
//        $data['page']		= 'main_superuser/client-overview-profile-form';
//        $data['menu']		= $this->menu;
//        $data['title']		= 'new-patient';
//        $data['pls'] 		= array(); //page level scripts optional
//        $data['plugins'] 	= array(); //page plugins
//        $data['javascript'] = array('/assets/global/js/client-overview.js'); //page javascript
//        $views				= array('layout/html_topbar','layout/sidebar','design/page','design/html_footer');
//        $data['user']       = $editable_user;
//        $this->layout->view($views,$data);
//
////        $this->load->view('main_superuser/new-patient');
//    }
    public function superuser(){



    }
}