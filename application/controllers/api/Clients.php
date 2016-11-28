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
//        $this->load->model('sys_admin_mdl','admin_mdl');
//        $this->lang->load('sys_admin');
        parent::__construct();

//        $this->load->library('Sys_admin_lib',NULL,'admin_lib');

        // application/modules/sys_admin/models/Sys_admin_mdl.php
        // application/modules/sys_admin/models/Sys_admin_mdl.php
        $this->load->model( APPPATH .  '/modules/sys_admin/models/Sys_admin_mdl');
//        $this->load->model(  'modules/sys_admin/models/Sys_admin_mdl');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
//        $this->methods['clients_get']['limit'] = 500; // 500 requests per hour per client/key
//        $this->methods['clients_post']['limit'] = 100; // 100 requests per hour per client/key
//        $this->methods['clients_delete']['limit'] = 50; // 50 requests per hour per client/key
    }

    public function clients_get()
    {
//        $clients = [
//            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
//            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
//            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
//        ];

        $id = $this->get('id');


        // If the id parameter doesn't exist return listing of  clients
        if ($id === NULL)
        {
            // Check if the clients data store contains clients (in case the database result returns NULL)
            //    public function getClientsList($OutputFormatCount = false, $page = 0, $filters = array(), $sort = '', $sort_direction = '')
            $show_client_type_description= !empty($_GET['show_client_type_description']) ? $_GET['show_client_type_description'] : '';
            $filter_client_name= !empty($_GET['filter_client_name']) ? $_GET['filter_client_name'] : '';
            $filter_client_active_status= !empty($_GET['filter_client_active_status']) ? $_GET['filter_client_active_status'] : '';
            $filter_client_type= !empty($_GET['filter_client_type']) ? $_GET['filter_client_type'] : '';
            $filter_client_zip= !empty($_GET['filter_client_zip']) ? $_GET['filter_client_zip'] : '';
            $filter_created_at_from= !empty($_GET['filter_created_at_from']) ? $_GET['filter_created_at_from'] : '';
            $filter_created_at_till= !empty($_GET['filter_created_at_till']) ? $_GET['filter_created_at_till'] : '';
            $sort= !empty($_GET['sort']) ? $_GET['sort'] : '';
            $sort_direction= !empty($_GET['sort_direction']) ? $_GET['sort_direction'] : '';
            $clients= $this->admin_mdl->getClientsList(true, '', array( 'show_client_type_description'=>$show_client_type_description, 'client_name'=> $filter_client_name, 'client_active_status'=> $filter_client_active_status, 'client_type'=> $filter_client_type, 'client_zip'=> $filter_client_zip, 'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till ), $sort, $sort_direction );  // get number of rows by given parameters
            echo '<pre>$clients::'.print_r($clients,true).'</pre>';

            if ($clients)
            {
                // Set the response and exit
                $this->response($clients, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No clients Clients found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular client.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the client from the array, using the id as key for retreival.
        // Usually a model is to be used for this.

        $client = NULL;

        if (!empty($clients))
        {
            foreach ($clients as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $client = $value;
                }
            }
        }

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
        // $this->some_model->update_client( ... );
        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function clients_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
