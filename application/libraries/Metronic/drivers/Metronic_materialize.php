<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_materialize extends CI_Driver {

	/**
	* Materialize
    *
    * Materialize JS/CSS
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function materialize($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/css/materialize.min.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/css/ghpages-materialize.css')
			);
		}
		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/js/materialize.min.js')
			);
		}

	}


}