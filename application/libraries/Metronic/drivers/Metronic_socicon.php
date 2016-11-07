<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_socicon extends CI_Driver {

    /**
     * Socicon
     *
     * Socicon Social Icons.
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function socicon($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/socicon/socicon.css')
			);
		}

		// No JavaScript available
	}


}