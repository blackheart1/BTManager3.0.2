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
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File acp_cache/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'CACHE'                  => 'Cache',
    'TITLE'                  => 'Site Cache',
    'TITLE_MEM'              => 'Memcache Settings',

    'TITLE_EXP'              => 'Here is where you can Set the Maximum Time to Hold Cache Files for before they get Updated.  The Longer you Keep them, the Better the Site Speed will be.<br /><br />',

    '_admpsql_time'          => 'SQL Cache Time',

    '_admpsql_timeexplain'   =>  'Note:- The Value that you Enter Here is also used for the Site\'s Configuration Settings, Shout Box Configuration and more...',

    '_admptheme_time'        => 'Theme Cache Time',
    '_admptheme_timeexplain' => 'Maximum Time to Hold Cache Files for your Themes',
    '_admpcache_dir'         => 'Cache Directory',

    '_admpcache_direxplain'  => 'This Directory will Need to be Writeable by the System.<br /><strong>DO NOT</strong> Add the Trailing Slash <strong>/</strong>',

    'ERR_SQL_TIME'           => 'There Appears to be an Issue with the Time you Set for the SQL Cache<br /><br />You Entered %1$s<br /><br /> Please Go Back and Enter a Numeric Value.',

    'ERR_THEME_TIME'         => 'There Appears to be an Issue with the Time you Set for the Theme\'s Cache<br /><br />You Entered %1$s<br /><br />Please Go Back and Enter a Numeric Value.',
    'ERR_MEMCACHE_PORT'      => 'There Appears to be an Issue with the Port Number you Set for the Memcache<br /><br />You Entered %1$s<br /><br />Please Go Back and Enter a Numeric Value.',

    'ERR_CACHE_DIR_NOTSET'   => 'There Appears to be an Issue Locating the Cache Directory you chose (%1$s).<br /><br />Please Go Back and make sure that you\'ve Entered the Correct Path to your Cache Directory and that it\'s Writeable.',

    'ERR_NO_MEMCACHE_HOST'   => 'There Appears to be an Issue With the Memcache Host you chose (%1$s).<br /><br />Please Go Back and make sure that you\'ve Entered a valid Host name.',

    'ERR_CACHE_DIR_NOT_WRITEABLE' => 'The Directory is NOT Writeable<br /><br />(%1$s)',
    'ERR_ARRAY_MESS'              => '<li>%s</li>',
	'ERR_NO_MEMCACHE'		=> 'Memcache is not loaded on this server please check with your provider to have it installed',

    '_admpmem_host'        => 'Host',
    '_admpmem_hostexplain' => 'Point to the host where memcached is listening for connections. This parameter may also specify other transports like unix:///path/to/memcached.sock to use UNIX domain sockets, in this case port must also be set to 0.',

    '_admpmem_port'        => 'Port',
    '_admpmem_portexplain' => 'Point to the port where memcached is listening for connections. Set this parameter to 0 when using UNIX domain sockets.<br />Please note: port defaults to memcache.default_port if not specified. For this reason it is wise to specify the port explicitly in this method call.',

    '_admpcache_type'        => 'Cache Type',
    '_admpcache_typeexplain' => 'Select what Type of Cache System You want to use File System or Memcache',
    '_admpSEL_TYPE'          => array('memcach' => 'Memcache System', 'file' => 'File System'),
));

?>