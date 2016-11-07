<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_uniform extends CI_Driver {

	/**
	* Uniform
    *
    * Uniform masks your standard form controls with custom themed controls.
    * It works in sync with your real form elements to ensure accessibility
    * and compatibility
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function uniform($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/uniform/css/uniform.default.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/uniform/jquery.uniform.min.js')
			);
		}

	}


}