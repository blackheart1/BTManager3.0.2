<?php

/**
**********************
** BTManager v3.0.1 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File install/english.php 2018-08-19 09:26:00 Black_heart
**
** CHANGES
**
** 2018-08-19 - Created New
**/

if (!defined('IN_PMBT'))
{
    include_once './../../../security.php';
    die ("Error 404 - Page Not Found");
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
	'INTRO_UPGRADE'					=> 'Welcome to BTManager Upgrade system',
	'INTRO_UPGRADE_EXP'				=> 'This Upgrade system well check your data base and find andy missing tables and add them as needed<br />if a table is missing a colom row or if one dose not match then it well try to add the missing colom or convert yours as needed to run the new Release.',
	'NOTICE_DB_CHANGES_ND'			=> 'We have checked your data base and found<br />You have <strong>%1$s</strong> Table that needs added<br /><strong>%2$s</strong> New Rows Need added<br /><strong>%3$s</strong> Rows that need updated',
	'BACKUP_NOTICE'					=> 'Please backup your board before updating in case any problems arise during the update process.',
	'START_BACKUP'					=> 'Start backup',
	'NO_BACKUP'						=> 'Proseed with out Back Up',
	'BACKUP_SUCCESS'				=> 'The backup file has been created successfully.',
	'FILE_WRITE_FAIL'				=> 'Unable to write file to storage folder.',
	'RETRY_BACKUP'					=> 'Try to back up again!',
	'PROCEED_WITH_UD'				=> 'Proceed with update.',
	'INLINE_UPDATE_SUCCESSFUL'		=> 'The database update was successful.',
	'FINAL_SETS'					=> 'Now that the Update is complete you can Now<br />
	<li>Update your files with the Newest release of BT.Manager</li>
	<li>If you had any mods on your site you well need to reinstall them.</li>
	<ol><li>After you have updated all your files you well need to procede to the admin panel and update your</li>
	<li>Groups Permissions</li>
	<li>This well include all users with modified Permissions</li>
	<li>Administrator Roles</li>
	<li>Moderator Roles</li>
	<li>User Roles</li></ol>',
));

?>