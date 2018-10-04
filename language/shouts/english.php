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
** File shouts/english.php 2018-09-23 00:00:00 Thor
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
    'SHOUT_COMAND_HELP_USER' => '[quote]<strong>As a User, you have the following Commands:</strong>
        If you want to View this Message in the Shoutbox Use:- <strong>/help</strong>
        If you want to Slap a User Use:- <strong>/slapuser</strong> Username
        If you want to Send a Quick Private Message Use:- <strong>/pmuser</strong> Username or ID Plus the Message
        If you want to Speak as a 3rd Person Use:- <strong>/me</strong> Message[/quote]',

    'SHOUT_COMAND_HELP_ADMIN' => '[quote]<strong>As a Staff Member, you have the following Commands:</strong>
        If you want to Delete or Edit a Shout, you need to <strong>Double Click</strong> on the relevant Icon
        If you want to make a Notice use:- <strong>/notice</strong>
        If you want to Empty Shouts use:- <strong>/empty</strong>
        If you want to Warn or Unwarn a User use:- <strong>/warn</strong> Username <strong>/unwarn</strong> Username
        If you want to Ban(Disable) or Unban(Enable) a User use:- <strong>/ban</strong> Username <strong>/unban</strong> Username
        If you want to Delete ALL Notices use:- <strong>/deletenotice</strong>
        If you want to Slap a User use:- <strong>/slapuser</strong> Username
        If you want to Send a Quick Private Message use:- <strong>/pmuser</strong> Username or ID + Message
        If you want to Speak as a 3rd Person use:- <strong>/me</strong> Message[/quote]',

    'NO_SHOUTS'           => 'NO Shouts at this Time!',
    'SHOUTBOX_ARCHIVE'    => 'Shoutbox Archive',
    'TOTAL_SHOUTS_POSTED' => 'Total Shouts Posted',
    'SHOUTS_IN_TWFOUR'    => 'Shouts in Past 24 Hours',
    'YOUR_SHOUTS'         => 'Your Shouts',
    'TOPFIFTEEN_SHOUTERS' => 'Top 15 Shouters',
    'SORT_BY'             => 'Sort Results by',
    'NEW_FIRST'           => 'Newest First',
    'OLD_FIRST'           => 'Oldest First',
    'SEARCH_TIME'         => 'Within Past <em>\'x\'</em> Hours',
    'USERNAME_CONTAINS'   => 'Username Contains',
    'SEARCH_CONTAINS'     => 'Shout Contains',
    'SEARCH_TERM'         => 'Search Terms',
    'SEARCH_SHOUTS'       => 'Search Shouts',
    'LEGEND_ADMIN'        => 'Legend: Admin ',
    'LEGEND_MODERATOR'    => ', Moderator',
    'LEGEND_PREMIUM'      => ', Premium',
    'DELETE_SHOUT'        => 'Delete Shout?',
));

?>