<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_morris extends CI_Driver {

	/**
	*
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function morris($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/morris/morris.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/morris/morris.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/morris/raphael-min.js')
			);

			$this->CI->output->append_output(
				script_tag('assets/global/plugins/counterup/jquery.waypoints.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/counterup/jquery.counterup.min.js')
			);

		}
	}


}