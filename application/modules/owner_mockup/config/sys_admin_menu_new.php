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
    "title" =>'locations', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'owner-mockup/#', 
        'title'	=>	'clients-add',//should be the same as the lang()
        'icon'	=>	'fa fa-plus',
		'data-toggle' => 'modal',
		'data-target' => '#new_user_modal1'	
    ),
    "sub_2" => array(
        'href'	=>	'owner-mockup/locations-list/',
        'title'	=>	'locations-view', //make sure to use dash
        'icon'	=>	'fa fa-folder-open'
    ),	
);


$config['menu_2'] = array(
    "icon" => "fa fa-user",
    "title" =>'residents', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'owner-mockup/#', 
        'title'	=>	'users-add',//should be the same as the lang()
        'icon'	=>	'fa fa-plus',
		'data-toggle' => 'modal',
		'data-target' => '#new_owner_resident'
    ),
    "sub_2" => array(
        'href'	=>	'owner-mockup/#',
        'title'	=>	'users-view', //make sure to use dash
        'icon'	=>	'fa fa-user'
    ), 

);
$config['menu_3'] = array(
    "icon" => "fa fa-user",
    "title" =>'contacts', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'owner-mockup/#', //make sure to use dash
        'title'	=>	'contacts-add',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
    ),
    "sub_2" => array(
        'href'	=>	'owner-mockup/contacts-list/',
        'title'	=>	'contacts-view', //make sure to use dash
        'icon'	=>	'fa fa-user'
    ), 

);
$config['menu_4'] = array(
    "icon" => "fa fa-user",
    "title" =>'profile', //should be the same as the lang()
    "sub_1" => array(
        'href'	=>	'owner-mockup/#', //make sure to use dash
        'title'	=>	'profile-my',//should be the same as the lang()
        'icon'	=>	'fa fa-plus'
    ),
    "sub_2" => array(
        'href'	=>	'owner-mockup/#',
        'title'	=>	'settings', //make sure to use dash
        'icon'	=>	'fa fa-user'
    ),
	"sub_3" => array(
        'href'	=>	'owner-mockup/#',
        'title'	=>	'logout', //make sure to use dash
        'icon'	=>	'fa fa-sign-out'
    ), 

);
