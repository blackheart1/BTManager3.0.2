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
** File backend/english.php 2018-09-23 00:00:00 Thor
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
    'RSS_BY_CAT'    => 'Best 10 Torrents for Category %1$s on %2$s\' (Files Feed)',
    'RSS_BY_BEST'   => 'Best 10 Torrents on %1$s\' (Files Feed)',
    'RSS_BY_SEARCH' => 'Results for Search Term %1$s on %2$s\' (Files Feed)',
    'RSS_BY_LAST'   => 'The Latest 10 Torrents on %1$s (Files Feed)',
));

?>