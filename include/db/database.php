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
** File db/database.php 2018-09-22 00:00:00 Thor
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

define("BEGIN_TRANSACTION",1);
define("END_TRANSACTION",-1);

switch($db_type) {

        case 'MySQL':
                require("include/db/mysql.php");
                break;

        case 'MySQL4':
                require("include/db/mysql4.php");
                break;

        case 'PostrgesSQL':
                require("include/db/postgres7.php");
                break;

        case 'MSSQL':
                require("include/db/mssql.php");
                break;

        case 'Oracle':
                require("include/db/oracle.php");
                break;

        case 'MSAccess':
                require("include/db/msaccess.php");
                break;

        case 'MSSQL-ODBC':
                require("include/db/mssql-odbc.php");
                break;
        case 'MySQLi':
                require("include/db/mysqli.php");
                break;

        case 'DB2':
                require("include/db/db2.php");
                break;
        default:
                die("No database set!!! Check config file");

}


?>