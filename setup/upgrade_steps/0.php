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
** File upgrade_steps/0.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_BTM')
**/

$template->set_custom_template('../setup/style/upgrade', 'index.html');
$template->set_filenames(array('index'=>'index.html'));
/*
Operating System Analysis
Useful for setup help
*/
if (strtoupper(substr(PHP_OS,0,3)) == "WIN") $os = "Windows";
else $os = "Linux";
        $template->assign_vars(array(
            'BTMVERSION'        => sprintf($user->lang['UPDATE_INSTRUCTIONS'],$tchan,$rchan,$ralt),
            'LANGIMG'           => $langpic,
            'STEPIMG'           => $stepimg,
            'OPSYSIMG'          => $os . ".png"
            ));
$handle = 'index';
$user->set_lang('httperror',$user->ulanguage);
if (extension_loaded('zlib')){ ob_end_clean();}
if (function_exists('ob_gzhandler') && !ini_get('zlib.output_compression'))
    ob_start('ob_gzhandler');
else
    ob_start();
ob_implicit_flush(0);
$template->display($handle);
die();
?>