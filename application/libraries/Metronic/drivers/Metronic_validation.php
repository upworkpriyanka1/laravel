<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_validation extends CI_Driver {

	/**
	* jQuery Validation Plugin
    *
    * The jQuery Validation Plugin provides drop-in validation for your existing
    * forms, while making all kinds of customizations to fit your application
    * really easy
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function validation($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-validation/js/additional-methods.min.js')
			);
		}

	}


}