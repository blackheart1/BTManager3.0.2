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
** File whos_online.php 2018-09-22 00:00:00 Thor
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

global $db_prefix, $user, $auth, $db, $shout_config,$template,$siteurl,$language,$pmbt_cache;
$user->set_lang('whos_online',$user->ulanguage);
if(!$pmbt_cache->get_sql("site_legend"))
{
	$legend = array();
	$sqlev = "SELECT group_id, group_name, group_colour, group_legend FROM ".$db_prefix."_level_settings";
	$reslev = $db->sql_query($sqlev);
	while ($rowlev = $db->sql_fetchrow($reslev))
	{
		if($rowlev['group_legend'] == 0)
		{
			continue;
		}
		$legend[] = array(
			"ID"              => $rowlev['group_id'],
			"NAME"              => (isset($user->lang[$rowlev['group_name']]))? $user->lang[$rowlev['group_name']] : $rowlev['group_name'],
			"COLOR"             => $rowlev['group_colour'],
		);
	}
}else{
$legend = $pmbt_cache->get_sql("site_legend");
}
foreach($legend as $val)
{
	$template->assign_block_vars('legend', $val);
}
$db->sql_freeresult($reslev);
$sql = "SELECT O.id AS id, O.page AS page, UNIX_TIMESTAMP(O.logged_in) AS logged_in, IF(U.name IS NULL, U.username, U.name) as name, U.lastpage as lastpage, U.donator AS donator, U.warned AS warned, U.can_do as can_do, U.level AS level, U.Show_online AS Show_online, U.uploaded as uploaded, U.downloaded AS downloaded FROM ".$db_prefix."_online_users O LEFT JOIN ".$db_prefix."_users U ON O.id = U.id WHERE UNIX_TIMESTAMP( NOW( ) ) - UNIX_TIMESTAMP( U.lastlogin )  < 1800 ;";
$res = $db->sql_query($sql);
$tot = $db->sql_numrows($res);
$i = 1;
$user_now = $db->sql_numrows($res);
if ($user_now == 0){
    $template->assign_vars(array(
    'S_USER_ON' => $user_now,
    'IS_USERS_ON' => false,
    ));

}else {
    $template->assign_vars(array(
    'S_USER_ON' => $user_now,
    'IS_USERS_ON' => true,
    ));
        while ($row = $db->sql_fetchrow($res)) {
   $template->assign_block_vars('user_online', array(
        "SHOW"              => ($row['Show_online'] == 'true' ) ? true : (($user->admin) ? true : false),
        "SHOW_ICON"         => ($row['Show_online'] == 'false' ) ? false : true,
        "LEVEL_ICON"        => ($row["level"] == "admin") ? pic("icon_admin.gif",'','admin') : (($row["level"] == "moderator") ? pic("icon_moderator.gif",'','moderator') : (($row["level"] == "premium") ?  pic("icon_premium.gif",'','premium') : '')),
        "ID"                => $row['id'],
        "USERNAME"          => htmlspecialchars($row["name"]),
        "DONER"             => ($row["donator"] == 'true') ? true : false,
        "WARNED"            => ($row["warned"] == '1') ? true : false,
        "RATIO"             => get_u_ratio($row["uploaded"], $row["downloaded"]),
        "COLOR"             => getusercolor($row["can_do"]),
        "LAST_PAGE"         => getlastaction($row['lastpage']),
        "ON_TIME"           => mkprettytime(time()-$row["logged_in"]),
        ));
        }
}
$db->sql_freeresult($res);
$statstot = array();
if(!$pmbt_cache->get_sql("site_stats")){
        //Total users
        $sql = "SELECT COUNT(id) FROM ".$db_prefix."_users WHERE `active` = 1 AND UNIX_TIMESTAMP(lastlogin) > UNIX_TIMESTAMP(NOW()) - 86400;";
        $res = $db->sql_query($sql);
        list ($totuser) = $db->fetch_array($res);
		$statstot['ON_NOW'] = $totuser;
        $db->sql_freeresult($res);
        //Total users
        $sql = "SELECT COUNT(id) FROM ".$db_prefix."_users WHERE `active` = 1 AND UNIX_TIMESTAMP(regdate) > UNIX_TIMESTAMP(NOW()) - 86400*7;";
        $res = $db->sql_query($sql);
        list ($totuser) = $db->fetch_array($res);
		$statstot['ON_REG_WEEK'] = $totuser;
        $db->sql_freeresult($res);
        //Total users
        $sql = "SELECT COUNT(id) FROM ".$db_prefix."_users WHERE `active` = 1 AND UNIX_TIMESTAMP(regdate) > UNIX_TIMESTAMP(NOW()) - 86400;";
        $res = $db->sql_query($sql);
        list ($totuser) = $db->fetch_array($res);
		$statstot['ON_REG_DAY'] = $totuser;
        $db->sql_freeresult($res);
        //Total users
        $sql = "SELECT COUNT(id) FROM ".$db_prefix."_users WHERE `active` = 1;";
        $res = $db->sql_query($sql);
        list ($totuser) = $db->fetch_array($res);
		$statstot['TOTAL_USERS'] = $totuser;
        $db->sql_freeresult($res);
        //Total Torrents and their size
        $sql = "SELECT COUNT(id), SUM(size) FROM ".$db_prefix."_torrents;";
        $res = $db->sql_query($sql);
        list ($tottorrent, $totshare) = $db->fetch_array($res);
		$statstot['TOTTAL_TORRENTS'] = $tottorrent;
		$statstot['TOTAL_DATA'] = mksize($totshare);
        $db->sql_freeresult($res);
        //Total peers and their speed
        $sql = "SELECT COUNT(id), (SUM(upload_speed)+SUM(download_speed))/2 FROM ".$db_prefix."_peers;";
        $res = $db->sql_query($sql);
        list ($totpeers, $totspeed) = $db->fetch_array($res);
        $db->sql_freeresult($res);
        //Total seeders and total leechers
        $sql = "SELECT COUNT(id) FROM ".$db_prefix."_peers GROUP BY seeder ORDER BY seeder ASC;";
        $res = $db->sql_query($sql);
        list ($totseeders) = $db->fetch_array($res);
        list ($totleechers) = $db->fetch_array($res);
		$statstot['TOTTAL_SEEDERS'] = (int)$totseeders;
		$statstot['TOTAL_LEACHERS'] = (int)$totleechers;
		$statstot['TOTAL_PEERS'] = ($totleechers+$totseeders);
		$statstot['TRANSFER_SPEED'] = mksize($totspeed);
        $db->sql_freeresult($res);
        $sql = "SELECT COUNT(id) as cnt, client FROM ".$db_prefix."_peers WHERE client IS NOT NULL GROUP BY client ORDER BY cnt DESC LIMIT 1;";
        $res = $db->sql_query($sql);
        list ($cnt, $client) = $db->fetch_array($res);
		$statstot['MOST_CLIENTS'] = ($cnt)?$client : 'N/A';
		$statstot['M_CLIENT_CO'] = (int)$cnt;
        $db->sql_freeresult($res);
$pmbt_cache->set_sql("site_stats", $statstot);
}else{
$statstot = $pmbt_cache->get_sql("site_stats");
}
$template->assign_vars($statstot);
echo $template->fetch('whos_online.html');

?>