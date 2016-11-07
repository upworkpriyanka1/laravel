<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_flot extends CI_Driver {

	/**
	* Flot
    *
    * Flot is a pure JavaScript plotting library for jQuery, with a focus on simple usage, attractive looks and interactive features.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function flot($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.resize.js')
			);

			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.resize.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.categories.min.js')
			);

			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.pie.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.stack.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.crosshair.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/flot/jquery.flot.axislabels.js')
			);
		}

	}




}