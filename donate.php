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
** File donate.php 2018-09-22 00:00:00 Thor
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
else
{
    define("IN_BTM",true);
}
require_once("common.php");
$user->set_lang('donate',$user->ulanguage);
$template = new Template();
set_site_var($user->lang['DONATIONS']);
    if($nodonate == "US")$type = "$";
    elseif($nodonate == "EU")$type = "&euro;";
    elseif($nodonate == "UK")$type = "&pound;";
 eval('$page = "' . html_entity_decode($donatepagecontents) . '";');
    $template->assign_vars(array(
                    'CURENTSY'          =>  $type,
                    'ASKING'            =>  $donateasked,
                    'RECEAVED'          =>  $donatein,
                    'CONTENT'           =>  $page,
                ));
echo $template->fetch('donate.html');
close_out();
?>