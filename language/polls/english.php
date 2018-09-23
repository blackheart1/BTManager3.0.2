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
** File polls/english.php 2018-09-23 00:00:00 Thor
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
    'POLL_OVER_VIEW'      => 'Poll Overview',
    'POLL_QUESTION'       => 'Poll Questions',
    'POLL_ANSWERS'        => 'Poll Answers',
    'POLL_OPTION_NUM'     => 'Poll Option Number',
    'POLL_USER_OVER_VIEW' => 'Poll User Overview',
    'SELECTION'           => 'Selected',
    'POLL_REMOVED'        => 'Poll was Successfully Removed',
    'ANSWERS'             => 'Answers',
    'POLL_DELETE'         => 'Are you sure you wish to Delete this Poll?',
    'ERROR_NO_POLLS'      => 'There are No Polls!',
    'POLL_OVERVIEW_INFO'  => 'Click on either the Poll ID or the Poll Question to see Who Voted!!',
));

?>