<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Metronic_bs_dropdown_hover extends CI_Driver {

	/**
	* Bootstrap Hover Dropdown Plugin
    *
    * A simple plugin to enable twitter bootstrap dropdowns to activate on
    * hover and provide a nice user experience.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function bs_dropdown_hover($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		// Set prefix to make reading easier, prevent text wrap
		$plugins = 'assets/global/plugins/bootstrap-hover-dropdown';

		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag($plugins . '/bootstrap-hover-dropdown.min.js')
			);
		}

	}


}