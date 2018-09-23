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
** File httperror.php 2018-09-22 00:00:00 Thor
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

$errid = request_var('errid', '');

$template = new Template();
$user->set_lang('httperror',$user->ulanguage);

switch ($errid) {
        case 400: {
                header("HTTP/1.0 400 Bad Request");
                $e = 'A';
                break;
        }
        case 401: {
                header("HTTP/1.0 401 Access Denied");
                $e = 'B';
                break;
        }
        case 403: {
                header("HTTP/1.0 403 Forbidden");
                $e = 'C';
                break;
        }
        case 404: {
                header("HTTP/1.0 404 Page Not Found");
                $e = 'D';
                break;
        }
        case 500: {
                header("HTTP/1.0 500 Internal Server Error");
                $e = 'E';
                break;
        }
}
                                set_site_var($user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR'           => true,
                                        'TITTLE_M'          => $user->lang[$e . '_ERROR_TTL'],
                                        'MESSAGE'           => sprintf($user->lang[$e . '_ERROR_EXP'],$admin_email) . $_SERVER["REQUEST_URI"],
                                ));
        echo $template->fetch('message_body.html');

?>