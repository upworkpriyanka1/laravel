<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_bs_switch extends CI_Driver {

	/**
	* Bootstrap Switch
    *
    * Use Radio Buttons as switches.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function bs_switch($type=NULL)
	{
		// Set prefix to make reading easier, prevent text wrap
		$plugins = 'assets/global/plugins';

		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag($plugins . '/bootstrap-switch/css/bootstrap-switch.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag($plugins . '/bootstrap-switch/js/bootstrap-switch.min.js')
			);
		}

	}


}