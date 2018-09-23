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
** File redirect.php 2018-09-22 00:00:00 Thor
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
include_once('include/function_posting.php');
$template = new Template();
  $url = '';
  foreach($_GET as $var=>$val)
  {
    $url .= "&$var=$val";
  }
  //while (list($var,$val) = each($_GET))
$i = strpos($url, "&url=");
if ($i !== false)
    $url = substr($url, $i + 5);
$url = str_replace('&link=', '' ,$url);
    $title = getMetaTitle($url);
                set_site_var($user->lang['REDIRECT']);
                meta_refresh(5,strip_tags($url) );
                $template->assign_vars(array(
                    'S_SUCCESS'         => true,
                    'S_FORWARD'         => false,
                    'TITTLE_M'          => $user->lang['REDIRECT'],
                    'MESSAGE'           => sprintf($user->lang['REDIRECT_EXP'],$title),
                ));
                echo $template->fetch('message_body.html');
                close_out();
?>