<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_pluginsmin extends CI_Driver {

    /**
     * pluginsmin
     *
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function pluginsmin($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/css/plugins.min.css')
			);
		}

		// No JavaScript available
	}


}