<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Driver used to create common HTML elements that
 * are regularaly used and modular elements with the template style.
 *
 *

 */
class Metronic_appmin extends CI_Driver {

	/**
	* respondmin
    *
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function appmin($type=NULL)
	{
		// No CSS available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/scripts/app.min.js')
			);
		}

	}


}
