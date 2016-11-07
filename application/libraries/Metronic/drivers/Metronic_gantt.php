<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_gantt extends CI_Driver {

    /**
     * Bootstrap Min
     *
     *
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function gantt($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-gantt/style.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-gantt/jquery.fn.gantt.js')
			);
		}
	}


}