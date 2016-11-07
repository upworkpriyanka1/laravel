<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_dropzonejs extends CI_Driver {

	/**
	* DropzoneJS
    *
    * DropzoneJS is an open source library that provides drag'n'drop file
    * uploads with image previews.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function dropzonejs($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/dropzone/dropzone.min.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/dropzone/basic.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/dropzone/dropzone.min.js')
			);
		}

	}


}