<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_nouislider extends CI_Driver {


	/**
	* jQuery noUiSlider
    *
    * noUiSlider is a super tiny jQuery plugin that allows you to create range sliders.
    * It fully supports touch, and it is way(!) less bloated than the jQueryUI library.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function nouislider($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/nouislider/nouislider.min.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/nouislider/nouislider.pips.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/nouislider/nouislider.min.js')
			);
		}

	}


}