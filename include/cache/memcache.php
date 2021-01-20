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

if (!defined('MEMCACHE_PORT'))
{
	define('MEMCACHE_PORT', 11211);
}

if (!defined('MEMCACHE_COMPRESS'))
{
	define('MEMCACHE_COMPRESS', false);
}

if (!defined('PHPBB_ACM_MEMCACHE_HOST'))
{
	define('MEMCACHE_HOST', 'localhost');
}

if (!defined('MEMCACHE'))
{
	//can define multiple servers with host1/port1,host2/port2 format
	define('MEMCACHE', MEMCACHE_HOST . '/' . MEMCACHE_PORT);
}
class memcached extends pmbt_cache
{
	var $extension = 'memcache';

	var $memcache;
	var $flags = 0;

	function __construct()
	{
		// Call the parent constructor

		$this->memcache = new Memcache;
		foreach (explode(',', MEMCACHE) as $u)
		{
			$parts = explode('/', $u);
			$this->memcache->addServer(trim($parts[0]), trim($parts[1]));
		}
		$this->flags = (MEMCACHE_COMPRESS) ? MEMCACHE_COMPRESSED : 0;
		//die(print_r($this->memcache->getStats()));
		//parent::__construct();
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
	function put($var, $data, $ttl = 2592000)
	{
       if($ttl > $this->expire)$expire = $ttl;
       else
       $ttl = $this->expire;
		if (!$this->memcache->replace($var, $data, $this->flags, $ttl))
		{
			return $this->memcache->set($var, $data, $this->flags, $ttl);
		}
		return true;
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
		return $this->memcache->delete($var);
	}
}
?>