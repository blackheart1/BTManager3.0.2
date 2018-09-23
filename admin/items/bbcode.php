<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File items/bbcode.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

if($auth->acl_get('a_bbcode'))
{
    adminentry("bbcode","bbcode",$user->lang['MENU_BBCODES'],"siteinfo","mod");
    $op_keys = explode(",","bbcode,delete_bbcode,clear_bbcode,new_bbcode,edit_bbcode");
}

?>