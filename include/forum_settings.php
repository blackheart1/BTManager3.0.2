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
** File include/forum_settings.php 2018-09-22 00:00:00 Thor
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

require_once("include/configdata.php");
require_once("include/db/database.php");

//This way we protect database authentication against hacked mods


$sql = "SELECT * FROM ".$db_prefix."_admin_forum LIMIT 1;";

$configquery = $db->sql_query($sql)or btsqlerror($sql);

if (!$row = $db->sql_fetchrow($configquery)) ;
//Config parser start
$forumpx = $row["prefix"];
$cookie_name = $row['cookie_name'];
$cookie_domain = $row["cookie_domain"];
$cookie_path = $row["cookie_path"];
$logintime = $row['cookie_time'];
$forumshare = ($row["forum_share"]=="true") ? true : false;
$forumbase = $row["base_folder"];
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$phpbb2_basefile = $forumbase;
$activate_phpbb2_forum = true;
$phpbb2_folder = "./".$forumbase."/";
$phpbb_root_path = "";
$phpbb_root_path = "./";
$auto_post = $row["auto_post_forum"];
$allow_posting = ($row["auto_post"]=="true") ? true : false;
$db->sql_freeresult($configquery);

#Config Parser end

?>