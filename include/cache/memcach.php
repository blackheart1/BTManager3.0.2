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
** File include/cache/memcache.php 2021-01-16 00:00:00 Black_Heart
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


if (!defined('MEMCACHE_COMPRESS'))
{
	define('MEMCACHE_COMPRESS', false);
}

class memcach extends pmbt_cache
{
	var $extension = 'memcache';
	var $memcache;
	var $flags = 0;
	var $cache_dir = '';

	function __construct()
	{
        global $db, $db_prefix;
		global $mem_host, $mem_port;
		$this->memcache = new Memcache();
		$this->memcache->addServer($mem_host, $mem_port);
		$this->flags = (MEMCACHE_COMPRESS) ? MEMCACHE_COMPRESSED : 0;
		// Call the parent constructor
		parent::__construct();
	}

	/**
	* {@inheritDoc}
	*/
	function unload()
	{
		parent::unload();

		$this->memcache->close();
	}

	/**
	* {@inheritDoc}
	*/
	function purge()
	{
		$this->memcache->flush();

		parent::purge();
	}

	/**
	* Fetch an item from the cache
	*
	* @access protected
	* @param string $var Cache key
	* @return mixed Cached data
	*/
	function get($var)
	{
		return $this->memcache->get($var);
	}

	/**
	* Store data in the cache
	*
	* @access protected
	* @param string $var Cache key
	* @param mixed $data Data to store
	* @param int $ttl Time-to-live of cached data
	* @return bool True if the operation succeeded
	*/
	function put($var, $data, $ttl = 60)
	{
       if($ttl > $this->expire)$expire = $ttl;
       else
       $ttl = $this->expire;
		if (!$this->memcache->replace($var, $data, $this->flags, $ttl))
		{
	   //die($var);
			return $this->memcache->set($var, $data, $this->flags, $ttl);
		}
		return true;
	}
    /**
    * Tidy cache
    */
	function tidy()
	{

		parent::tidy();
		// cache has auto GC, no need to have any code here :)
		set_config('cache_last_gc', time(), true);
	}

	/**
	* Remove an item from the cache
	*
	* @access protected
	* @param string $var Cache key
	* @return bool True if the operation succeeded
	*/
	function remove_file($var)
	{
			 if (file_exists($this->cache_dir.$var))
			 {
				if (!@unlink($this->cache_dir.$var))
				{
					// E_USER_ERROR - not using language entry - intended.
				   // trigger_error('Unable to remove files within ' . $this->cache_dir . $filename . '. Please check directory permissions.', E_USER_ERROR);
				}
			}
		return $this->memcache->delete($var);
	}
}
?>