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
** File items/forum.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

if ($auth->acl_get('a_forum'))
{
    adminentry("forum","forum",$user->lang['MENU_FORUM'],"siteinfo","admin");
    $op_keys = explode(",","forum,setting_forum_local,setting_mod_local,setting_forum_conf,forum_pruning,forum_permissions,setting_group_local,setting_user_local,forum_words,forum_search");
}

?>