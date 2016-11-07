<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_defaultmin extends CI_Driver {

	/**
	* defaultmin link_tag('assets/layouts/default/css/themes/darkblue.css')
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function defaultmin($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {

			$link = array(
				'href'	=> 	'assets/layouts/default/css/themes/darkblue.css',
				'rel'	=>	'stylesheet',
				'type'	=>	'text/css',
				'id'	=>	'style_color'
			);

			$this->CI->output->append_output(
				link_tag($link)
			);
		}

		// No JavaScript available

	}


}