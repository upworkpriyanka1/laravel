<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Libraryused to create common HTML elements that 
 * are regularaly used and modular elements with the template style.
 *
 * Full List of the functions:
 *
 * amcharts, autosize, backstretch, blockui, bootbox, bootpad, 
 * bootstrap_confirmation, bootstrap_context, bootstrap_growl, 
 * bootstrap_select, bootstrap_tagsinput, bootstraptimepicker, 
 * bs-dropdown-hover, ckeditor, clockfacetimepicker, colorpicker, cookie, 
 * countdown, datatables, datepaginator, datepicker, daterangepicker, 
 * datetimepicker, dropzonejs, easy_pie_chart, fancybox, fileinput, 
 * fileupload, flot, flowchart, fontawesome, fullcalendar, gmaps, icheck, 
 * idle-timeout, ip_address, jcrop, jquery_jstree, jquery_notific8, 
 * jquery_typeahead, jqvmap, markdown, mask, maxlength, minicolors, modal, 
 * multiselect, nestable, nouislider, opensans, pace, materializeIcons, pulsate, select2, 
 * selectsplitter, session-timeout, simplelineicons, slimscroll, socicon, 
 * sparklines, summer, switch, tabdrop, tagsinput, taostr, touchspin, 
 * uisortable, uniform, validation, wizard, wysiwyg5, xeditable, materialize, jsinit
 */
class Metronic extends CI_Driver_Library {

	public $valid_drivers;
	public $CI;
    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('html');
        $this->valid_drivers = array(
        	'socicon', 
        	'fancybox', 
        	'opensans', 
        	'fontawesome', 
        	'materializeIcons',
        	'simplelineicons',
        	'bootstrapmin',
        	'uniform',
        	'bs_switch',
        	'componentsmin',
        	'pluginsmin',
        	'layoutmin',
        	'defaultmin',
        	'custommin',
        	'respondmin',
        	'excanvasmin',
        	'jquerymin',
        	'cookiemin',
        	'bs_dropdown_hover',
        	'slimscroll',
        	'blockui',
        	'appmin',
        	'quicksidebar',
        	'validation',
        	'nestable',
        	'dropzonejs',
        	'jqvmap',
        	'morris',
        	'fullcalendar',
        	'gmaps',
        	'flot',
        	'fileupload',
        	'fileinput',
        	'datatables',
        	'datepicker',
        	'daterangepicker',
        	'bootstraptimepicker',
        	'datetimepicker',
			'timepicker', //added for survey
        	'nouislider',
        	'select2',
        	'bootstraptable',
        	'wizard',
        	'gantt',
			'login',
			'materialize',
			'jsinit',
			'globaljs'
        );
        
	}
	
    /**
     * Magic Method
     *
     *  __call() is triggered when invoking inaccessible methods in an object 
     * context.
     *
     * @access  public
     * @param	string $name of the method being called.
	 * @param	array $arguments passed to the $name'ed method. 
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */	
	public function __call($name, $arguments)
	{
		// Double call to reach driver function with the same name.
		// Magic method passes $arguments as array
		//  use $arguments[0] to pass first item.
		$this->{$name}->{$name}($arguments[0]);
	}
	
