<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/* Logging
 * @params, UTC
 */

    class Logging {
        public function log_activity() {
            $CI =& get_instance();
            if ($CI->session->userdata('user_id')){
            // Start off with the session stuff we know
                $data = array();
                $data['username'] = $CI->session->userdata('username');
                $data['super_id'] = $CI->session->userdata('super_id');
                $data['user_id'] = $CI->session->userdata('user_id');
            // Next up, we want to know what page we're on, use the router class
                $data['section'] = $CI->router->class;
                $data['action'] = $CI->router->method;
            // Lastly, we need to know when this is happening
                $data['activity_time'] = time();
            //log the URI just in case
                $data['uri'] = uri_string();
            // And write it to the database
                $CI->db->insert('activity_logs', $data);
            }
        }
    }

