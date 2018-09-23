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
** File install/english.php 2018-09-23 00:00:00 Thor
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
    'INTRO_UPGRADE'                 => 'Welcome to the BT.Manager Upgrade System',

    'INTRO_UPGRADE_EXP'             => 'The Upgrade System will Scan your Database to Check for any Missing Tables and will attempt to Add them.<br />If a Table is Missing a Column/Row or if one Does Not Match it will then try to Add them or Convert yours in order for you to Install the New Release.',

    'NOTICE_DB_CHANGES_ND'          => 'We have Scanned your Database and found:-<br />You have <strong>%1$s</strong> Table/s that need Adding<br /><strong>%2$s</strong>New Rows that need Adding<br /><strong>%3$s</strong>Rows that need Updating',

    'BACKUP_NOTICE'                 => 'Please Backup your Site before Updating just in case any problems arise during the Update Process.',

    'START_BACKUP'                  => 'Start Backup',
    'NO_BACKUP'                     => 'Proceed without Backup',
    'BACKUP_SUCCESS'                => 'The Backup File has been Successfully Created.',
    'FILE_WRITE_FAIL'               => 'We are Unable to Write the File to your Storage Folder.',
    'RETRY_BACKUP'                  => 'Try to Backup again?',
    'PROCEED_WITH_UD'               => 'Proceed with Update?',
    'INLINE_UPDATE_SUCCESSFUL'      => 'The Database Update was Successful.',
    'FINAL_SETS'                    => 'Now that the Update is Complete you can now:-<br />

    <li>Update your Files with the Newest Release of BT.Manager</li>
    <li>If you had any Mods Installed on your Site you will need to Reinstall them.</li>
    <ol><li>After you have Updated ALL your Files you will need to Proceed to the Usergroup Management in your Administration Panel and Update your:-</li>
    <li>Groups Permissions</li>
    <li>This will Include ALL Users with Modified Permissions</li>
    <li>Administrator Roles</li>
    <li>Moderator Roles</li>
    <li>User Roles</li>
    <li>Forum Roles</li></ol>',
));

?>