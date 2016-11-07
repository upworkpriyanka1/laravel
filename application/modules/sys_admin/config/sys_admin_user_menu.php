<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*********************
* Menu Multidimensiona Array
* params menu, icon, title, array(href,title,icon)
* href should be the same as title, which should be defined in language file
* href,title seperated with dash(-) and not underscore
******************/
$config['user_1'] = array(
    "icon" => "fa fa-book",
    "title" =>'clients', //should be the same as the lang()
    "sub_1" => array(
    					'href'	=>	'/users-edit',
    					'title'	=>	'users-edit', //make sure to use dash
    					'icon'	=>	'fa fa-folder-open'
    					),
    "sub_2" => array(
    					'href'	=>	'/users-email', //make sure to use dash
    					'title'	=>	'clients-add',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
                    ),
    "sub_3" => array(
    					'href'	=>	'/clients-type', //make sure to use dash
    					'title'	=>	'clients-type',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
    					)
    );
