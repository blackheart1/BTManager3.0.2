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
** File files/bans.php 2018-09-22 00:00:00 Thor
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

$user->set_lang('admin/acp_bans',$user->ulanguage);
$user->set_lang('admin/acp_users',$user->ulanguage);

$mode = request_var('mode', 'user');

$template->assign_block_vars('l_block1.l_block2',array(
        'L_TITLE'    => $user->lang['ACP_BAN'],
        'S_SELECTED' => true,
        'U_TITLE'    => '1',));

$template->assign_block_vars('l_block1.l_block2.l_block3',array(
        'S_SELECTED' => ('user' ==$mode)? true:false,
        'IMG'        => '',
        'L_TITLE'    => $user->lang['ACP_BAN_USERNAMES'],
        'U_TITLE'    => append_sid("{$siteurl}/admin.$phpEx", 'i=userinfo&amp;op=bans&amp;mode=user'),
));

$template->assign_block_vars('l_block1.l_block2.l_block3',array(
        'S_SELECTED' => ('ip' ==$mode)? true:false,
        'IMG'        => '',
        'L_TITLE'    => $user->lang['ACP_BAN_IPS'],
        'U_TITLE'    => append_sid("{$siteurl}/admin.$phpEx", 'i=userinfo&amp;op=bans&amp;mode=ip'),
));

$template->assign_block_vars('l_block1.l_block2.l_block3',array(
        'S_SELECTED' => ('email' ==$mode)? true:false,
        'IMG'        => '',
        'L_TITLE'    => $user->lang['ACP_BAN_EMAILS'],
        'U_TITLE'    => append_sid("{$siteurl}/admin.$phpEx", 'i=userinfo&amp;op=bans&amp;mode=email'),
));

include_once('include/message_parser.php');
include_once('include/class.bbcode.php');
include_once('include/user.functions.php');
include_once('include/acp/acp_ban.php');
include_once('include/modules.php');

$module           = new acp_ban();
$module->module   =  'acp_ban';
$module->u_action =  append_sid("{$siteurl}/admin.$phpEx", 'i=userinfo&amp;op=bans&amp;mode=' . $mode);

$module->main('',$mode);

echo $template->fetch('admin/' . $module->tpl_name . '.html');
close_out();

?>