<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_gmaps extends CI_Driver {
	/**
	* gmaps.js
    *
    * gmaps.js allows you to use the potential of Google Maps in a simple way.
    * No more extensive documentation or large amount of code
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function gmaps($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/js/gmaps.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/js/demo.gmaps.js')
			);
		}

	}


}