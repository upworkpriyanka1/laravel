<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Driver used to create common HTML elements that 
 * are regularaly used and modular elements with the template style. 
 *
 * 

 */
class Metronic_bootstrapmin extends CI_Driver {

    /**
     * Bootstrap Min
     *
     * 
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */		
	public function bootstrapmin($type=NULL)
	{		
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap/css/bootstrap.min.css')
			);
		}
		
		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap/js/bootstrap.min.js')
			);
		}
	}


}
