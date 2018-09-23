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
** File whos_online/english.php 2018-09-23 00:00:00 Thor
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
    'VIEWING_THREAD' => 'Viewing Thread<br /><strong>%s</strong>',
    'VIEWING_FORUM'  => 'Viewing Forum<br /><strong>%s</strong>',
    'VIEWING_ERROR'  => 'Viewing Error Message',
    'VIEWING_FORUM'  => 'Viewing Forum Index',
    'CREATING_TOPIC' => 'Creating New Topic in<br /><strong>%s</strong>',
    'REPLYING_TO'    => 'Replying to<br /><strong>%s</strong>',
    'EDITING_POST'   => 'Modifying Post<br /><strong>%s</strong>',
    'WHOS_ON_LINE'   => 'Who\'s Online?',
    'LEGEND'         => 'Legend: ',
    'USERNAME'       => 'Username: ',
    'MOST_CLIENT'    => 'Most Used Client: ',
    'TOTAL_LEECHERS' => 'Total Leechers: ',
    'TOTAL_SEEDERS'  => 'Total Seeders: ',
    'TOTAL_SPEED'    => 'Total Transfer Speed: ',
    'TOTAL_PEERS'    => 'Total Peers: ',
    'TOTAL_SHARED'   => 'Total Shared Data: ',
    'TOTAL_TORRENTS' => 'Total Torrents: ',
    'TOTAL_USERS'    => 'Total Registered Users: ',
    'TOTAL_REG_24'   => 'Total Registered Users in Last 24 Hours: ',
    'TOTAL_REG_7D'   => 'Total Registered Users in Last 7 Days: ',
    'ONLINE_24HRS'   => 'Total Users Online in Last 24 Hours: ',
    'STAT1'          => 'In Total there are',
    'STAT2'          => 'User\'s Online (Based on User\'s Active in the Last 5 Minutes)',
    'MOST_EVER_ON'   => 'Most User\'s Ever Online was',
));

?>