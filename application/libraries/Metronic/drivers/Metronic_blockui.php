<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Driver used to create common HTML elements that
 * are regularaly used and modular elements with the template style.
 *
 * 

 */
class Metronic_blockui extends CI_Driver {

	/**
	* jQuery BlockUI
    *
    * The jQuery BlockUI Plugin lets you simulate synchronous behavior
    * when using AJAX, without locking the browser
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function blockui($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery.blockui.min.js')
			);
		}
	}


}
