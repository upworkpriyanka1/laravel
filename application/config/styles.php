<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| Default GLOBAL MANDATORY STYLES
|--------------------------------------------------------------------------
*/
$config['global_mandatory_styles']	=	array(
											'opensans',
											'fontawesome',
											'materializeIcons',
											'simplelineicons',
											'bootstrapmin',
											'uniform',
											'bs_switch',
											'materialize'
										);
/*
|--------------------------------------------------------------------------
| Default THEME GLOBAL STYLES
|--------------------------------------------------------------------------
*/
$config['theme_global_styles']	=	array('componentsmin','pluginsmin');

/*
|--------------------------------------------------------------------------
| Default PAGE LEVEL STYLES
|--------------------------------------------------------------------------
*/
$config['page_level_styles'] = NULL;

/*
|--------------------------------------------------------------------------
| Default THEME LAYOUT STYLES
|--------------------------------------------------------------------------
*/
$config['theme_layout_styles'] =	array(
										'layoutmin',
										'defaultmin',
										'custommin'
									);

/*
|--------------------------------------------------------------------------
| Default IE SCRIPTS
|--------------------------------------------------------------------------
*/
$config['ie9_scripts'] = array('respondmin', 'excanvasmin');

/*
|--------------------------------------------------------------------------
| Default CORE PLUGINS
|--------------------------------------------------------------------------
*/
$config['core_plugins'] = 	array(
								'jquerymin',
								'materialize',
								'bootstrapmin',
								'cookiemin',
								'bs_dropdown_hover',
								'slimscroll',
								'blockui',
								'bs_switch',
//								'uniform',
//								'materialize',
								'jsinit',
								'globaljs'
							);

/*
|--------------------------------------------------------------------------
| Default THEME LAYOUT STYLES
|--------------------------------------------------------------------------
*/
$config['theme_global_scripts'] = 'appmin';

/*
|--------------------------------------------------------------------------
| Default THEME LAYOUT STYLES
|--------------------------------------------------------------------------
*/
$config['theme_layout_scripts'] = 	array(
										'layoutmin'
									);
