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
** File reseed/english.php 2018-09-23 00:00:00 Thor
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
    'RESEED_REQ'       => 'Reseed Request',
    'ALREAD_REQUISTED' => 'You have recently made a Request for this Re-Seed.  Please wait a little longer for another Request.',
    'ALREADY_SEEDED'   => 'NO need for this Request as it already has <strong>%1$s</strong> Seeder on this Torrent',
    'RESEED_REQ_SENT'  => 'Your Request for a Re-Seed has been Sent to Members that have Completed this Torrent: <br />%1$s',

    'RESEED_PM'        => '%1$s has Requested a Re-Seed on the %2$s because there are currently Few or NO SEEDERS: <br />Click Here for more on this File %3$s',

    'THANK_YOU'        => 'Thank You!',
));

?>