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
** File info/mcp_reports.php 2018-09-22 00:00:00 Thor
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

class mcp_reports_info
{
    function module()
    {
        return array(
            'filename'  => 'mcp_reports',
            'title'     => 'MCP_REPORTS',
            'version'   => '1.0.0',
            'modes'     => array(
                'reports'           => array('title' => 'MCP_REPORTS_OPEN', 'auth' => 'aclf_m_report', 'cat' => array('MCP_REPORTS')),
                'reports_closed'    => array('title' => 'MCP_REPORTS_CLOSED', 'auth' => 'aclf_m_report', 'cat' => array('MCP_REPORTS')),
                'report_details'    => array('title' => 'MCP_REPORT_DETAILS', 'auth' => 'acl_m_report,$id || (!$id && aclf_m_report)', 'cat' => array('MCP_REPORTS')),
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