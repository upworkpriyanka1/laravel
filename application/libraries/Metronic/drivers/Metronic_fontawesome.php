<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_fontawesome extends CI_Driver {

	/**
	* Font Awesome
    *
    * The iconic font designed for use with Twitter Bootstrap.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function fontawesome($type=NULL)
	{
		// CSS Files(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/font-awesome/css/font-awesome.css')
			);
		}

		// No JavaScript Available

	}


}