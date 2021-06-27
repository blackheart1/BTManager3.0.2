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
** File acp_user_signup.php 2018-09-15 14:32:00 Black_Heart
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
class acp_user_signup
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config,$db_prefix, $phpEx;
		global $pmbt_cache;
		$user->set_lang('admin/acp_site_settings',$user->ulanguage);

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$form_key = 'acp_user_signup';
		add_form_key($form_key);

		/**
		*	Validation types are:
		*		string, int, bool,
		*		script_path (absolute path in url - beginning with / and no trailing slash),
		*		rpath (relative), rwpath (realtive, writable), path (relative path, but able to escape the root), wpath (writable)
		*/
		$display_vars = array(
			'title'	=> 'ACP_REGISTER_SETTINGS',
			'vars'	=> array(
				'legend1'						=> 'SITE_SETTINGS',
				'max_name_chars'				=> array('lang' => 'USERNAME_LENGTH', 'validate' => 'int:8:180', 'type' => false, 'method' => false, 'explain' => true,),
				'max_pass_chars'				=> array('lang' => 'PASSWORD_LENGTH', 'validate' => 'int:8:255', 'type' => false, 'method' => false, 'explain' => true,),
				'min_name_chars'				=> array('lang' => 'USERNAME_LENGTH',	'validate' => 'int:1',	'type' => 'custom:5:180', 'method' => 'username_length', 'explain' => true),
				'min_pass_chars'				=> array('lang' => 'PASSWORD_LENGTH',	'validate' => 'int:1',	'type' => 'custom', 'method' => 'password_length', 'explain' => true),
				'allow_name_chars'				=> array('lang' => 'USERNAME_CHARS',	'validate' => 'string',	'type' => 'select', 'method' => 'select_username_chars', 'explain' => true),
				'pass_complex'					=> array('lang' => 'PASSWORD_TYPE',		'validate' => 'string',	'type' => 'select', 'method' => 'select_password_chars', 'explain' => true),
				'conferm_email'					=> array('lang' => '_admpconferm_email',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'disclaimer_check'				=> array('lang' => '_admpdisclaimer_check',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'limit_acn_ip'					=> array('lang' => '_admplimit_acn_ip',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'allow_change_email'			=> array('lang' => '_admpallow_change_email',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'force_passkey'					=> array('lang' => '_admpforce_passkey',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'give_sign_up_credit'			=> array('lang' => '_admpgive_sign_up_credit',		'validate' => 'int:0',	'type' => 'text:20:50', 'explain' => true, 'append' => ' ' . $user->lang['BYTES']),
				'invites_open'					=> array('lang' => '_admpinvites_open',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'invite_only'					=> array('lang' => '_admpinvite_only',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
				'max_members'					=> array('lang' => '_admpmax_members',	'validate' => 'int:0',	'type' => 'text:20:50', 'explain' => true),
				'legend3'                   => 'ACP_SUBMIT_CHANGES',
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
            	add_log('admin', 'LOG_CONFIG_REGISTRATION');
				set_config($config_name, $config_value);
				trigger_error($user->lang['_admsaved'] . adm_back_link($this->u_action));
			}
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

	function select_username_chars($selected_value, $key)
	{
		global $user;

		$user_char_ary = array('USERNAME_CHARS_ANY', 'USERNAME_ALPHA_ONLY', 'USERNAME_ALPHA_SPACERS', 'USERNAME_LETTER_NUM', 'USERNAME_LETTER_NUM_SPACERS', 'USERNAME_ASCII');
		$user_char_options = '';
		foreach ($user_char_ary as $user_type)
		{
			$selected = ($selected_value == $user_type) ? ' selected="selected"' : '';
			$user_char_options .= '<option value="' . $user_type . '"' . $selected . '>' . $user->lang[$user_type] . '</option>';
		}

		return $user_char_options;
	}

	function select_password_chars($selected_value, $key)
	{
		global $user;

		$pass_type_ary = array('PASS_TYPE_ANY', 'PASS_TYPE_CASE', 'PASS_TYPE_ALPHA', 'PASS_TYPE_SYMBOL');
		$pass_char_options = '';
		foreach ($pass_type_ary as $pass_type)
		{
			$selected = ($selected_value == $pass_type) ? ' selected="selected"' : '';
			$pass_char_options .= '<option value="' . $pass_type . '"' . $selected . '>' . $user->lang[$pass_type] . '</option>';
		}

		return $pass_char_options;
	}
	function username_length($value, $key = '')
	{
		global $user, $module;

		return '<input id="' . $key . '" type="text" size="3" maxlength="3" name="config[min_name_chars]" value="' . $value . '" /> ' . $user->lang['MIN_CHARS'] . '&nbsp;&nbsp;<input type="text" size="3" maxlength="3" name="config[max_name_chars]" value="' . $module->new_config['max_name_chars'] . '" /> ' . $user->lang['MAX_CHARS'];
	}
	function password_length($value, $key)
	{
		global $user, $module;

		return '<input id="' . $key . '" type="text" size="3" maxlength="3" name="config[min_pass_chars]" value="' . $value . '" /> ' . $user->lang['MIN_CHARS'] . '&nbsp;&nbsp;<input type="text" size="3" maxlength="3" name="config[max_pass_chars]" value="' . $module->new_config['max_pass_chars'] . '" /> ' . $user->lang['MAX_CHARS'];
	}
}
?>