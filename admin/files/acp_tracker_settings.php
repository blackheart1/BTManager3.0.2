<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright © 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File acp_tracker_settings.php 2018-09-15 14:32:00 Black_Heart
**
** CHANGES
**
** 2018-09-15 - Created New File
**/


if (!defined('IN_BTM'))
{
	include_once './../../security.php';
	die ("You can't access this file directly");
}
class acp_tracker_settings
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config,$db_prefix, $phpEx;
		global $pmbt_cache, $site_announce;
		$user->set_lang('admin/acp_site_settings',$user->ulanguage);

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$form_key = 'acp_tracker_settings';
		add_form_key($form_key);

		/**
		*	Validation types are:
		*		string, int, bool, array,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writable), path (relative path, but able to escape the root), wpath (writable)
		*/
				$display_vars = array(
					'title'	=> 'TRACKER_SETTINGS',
					'vars'	=> array(
						'legend'							=> 'TRACKER_SETTINGS',
						'announce_url'						=> array('lang' => '_admpannounce_url',		'validate' => 'array',	'type' => 'custom', 'method' => 'announce', 'explain' => true),
						'stealthmode'						=> array('lang' => '_admpstealthmode',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
                        'announce_text'   					=> array('lang' => '_admpannounce_text',   'validate' => 'string', 'type' => 'text:65:50', 'explain' => true),
                        'announce_level'     				=> array('lang' => '_admpannounce_level',          'validate' => 'string', 'type' => 'select', 'method' => 'announce_level_select', 'explain' => true),
						'allow_multy_tracker'				=> array('lang' => '_admpallow_multy_tracker',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_backup_tracker'				=> array('lang' => '_admpallow_backup_tracker',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_allow_magnet'				=> array('lang' => '_admpallow_magnet',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
                        'max_torrent_size'					=> array('lang' => '_admpmax_torrent_size',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
                        'torrent_prefix'   					=> array('lang' => '_admptorrent_prefix',   'validate' => 'string', 'type' => 'text:65:50', 'explain' => true),
                        'torrent_per_page' 					=> array('lang' => '_admptorrent_per_page',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
                        'minupload_size_file'				=> array('lang' => '_admpminupload_size_file',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
                        'max_num_file'						=> array('lang' => '_admpmax_num_file',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
                        'max_share_size'					=> array('lang' => '_admpmax_share_size',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
                        'announce_interval' 				=> array('lang' => '_admpannounce_interval',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
                        'announce_interval_min'				=> array('lang' => '_admpannounce_interval_min',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
                        'dead_torrent_interval'				=> array('lang' => '_admpdead_torrent_interval',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
						'torrent_complaints'				=> array('lang' => '_admptorrent_complaints',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'torrent_global_privacy'			=> array('lang' => '_admptorrent_global_privacy',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
                        'legend2'              				=> 'EXTERNAL_TORRENTS',
 						'allow_external'					=> array('lang' => '_admpallow_external',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'autoscrape'						=> array('lang' => '_admpautoscrape',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
                        'time_tracker_update' 				=> array('lang' => '_admptime_tracker_update',   'validate' => 'int:0', 'type' => 'text:5:10', 'explain' => true),
						'upload_dead'						=> array('lang' => '_admpupload_dead',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
                        'legend3'                   		=> 'ACP_SUBMIT_CHANGES',
			)
				);
		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();
		$this->tpl_name = 'site_settings';
		$this->page_title = $display_vars['title'];

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID']. 'invalid';
		}
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}
		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}

			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];
			if ($submit)
			{
				if ($config_name == 'announce_url')
				{
					$vallad_ann = array();
					$announce_url = explode("\n", $config_value);
					foreach($announce_url as $a)
					{
						if(is_url(strtolower($a)))array_push($vallad_ann,$a);
					}
					$config_value = serialize($vallad_ann);
					$this->new_config[$config_name] = $config_value;
				}
				set_config($config_name, $config_value);
			}
		}
			if ($submit)
			{
				trigger_error($user->lang['CONFIG_UPDATED_TRACKER'] . adm_back_link($this->u_action));
			}
		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'U_ACTION'			=> $this->u_action)
		);

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . 'explain'])) ? $user->lang[$vars['lang'] . 'explain'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);

			unset($display_vars['vars'][$config_key]);
		}
	}

	function announce($value, $key)
	{
		global $user, $module;

		return '<textarea type="text" name="config[' . $key . ']" rows="15" cols="76">' . @implode("\n",unserialize($value)) . '</textarea>';
	}
    function announce_level_select($selected_method, $key = '')
    {
        global $user;

        $auth_methods = $user->lang["_admpannounce_levelopt"];
        $s_smtp_auth_options = '';

        foreach ($auth_methods as $method=>$val)
        {
            $s_smtp_auth_options .= '<option value="' . $method . '"' . (($selected_method == $method) ? ' selected="selected"' : '') . '>' . $val . '</option>';
        }

        return $s_smtp_auth_options;
    }
}
?>