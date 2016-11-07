<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_datatables extends CI_Driver {

	/**
	* DataTables
    *
    * DataTables for Twitter Bootstrap
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function datatables($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/datatables/plugins/datatables/datatables.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/datatables/datatables.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')
			);
		}

	}


}