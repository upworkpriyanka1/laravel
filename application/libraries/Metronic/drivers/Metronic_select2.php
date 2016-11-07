<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_select2 extends CI_Driver {

	/**
	* Select2
    *
    * Select2 is a jQuery based replacement for select boxes. It supports searching,
    * remote data sets, and infinite scrolling of results.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function select2($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/select2/css/select2.min.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/select2/css/select2-bootstrap.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/select2/js/select2.full.min.js')
			);
		}

	}


}