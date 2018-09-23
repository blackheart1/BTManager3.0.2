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
** File warned/english.php 2018-09-23 00:00:00 Thor
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
    'ACP_WARNINGS'         => 'Warned Accounts',

    'ACP_WARNINGS_EXPLAIN' => 'Here you can View ALL Users that Currently have Warning\'s Issued against their Account.<br /><br />',

    'NO_ENTRIES'           => 'There are Currently No Warned Users.',
    'USERNAME'             => 'Username',
    'REGISTERED'           => 'Registered',
    'LAST_ACCESS'          => 'Last Access',
    'CLASS_USER'           => 'User Class',
    'DOWNLOADED'           => 'Downloaded',
    'UPLOADED'             => 'Uploaded',
    'U_RATIO'              => 'Ratio',
    'MOD_COMM'             => 'Moderator Comments',
    'SORT_USERNAME'        => 'User Name',
    'SORT_REG_DATE'        => 'Registered Date',
    'SORT_UP'              => 'Uploaded',
    'SORT_DOWN'            => 'Downloaded',
    'SORT_WARN_DATE'       => 'Date Warned',
    'SORT_BY'              => 'Sort by',
    'DISPLAY_WARNED'       => 'Display Entries from previous',
));

?>