<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*********************
 * Menu Multidimensiona Array
 * params menu, icon, title, array(href,title,icon)
 * href should be the same as title, which should be defined in language file
 * href,title seperated with dash(-) and not underscore
 ******************/
$config['menu_1'] = array(
    "icon" => "fa fa-book",
    "title" =>'clients', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'/client/new/', //make sure to use dash
        'title'	=>	'clients-add',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
    ),
    "sub_2" => array(
        'href'	=>	'/clients-view',
        'title'	=>	'clients-view', //make sure to use dash
        'icon'	=>	'fa fa-folder-open'
    ),
	"sub_3" => array(
        'href'	=>	'/clients-type',
        'title'	=>	'clients-type', //make sure to use dash
        'icon'	=>	'fa fa-plus'
    ),
);


$config['menu_2'] = array(
    "icon" => "fa fa-user",
    "title" =>'users', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'/users/users-edit/new/', //make sure to use dash
        'title'	=>	'users-add',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
    ),
    "sub_2" => array(
        'href'	=>	'/users/users-view',
        'title'	=>	'users-view', //make sure to use dash
        'icon'	=>	'fa fa-user'
    ),
    "sub_3" => array(
        'href'	=>	'/users-role', //make sure to use dash
        'title'	=>	'users-role',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
    ),

);
$config['menu_3'] = array(
    "icon" => "fa fa-book",
    "title" =>'patients', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'/patients/patients-view', //make sure to use dash
        'title'	=>	'patients-view',//should be the same as the lang()
        'icon'	=>	'fa fa-user'
    )
);



$config['menu_4'] = array(
    "icon" => "fa fa-wheelchair",
    "title" =>'vendors', //should be the same as the lang()


    "sub_1" => array(
        'href'	=>	'/vendors/vendors-edit/new/', //make sure to use dash
        'title'	=>	'vendors-add',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
    ),
    "sub_2" => array(
        'href'	=>	'/vendors/vendors-view', //make sure to use dash
        'title'	=>	'vendor-view',//should be the same as the lang()
        'icon'	=>	'fa fa-wheelchair'
    ),


);
$config['menu_5'] = array(
    "icon" => "fa fa-book",
    "title" =>'locations', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'/locations-edit/new/', //make sure to use dash
        'title'	=>	'locations-add',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
    ),
    "sub_2" => array(
        'href'	=>	'/locations-view',
        'title'	=>	'locations-view', //make sure to use dash
        'icon'	=>	'fa fa-folder-open'
    ), "sub_3" => array(
        'href'	=>	'/locations-types',
        'title'	=>	'locations-types', //make sure to use dash
        'icon'	=>	'fa fa-plus'
    ),

);