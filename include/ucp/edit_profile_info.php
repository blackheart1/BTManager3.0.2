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
** File ucp/edit_profile_info.php 2018-09-22 00:00:00 Thor
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

        $country = request_var('country','0');
        $aim = request_var('aim','');
        $icq = request_var('icq','');
        $msn = request_var('msn','');
        $skype = request_var('skype','');
        $yahoo = request_var('yahoo','');
        $jabber = request_var('jabber','');
        if (!isset($aim) OR $aim == "") $aim = "NULL";
        processinput("aim",$aim);
        if (!isset($icq) OR $icq == "") $icq = "NULL";
        processinput("icq",$icq);
        if (!isset($jabber) OR $jabber == "") $jabber = "NULL";
        processinput("jabber",$jabber);
if ($config['allow_birthdays'])
{
        $bday_day = request_var('bday_day','');
        $bday_month = request_var('bday_month','');
        $bday_year = request_var('bday_year','');
        if (!isset($bday_day) OR $bday_day =='--' OR !isset($bday_month) OR $bday_month == "--" OR !isset($bday_year) OR $bday_year == "--") $birthday = "NULL";
        else
        $birthday = $bday_day.'-'.$bday_month.'-'.$bday_year;
        processinput("birthday",$birthday);
}
if (!isset($msn) OR $msn == "") $msn = "NULL";
        processinput("msn",$msn);
        if (!isset($skype) OR $skype == "") $skype = "NULL";
        processinput("skype",$skype);
        if (!isset($yahoo) OR $yahoo == "") $yahoo = "NULL";
        processinput("yahoo",$yahoo);
        processinput("country",$country);
                $sql = "UPDATE ".$db_prefix."_users SET ";
                for ($i = 0; $i < count($sqlfields); $i++) $sql .= $sqlfields[$i] ." = ".$sqlvalues[$i].", ";
                $sql .= "act_key = ".(($admin_mode) ? "act_key" : "'".RandomAlpha(32)."'")." WHERE id = '".$uid."';"; //useless but needed to terminate SQL without a comma
                //echo $sql;
                //die();
                if (!$db->sql_query($sql)) btsqlerror($sql);
                if (!$admin_mode) userlogin($uname,$btuser); //SQL is executed, cookie is invalid and getusername() function returns nothing, so it must be called earlier
                                $template->assign_vars(array(
                                        'S_REFRESH'             => true,
                                        'META'                  => '<meta http-equiv="refresh" content="5;url=' . $siteurl . '/user.php?op=editprofile' . ((!$admin_mode) ? '' : "&amp;id=" .$uid  ) . '&amp;action=profile&amp;mode=profile_info" />',
                                        'S_ERROR_HEADER'        =>$user->lang['UPDATED'],
                                        'S_ERROR_MESS'          => $user->lang['PROFILE_UPDATED'],
                                ));
                //trigger_error($message);
                echo $template->fetch('error.html');
                die();

?>