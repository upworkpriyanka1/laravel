<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_daterangepicker extends CI_Driver {

	/**
	* Date Range Picker for Bootstrap
    *
    * This date range picker component for Twitter Bootstrap creates a dropdown
    * menu from which a user can select a range of dates.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function daterangepicker($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')
			);

		}

	}


}