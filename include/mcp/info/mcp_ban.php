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
** File info/mcp_ban.php 2018-09-22 00:00:00 Thor
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

class mcp_ban_info
{
    function module()
    {
        return array(
            'filename'  => 'mcp_ban',
            'title'     => 'MCP_BAN',
            'version'   => '1.0.0',
            'modes'     => array(
                'user'      => array('title' => 'MCP_BAN_USERNAMES', 'auth' => 'acl_m_ban', 'cat' => array('MCP_BAN')),
                'ip'        => array('title' => 'MCP_BAN_IPS', 'auth' => 'acl_m_ban', 'cat' => array('MCP_BAN')),
                'email'     => array('title' => 'MCP_BAN_EMAILS', 'auth' => 'acl_m_ban', 'cat' => array('MCP_BAN')),
            ),
        );
    }

    function install()
    {
    }

    function uninstall()
    {
    }
}

?>