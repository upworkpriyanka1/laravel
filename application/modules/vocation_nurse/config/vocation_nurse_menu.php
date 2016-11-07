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
    "title" =>'patients', //should be the same as the lang()
    "sub_1" => array(
    					'href'	=>	'/patients-view',
    					'title'	=>	'patients-view', //make sure to use dash
    					'icon'	=>	'fa fa-folder-open'
    					),
    "sub_2" => array(
    					'href'	=>	'/patients-add', //make sure to use dash
    					'title'	=>	'patients-add',//should be the same as the lang()
    					'icon'	=>	'fa fa-plus'
    					)
    );




