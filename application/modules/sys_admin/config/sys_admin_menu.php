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
    					'href'	=>	'/clients-view',
    					'title'	=>	'clients-view', //make sure to use dash
    					'icon'	=>	'fa fa-folder-open'
    					),
    "sub_2" => array(
    					'href'	=>	'/clients-add', //make sure to use dash
    					'title'	=>	'clients-add',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
                    ),
    "sub_3" => array(
    					'href'	=>	'/clients-type', //make sure to use dash
    					'title'	=>	'clients-type',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
    					)
    );


$config['menu_2'] = array(
    "icon" => "fa fa-user",
    "title" =>'users', //should be the same as the lang()
    "sub_1" => array(
    					'href'	=>	'/users-view',
    					'title'	=>	'users-view', //make sure to use dash
    					'icon'	=>	'fa fa-user'
    					),
    "sub_2" => array(
    					'href'	=>	'/users-add', //make sure to use dash
    					'title'	=>	'users-add',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
                    ),
    "sub_3" => array(
    					'href'	=>	'/users-role', //make sure to use dash
    					'title'	=>	'users-role',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
                    ),
    "sub_4" => array(
    					'href'	=>	'/users-jobs', //make sure to use dash
    					'title'	=>	'users-jobs',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
    					)
    );

$config['menu_3'] = array(
    "icon" => "fa fa-book",
    "title" =>'contacts', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'/contact-type', //make sure to use dash
        'title'	=>	'contact-type',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
        )
    );

$config['menu_4'] = array(
    "icon" => "fa fa-book",
    "title" =>'activity', //should be the same as the lang()
    "sub_1" => array(
    					'href'	=>	'/activity-logs', //make sure to use dash
    					'title'	=>	'activity-logs',//should be the same as the lang()
    					'icon'	=>	'fa fa-bars'
    					)
    );
