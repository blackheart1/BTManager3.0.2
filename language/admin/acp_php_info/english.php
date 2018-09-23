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
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File php_info/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'ACP_PHP_INFO_EXPLAIN' => 'This Page Lists Information on the Version of php Installed on this Server.  It Includes Details of Loaded Modules, Available Variables and Default Settings.  This Information maybe useful when Diagnosing Problems.  Please be aware that some Hosting Companies will Limit what Information is Displayed here for Security Reasons.  You are Advised to NOT give out any Details on this Page Except when asked by <a href="http://www.phpbb.com/about/team/">Official Team Members</a> on the Support Forums.<br /><br />',

    'NO_PHPINFO_AVAILABLE' => 'Information about your php Configuration is Unable to be determined. phpinfo() has been Disabled for Security Reasons.',

    'ACP_PHP_INFO'         => 'php Information',
));

?>