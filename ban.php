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
** File ban.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_BTM",true);
                header("HTTP/1.0 401 Access Denied");
require_once("common.php");
$template = new Template();
set_site_var($user->lang['BANNED']);
$reson  = request_var('reson', '');
if($reson == '')$reson = $user->lang['UNKNOWN'];
$template->assign_vars(array(
        'S_FOR'            => sprintf($user->lang['BANNED_FOR'],strip_tags($reson)),
));
echo $template->fetch('banned.html');
$db->sql_close();

?>