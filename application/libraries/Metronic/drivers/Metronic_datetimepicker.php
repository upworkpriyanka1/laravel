<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_datetimepicker extends CI_Driver {



	/**
	* Bootstrap Datetimepicker
    *
    * This project is a fork of bootstrap-datetimepicker project which doesn't include Time part.
    * Some others parts has been improved as for example the load process which now accepts the
    * ISO-8601 format. I've copy/pasted the forked project's documentation and added my specifications.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function datetimepicker($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')
			);
		}

	}


}