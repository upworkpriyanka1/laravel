<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metronic_componentsmin extends CI_Driver {

    /**
     * Socicon
     *
     * Socicon Social Icons.
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function componentsmin($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {

			$link = array(
				'href'	=> 	'assets/global/css/components.min.css',
				'rel'	=>	'stylesheet',
				'id'	=>	'style_components',
				'type'	=>	'text/css'
			);
			$this->CI->output->append_output(
				link_tag($link)
			);
		}

		// No JavaScript available
	}


}