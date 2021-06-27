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
** File takeregister.php 2018-09-22 00:00:00 Thor
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

require_once("common.php");
$user->set_lang('profile',$user->ulanguage);
$template = new Template();
$errmsg = array();
$username                                               = utf8_normalize_nfc(request_var('username', '', true));
$password                                               = request_var('password', '');
$cpassword                                              = request_var('cpassword', '');
$email                                                  = request_var('email', '');
$disclaimer                                             = request_var('disclaimer', '');
$gfxcheck                                               = request_var('gfxcheck', '');
$gfxcode                                                = request_var('gfxcode', '');
        $recaptcha_response_field                                   = request_var('g-recaptcha-response', '');
        $recaptcha_challenge_field                                  = request_var('recaptcha_challenge_field', '');
        $recap_pass = true;
            if ($gfx_check AND $recap_puplic_key)
            {
                $ip = $_SERVER['REMOTE_ADDR'];
                $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recap_private_key."&response=".$recaptcha_response_field."&remoteip=".$ip);
                $responseKeys = json_decode($response,true);
                $recap_pass = intval($responseKeys["success"]) !== 1 ? false : true;
            }
		$data = array(
			'username'			=> $username,
			'new_password'		=> $password,
			'password_confirm'	=> $cpassword,
			'email'				=> strtolower($email),
		);
			$errmsg = validate_data($data, array(
				'username'			=> array(
					array('string', false, $config['min_name_chars'], $config['max_name_chars']),
					array('username', '')),
				'new_password'		=> array(
					array('string', false, $config['min_pass_chars'], $config['max_pass_chars']),
					array('password')),
				'password_confirm'	=> array('string', false, $config['min_pass_chars'], $config['max_pass_chars']),
				'email'				=> array(
					array('string', false, 6, 60),
					array('email')),
			));

			// Replace "error" strings with their real, localised form
			$errmsg = array_map(array($user, 'lang'), $errmsg);
			if (!sizeof($errmsg))
			{
				if ($data['new_password'] != $data['password_confirm'])
				{
					$errmsg[] = $user->lang['ERR_PASS_NOT_MATCH'];
				}
			}
			$config['limit_acn_ip'] = 0;
if (!isset($username) OR $username == "")
        $errmsg[] = $user->lang['NO_USERNAME_SET'];
if (!isset($password) OR $password == "")
        $errmsg[] = $user->lang['NO_PASSWORD_SET'];
if (!isset($email) OR $email == "")
        $errmsg[] = $user->lang['NO_EMAIL_SET'];
if (count($errmsg) == 0) {
        if ($config['limit_acn_ip'] AND $db->sql_numrows($db->sql_query("SELECT * FROM ".$db_prefix."_users WHERE lastip = '".sprintf("%u",ip2long(getip()))."';")) != 0)
                $errmsg[] = $user->lang['DUPE_IP'];
        if ($disclaimer_check AND $disclaimer != "yes")
                $errmsg[] = $user->lang['DISCL_NOT_ACCP'];
                #GFX Check
                if ($gfx_check AND $recap_puplic_key AND !$recap_pass)
                    {
                        $errmsg[] = $user->lang['SEC_CODE_ERROR'];
                    }
                elseif ($gfx_check AND !$recap_puplic_key AND (!isset($gfxcode) OR $gfxcode == "" OR $gfxcheck != md5(strtoupper($gfxcode))))
                    {
                        $errmsg[] = $user->lang['SEC_CODE_ERROR'] .$gfxcheck . ' = ' . md5(strtoupper($gfxcode));
                    }
}
if (count($errmsg) != 0){
              set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR_HEADER'          => $user->lang['SIGN_UP_ERROR'],
                                        'S_ERROR_MESS'            => implode("<br />",$errmsg),
                                ));
echo $template->fetch('error.html');
close_out();
}
    $username_clean = utf8_strtolower($username);

