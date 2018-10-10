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
** File files/bbcode.php 2018-10-10 09:19:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
** 2018-10-10 - Added Missing Language
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

include_once'include/class.bbcode.php';

$user->set_lang('admin/acp_bbcode',$user->ulanguage);
    $template->assign_vars(array(
        'ICON_EDIT'                 => '<img src="themes/' . $themne . '/pics/edit.gif" alt="' . $user->lang['BBCODE_EDIT'] . '" title="' . $user->lang['BBCODE_EDIT'] . '" border="0">',

        'ICON_DELETE'               => '<img src="themes/' . $themne . '/pics/drop.gif" alt="' . $user->lang['BBCODE_DELETE'] . '" title="' . $user->lang['BBCODE_DELETE'] . '" border="0">',

        'ACP_BBCODES'               => 'BBCodes',
));

$bbcode  =  new acp_bbcodes();
$bbcode->u_action = $siteurl . '/admin.php?i=staff&op=bbcode';
$bbcode->main('1','edit');

echo $template->fetch('admin/acp_bbcodes.html');

?>