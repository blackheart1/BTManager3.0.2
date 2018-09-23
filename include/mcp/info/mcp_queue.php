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
** File info/mcp_queue.php 2018-09-22 00:00:00 Thor
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

class mcp_queue_info
{
    function module()
    {
        return array(
            'filename'  => 'mcp_queue',
            'title'     => 'MCP_QUEUE',
            'version'   => '1.0.0',
            'modes'     => array(
                'unapproved_topics' => array('title' => 'MCP_QUEUE_UNAPPROVED_TOPICS', 'auth' => 'aclf_m_approve', 'cat' => array('MCP_QUEUE')),
                'unapproved_posts'  => array('title' => 'MCP_QUEUE_UNAPPROVED_POSTS', 'auth' => 'aclf_m_approve', 'cat' => array('MCP_QUEUE')),
                'approve_details'   => array('title' => 'MCP_QUEUE_APPROVE_DETAILS', 'auth' => 'acl_m_approve,$id || (!$id && aclf_m_approve)', 'cat' => array('MCP_QUEUE')),
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