<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_jsinit extends CI_Driver {

	/**
	* Demo Min
    *
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function jsinit($type=NULL)
	{
		// No CSS available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/js/init.js')
			);
		}

	}


}