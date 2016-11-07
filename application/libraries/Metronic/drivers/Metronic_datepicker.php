<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_datepicker extends CI_Driver {

	/**
	* Enhanced Datepicker for Bootstrap
    *
    * Add datepicker picker to field or to any other element
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function datepicker($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			//$this->CI->output->append_output(
				//link_tag('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')
//			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')
			);
		}

	}


}