<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_simplelineicons extends CI_Driver {

	/**
	* Simple Line Icons
    *
    * Simple Line Icons is 162 simple stroke icons that are great for mobile applications,
    * websites, user interfaces, etc. All icons were converted from the same beautiful simple
    * line icon sets released previously on GraphicBurger.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function simplelineicons($type=NULL)
	{
		// Set prefix to make reading easier, prevent text wrap
		$plugins = 'assets/global/plugins/simple-line-icons';

		// CSS Files(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag($plugins . '/simple-line-icons.min.css')
			);
		}

		// No JavaScript Available

	}


}