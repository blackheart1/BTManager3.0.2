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
** File acp_overall_settings.php 2021-02-08 14:32:00 Black_Heart
**
** CHANGES
**
** 2021-02-08 - Created New File
**/


if (!defined('IN_BTM'))
{
	include_once './../../security.php';
	die ("You can't access this file directly");
}
class acp_forum_settings
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config,$db_prefix, $phpEx;
		global $pmbt_cache, $site_announce, $pmbt_time_zone;
		$user->set_lang('admin/acp_site_settings',$user->ulanguage);

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$form_key = 'acp_forum_settings';
		add_form_key($form_key);

		/**
		*	Validation types are:
		*		string, int, bool, array,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writable), path (relative path, but able to escape the root), wpath (writable)
		*/
				$display_vars = array(
					'title'	=> 'FORUM_CONF',
					'vars'	=> array(
						'legend'							=> 'GENERAL_SETTINGS',
						'forum_open'			=> array('lang' => '_admpforum_open',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'board_disable_msg'		=> array('lang' => '_admpboard_disable_msg',		'validate' => 'string',			'type' => 'text:40:255', 'explain' => true),
						'load_db_lastread'		=> array('lang' => 'YES_READ_MARKING',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_db_track'			=> array('lang' => 'YES_POST_MARKING',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'load_moderators'		=> array('lang' => 'YES_MODERATORS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_jumpbox'			=> array('lang' => 'YES_JUMPBOX',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'load_onlinetrack'		=> array('lang' => 'YES_ONLINE_TRACK',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_bbcode'			=> array('lang' => 'ALLOW_BBCODE',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_signatures'				=> array('lang' => 'ALLOW_SIG',				'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_board_notifications'		=> array('lang' => 'ALLOW_BOARD_NOTIFICATIONS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_nocensors'		=> array('lang' => 'ALLOW_NO_CENSORS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_post_flash'		=> array('lang' => 'ALLOW_POST_FLASH',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_smilies'			=> array('lang' => 'ALLOW_SMILIES',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_post_links'		=> array('lang' => 'ALLOW_POST_LINKS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_attachments'		=> array('lang' => 'ALLOW_ATTACHMENTS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_nocensors'		=> array('lang' => 'ALLOW_NO_CENSORS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_bookmarks'		=> array('lang' => 'ALLOW_BOOKMARKS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'enable_post_confirm'	=> array('lang' => 'VISUAL_CONFIRM_POST',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'allow_quick_reply'		=> array('lang' => 'ALLOW_QUICK_REPLY',		'validate' => 'bool',	'type' => 'custom', 'method' => 'quick_reply', 'explain' => true),
						'allow_forum_notify'	=> array('lang' => 'ALLOW_FORUM_NOTIFY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'allow_topic_notify'	=> array('lang' => 'ALLOW_TOPIC_NOTIFY',	'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => false),
						'board_hide_emails'		=> array('lang' => 'BOARD_HIDE_EMAILS',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'legend2'				=> 'POSTING',
						'edit_time'				=> array('lang' => 'EDIT_TIME',				'validate' => 'int:0:99999',		'type' => 'number:0:99999', 'explain' => true, 'append' => ' ' . $user->lang['MINUTES']),
						'delete_time'			=> array('lang' => 'DELETE_TIME',			'validate' => 'int:0:99999',		'type' => 'number:0:99999', 'explain' => true, 'append' => ' ' . $user->lang['MINUTES']),
						'display_last_edited'	=> array('lang' => 'DISPLAY_LAST_EDITED',	'validate' => 'bool',		'type' => 'radio:yes_no', 'explain' => true),
						'flood_interval'		=> array('lang' => 'FLOOD_INTERVAL',		'validate' => 'int:0:9999999999',		'type' => 'number:0:9999999999', 'explain' => true, 'append' => ' ' . $user->lang['SECONDS']),
						'bump_interval'			=> array('lang' => 'BUMP_INTERVAL',			'validate' => 'int:0',		'type' => 'custom', 'method' => 'bump_interval', 'explain' => true),
						'topics_per_page'		=> array('lang' => 'TOPICS_PER_PAGE',		'validate' => 'int:1:9999',		'type' => 'number:1:9999', 'explain' => false),
						'posts_per_page'		=> array('lang' => 'POSTS_PER_PAGE',		'validate' => 'int:1:9999',		'type' => 'number:1:9999', 'explain' => false),
						'topics_per_page'		=> array('lang' => 'TOPICS_PER_PAGE',		'validate' => 'int:1:9999',		'type' => 'number:1:9999', 'explain' => false),
						'posts_per_page'		=> array('lang' => 'POSTS_PER_PAGE',		'validate' => 'int:1:9999',		'type' => 'number:1:9999', 'explain' => false),
						'smilies_per_page'		=> array('lang' => 'SMILIES_PER_PAGE',		'validate' => 'int:1:9999',		'type' => 'number:1:9999', 'explain' => false),
						'hot_threshold'			=> array('lang' => 'HOT_THRESHOLD',			'validate' => 'int:0:9999',		'type' => 'number:0:9999', 'explain' => true),
						'max_poll_options'		=> array('lang' => 'MAX_POLL_OPTIONS',		'validate' => 'int:2:127',	'type' => 'number:2:127', 'explain' => false),
						'max_post_chars'		=> array('lang' => 'CHAR_LIMIT',			'validate' => 'int:0:999999',		'type' => 'number:0:999999', 'explain' => true),
						'min_post_chars'		=> array('lang' => 'MIN_CHAR_LIMIT',		'validate' => 'int:1:999999',		'type' => 'number:1:999999', 'explain' => true),
						'max_post_smilies'		=> array('lang' => 'SMILIES_LIMIT',			'validate' => 'int:0:9999',		'type' => 'number:0:9999', 'explain' => true),
						'max_post_urls'			=> array('lang' => 'MAX_POST_URLS',			'validate' => 'int:0:9999',		'type' => 'number:0:9999', 'explain' => true),
						'max_post_font_size'	=> array('lang' => 'MAX_POST_FONT_SIZE',	'validate' => 'int:0:9999',		'type' => 'number:0:9999', 'explain' => true, 'append' => ' %'),
						'max_quote_depth'		=> array('lang' => 'QUOTE_DEPTH_LIMIT',		'validate' => 'int:0:9999',		'type' => 'number:0:9999', 'explain' => true),
						'max_post_img_width'	=> array('lang' => 'MAX_POST_IMG_WIDTH',	'validate' => 'int:0:9999',		'type' => 'number:0:9999', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),
						'max_post_img_height'	=> array('lang' => 'MAX_POST_IMG_HEIGHT',	'validate' => 'int:0:9999',		'type' => 'number:0:9999', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),

						'legend3'					=> 'ACP_SUBMIT_CHANGES',
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
				//set_config($config_name, $config_value);
			}
		}
			if ($submit)
			{
				trigger_error($user->lang['CONFIG_UPDATED_TRACKER'] . adm_back_link($this->u_action));
			}
		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . 'explain'],

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

	/**
	* Global quick reply enable/disable setting and button to enable in all forums
	*/
	function quick_reply($value, $key)
	{
		global $user;

		$radio_ary = array(1 => 'YES', 0 => 'NO');

		return h_radio('config[allow_quick_reply]', $radio_ary, $value) .
			'<br /><br /><input class="button2" type="submit" id="' . $key . '_enable" name="' . $key . '_enable" value="' . $user->lang['ALLOW_QUICK_REPLY_BUTTON'] . '" />';
	}
}
?>