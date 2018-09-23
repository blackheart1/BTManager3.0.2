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
** Project Leaders: Black_Heart, Thor
** File files/arcade.php 2018-09-22 00:00:00 Thor
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

        $user->set_lang('admin/acp_arcade',$user->ulanguage);
        $mode           = request_var('mode', 'manage');
                            $template->assign_block_vars('l_block1.l_block2',array(
                            'L_TITLE'       => $user->lang['ARCADE'],
                            'S_SELECTED'    => true,
                            'U_TITLE'       => '1',));
                            $template->assign_block_vars('l_block1.l_block2.l_block3',array(
                            'S_SELECTED'    => ('settings' ==$mode)? true:false,
                            'IMG' => '',
                            'L_TITLE' => $user->lang['A_SETTINGS'],
                            'U_TITLE' => append_sid($u_action, 'mode=settings'),
                            ));
                            $template->assign_block_vars('l_block1.l_block2.l_block3',array(
                            'S_SELECTED'    => ('manage' ==$mode)? true:false,
                            'IMG' => '',
                            'L_TITLE' => $user->lang['A_MANAGE'],
                            'U_TITLE' => append_sid($u_action, 'mode=manage'),
                            ));
        require_once 'admin/files/acp_arcade.php';
        $arcade = new acp_arcade($u_action);
        $module_id      = request_var('id', '');
        $arcade->main($module_id, $mode);
        $template->assign_vars(array(
            'ICON_EDIT'                 => '<img src="themes/' . $theme . '/pics/edit.gif" alt="Edit" title="Edit" border="0">',
            'ICON_DELETE'               => '<img src="themes/' . $theme . '/pics/drop.gif" alt="Delete" title="Delete" border="0">',
            'ACP_BBCODES'               => 'BBCodes',
        ));
        echo $template->fetch('admin/' . $arcade->tpl_name . '.html');
        close_out();

?>