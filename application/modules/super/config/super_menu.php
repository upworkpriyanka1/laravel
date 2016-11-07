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
    "title" =>'users', //should be the same as the lang()
    "sub_1" => array(
    					'href'	=>	'/users-view',
    					'title'	=>	'users-view', //make sure to use dash
    					'icon'	=>	'fa fa-folder-open'
    					),
    "sub_2" => array(
    					'href'	=>	'/users-add', //make sure to use dash
    					'title'	=>	'users-add',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
    					)
    );
    $config['menu_2'] = array(
        "icon" => "fa fa-book",
        "title" =>'contacts', //should be the same as the lang()
        "sub_1" => array(
            'href'	=>	'/contacts-view', //make sure to use dash
            'title'	=>	'contacts-view',//should be the same as the lang()
            'icon'	=>	'fa fa-folder-open'
        ),
        "sub_2" => array(
            'href'	=>	'/contacts-add', //make sure to use dash
            'title'	=>	'contacts-add',//should be the same as the lang()
            'icon'	=>	'fa fa-plus'
            )
        );
    $config['menu_3'] = array(
        "icon" => "fa fa-book",
        "title" =>'profile', //should be the same as the lang()
        "sub_1" => array(
        					'href'	=>	'/profile',
        					'title'	=>	'my-profile', //make sure to use dash
        					'icon'	=>	'fa fa-pencil-square'
        					),
        "sub_2" => array(
        					'href'	=>	'/profile-company', //make sure to use dash
        					'title'	=>	'my-company',//should be the same as the lang()
        					'icon'	=>	'fa fa-pencil-square'
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