// **************************
//  END END END END
// **************************
// All items below should be moved



	public function login3($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/pages/css/login-3.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/pages/scripts/login.min.js')
			);
		}
	
	}
	
	public function echarts($type=NULL)
	{
		// No CSS available
		
		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/echarts/echarts.js')
			);
		}
	
	}

    /**
     * jQuery Sparklines
     *
     * This jQuery plugin generates sparklines (small inline charts) directly
     * in the browser using data supplied either inline in the HTML, or via 
     * javascript.
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */		
	public function sparklines($type=NULL)
	{
		// No CSS available
		
		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery.sparkline.min.js')
			);
		}
	
	}

    /**
     * Twitter Typeahead
     *
     * A fast and fully-featured autocomplete library.
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */		
	public function jquery_typeahead($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/typeahead/typeahead.css')
			);
		}
		
		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/typeahead/handlebars.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/typeahead/typeahead.bundle.min.js')
			);
		}
	
	}

    /**
     * Autosize
     *
     * A small, stand-alone script to automatically adjust textarea height.
     *
     * @access  public
	 * @param	string $type of tag to use / css or javascript
     * @return  string Appends CodeIgniter output with properly formated HTML elements
     */		
	public function autosize($type=NULL)
	{
		// No CSS available
		
		// JavaScript File(s)
		if ($type == 'javascript') {
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/autosize/autosize.min.js')
			);
		}
	
	}

	/** 
	* Bootstrap Tagsinput
	*
	* Bootstrap Tags Input is a jQuery plugin providing a Twitter Bootstrap user 
	* interface for managing tags.
	*
	* @access  public
	* @param	string $type of tag to use / css or javascript
	* @return  string Appends CodeIgniter output with properly formated HTML elements
	*/

	public function bootstrap_tagsinput($type=NULL)
		{
			// No  CSS available

			// JavaScript File(s)
			if ($type == 'javascript') {

			// Keep the function easier to read, avoid text wrapping
			$prefix = 'assets/global/plugins/bootstrap-tagsinput/';
						
				$this->CI->output->append_output(
					link_tag($prefix . 'bootstrap-tagsinput.min.js')
				);
			}
		}

	/** 
	* Flow Chart
	*
	* BDraws simple SVG flow chart diagrams from textual representation of the diagram.
	*
	* @access  public
	* @param	string $type of tag to use / css or javascript
	* @return  string Appends CodeIgniter output with properly formated HTML elements
	*/

	public function flowchart($type=NULL)
		{
			// No  CSS available

			// JavaScript File(s)
			if ($type == 'javascript') {
				$this->CI->output->append_output(
					link_tag('assets/global/plugins/flowchart/flowchart.min.js')
				);
			}
		}
	    
	/** 
	*
	* Bootstrap Growl
	*
	* Pretty simple jQuery plugin that turns standard Bootstrap alerts into 
	* "Growl-like" notifications.
	*
	* @access  public
	* @param	string $type of tag to use / css or javascript
	* @return  string Appends CodeIgniter output with properly formated HTML elements
	*/

	public function bootstrap_growl($type=NULL)
		{
			// No  CSS available

			// JavaScript File(s)
			if ($type == 'javascript') {
				$this->CI->output->append_output(
					link_tag('assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js')
				);
			}
		}


	/** 
	* Bootstrap Tabdrop
	*
	* Very usefull script when your tabs do not fit in a single row. This script 
	* takes the not fitting tabs and makes a new dropdown tab. In the dropdown 
	* there are all the tabs that do not fit.
	*
	* @access  public
	* @param	string $type of tag to use / css or javascript
	* @return  string Appends CodeIgniter output with properly formated HTML elements
	*/

	public function tabdrop($type=NULL)
		{
			// No  CSS available

			// JavaScript File(s)
			if ($type == 'javascript') {
				$this->CI->output->append_output(
					link_tag('assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')
				);
			}
		}

	/**
	* jQuery MiniColors
    *
    * A tiny color picker built on jQuery
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function minicolors($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-minicolors/jquery.minicolors.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Select Splitter
    *
    * Transforms SELECT containing one or more OPTGROUP in two chained SELECT.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function selectsplitter($type=NULL)
	{
		// No CSS available
		
		// JavaScript File(s)
		if ($type == 'javascript') {
			
			// Keep the function easier to read, avoid text wrapping
			$prefix = 'assets/global/plugins/bootstrap-selectsplitter/';
			
			$this->CI->output->append_output(
				script_tag($prefix . 'bootstrap-selectsplitter.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Confirmation
    *
    * Bootstrap plugin for on-place confirm boxes using Popover.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function bootstrap_confirmation($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Context Menu
    *
    * Context menu plugin for Twitter's Bootstrap framework
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function bootstrap_context($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-contextmenu/bootstrap-contextmenu.js')
			);
		}
	
	}

	/**
	* amcharts
    *
    * Charting library & maps. Where all data goes visual
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function amcharts($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/amcharts/amcharts.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/amcharts/serial.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/amcharts/pie.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/amcharts/radar.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/amcharts/themes/light.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/ammap/ammap.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/amcharts/amstockcharts/amstock.js')
			);
		}
	
	}

	/**
	* iCheck
    *
    * A SUPER CUSTOMIZED CHECKBOXES AND RADIO BUTTONS FOR JQUERY & ZEPTO
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function icheck($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/icheck/skins/all.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/icheck/icheck.min.js')
			);
		}
	
	}

	/**
	* Bootstrap TouchSpin
    *
    * A mobile and touch friendly input spinner component for Bootstrap 3. It supports the 
    * mousewheel and the up/down keys.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function touchspin($type=NULL)
	{
		// No CSS Available
		
		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js')
			);
		}
	
	}

	/**
	* Bootstrap Date Paginator
    *
    * A jQuery plugin which takes Twitter Bootstrap's already great pagination component and injects a 
    * bit of date based magic. In the process creating a hugely simplified and modularised way of paging 
    * date based results in your application.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function datepaginator($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-datepicker/css/datepicker.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/moment.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-datepaginator/bootstrap-datepaginator.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Summernote
    *
    * Super Simple WYSIWYG Editor for Bootstrap 3. Summernote is a javascript program that helps 
    * you to create WYSIWYG Editor on web.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function summer($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-summernote/summernote.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-summernote/summernote.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Select
    *
    * A custom select for @twitter Bootstrap using button dropdown.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function bootstrap_select($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')
			);
		}
	
	}



	/**
	* Bootstrap Session Timeout
    *
    * After a set amount of time, a dialog is shown to the user with the option to either log out now, 
    * or stay connected. If log out now is selected, the page is redirected to a logout URL. If stay 
    * connected is selected, a keep-alive URL is requested through AJAX. If no options is selected after 
    * another set amount of time, the page is automatically redirected to a timeout URL.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function session_timeout($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-sessiontimeout/jquery.sessionTimeout.min.js')
			);
		}
	
	}

	/**
	* jQuery Idle Timeout
    *
    * This script allows you to detect when a user becomes idle (detection provided by Paul Irish's idletimer plugin) 
    * and notify the user his/her session is about to expire. Similar to the technique seen on Mint.com. Polling requests 
    * are automatically sent to the server at a configurable interval, maintaining the users session while s/he is using 
    * your application for long periods of time.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function idle_timeout($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js')
			);
		}
	
	}

	/**
	* Bootbox.js
    *
    * Bootbox.js is a small JavaScript library which allows you to create programmatic dialog boxes using 
    * Twitter’s Bootstrap modals, without having to worry about creating, managing or removing any of the 
    * required DOM elements or JS event handlers.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function bootbox($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootbox/bootbox.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Toastr Notifications
    *
    * Toastr is a Javascript library for non-blocking notifications. jQuery is required. The goal 
    * is to create a simple core library that can be customized and extended.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function taostr($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-toastr/toastr.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-toastr/toastr.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Markdown
    *
    * Markdown editing for Bootstrap.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function markdown($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')
			);
		}
	
	}


	/**
	* Bootstrap Maxlength
    *
    * This plugin integrates by default with Twitter bootstrap using badges to display the maximum length 
    * of the field where the user is inserting text. This plugin uses the HTML5 attribute "maxlength" to work.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function maxlength($type=NULL)
	{
		// No CSS Available
		
		// JavaScript File(s)
		if ($type == 'javascript') {			
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')
			);
		}
	
	}



	/**
	* X-Editable
    *
    * In-place editing with Twitter Bootstrap.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function xeditable($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {

			// X-EDITABLE PLUGIN
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {
			// PLUGINS USED BY X-EDITABLE

			// X-EDITABLE PLUGIN
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js')
			);
			$this->CI->output->append_output(
				script_tag('/assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js')
			);
		}

	}

	/**
	* Bootstrap Extended Modals
    *
    * Responsive, Stackable, AJAX and more.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function modal($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')
			);
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')
			);
		}
	
	}

	/**
	* Bootstrap WYSIWYG5
    *
    * Simple WYSIWYG Editor for Bootstrap.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function wysiwyg5($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')
			);
		}
	
	}



	/**
	* Colorpicker for Bootstrap
    *
    * Add color picker to field or to any other element.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function colorpicker($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')
			);
		}
	
	}





	/**
	* Clockface Timepicker
    *
    * Clockface is a simple timepicker for Twitter Bootstrap
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function clockfacetimepicker($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/clockface/css/clockface.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/clockface/js/clockface.js')
			);
		}
	
	}

	/**
	* jQuery Bootpad for Bootstrap
    *
    * Dynamic pagination jQuery plugin. Works well with twitter bootstrap or standalone.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function bootpad($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery.bootpag.min.js')
			);
		}
	
	}

	/**
	* Pace - Page Progress Bar
    *
    * An automatic web page progress bar. Pace will automatically monitor your Ajax requests, 
    * event loop lag, document ready state and elements on your page to decide on the progress. 
    * For more info check the plugin documentation.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function pace($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/pace/themes/pace-theme-flash.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/pace/pace.min.js')
			);
		}
	
	}

	/**
	* jQuery Notific8
    *
    * jQuery Notific8 is a notification plug-in that was inspired by the notification style introduced in Windows 8. 
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function jquery_notific8($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-notific8/jquery.notific8.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-notific8/jquery.notific8.min.js')
			);
		}
	
	}

	/**
	* jQuery jsTree
    *
    * A tree view plugin for jQuery.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function jquery_jstree($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jstree/dist/themes/default/style.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jstree/dist/jstree.min.js')
			);
		}
	
	}


	/**
	* jQuery jCrop
    *
    * Jcrop is the quick and easy way to add image cropping functionality to your web application.
    * It combines the ease-of-use of a typical jQuery plugin with a powerful cross-platform DHTML 
    * cropping engine that is faithful to familiar desktop graphics applications. 
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function jcrop($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jcrop/css/jquery.Jcrop.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jcrop/js/jquery.color.js')
			);
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jcrop/js/jquery.Jcrop.min.js')
			);
		}
	
	}

	/**
	* jQuery Input Mask
    *
    * jQuery Input Mask is a jquery plugin which create an input mask. An inputmask helps 
    * the user with the input by ensuring a predefined format. This can be usefull for 
    * dates, numerics, phone numbers. 
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function mask($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')
			);
		}
	
	}

	/**
	* jQuery Multi Select
    *
    * This plugin is a drop-in replacement for the standard select element with multiple attribute activated.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function multiselect($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-multi-select/css/multi-select.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')
			);
		}
	
	}

	/**
	* jQuery Easy Pie Chart
    *
    * Lightweight jQuery plugin to render and animate nice pie charts with the HTML5 canvas element.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function easy_pie_chart($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.js')
			);
		}
	
	}

	/**
	* jQuery Input IP Address Control
    *
    * During user input field, this plugin controls the format of IPv4 or IPv6 addresses.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function ip_address($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery.input-ip-address-control-1.0.min.js')
			);
		}
	
	}

	/**
	* jQuery Backstretch
    *
    * DA simple jQuery plugin that allows you to add a dynamically-resized, slideshow-capable background image to any page or element.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function backstretch($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/backstretch/jquery.backstretch.min.js')
			);
		}
	
	}

	/**
	* jQuery Countdown
    *
    * A jQuery plugin that sets a div or span to show a countdown to a given time.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function countdown($type=NULL)
	{
		// No CSS Available

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/countdown/jquery.countdown.js')
			);
		}
	
	}



	/**
	* jQuery UI Sortable
    *
    * Enable a group of DOM elements to be sortable. Click on and drag an element to a new spot within the list,
    * and the other items will adjust to fit. By default, sortable items share draggable properties.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function uisortable($type=NULL)
	{
		// CSS File(s)
		if ($type == 'css') {
			$this->CI->output->append_output(
				link_tag('assets/global/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css')
			);
		}

		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js')
			);
		}
	
	}



	/**
	* jQuery Cookie
    *
    * A simple, lightweight jQuery plugin for reading, writing and deleting cookies.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function cookie($type=NULL)
	{
		// No CSS Available
		
		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/js/jquery.cookie.js')
			);
		}
	
	}

	/**
	* jQuery Pulsate
    *
    * jQuery Pulsate provides animated pulsating effect that's useful for focussing 
    * attention to a certain part of your webpage in a subtle way.
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function pulsate($type=NULL)
	{
		// No CSS Available
		
		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/js/jquery.pulsate.min.js')
			);
		}
	
	}

	/**
	* Bootstrap Tagsinput
    *
    * Bootstrap Tags Input is a jQuery plugin providing a Twitter Bootstrap user interface for managing tags. 
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function tagsinput($type=NULL)
	{
		// No CSS Available
		
		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/js/jquery.pulsate.min.js')
			);
		}
	
	}

	/**
	* CKEditor
    *
    * CKEditor is a ready-for-use HTML text editor designed to simplify web content creation
    *
    * @access public
	* @param string $type of tag to use / css or javascript
    * @return  string Appends CodeIgniter output with properly formated HTML elements
    */		
	public function ckeditor($type=NULL)
	{
		// No CSS Available
		
		// JavaScript File(s)
		if ($type == 'javascript') {		
			$this->CI->output->append_output(
				script_tag('assets/global/plugins/ckeditor/ckeditor.js')
			);
		}
	
	}

	
}