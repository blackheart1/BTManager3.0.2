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
** File index.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}
else
{
    define("IN_BTM",true);
}
//die(mysqli_get_client_info());
require_once("common.php");
$template = new Template();
set_site_var($user->lang['INDEX']);
if($config['load_birthdays'])
{
	$birthday_list = '';
	$now = getdate(time() - date('Z'));
	$sql = "SELECT * FROM ".$db_prefix."_users WHERE ban = '0' AND birthday LIKE '" . $now['mday']."-". $now['mon']."-" . "%'";
    $result = $db->sql_query($sql) or btsqlerror($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        if($row["donator"] == 'true')$donator = true;
        else
        $donator = false;
		$img = '';
		if ($row["level"] == "premium") $img .= pic("icon_premium.gif",'','premium');
		elseif ($row["level"] == "moderator") $img .= pic("icon_moderator.gif",'','moderator');
		elseif ($row["level"] == "admin") $img .= pic("icon_admin.gif",'','admin');
		if($donator) $img .= '<img src="images/donator.gif" height="16" width="16" title="donator" alt="donator" />';
		if($row["warned"] == "1") $img .= '<img src="images/warning.gif" title="warned" alt="warned" />';

        $name = ($row['name'] == '' ? $row['username'] : $row['name']);
        $birthday_list .= (($birthday_list != '') ? ', ' : '') ."<a href=\"user.php?op=profile&amp;id=".$row["id"]."\"><font color=\"".getusercolor($row["can_do"])."\">{$name}</font></a>{$img}";
        if ($age = (int) substr($row['birthday'], -4))
        {
            $birthday_list .= ' (' . ($now['year'] - $age) . ')';
        }
    }
    $db->sql_freeresult($result);
    if($birthday_list!= '')
	{
		$birthday_list = $user->lang['HAPPY_BIRTHDAY'].$birthday_list;
	}
	else
	{
		$birthday_list = $user->lang['NO_BIRTHDAY'];
	}
	$template->assign_vars(array(
			'BIRTHDAY_LIST'            => $birthday_list,
	));
}
echo $template->fetch('index_body.html');
close_out();
?>