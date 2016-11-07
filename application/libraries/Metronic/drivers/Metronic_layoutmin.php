<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_layoutmin extends CI_Driver {

    /**
     * layoutmin
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function layoutmin($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
                link_tag('assets/layouts/default/css/layout.css')


			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/layouts/default/scripts/layout.min.js')
			);
		}
	}


}