<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_custommin extends CI_Driver {

	/**
	* Bootstrap Switch
    *
    * Use Radio Buttons as switches.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function custommin($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/layouts/default/css/custom.css')
			);
		}

		// No JavaScript available

	}


}