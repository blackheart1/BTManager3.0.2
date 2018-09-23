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
** File pm_ajax.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_BTM",true);
require_once("common.php");
$template = new Template();
set_site_var('');
  $error = "OK";
  $sql = "SELECT msg_id FROM ".$db_prefix."_privmsgs_to WHERE user_id = ".$user->id." AND pm_unread = 1  LIMIT 1;";
  $res = $db->sql_query($sql) or $error = "sql: ".$sql;
  $has_newpm = ($db->sql_numrows($res) > 0) ? true : false;
  $db->sql_freeresult($res);

  if ($has_newpm AND $user->pm_popup) $pmout = $user->lang['NEW_MESAGE'];
  else $pmout = "false";
  if ($pmout != "false") $confirmtext = "<confirm>".$user->lang['JAVA_NEW_PM']."</confirm>";
  else $confirmtext = "";

  $xmldata = "<response><status>".$error."</status><pm>".$pmout."</pm>".$confirmtext."</response>";
  header('Content-Type: text/xml');
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>\n";
  echo $xmldata;
$db->sql_close();
exit();

?>