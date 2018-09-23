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
** File info/mcp_logs.php 2018-09-22 00:00:00 Thor
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

class mcp_logs_info
{
    function module()
    {
        return array(
            'filename'  => 'mcp_logs',
            'title'     => 'MCP_LOGS',
            'version'   => '1.0.0',
            'modes'     => array(
                'front'         => array('title' => 'MCP_LOGS_FRONT', 'auth' => 'acl_m_ || aclf_m_', 'cat' => array('MCP_LOGS')),
                'forum_logs'    => array('title' => 'MCP_LOGS_FORUM_VIEW', 'auth' => 'acl_m_,$id', 'cat' => array('MCP_LOGS')),
                'topic_logs'    => array('title' => 'MCP_LOGS_TOPIC_VIEW', 'auth' => 'acl_m_,$id', 'cat' => array('MCP_LOGS')),
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