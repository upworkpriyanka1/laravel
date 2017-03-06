<?php

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
//define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
// Just some testing of the branch.
$domain = ! empty($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : 'cli';
if (strpos( $domain,'.nix') !==FALSE || strpos( $domain,'naz.') !==FALSE || strpos( $domain,'.dev') !==FALSE || $domain === 'cli')//if local or dev
	define('ENVIRONMENT', 'development');
else if (strpos ($domain,'dev2') !==FALSE)
        define('ENVIRONMENT', 'dev2');
else if (strpos ($domain,'dev4') !==FALSE)
	define('ENVIRONMENT', 'dev4');
else if (strpos ($domain,'dev4b') !==FALSE)
	define('ENVIRONMENT', 'dev4b');
else if (strpos ($domain,'dev5') !==FALSE)
	define('ENVIRONMENT', 'dev5');
else if (strpos ($domain,'devk') !==FALSE)
	define('ENVIRONMENT', 'devK');
else
	define('ENVIRONMENT', 'production');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT)
{
	case 'development':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
	break;
	case 'dev2':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
	break;
	case 'dev4':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
		break;
	case 'devK':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
		break;
	case 'dev4b':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
		break;
	case 'dev5':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
		break;

	case 'prince':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
	break;
	case 'sanjeev':
		//Report all errors
		//error_reporting(-1);
		//Report only errors and warning. Do not show uninitialized variables because it can break the normal functioning.
		error_reporting(E_ERROR | E_WARNING);
		ini_set('display_errors', 1);
	break;


	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
		break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
$system_path = 'system';
$application_folder = 'application';

/*
 * NO TRAILING SLASH!
 */
$view_folder = '';

// Set the current directory correctly for CLI requests
if (defined('STDIN'))
{
	chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== FALSE)
{
	$system_path = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	// Ensure there's a trailing slash
	$system_path = strtr(
			rtrim($system_path, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		).DIRECTORY_SEPARATOR;
}

// Is the system path correct?
if ( ! is_dir($system_path))
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
	exit(3); // EXIT_CONFIG
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system directory
define('BASEPATH', $system_path);

// Path to the front controller (this file) directory
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Name of the "system" directory
define('SYSDIR', basename(BASEPATH));

// The path to the "application" directory
if (is_dir($application_folder))
{
	if (($_temp = realpath($application_folder)) !== FALSE)
	{
		$application_folder = $_temp;
	}
	else
	{
		$application_folder = strtr(
			rtrim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
}
elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
{
	$application_folder = BASEPATH.strtr(
			trim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
}
else
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
	exit(3); // EXIT_CONFIG
}

define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

// The path to the "views" directory
if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
{
	$view_folder = APPPATH.'views';
}
elseif (is_dir($view_folder))
{
	if (($_temp = realpath($view_folder)) !== FALSE)
	{
		$view_folder = $_temp;
	}
	else
	{
		$view_folder = strtr(
			rtrim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
}
elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
{
	$view_folder = APPPATH.strtr(
			trim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
}
else
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
	exit(3); // EXIT_CONFIG
}

define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
