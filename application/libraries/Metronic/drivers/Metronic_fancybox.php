<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_fancybox extends CI_Driver {

	/**
	* FancyBox
    *
    * FancyBox is a tool for displaying images, html content and multi-media
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function fancybox($type=NULL)
	{
		// Set prefix to make reading easier, prevent text wrap
		$plugins = 'assets/global/plugins';

		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag($plugins . '/fancybox/source/jquery.fancybox.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag($plugins . '/fancybox/source/jquery.fancybox.pack.js')
			);
		}

	}


}