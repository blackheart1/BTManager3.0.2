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
** File download/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ('Error 404 - Page Not Found');
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'AUTH_REQ_MAIL_SUB' => 'Download Request on %1$s',
    'MAIL_NEWSEEDER'    => 'New Seed on %1$s',

    'ACCOUNT_PARKED'    => 'This Account has been Parked!  If you are the Owner of this Account please Disable "Account Parked" in User > Edit > Board Preferences',

    'ACCOUNT_DISABLED'  => 'This Account has been Disabled for %1$s',
));

?>