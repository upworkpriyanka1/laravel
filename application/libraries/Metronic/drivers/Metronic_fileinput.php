<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_fileinput extends CI_Driver {

	/**
	* Bootstrap File Unput
    *
    * The file input plugin allows you to create a visually appealing file or
    * image input widgets.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function fileinput($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')
			);
		}
		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')
			);
		}

	}


}