<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_wizard extends CI_Driver {

	/**
	* Bootstrap Form Wizard
    *
    * This twitter bootstrap plugin builds a wizard out of a formatter tabbable structure. It allows
    * to build a wizard functionality using buttons to go through the different wizard steps and
    * using events allows to hook into each step individually.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function wizard($type=NULL)
	{
		//  No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')
			);
		}

	}


}