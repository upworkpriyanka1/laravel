<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_slimscroll extends CI_Driver {

	/**
	* jQuery slimScroll
    *
    * slimScroll is a small (3.7KB) jQuery plugin that transforms any div
    * into a scrollable area with a nice scrollbar
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function slimscroll($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		// Set prefix to make reading easier, prevent text wrap
		$plugins = 'assets/global/plugins';

		if ($type == 'javascript') {

			$this->CI->output->append_output(
				script_tag($plugins . '/jquery-slimscroll/jquery.slimscroll.min.js')
			);
		}

	}


}