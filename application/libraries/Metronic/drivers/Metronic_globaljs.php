<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_globaljs extends CI_Driver {

	/**
	* globaljs
    *
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function globaljs($type=NULL)
	{
		// No CSS available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/js/global.js')
			);
		}

	}


}