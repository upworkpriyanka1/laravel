<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_nestable extends CI_Driver {

	/**
	* Nestable
    *
    * Drag & drop hierarchical list with mouse and touch compatibility.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function nestable($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-nestable/jquery.nestable.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-nestable/jquery.nestable.js')
			);
		}

	}


}