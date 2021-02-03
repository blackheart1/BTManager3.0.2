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
** File include/class.cache.php 2018-09-22 00:00:00 Thor
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
require_once("cache/data_global.php");
require_once("include/cache/" . $cache_type . ".php");
$pmbt_cache = new $cache_type();
class pmbt_cache {

    var $cache_dir = './';
    var $expire = '60';
    var $theme_expire = '60';
    var $vars = array();
    var $var_expires = array();

    /**
    * Constuctor
    */

       function __construct()
       {
            global $db, $db_prefix;
            $ch_con = $this->get_sql('cache');
            if(!$ch_con)
            {
                $sql = "SELECT * FROM ".$db_prefix."_cache_con;";
                $ch_con = array();
                $sql_query = $db->sql_query($sql);
                while ($row_attach = $db->sql_fetchrow($sql_query))
                {
                    $ch_con[$row_attach['name']] = $row_attach['value'];
                }
                $db->sql_freeresult($sql_query);
                $this->set_sql('cache', $ch_con);
            }
                $this->cache_dir = $ch_con['cache_dir'] . '/';
                $this->expire = $ch_con['sql_time'];
                $this->theme_expire = $ch_con['theme_time'];
       }
    /*To not break everyone using your library, you have to keep backwards compatibility:
    Add the PHP5-style constructor, but keep the PHP4-style one. */
        function pmbt_cache()
        {
            $this->__construct();
        }
       function get_sql($file, $expire = 60)
       {
		   return $this->get("sql_".md5($file), $expire);
       }
       function destroy($filename)
       {
           return $this->remove_file($filename . '.php');
       }
    function obtain_icons()
    {
        if (($icons = $this->get('_icons')) === false)
        {
            global $db, $db_prefix;

            // Topic icons
            $sql = 'SELECT *
                FROM ' . $db_prefix . '_icons
                ORDER BY icons_order';
            $result = $db->sql_query($sql);

            $icons = array();
            while ($row = $db->sql_fetchrow($result))
            {
                $icons[$row['icons_id']]['img'] = $row['icons_url'];
                $icons[$row['icons_id']]['width'] = (int) $row['icons_width'];
                $icons[$row['icons_id']]['height'] = (int) $row['icons_height'];
                $icons[$row['icons_id']]['display'] = (bool) $row['display_on_posting'];
            }
            $db->sql_freeresult($result);

            $this->put('_icons', $icons);
        }

        return $icons;
    }
    function obtain_ranks()
    {
        if (($ranks = $this->get('_ranks')) === false)
        {
            global $db, $db_prefix;

            $sql = 'SELECT *
                FROM ' . $db_prefix . '_ranks
                ORDER BY rank_min DESC';
            $result = $db->sql_query($sql);

            $ranks = array();
            while ($row = $db->sql_fetchrow($result))
            {
                if ($row['rank_special'])
                {
                    $ranks['special'][$row['rank_id']] = array(
                        'rank_title'    =>  $row['rank_title'],
                        'rank_image'    =>  $row['rank_image']
                    );
                }
                else
                {
                    $ranks['normal'][] = array(
                        'rank_title'    =>  $row['rank_title'],
                        'rank_min'      =>  $row['rank_min'],
                        'rank_image'    =>  $row['rank_image']
                    );
                }
            }
            $db->sql_freeresult($result);

            $this->put('_ranks', $ranks);
        }

        return $ranks;
    }
    function obtain_disallowed_usernames()
    {
        if (($usernames = $this->get('_disallowed_usernames')) === false)
        {
            global $db, $db_prefix;

            $sql = 'SELECT disallow_username
                FROM ' . $db_prefix . '_disallow';
            $result = $db->sql_query($sql);

            $usernames = array();
            while ($row = $db->sql_fetchrow($result))
            {
                $usernames[] = str_replace('%', '.*?', preg_quote(utf8_clean_string($row['disallow_username']), '#'));
            }
            $db->sql_freeresult($result);

            $this->put('_disallowed_usernames', $usernames);
        }

        return $usernames;
    }
       function purge()
       {
        // Purge all phpbb cache files
        $dir = @opendir($this->cache_dir);

        if (!$dir)
        {
            return;
        }
        while (($entry = readdir($dir)) !== false)
        {
            if (preg_match('/^data_/', $entry) OR $entry == "index.html" OR $entry == "." OR $entry == "..")
            {
                continue;
            }

            $this->remove_file($entry);
        }
        closedir($dir);
       }
       function set_sql($file, $output)
       {
		   $this->put("sql_".md5($file), $output,$this->expire);
       }
    function obtain_word_list()
    {
        global $db, $db_prefix;

        if (($censors = $this->get('_word_censors')) === false)
        {
            $sql = 'SELECT word, replacement
                FROM ' . $db_prefix . '_words';
            $result = $db->sql_query($sql);

            $censors = array();
            while ($row = $db->sql_fetchrow($result))
            {
                $censors['match'][] = get_censor_preg_expression($row['word']);
                $censors['replace'][] = $row['replacement'];
            }
            $db->sql_freeresult($result);

            $this->put('_word_censors', $censors);
        }

        return $censors;
    }
    /**
    * Load global cache
    */
    function load()
    {
        return $this->_read('data_global');
    }
    function obtain_attach_extensions($forum_id)
    {
        if (($extensions = $this->get('_extensions')) === false)
        {
            global $db, $db_prefix;

            $extensions = array(
                '_allowed_post' => array(),
                '_allowed_pm'   => array(),
            );

            // The rule is to only allow those extensions defined. ;)
            $sql = 'SELECT e.extension, g.*
                FROM ' . $db_prefix . '_extensions e, ' . $db_prefix . '_extension_groups g
                WHERE e.group_id = g.group_id
                    AND (g.allow_group = 1 OR g.allow_in_pm = 1)';
            $result = $db->sql_query($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $extension = strtolower(trim($row['extension']));

                $extensions[$extension] = array(
                    'display_cat'   => (int) $row['cat_id'],
                    'download_mode' => (int) $row['download_mode'],
                    'upload_icon'   => trim($row['upload_icon']),
                    'max_filesize'  => (int) $row['max_filesize'],
                    'allow_group'   => $row['allow_group'],
                    'allow_in_pm'   => $row['allow_in_pm'],
                );

                $allowed_forums = ($row['allowed_forums']) ? unserialize(trim($row['allowed_forums'])) : array();

                // Store allowed extensions forum wise
                if ($row['allow_group'])
                {
                    $extensions['_allowed_post'][$extension] = (!sizeof($allowed_forums)) ? 0 : $allowed_forums;
                }

                if ($row['allow_in_pm'])
                {
                    $extensions['_allowed_pm'][$extension] = 0;
                }
            }
            $db->sql_freeresult($result);

            $this->put('_extensions', $extensions);
        }

        // Forum post
        if ($forum_id === false)
        {
            // We are checking for private messages, therefore we only need to get the pm extensions...
            $return = array('_allowed_' => array());

            foreach ($extensions['_allowed_pm'] as $extension => $check)
            {
                $return['_allowed_'][$extension] = 0;
                $return[$extension] = $extensions[$extension];
            }

            $extensions = $return;
        }
        else if ($forum_id === true)
        {
            return $extensions;
        }
        else
        {
            $forum_id = (int) $forum_id;
                //die(print_r($extensions['_allowed_post']));
    $return = array('_allowed_' => array());

            foreach ($extensions['_allowed_post'] as $extension => $check)
            {
                // Check for allowed forums
                if (is_array($check))
                {
                    $allowed = (!in_array($forum_id, $check)) ? false : true;
                }
                else
                {
                    $allowed = true;
                }

                if ($allowed)
                {
                    $return['_allowed_'][$extension] = 0;
                    $return[$extension] = $extensions[$extension];
                }
            }

            $extensions = $return;
        }

        if (!isset($extensions['_allowed_']))
        {
            $extensions['_allowed_'] = array();
        }
//die(print_r($extensions));
        return $extensions;
    }
    function tidy()
    {
        global $phpEx;

        $dir = @opendir($this->cache_dir);

        if (!$dir)
        {
            return;
        }

        $time = time();

        while (($entry = readdir($dir)) !== false)
        {
            if (preg_match('/^(imdb_|data_)/', $entry) OR $entry == "index.html" OR $entry == "." OR $entry == "..")
            {
                continue;
            }

            if (!($handle = @fopen($this->cache_dir . $entry, 'rb')))
            {
                continue;
            }
            if (preg_match('/\.html.php$/', $entry))
            {
            $expires = (int) (filemtime($this->cache_dir.$entry) + $this->theme_expire);
            }
            else
            {
            $expires = (int) (filemtime($this->cache_dir.$entry) + $this->expire);
            }
            fclose($handle);

            if ($time >= $expires)
            {
                $this->remove_file($entry);
            }
        }
        closedir($dir);


        set_config('cache_last_gc', time(), true);
    }
}

?>