$sql = 'SELECT `group_id` FROM `'.$db_prefix.'_level_settings` WHERE `group_default` = 1 LIMIT 1 ';
$res = $db->sql_query($sql);
$default_group = $db->sql_fetchrow($res);
if($force_passkey){
                do {
                        $passkey = RandomAlpha(32);
                        //Check whether passkey already exists
                        $sql = "SELECT passkey FROM ".$db_prefix."_users WHERE passkey = '".$passkey."';";
                        $res = $db->sql_query($sql);
                        $cnt = $db->sql_numrows($sql);
                        $db->sql_freeresult($res);
                        $passkey = ", '".$passkey."'";
                } while ($cnt > 0);
                $passkeyrow = ', passkey';
                }else{
                $passkeyrow = NULL;
                $passkey = NULL;
                }
$act_key = RandomAlpha(32);
/*if ($use_rsa)
{
	$password = $rsa->encrypt($password);
}
else
{
	$password = md5($password);
}
die($password);*/
if($conferm_email)
$sql = "INSERT INTO ".$db_prefix."_users (username, clean_username, email, password, act_key, can_do, uploaded, regdate, user_type" . $passkeyrow . "        ) VALUES ('".$db->sql_escape($username)."', '".$db->sql_escape($username_clean)."', '".$db->sql_escape($email)."', '".md5($password)."', '".$act_key."', " . $default_group['group_id'] . ", '".$give_sign_up_credit."', NOW(), 1 " . $passkey .");";
else
$sql = "INSERT INTO ".$db_prefix."_users (username, clean_username, email, password, act_key, can_do, uploaded, regdate, user_type" . $passkeyrow . ", active) VALUES ('".$db->sql_escape($username)."', '".$db->sql_escape($username_clean)."', '".$db->sql_escape($email)."', '".md5($password)."', '".$act_key."', " . $default_group['group_id'] . ", '".$give_sign_up_credit."', NOW(), 0 " . $passkey .", 1);";
$db->sql_query($sql) or btsqlerror($sql);
$new_id = $db->sql_nextid();
$sql = "INSERT INTO `".$db_prefix."_user_group` (`group_id`, `user_id`, `group_leader`, `user_pending`) VALUES ('" . $default_group['group_id'] . "', '" . $new_id . "', '0', '0');";
$db->sql_query($sql) or btsqlerror($sql);
group_set_user_default($default_group['group_id'], array($new_id), false);

if($config['email_enable'] AND $conferm_email)
{
            $act_key = md5($act_key);
            require_once("include/class.email.php");
            include_once('include/function_messenger.php');
            include_once("include/utf/utf_tools.php");
                        $messenger = new messenger();
                        $messenger->template('regester', $language);
                        $messenger->to($email, $username);
                        $messenger->assign_vars(array(
                                    'SUB_JECT'              =>  sprintf($user->lang['ACCOUNTACTIVATESUB'],$sitename),
                                    'REG_URL'               =>  $siteurl . '/user.php?op=confirm&username=' . $username . '&act_key=' . $act_key,
                                    'U_NAME'                =>  $username ,
                                    'U_PASS_W'              =>  $password,
                                    ));
                        $messenger->send(0);
                        $messenger->save_queue();
                        $message = sprintf($user->lang['REG_SUCCESS_CONFERM'],spellmail($admin_email));
}else{
                meta_refresh(2, $siteurl . "/login.php");
                $message = $user->lang['REG_SUCCESS'];
                $sql = "INSERT INTO ".$db_prefix."_shouts (user, text, posted) VALUES ('1', '/notice <!-- swelcome --><img src=\"smiles/welcome.gif\" alt=\"welcome\" title=\"welcome\"><!-- swelcome -->  our newest Member ".$db->sql_escape($username)."', NOW());";
                $db->sql_query($sql);
}
              set_site_var('- '.$user->lang['USER_CPANNEL']);
$template->assign_vars(array(
        'S_SUCCESS'          => true,
        'TITTLE_M'           => $user->lang['SUCCESS'],
        'MESSAGE'            => $message,
));
echo $template->fetch('message_body.html');
close_out();

?>