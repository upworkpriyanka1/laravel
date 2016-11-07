<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_login extends CI_Driver {

	/**
	* respondmin
    *
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function login($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/pages/login/login.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/pages/login/login.js')
			);
		}

	}


}