<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Clients extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model(  'sys_admin_mdl', 'admin_mdl');


//        $this->load->model(  'modules/sys_admin/models/Sys_admin_mdl');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
//        $this->methods['clients_get']['limit'] = 500; // 500 requests per hour per client/key
//        $this->methods['clients_post']['limit'] = 100; // 100 requests per hour per client/key
//        $this->methods['clients_delete']['limit'] = 50; // 50 requests per hour per client/key
    }

    /////////// CLIENTS BLOCK START ////////////
    public function clients_get()
    {
        $uri_array = $this->uri->uri_to_assoc(5);
        $id= !empty($uri_array['id']) ? $uri_array['id'] : null;


        // If the id parameter doesn't exist return listing of  clients
        if ($id === NULL)
        {
            // Check if the clients data store contains clients (in case the database result returns NULL)
            $show_client_type_description= !empty($uri_array['show_client_type_description']) ? $uri_array['show_client_type_description'] : '';
            $filter_client_name= !empty($uri_array['filter_client_name']) ? $uri_array['filter_client_name'] : '';
            $filter_client_active_status= !empty($uri_array['filter_client_active_status']) ? $uri_array['filter_client_active_status'] : '';
            $filter_client_type= !empty($uri_array['filter_client_type']) ? $uri_array['filter_client_type'] : '';
            $filter_client_zip= !empty($uri_array['filter_client_zip']) ? $uri_array['filter_client_zip'] : '';
            $filter_created_at_from= !empty($uri_array['filter_created_at_from']) ? $uri_array['filter_created_at_from'] : '';
            $filter_created_at_till= !empty($uri_array['filter_created_at_till']) ? $uri_array['filter_created_at_till'] : '';
            $sort= !empty($uri_array['sort']) ? $uri_array['sort'] : '';
            $sort_direction= !empty($uri_array['sort_direction']) ? $uri_array['sort_direction'] : '';
            $clients= $this->admin_mdl->getClientsList(false, '', array( 'show_client_type_description'=>$show_client_type_description, 'client_name'=> $filter_client_name, 'client_active_status'=> $filter_client_active_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );
            if ($clients)     // If there are clients set the response and exit
            {
                $this->response($clients, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No Clients found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular client.

        $id = (int) $id;
        if ($id <= 0)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code on Invalid id
        }


        // Get the client from db by its id
        $client = $this->admin_mdl->getRowById($id);

        if (!empty($client))
        {
            $this->set_response($client, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Client could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function clients_post()
    {
        $date_time_mysql_format= $this->common_lib->getSettings('date_time_mysql_format');
        $client_name = $this->post('client_name');
        $client_email = $this->post('client_email');
        $client_website = $this->post('client_website');
        $client_active_status = $this->post('client_active_status');
        $clients_types_id  = $this->post('clients_types_id');
        $client_owner = $this->post('client_owner');
        $client_address1 = $this->post('client_address1');
        $client_address2 = $this->post('client_address2');
        $client_state = $this->post('client_state');
        $client_city = $this->post('client_city');
        $client_zip = $this->post('client_zip');
        $client_phone = $this->post('client_phone');
        $client_fax = $this->post('client_fax');
        $client_notes = $this->post('client_notes');

        $validation_errors= array();
        include_once("validateData.php");
        $validateDataObj= new validateData($this);
        $validateDataObj->set_validation_required_fields(  array( 'client_name', 'client_email', 'client_active_status', 'clients_types_id', 'client_owner', 'client_address1', 'client_city', 'client_state', 'client_zip', 'client_phone', 'client_fax' ) );
        $validateDataObj->set_validation_email_fields(  array( 'client_email' ) );
        $validateDataObj->set_validation_not_negative_fields(  array( 'client_zip' ) );
        $validateDataObj->set_validation_integer_fields(  array( 'client_zip' ) );
        $validateDataObj->set_validation_name_fields(  array( 'client_name' ) );
        $validateDataObj->set_validation_url_fields(  array( 'client_website' ) );
        $validateDataObj->set_validation_phone_fields(  array( 'client_phone' ) );
        $validateDataObj->set_validation_url_fields(  array( 'client_website' ) );
        $validateDataObj->set_validation_enum_fields(  array(
            array( 'field_name'=>'client_active_status', 'values'=>array( 'N','A','I' ) ),
        ) );
        $validateDataObj->set_validation_reference_links(  array(
            array( 'field_name'=>"clients_types_id", 'ref_table'=>'clients_types', 'ref_column'=>'type_id' ),
        ) );

        $validateDataObj->set_validation_method('post');
        $validateDataObj->runValidation();
        if ( $validateDataObj->has_validation_errors() ) {
            $validation_errors= $validateDataObj->get_validation_errors();
        }
        if ( !$this->admin_mdl->checkIsEmailUnique($client_email) and empty($validation_errors['client_email']) ) {
            $validation_errors['client_email']= array('client_email'=> $client_email, 'error_type'=>'validation_email_is_not_unique');
        }
        if ( !$this->admin_mdl->checkIsClient_NameUnique($client_name) and empty($validation_errors['client_name']) ) {
            $validation_errors['client_name']= array('client_name'=> $client_name, 'error_type'=>'validation_client_name_is_not_unique');
        }

        if ( count($validation_errors) > 0 ) {
            $this->response(array(
                'errors' => $this->get_error_codes( $validation_errors , __FILE__, __LINE__),
            ), REST_Controller::HTTP_BAD_REQUEST );
            exit;
        }

        $client_data= array( 'client_name'=> $client_name, 'client_email'=> $client_email, 'client_website'=> $client_website,  'client_active_status'=> $client_active_status, 'clients_types_id'=> $clients_types_id, 'client_owner'=> $client_owner, 'client_address1'=> $client_address1, 'client_address2'=> $client_address2,  'client_city'=> $client_city,  'client_state'=> $client_state, 'client_zip'=> $client_zip, 'client_phone'=> $client_phone, 'client_fax'=> $client_fax, 'client_notes'=> $client_notes, 'created_at'=>strftime($date_time_mysql_format) , 'updated_at'=>strftime($date_time_mysql_format) );
        if ( $this->db->insert('clients',$client_data) ) {
            $new_client_id = $this->db->insert_id();
            $this->set_response($new_client_id, REST_Controller::HTTP_CREATED);
        }


    }

//    public function clients_delete()
//    {
//        $id = (int) $this->get('id');
//
//        // Validate the id.
//        if ($id <= 0)
//        {
//            // Set the response and exit
//            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
//        }
//
//        // $this->some_model->delete_something($id);
//        $message = [
//            'id' => $id,
//            'message' => 'Deleted the resource'
//        ];
//
//        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
//    }
    /////////// CLIENTS BLOCK END ////////////



    /////////// CLIENTS_TYPES BLOCK START ////////////
    public function clients_types_get()
    {
        $uri_array = $this->uri->uri_to_assoc(5);

        // If the id parameter doesn't exist return listing of  clients
        // Check if the clients data store contains clients (in case the database result returns NULL)
        $filter_type_name= !empty($uri_array['filter_type_name']) ? $uri_array['filter_type_name'] : '';
        $sort= !empty($uri_array['sort']) ? $uri_array['sort'] : '';
        $sort_direction= !empty($uri_array['sort_direction']) ? $uri_array['sort_direction'] : '';
        $clients= $this->admin_mdl->getClient_TypesList(false, '', array( 'type_name'=> $filter_type_name ), $sort, $sort_direction );
        if ($clients)     // If there are clients set the response and exit
        {
            $this->response($clients, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No Clients Types found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /////////// CLIENTS_TYPES BLOCK END ////////////

    private function get_error_codes($db_error, $_file, $_line)
    {
        $ret_errors = array();
        if ( !empty($db_error) and is_array($db_error) ) {
            foreach( $db_error as $next_key=>$next_value ) {
                $ret_errors[$next_key]= $next_value;
            }
        }
        if ( $this->input->get('d') == 99 ) {
            $ret_errors['file']= $_file;
            $ret_errors['line']= $_line;
        }
        return $ret_errors;
    }

}
