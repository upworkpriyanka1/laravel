<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';

$route['404_override'] = '';

$route['translate_uri_dashes'] = TRUE;







$route['activation/(.+)'] = 'sys-admin/main/activation/$1';

$route['forgotten_password/(.+)'] = 'sys-admin/main/forgotten_password/$1'; 

$route['newUserDetails/(.+)'] = 'sys-admin/main/newUserDetails/$1';

