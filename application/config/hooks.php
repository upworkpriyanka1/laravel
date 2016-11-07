<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
/* Define the Set_timezone hook , see application/hooks
 * @params, UTC
 */
$hook['pre_system'] = array(
	'class'    => 'Set_timezone',
    'function' => 'Set_DefaulT_Timezone',
    'filename' => 'Set_timezone.php',
    'filepath' => 'hooks'
);

/* Log user actions
 * @params, session
 */
$hook['post_controller'] = array(
    'class'    => 'Logging',
    'function' => 'log_activity',
    'filename' => 'Logging.php',
    'filepath' => 'hooks'
);
