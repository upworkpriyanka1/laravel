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
class Patients extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model(  'sys_admin_mdl', 'admin_mdl');
        $this->load->model(  'patients_mdl' );
    }

    /////////// PATIENTS BLOCK START ////////////

    private function get_dictionary($dictionary_items_name)
    {
        $this->config->load('dictionary_items', true);
        $dictionary_items_list = $this->config->item('dictionary_items');
        $ret_array= [];
        if ( !empty($dictionary_items_list[$dictionary_items_name]) ) {
            $ret_array= $dictionary_items_list[$dictionary_items_name];
        }
        return $ret_array;
    }
    public function patients_get()
    {
        $uri_array = $this->uri->uri_to_assoc(5);
        if ( !empty($uri_array['get_dictionary']) ) {
            $dictionary_items= $this->get_dictionary( $uri_array['get_dictionary'] );
            if ( empty($dictionary_items) ) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No "'.$uri_array['get_dictionary'].'" items found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
            $this->response($dictionary_items, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        $id= !empty($uri_array['id']) ? $uri_array['id'] : null;


        // If the id parameter doesn't exist return listing of  patients
        if ($id === NULL)
        {
            // Check if the patients data store contains patients (in case the database result returns NULL)
            // apply all filters to data retrieving
            $filter_pt_patient_login= !empty($uri_array['filter_pt_patient_login']) ? $uri_array['filter_pt_patient_login'] : '';
            $filter_pt_patient_active_status= !empty($uri_array['filter_pt_patient_active_status']) ? $uri_array['filter_pt_patient_active_status'] : '';
            $filter_pt_state= !empty($uri_array['filter_pt_state']) ? $uri_array['filter_pt_state'] : '';
            $filter_pt_zip= !empty($uri_array['filter_pt_zip']) ? $uri_array['filter_pt_zip'] : '';
            $filter_pt_gender= !empty($uri_array['filter_pt_gender']) ? $uri_array['filter_pt_gender'] : '';
            $filter_pt_birth_date= !empty($uri_array['filter_pt_birth_date']) ? $uri_array['filter_pt_birth_date'] : '';
            $filter_pt_ss_number= !empty($uri_array['filter_pt_ss_number']) ? $uri_array['filter_pt_ss_number'] : '';
            $filter_created_at_from= !empty($uri_array['filter_created_at_from']) ? $uri_array['filter_created_at_from'] : '';
            $filter_created_at_till= !empty($uri_array['filter_created_at_till']) ? $uri_array['filter_created_at_till'] : '';
            $show_patient_bereavements= !empty($uri_array['show_patient_bereavements']) ? $uri_array['show_patient_bereavements'] : '';
            $show_patient_contacts= !empty($uri_array['show_patient_contacts']) ? $uri_array['show_patient_contacts'] : '';
            $filter_pt_birth_date_from= !empty($uri_array['filter_pt_birth_date_from']) ? $uri_array['filter_pt_birth_date_from'] : '';
            $filter_pt_birth_date_till= !empty($uri_array['filter_pt_birth_date_till']) ? $uri_array['filter_pt_birth_date_till'] : '';
            $sort= !empty($uri_array['sort']) ? $uri_array['sort'] : '';
            $sort_direction= !empty($uri_array['sort_direction']) ? $uri_array['sort_direction'] : '';
            $patients= $this->patients_mdl->getPatientsList(false, '', array( 'pt_patient_login'=> $filter_pt_patient_login, 'pt_patient_active_status'=> $filter_pt_patient_active_status, 'pt_state'=> $filter_pt_state, 'pt_zip'=> $filter_pt_zip, 'pt_gender'=> $filter_pt_gender,'pt_birth_date'=> $filter_pt_birth_date, 'pt_ss_number'=> $filter_pt_ss_number,  'created_at_from'=> $filter_created_at_from, 'created_at_till'=> $filter_created_at_till, 'show_patient_bereavements'=> $show_patient_bereavements,  'show_patient_contacts'=> $show_patient_contacts,  'pt_birth_date_from'=> $filter_pt_birth_date_from, 'pt_birth_date_till'=> $filter_pt_birth_date_till ), $sort, $sort_direction );
            if ($patients)     // If there are patients set the response and exit
            {
                $this->response($patients, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No Patients found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular patient.

        $id = (int) $id;
        if ($id <= 0)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code on Invalid id
        }


        // Get the patient from db by its id
        $patient = $this->patients_mdl->getRowById($id);

        if (!empty($patient))
        {
            $this->set_response($patient, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Patient could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function patients_post()
    {

    }

    /////////// PATIENTS BLOCK END ////////////




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
