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
class acp_overall_settings
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

		$form_key = 'acp_overall_settings';
		add_form_key($form_key);
		$config['time_zone'] = $pmbt_time_zone;

		/**
		*	Validation types are:
		*		string, int, bool, array,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writable), path (relative path, but able to escape the root), wpath (writable)
		*/
				$display_vars = array(
					'title'	=> '_admconfigttl',
					'vars'	=> array(
						'legend'							=> 'SITE_SETTINGS',
                        'sitename'   					=> array('lang' => '_admpsitename',			'validate' => 'string', 	'type' => 'text:65:50',		'explain' => true),
						'on_line'						=> array('lang' => '_admpon_line',			'validate' => 'bool',		'type' => 'custom', 		'method' =>		'board_disable', 	'explain' => true),
                        'off_line_mess'   				=> array('lang' => '_admpoff_line_mess',	'validate' => 'string', 	'type' => 'text:65:255',	'explain' => true),
                        'siteurl'   					=> array('lang' => '_admpsiteurl',			'validate' => 'string', 	'type' => 'text:65:50', 	'explain' => true),
                        'cookiedomain'   				=> array('lang' => '_admpcookiedomain',		'validate' => 'string', 	'type' => 'text:65:50', 	'explain' => true),
                        'cookiepath'   					=> array('lang' => '_admpcookiepath',   	'validate' => 'string', 	'type' => 'text:65:50', 	'explain' => true),
                        'sourcedir'   					=> array('lang' => '_admpsourcedir',   		'validate' => 'string', 	'type' => 'text:65:50', 	'explain' => true),
                        'admin_email'   				=> array('lang' => '_admpadmin_email',   	'validate' => 'string', 	'type' => 'text:65:50', 	'explain' => true),
                        'time_zone'   					=> array('lang' => '_admptime_zone',   		'validate' => 'timezone', 	'type' => 'custom', 		'method' =>		'timezone_select', 	'explain' => true),
                        'language'   					=> array('lang' => '_admplanguage',   		'validate' => 'language', 	'type' => 'custom', 		'method' => 	'language_select', 	'explain' => true),
                        'theme'   						=> array('lang' => '_admptheme',  			'validate' => 'theme', 		'type' => 'custom', 		'method' => 	'style_select', 	'explain' => true),
                        'welcome_message'   			=> array('lang' => '_admpwelcome_message',  'validate' => 'string', 	'type' => 'custom', 		'method' => 	'ac_textarea', 		'explain' => true),
                        'announce_ments'   				=> array('lang' => '_admpannounce_ments',   'validate' => 'string',		'type' => 'text:65:50', 	'explain' => true),
						'rewrite_engine'				=> array('lang' => '_admprewrite_engine',	'validate' => 'bool',		'type' => 'radio:yes_no', 	'explain' => true),
						'pivate_mode'					=> array('lang' => '_admppivate_mode',		'validate' => 'bool',		'type' => 'radio:yes_no', 	'explain' => true),
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
	* Board disable option and message
	*/
	function board_disable($value, $key)
	{
		global $module;
		$radio_ary = array(1 => 'YES', 0 => 'NO');

		return h_radio('config[board_disable]', $radio_ary, $value) . '<br /><input id="' . $key . '" type="text" name="config[board_disable_msg]" maxlength="255" size="40" value="' . $module->new_config['board_disable_msg'] . '" />';
	}
	function timezone_select($value, $key = '')
	{
		global $template, $user;
		$timezone_identifiers = DateTimeZone::listIdentifiers();
		$s_timezone_select = '';
        foreach ($timezone_identifiers as $method=>$val)
        {
		$s_timezone_select .= '<option value="' . $val . '"' . (($value == $val) ? ' selected="selected"' : '') . '>' . $val . '</option>';
        }
		return '<select name="config[' . $key . ']" id="' . $key . '">' . $s_timezone_select . '</select>';
	}
	function language_select($value, $key = '')
	{
		global $template, $user;
                    $languages = Array();
                    $langdir = "language/common";
                    $langhandle = opendir($langdir);
                    while ($langfile = readdir($langhandle)) {
                            if (preg_match("/.php/",$langfile) AND strtolower($langfile) != "mailtexts.php")
                                    $languages[str_replace(".php","",$langfile)] = ucwords(str_replace(".php","",$langfile));
                    }
                    closedir($langhandle);
                    unset($langdir,$langfile);
		$s_language_select = '';
        foreach ($languages as $method=>$val)
        {
		$s_language_select .= '<option value="' . $method . '"' . (($value == $method) ? ' selected="selected"' : '') . '>' . $val . '</option>';
        }
		return '<select name="config[' . $key . ']" id="' . $key . '">' . $s_language_select . '</select>';
	}
	function style_select($value, $key = '')
	{
		global $template, $user;
                    $themes = Array();
                    $thememaindir = "themes";
                    $themehandle = opendir($thememaindir);
                    while ($themedir = readdir($themehandle)) {
                            if (is_dir($thememaindir."/".$themedir) AND $themedir != "." AND $themedir != ".." AND $themedir != "CVS")
                                    $themes[$themedir] = $themedir;
                    }
                    closedir($themehandle);
                    unset($thememaindir,$themedir);
		$s_style_select = '';
        foreach ($themes as $method=>$val)
        {
		$s_style_select .= '<option value="' . $val . '"' . (($value == $val) ? ' selected="selected"' : '') . '>' . $val . '</option>';
        }
		return '<select name="config[' . $key . ']" id="' . $key . '">' . $s_style_select . '</select>';
	}
	function ac_textarea($value, $key = '')
	{
		global $template, $user,$theme;
        include_once('include/function_posting.php');
        include_once('include/message_parser.php');
        include_once('include/class.bbcode.php');
        generate_smilies('inline', 0);
		display_custom_bbcodes(24);
				$template->assign_vars(array(
				'S_TEXT'			=> $value,
				'T_AREA'			=> 'config[' . $key . ']',
				'U_MORE_SMILIES'	=> 'forum.php?action=posting&mode=smilies&amp;f=0',
                            'S_SMILIES_ALLOWED'         =>  true,
                            'S_SHOW_SMILEY_LINK'        => true,
                            'S_BBCODE_ALLOWED'          => true,
                            'T_TEMPLATE_PATH'           => 'themes/' . $theme . '/templates',
                            'S_BBCODE_QUOTE'            => true,
                            'S_BBCODE_IMG'              => true,
                            'S_LINKS_ALLOWED'           => true,
                            'S_BBCODE_FLASH'            => true,
				));
				return $template->fetch('text_area.html');		
	}
}
?>