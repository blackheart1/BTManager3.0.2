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
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File include/constants.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define('PRIVMSGS_HOLD_BOX', -4);
define('PRIVMSGS_NO_BOX', -3);
define('PRIVMSGS_OUTBOX', -2);
define('PRIVMSGS_SENTBOX', -1);
define('PRIVMSGS_INBOX', 0);
define('_NEXT_STEP', 'Next');
define('ANONYMOUS','0');

// BBCode UID length
define('BBCODE_UID_LEN', 8);
// Magic url types
define('MAGIC_URL_EMAIL', 1);
define('MAGIC_URL_FULL', 2);
define('MAGIC_URL_LOCAL', 3);
define('MAGIC_URL_WWW', 4);
// Full Folder Actions
define('FULL_FOLDER_NONE', -3);
define('FULL_FOLDER_DELETE', -2);
define('FULL_FOLDER_HOLD', -1);
define('_IF', 'IF');
define('RULE_IS_LIKE', 1);      // Is Like
define('RULE_IS_NOT_LIKE', 2);  // Is Not Like
define('RULE_IS', 3);           // Is
define('RULE_IS_NOT', 4);       // Is Not
define('RULE_BEGINS_WITH', 5);  // Begins with
define('RULE_ENDS_WITH', 6);    // Ends with
define('RULE_IS_FRIEND', 7);    // Is Friend
define('RULE_IS_FOE', 8);       // Is Foe
define('RULE_IS_USER', 9);      // Is User
define('RULE_IS_GROUP', 10);    // Is In Usergroup
define('RULE_ANSWERED', 11);    // Answered
define('RULE_FORWARDED', 12);   // Forwarded
define('RULE_TO_GROUP', 14);    // Usergroup
define('RULE_TO_ME', 15);       // Me

define('ACTION_PLACE_INTO_FOLDER', 1);
define('ACTION_MARK_AS_READ', 2);
define('ACTION_MARK_AS_IMPORTANT', 3);
define('ACTION_DELETE_MESSAGE', 4);

define('CHECK_SUBJECT', 1);
define('CHECK_SENDER', 2);
define('CHECK_MESSAGE', 3);
define('CHECK_STATUS', 4);
define('CHECK_TO', 5);
define('ATTACHMENT_CATEGORY_NONE', 0);
define('ATTACHMENT_CATEGORY_IMAGE', 1); // Inline Images
define('ATTACHMENT_CATEGORY_WM', 2); // Windows Media Files - Streaming
define('ATTACHMENT_CATEGORY_RM', 3); // Real Media Files - Streaming
define('ATTACHMENT_CATEGORY_THUMB', 4); // Not used within the database, only while displaying posts
define('ATTACHMENT_CATEGORY_FLASH', 5); // Flash/SWF files
define('ATTACHMENT_CATEGORY_QUICKTIME', 6); // Quicktime/Mov files
// Group settings
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);
define('GROUP_SPECIAL', 3);
define('GROUP_FREE', 4);

?>