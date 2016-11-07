<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_jqvmap extends CI_Driver {

	/**
	* JQVMAP
    *
    * JQVMap is a jQuery plugin that renders Vector Maps. It uses resizable
    * Scalable Vector Graphics (SVG) for modern browsers like Firefox,
    * Safari, Chrome, Opera and Internet Explorer 9. Legacy support for older
    * versions of Internet Explorer 6-8 is provided via VML.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function jqvmap($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')
			);
		}

	}


}