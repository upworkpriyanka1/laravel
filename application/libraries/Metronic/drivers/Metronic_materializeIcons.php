<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_materializeIcons extends CI_Driver {

	/**
	* Open Sans
    *
    * Metornic uses Open Sans web font from google fonts: http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function materializeIcons($type=NULL)
	{
		// CSS Files(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('//fonts.googleapis.com/icon?family=Material+Icons')
			);
		}

		// No JavaScript Available

	}


}