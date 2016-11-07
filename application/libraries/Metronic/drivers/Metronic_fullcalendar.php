<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_fullcalendar extends CI_Driver {

	/**
	* FullCalendar
    *
    * FullCalendar is a jQuery plugin that provides a full-sized, drag & drop calendar
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */
	public function fullcalendar($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/fullcalendar/fullcalendar/bootstrap-fullcalendar.css')
			);
		}
		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js')
			);
		}

	}


}