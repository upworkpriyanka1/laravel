<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Markup_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
		$this->load->library('session');
		$this->load->helper('url');
		//$this->load->model('metronic_model', 'metronic');
		$this->load->driver('metronic');
		$this->config->load('styles', TRUE);

	}

	/**
	 * Method to populate the CSS link tags in the page head.
	 *
	 * Designed the be very flexable, allowing grainular control
	 * over the CSS loaded by the page when needed.  Common use
	 * is for the login page, where page level styles are not
	 * used.
	 *
     * @access  public
	 * @param	mixed	string or an array of $plugins
	 * @param	mixed	$pls - string or an array of PAGE LEVEL STYLES
	 * @param	mixed	$tls - string or an array of THEME LAYOUT STYLES
	 * @param	mixed	$tgs - string or an array of THEME GLOBAL STYLES
	 * @param	mixed	$gms - string or an array of GLOBAL MANDATORY STYLES
     * @return  string Appends CodeIgniter output with properly formated HTML elements
	 */
	public function styles($plugins,$pls=NULL,$tls=NULL,$tgs=NULL,$gms=NULL)
	{

		// GLOBAL MANDATORY STYLES
		$this->global_mandatory_styles($gms);

		$this->comment('<!-- BEGIN PAGE LEVEL PLUGINS -->');

		// PAGE LEVEL PLUGINS CSS
		$this->get_link_tags($plugins,'css');

		$this->comment('<!-- END PAGE LEVEL PLUGINS -->');

		// THEME GLOBAL STYLES
		$this->theme_global_styles($tgs);

		// PAGE LEVEL STYLES
		$this->page_level_styles($pls);

		// THEME LAYOUT STYLES
		$this->theme_layout_styles($tls);

		// Favorite Icon
		$this->favicon();
	}

	/**
	 * Method to populate the JavaScritp tages at the end of the body.
	 *
	 * Designed the be very flexable, allowing grainular control
	 * over the Javascript loaded by the page when needed.  Common use
	 * is for the login page, where theme layout scripts are not
	 * used.
	 *
     * @access  public
	 * @param	mixed	string or an array of $plugins
	 * @param	mixed	$pls - string or an array of PAGE LEVEL STYLES
	 * @param	mixed	$tls - string or an array of THEME LAYOUT STYLES
	 * @param	mixed	$tgs - string or an array of THEME GLOBAL STYLES
	 * @param	mixed	$gms - string or an array of GLOBAL MANDATORY STYLES
     * @return  string Appends CodeIgniter output with properly formated HTML elements
	 */
	public function scripts($plugins,$pls=NULL,$tls=NULL,$tgs=NULL,$core=NULL,$ie=NULL)
	{
		// Internet Exploder Hacks
		$this->ie9_scripts($ie);

		// CORE PLUGINS
		$this->core_plugins($core);

		$this->comment('<!-- BEGIN PAGE LEVEL PLUGINS -->');

		// PAGE LEVEL PLUGINS JavaScript
		$this->get_link_tags($plugins,'javascript');

		$this->comment('<!-- END PAGE LEVEL PLUGINS -->');

		// THEME GLOBAL SCRIPTS
		$this->theme_global_scripts($tgs);

		// PAGE LEVEL SCRIPTS
		$this->page_level_scripts($pls);

		// THEME LAYOUT SCRIPTS
		$this->theme_layout_scripts($tls);
	}

	/**
	 * Method to generate JavaScript and CSS link tags.
	 *
	 * Generates the HTML for JavaScript and CSS
	 *
     * @access  public
	 * @param	mixed	string or an array
     * @param	string $type Type of tage to generate
     * @return  string Appends CodeIgniter output with properly formated HTML elements
	 */
	public function get_link_tags($tag=NULL,$type='css')
	{
		if (is_array($tag))
		{
			foreach ($tag as $value)
			{
				$this->metronic->{$value}($type);
			}
		} else {
			if (!empty($tag))
			{
				$this->metronic->{$tag}($type);
			}
		}
	}




    /**
     * Method used to link to external style sheets to the HTML document
     * Global mandatory styles for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function global_mandatory_styles($tag=NULL,$type='css')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('global_mandatory_styles', 'styles');
		}

		$this->comment('<!-- BEGIN GLOBAL MANDATORY STYLES -->');
		$this->get_link_tags($tag,$type);
		$this->comment('<!-- END GLOBAL MANDATORY STYLES -->');

	}

    /**
     * Method used to link to external style sheets to the HTML document
     * Theme global styles for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function theme_global_styles($tag=NULL,$type='css')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('theme_global_styles', 'styles');
		}

		$this->comment('<!-- BEGIN THEME GLOBAL STYLES -->');
		$this->get_link_tags($tag,$type);
		$this->comment('<!-- END THEME GLOBAL STYLES -->');

	}

    /**
     * Method used to link to external style sheets to the HTML document
     * Page level styles for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function page_level_styles($tag=NULL,$type='css')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('page_level_styles', 'styles');
		}

		$this->comment('<!-- BEGIN PAGE LEVEL STYLES -->');
		$this->get_link_tags($tag,$type);
		$this->comment('<!-- END PAGE LEVEL STYLES -->');

	}

    /**
     * Method used to link to external style sheets to the HTML document
     * Theme global styles for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function theme_layout_styles($tag=NULL,$type='css')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('theme_layout_styles', 'styles');
		}

		$this->comment('<!-- BEGIN THEME LAYOUT STYLES -->');
		$this->get_link_tags($tag,$type);
		$this->comment('<!-- END THEME LAYOUT STYLES -->');

	}

    /**
     * Method used to add favicon to the HTML document
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function favicon()
	{

		// Components
		$link = array(
			'rel'	=>	'shortcut icon',
			'href'	=>	'assets/favicon.ico'
		);
		$this->output->append_output(
			link_tag($link)
		);

	}

    /**
     * Method used to include JavaScript files to the HTML document
     * Theme IE9 scripts for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function ie9_scripts($tag=NULL,$type='javascript')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('ie9_scripts', 'styles');
		}

		$this->comment();
		$this->comment('<!--[if lt IE 9]>');
		$this->get_link_tags($tag,$type);
		$this->comment('<![endif]-->');

	}

    /**
     * Method used to include JavaScript files to the HTML document
     * Theme core plugins for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function core_plugins($tag=NULL,$type='javascript')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('core_plugins', 'styles');
		}

		$this->comment('<!-- BEGIN CORE PLUGINS -->');
		$this->get_link_tags($tag,$type);
		$this->comment('<!-- END CORE PLUGINS -->');

	}

    /**
     * Method used to include JavaScript files to the HTML document
     * Theme global scripts for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function theme_global_scripts($tag=NULL,$type='javascript')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('theme_global_scripts', 'styles');
		}

		$this->comment('<!-- BEGIN THEME GLOBAL SCRIPTS -->');
		$this->get_link_tags($tag,$type);
		$this->comment('<!-- END THEME GLOBAL SCRIPTS -->');

	}

	/**
	 * Method to generate JavaScript and CSS link tags.
	 *
	 * Generates the HTML for JavaScript and CSS
	 *
     * @access  public
	 * @param	mixed	string or an array
     * @return  string Appends CodeIgniter output with properly formated HTML elements
	 */
	public function page_level_scripts($tag=NULL)
	{
		$this->comment('<!-- BEGIN PAGE LEVEL SCRIPTS -->');

		if (is_array($tag))
		{
			foreach ($tag as $value)
			{
				$this->output->append_output(
					script_tag($value)
				);
			}
		} else {
			if (!empty($tag))
			{
				$this->output->append_output(
					script_tag($tag)
				);
			}
		}

		$this->comment('<!-- END PAGE LEVEL SCRIPTS -->');

	}

    /**
     * Method used to include JavaScript files to the HTML document
     * Theme layout scripts for the Metronic template
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function theme_layout_scripts($tag=NULL,$type='javascript')
	{
		// Use config values if nothing is passed to the function
		if (is_null($tag))
		{
			$tag =	$this->config->item('theme_layout_scripts', 'styles');
		}

		$this->comment('<!-- BEGIN THEME LAYOUT SCRIPTS -->');
		$this->get_link_tags($tag,$type);
		$this->comment('<!-- END THEME LAYOUT SCRIPTS -->');

	}



    /**
     * Method used to insert HTML comment & CRLF
     *
     * @access  public
	 * @param	string	HTML Comment to insert
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
     public function comment($string='')
	{
		$crlf = '
';
		$this->output->append_output($string . $crlf);
	}


    /**
     * Method used to end the HTML document
     *
     * @access  public
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */
	public function html_close()
	{	
		$html ='</body>
                </html>';
        $this->output->append_output($html);
	}


    /**
         * Method used to begin the HTML document
         *
         * @access  public
    	 * @param	string $page_lang HTML language attribute
         * @param	string $page_name Title of the HTML document
         * @return  string Appends CodeIgniter output with properly formated HTML elements
         */
    	public function html_begin($data)
    	{
            $description = (isset($data['meta_description'])) ? $data['meta_description'] : '';
            $keywords = (isset($data['meta_keywords'])) ? $data['meta_keywords'] : '';
            
            $html ='<html lang="en">
                <!-- BEGIN HEAD -->
                <head>
                    <meta charset="utf-8" />
                    <title>'.lang('dashboard-title').'</title>
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta content="width=device-width, initial-scale=1" name="viewport" />
                    <meta content="'.$description.'" name="description" />
                    <meta content="'.$keywords.'" name="keywords" />'.PHP_EOL;
                $this->output->append_output($html);
            

    	}	




}
