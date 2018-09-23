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
** File udl/database.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
    die ("You Can't Access this File Directly");

define("BEGIN_TRANSACTION",1);
define("END_TRANSACTION",-1);

switch($db_type) {

        case 'MySQL':
                require("udl/mysql.php");
                break;

        case 'MySQL4':
                require("udl/mysql4.php");
                break;
        case 'MySQLi':
                require("udl/mysqli.php");
                break;
        default:
                die("No database set!!! Check config file");

}

?>