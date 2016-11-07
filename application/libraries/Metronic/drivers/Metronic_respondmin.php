<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_respondmin extends CI_Driver {

	/**
	* respondmin
    *
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function respondmin($type=NULL)
	{
		// No CSS available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/respond.min.js')
			);
		}

	}


}