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
** File ucp/edit_bookmarks.php 2018-09-22 00:00:00 Thor
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

set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
$t      = request_var('t', array(0));
$hid    = '';
if(isset($t) && count($t) >=1){
    foreach($t as $key => $value)
    {
        $hid .= "<input type=\"hidden\" name=\"t[".$key."]\" value=\"1\" />";
    }
}
$hidden='<input type="hidden" name="take_edit" value="1" >
<input type="hidden" name="check" value="1" >
<input type="hidden" name="action" value="overview" >
<input type="hidden" name="op" value="editprofile" >
<input type="hidden" name="mode" value="bookmarks" />'.
$hid;
if(isset($check))$check=true;
else
$check = false;
            if(!confirm_box($check, 'bt_fm_del_bookm', $hidden,'confirm_body.html','?overview&mode=bookmarks')){
              set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
              $template->assign_var('S_IN_UCP', true);
            }
$t                                     = request_var('t', array(0));
    if(!isset($t) && !count($t) >=1)bterror("NO_TOPIC_SET",'BT_ERROR');
    foreach($t as $book=> $value){
        $db->sql_query("DELETE FROM ".$db_prefix."_bookmarks WHERE topic_id='".$book."' AND user_id='".$user->id."'");
     }

?>