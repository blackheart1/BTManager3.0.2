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
** File include/cleanup.php 2018-09-22 00:00:00 Thor
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

if(defined('BTM_DEBUG'))error_reporting(E_ALL);
else
error_reporting(0);
if (isset($autoscrape)) {
    include_once("include/bdecoder.php");
    include_once("include/torrent_functions.php");
}
/*Auto Prommote system By joeroberts
To Use call to function in clean up You Must use a new call for each level you want to Promote
autopromote(10,2,1.1,"Power User","user");
autpromote(
$upload = user with upload equle or greater then
$bite = Type of byte Meg Gig Tera
$ratio = user with ratio equle or better then
$new_level = New level to promote to
$old_level = select from user in this level
)
*/
function autopromote($upload, $bite="1", $ratio, $new_level, $old_level){
       global $db, $db_prefix;
$mb = 1024*1024;
$gb = 1024*1024*1024;
$tb = 1024*1024*1024*1024;
if ($bite == '1')
    $upload = $mb*$upload;
elseif ($bite == '2')
    $upload = $gb*$upload;
elseif ($bite == '3')
    $upload = $tb*$upload;
else return;
    $res1 ="SELECT id FROM ".$db_prefix."_users WHERE  can_do = '".$old_level."' AND active = 1 AND uploaded >= $upload AND uploaded / downloaded >= $ratio AND warned = '0'" ;
$res =$db->sql_query($res1)or btsqlerror($res1);
    $prouser = array();
       while ($arr = $db->sql_fetchrow($res))
       {
        $prouser[] = $arr['id'];
}
$db->sql_freeresult($res);
if(count($prouser) > 0)
  $db->sql_query("UPDATE ".$db_prefix."_users SET  can_do ='".$new_level."' WHERE id IN ( '".implode("','",$prouser)."')") or btsqlerror("UPDATE ".$db_prefix."_users SET  can_do ='".$level."' WHERE id IN ( '".implode("','",$prouser)."')");
}
/*Auto Demotion system By joeroberts
To Use call to function in clean up You Must use a new call for each level you want to demote
autodemote(1.0, "user", "Power User");
autodemote(
$ratio = user with ratio less then
$new_level New Level for user
$old_level Level From sich to demote from
)
*/
function autodemote($ratio, $new_level, $old_level)
{
    global $db, $db_prefix;
    $res1 ="SELECT id FROM ".$db_prefix."_users WHERE  can_do = '".$old_level."' AND active = 1 AND uploaded / downloaded < $ratio AND warned = '0'" ;
    $res =$db->sql_query($res1)or btsqlerror($res1);
    $prouser = array();
    while ($arr = $db->sql_fetchrow($res))
    {
        $prouser[] = $arr['id'];
    }
    $db->sql_freeresult($res);
    if(count($prouser) > 0)
    $db->sql_query("UPDATE ".$db_prefix."_users SET  can_do ='".$new_level."' WHERE id IN ( '".implode("','",$prouser)."')") or btsqlerror("UPDATE ".$db_prefix."_users SET  can_do ='".$level."' WHERE id IN ( '".implode("','",$prouser)."')");
}
function autoinvites($length, $minlimit, $maxlimit, $minratio, $invites)
{
    global $db, $db_prefix;
    $minlimit = 1024*1024*1024*$minlimit;
    $maxlimit = 1024*1024*1024*$maxlimit;
    $res = $db->sql_query("SELECT id, invites FROM ".$db_prefix."_users WHERE  active = 1 AND downloaded >= $minlimit AND downloaded < $maxlimit AND uploaded / downloaded >= $minratio AND warned = '0' AND invites < 10 AND UNIX_TIMESTAMP(invitedate) < UNIX_TIMESTAMP(NOW()) - $length*86400") ;
    if ($db->sql_numrows($res) > 0)
    {
        while ($arr = $db->sql_fetchrow($res))
        {
            if ($arr['invites'] == 9)
            $invites = 1;
            elseif ($arr['invites'] == 8 && $invites == 3)
            $invites = 2;
            $db->sql_query("UPDATE ".$db_prefix."_users SET invites = invites + ".$invites.", invitedate = NOW() WHERE id='".$arr['id']."'") ;
        }
    }
}
function cleanup() {
         global $db, $db_prefix, $admin_email, $user, $sourcedir, $btuser, $autoscrape,$most_users_online , $dead_torrent_interval, $announce_interval;
         global $down_limit, $autodel_users, $sitename, $autodel_users_time, $inactwarning_time, $siteurl,$forumbase,$phpEx, $config, $shout_config,$time_tracker_update, $pmbt_cache;
        set_include_path($sourcedir);
        ini_set('include_path',$sourcedir);
        //most users online
        $sql = "SELECT COUNT(id)as num_users  FROM ".$db_prefix."_online_users";
        $sql_count = $db->sql_query($sql)or die(print_r('asd'));
        $numbero = (int)$db->sql_fetchfield('num_users');
        $db->sql_freeresult($sql_count);
        if($most_users_online < $numbero)
        {
        $db->sql_query("UPDATE ".$db_prefix."_config SET `most_on_line` = '".$numbero."', `when_most` = NOW()");
        }
//clean up donations
    $sql = "SELECT COUNT(DISTINCT username) as name
    FROM ".$db_prefix."_users
    WHERE donator = 'true'";
    $res = $db->sql_query($sql);
    $doners = (int) $db->sql_fetchfield('name');
    $db->sql_freeresult($res);
   if ($doners > 0) {
    $sql2 = "SELECT  id, dondate, donator_tell
    FROM ".$db_prefix."_users
    WHERE donator = 'true'
    AND UNIX_TIMESTAMP(donator_tell) > UNIX_TIMESTAMP(NOW())";
    $res2 = $db->sql_query($sql2);
    while ($arr = $db->sql_fetchrow($res2)) {
    $donatedate = $arr['dondate'];
    $doner_tell = $arr['donator_tell'];
    $uid = $arr['id'];
       if(get_date_time(gmtime()) >= $doner_tell){
       $db->sql_query("UPDATE ".$db_prefix."_users SET `dondate`= '0000-00-00 00:00:00', `donator_tell`='0000-00-00 00:00:00', `donator`= 'false', `dongift`=0 WHERE `id` = ".$uid.";");
       }
    }
  }
  unset($sql,$res,$arr,$uid,$donatedate,$doner_tell);

  //Cleean Hit and Runners

$hnr_sql = "SELECT `hnr_system`, `seedtime`, `time_before_warn`, `maxhitrun`, `warnlength`, demote_hnr_users, ban_hnr_users FROM `".$db_prefix."_hit_n_run` ";
        $hnr_sql1=$db->sql_query($hnr_sql);
        $rowhnr = $db->sql_fetchrow($hnr_sql1);
        $db->sql_freeresult($hnr_sql);
        $hnr_system = $rowhnr['hnr_system'];
        $warnlength = $rowhnr['warnlength'];
        $maxhitrun = $rowhnr['maxhitrun'];
        $seedtime = $rowhnr['seedtime']*60;
        $demote_hnr = $rowhnr['demote_hnr_users'];
        $time_before_warn = ($rowhnr['time_before_warn']*60);
        $warnlength = ($rowhnr['warnlength']*60*60*24);
        $timedelay = time()-($announce_interval+$time_before_warn);
if($hnr_system == 'true')
{
    include_once('include/function_posting.php');
    // Message users who have hit and run
    $dohr = false;
    $sqlc = "SELECT COUNT(s.id)as hrcount  FROM ".$db_prefix."_snatched AS s INNER JOIN ".$db_prefix."_torrents AS t ON s.torrentid = t.id WHERE s.userid <> t.owner AND `completedat` > '0000-00-00 00:00:00' AND `completedat` > '2009-12-01 17:53:50' AND `seeding_time` > '0' AND `seeding_time` < '".$seedtime."' AND s.`downloaded` > s.`uploaded` AND `seeder` = 'no'  AND s.last_action < '".get_date_time(gmtime() - ($announce_interval+$time_before_warn))."' AND hitrunwarn = 'no'";
    $resc = $db->sql_query($sqlc)or btsqlerror($sqlc);
    while ($arrc = $db->sql_fetchrow($resc)) {
        $dohr = true;
    }
    $sql = "SELECT s.id, userid, torrentid, t.name FROM ".$db_prefix."_snatched AS s INNER JOIN ".$db_prefix."_torrents AS t ON s.torrentid = t.id WHERE s.userid <> t.owner AND `completedat` > '0000-00-00 00:00:00' AND `completedat` > '2009-01-27 17:53:50' AND `seeding_time` > '0' AND `seeding_time` < '".$seedtime."' AND s.`downloaded` > s.`uploaded` AND `seeder` = 'no'  AND s.last_action < '".get_date_time(gmtime() - ($announce_interval+$time_before_warn))."' AND hitrunwarn = 'no'";
    $res = $db->sql_query($sql)or btsqlerror($sql);
    if ($dohr)
    {
        $ids = $userids = $hitrun = array();
        while ($arr = $db->sql_fetchrow($res))
        {
            if(hitrun($arr['userid']))
            {
                $ids[] = $arr["id"];
                $userids[] = $arr["userid"];
                if(!isset($hitrun[$arr["userid"]]))$hitrun[$arr["userid"]] = 0;
                $hitrun[$arr["userid"]]++;
                if(!isset($torrents[$arr["userid"]]))$torrents[$arr["userid"]] = '';
                $torrents[$arr["userid"]] .= "\n[b][url=".$siteurl."/details.php?id=$arr[torrentid]]".addslashes($arr['name'])."[/url][/b]";
            }
        }
        $userids = array_unique($userids);
        foreach($userids as $userid)
        {
            $hnrtorrents = $torrents[$userid];
            $hnrtot = $hitrun[$userid];
            $hnrcount = ($hitrun[$userid] == 1 ? "" : "s");
            $these = ($hitrun[$userid] == 1 ? "this" : "these");
            $is = ($hitrun[$userid] == 1 ? "is" : "are");
            $msg = str_replace(array("{hnrtot}","{hnrcount}","{these}","{is}","{hnrtorrents}"),array($hnrtot,$hnrcount,$these,$hnrtorrents),$user->lang['HNR_NOTICE_PM']);
            system_pm($msg,$user->lang['HIT_N_RUN'],$userid,'');
            //$db->sql_query("INSERT INTO ".$db_prefix."_private_messages (sent, sender, recipient, subject, text) VALUES (NOW(), 0, $userid, 'Hit and Run', '$msg')") ;
        }
        if(sizeof($ids) != 0)$db->sql_query("UPDATE ".$db_prefix."_snatched SET hitrunwarn = 'pending' WHERE id IN (".implode(", ", $ids).")") or sqlerr();
    }
    // Process hit and runs of users that have not returned
    $sql = "SELECT id, userid FROM ".$db_prefix."_snatched WHERE hitrunwarn = 'pending' AND last_action < '".get_date_time(gmtime() - ($announce_interval+$time_before_warn))."'";
    $res = $db->sql_query($sql);
    if ($db->sql_numrows($res) > 0)
    {
        $ids = $userids = array();
        while ($arr = $db->sql_fetchrow($res))
        {
            $ids[] = $arr["id"];
            $userids[] = $arr["userid"];
            if(!isset($hitrun[$arr["userid"]]))$hitrun[$arr["userid"]] = 0;
            $hitrun[$arr["userid"]]++;
        }
        $userids = array_unique($userids);
        foreach($userids as $userid)
        $db->sql_query("UPDATE ".$db_prefix."_users SET hitruns = hitruns + $hitrun[$userid], hitrun = '".get_date_time()."' WHERE id = $userid");
        $db->sql_query("UPDATE ".$db_prefix."_snatched SET hitrunwarn = 'yes', hitrun = '".get_date_time()."' WHERE id IN (".implode(", ", $ids).")");
    }
    // Warn repeating hit and runners
    $sql = "SELECT id FROM ".$db_prefix."_users WHERE hitruns > $maxhitrun AND hitrun > '".get_date_time(gmtime() - ($announce_interval+$time_before_warn))."' AND warned = '0'";
    $res = $db->sql_query($sql);
    if ($db->sql_numrows($res) > 0)
    {
        $userids = array();
        $modcomment = addslashes($user->lang['MOD_HNR_COMENT_ADD']);
        $msg = $user->lang['HNR_WARN_PM'];
        while ($arr = $db->sql_fetchrow($res))
        {
            $userids[] = $arr["id"];
            system_pm($msg,$user->lang['HIT_N_RUN'],$arr['id'],'');
            $db->sql_query("UPDATE ".$db_prefix."_users SET warned = '1', " . (($demote_hnr =='true')? 'can_do = \'21\', ' : '') . "warn_kapta='" . strtotime(gmdate("Y-m-d H:i:s", time())) . "', warn_hossz = warn_hossz + '".$warnlength."', modcomment = CONCAT('$modcomment', modcomment), hitruns = 0, HNR_W = HNR_W + '1' WHERE id = '" . $arr["id"] . "'");
            if($demote_hnr =='true'){
                $sql = "INSERT INTO `".$db_prefix."_user_group` (`group_id`, `user_id`, `group_leader`, `user_pending`) VALUES ('21', '" . $arr["id"] . "', '0', '0');";
                $db->sql_query($sql) or btsqlerror($sql);
                group_set_user_default('21', $userids, false);
            }
        }
    }
    $sql = "SELECT id, userid FROM ".$db_prefix."_snatched WHERE seeder = 'yes' AND     hitrunwarn = 'yes'";
    $res = $db->sql_query($sql);
    if ($db->sql_numrows($res) > 0)
    {
        $ids = $userids = array();
        $msg = addslashes($user->lang['HNR_REMOVED']);
        $modcomment = addslashes($user->lang['MOD_HNR_COMENT_REMOVED']);
        while ($arr = $db->sql_fetchrow($res))
        {
            $ids[] = $arr["id"];
            $userids[] = $arr["userid"];
            $userids[] = $arr["id"];
            system_pm($msg,$user->lang['HIT_N_RUN'],$arr['userid'],'');
        }
        //$warnlength = 604800;
        $db->sql_query("UPDATE ".$db_prefix."_users SET warned = '0', warn_kapta='" . strtotime(gmdate("Y-m-d H:i:s", time())) . "', warn_hossz = warn_hossz - '".$warnlength."', modcomment = CONCAT('$modcomment', modcomment), hitruns = 0, HNR_W = HNR_W - '1' WHERE id IN (".implode(", ", $userids).")");
        $db->sql_query("UPDATE ".$db_prefix."_snatched SET hitrun ='0000-00-00 00:00:00', hitrunwarn = 'no' WHERE id IN (".implode(", ", $ids).")");
    }
}
#END HNR
    $db->sql_query("DELETE FROM ".$db_prefix."_users WHERE active = 0 AND UNIX_TIMESTAMP(regdate) < UNIX_TIMESTAMP(NOW()) - 86400;");
    # Delete PMs that have been removed by both Sender and Recipient
    $db->sql_query( "DELETE FROM ".$db_prefix."_private_messages WHERE sender = '0' AND recipient_del = 'true';");
    $db->sql_query( "DELETE FROM ".$db_prefix."_private_messages WHERE sender_del = 'true' AND recipient_del = 'true';");
    $db->sql_query( "DELETE FROM ".$db_prefix."_private_messages WHERE recipient = '0';");
    #$db->sql_query(    "DELETE FROM ".$db_prefix."_private_messages WHERE save = 'false' AND UNIX_TIMESTAMP(sent) < UNIX_TIMESTAMP(NOW()) - 2592000;");
    #clean snatch list
   $db->sql_query("UPDATE ".$db_prefix."_snatched SET seeder = 'no' WHERE seeder = 'yes' AND last_action < '".get_date_time(gmtime() - $announce_interval)."';");
   $db->sql_query("UPDATE ".$db_prefix."_users SET warned = '0', warn_kapta= 0, warn_hossz = 0 WHERE (`warn_hossz` + `warn_kapta`) < '" . strtotime(gmdate("Y-m-d H:i:s", time())) . "'");


        $db->sql_query("UPDATE ".$db_prefix."_torrents SET evidence = 0 WHERE evidence = 1 AND UNIX_TIMESTAMP(added) < UNIX_TIMESTAMP(NOW()) - 14*84600;");
        $db->sql_query("UPDATE ".$db_prefix."_torrents SET visible = 'no' WHERE type != 'link' AND tot_peer <= '".$down_limit."' AND UNIX_TIMESTAMP(last_action) < UNIX_TIMESTAMP(NOW()) - ".intval($dead_torrent_interval)." AND evidence != 1 AND (TRACKER IS NULL OR ".intval($autoscrape).");");
        $db->sql_query("UPDATE ".$db_prefix."_torrents SET visible = 'yes' WHERE tot_peer > '".$down_limit."';");
        $db->sql_query("DELETE FROM ".$db_prefix."_online_users WHERE UNIX_TIMESTAMP(last_action) < UNIX_TIMESTAMP(NOW()) - 300;");

#prune users
if ($autodel_users)
{
$userwarninactivesub = Array();
$userwarninactivesub['english'] = "".$sitename." Warning";
$userwarninactivesub['german'] = "".$sitename." Achtung";
$userwarninactivesub['spanish'] = "Advertencia ".$sitename."";
$userwarninactivesub['brazilian'] = "".$sitename." adverte";
$userwarninactivesub['portuguese'] = "".$sitename." adverte";

$userwarninactivetext = Array();

$warntexten1 = "Hi,
we would like to warn you that you have not been active on **siteurl** for more than **inactwarning_time** days,
if you do not want to have your account deleted please login to it.";
if ($autodel_users_time != 0)
{
$warntexten2 = "You have **autodel_users_time** days to log in from now.
Otherwise we will delete your account permanently.";
}
else $warntexten2 = "";
$warntexten3 = "
Thanks **sitename** Admin
**siteurl**";
$userwarninactivetext['english'] = "".$warntexten1.$warntexten2.$warntexten3."";


$warntextger1 = "Hallo,
wir möchten Sie warnen, dass Sie seit mehr als **inactwarning_time** Tagen nicht auf **siteurl** aktiv waren,
Wenn Sie Ihr Konto nicht löschen lassen möchten, melden Sie sich bitte an.";
if ($autodel_users_time != 0)
{
$warntextger2 = "Sie haben **autodel_users_time** Tage, um sich ab sofort anzumelden.
Ansonsten werden wir Ihr Konto dauerhaft löschen.";
}
else $warntextger2 = "";
$warntextger3 = "
Danke **sitename** Admin
**siteurl**";

$userwarninactivetext['german'] = "".$warntextger1.$warntextger2.$warntextger3."";

$warntextspa1 = "Hola,
nos gustaría advertirle que no ha estado activo en **siteurl** durante más de **inactwarning_time**
Si no desea que se elimine su cuenta, inicie sesión en ella.";
if ($autodel_users_time != 0)
{
$warntextspa2 = "Tienes **autodel_users_time** días para iniciar sesión desde ahora.
De lo contrario, eliminaremos su cuenta de forma permanente.";
}
else $warntextspa2 = "";
$warntextspa3 = "
Gracias **sitename** administrador
**siteurl**";

$userwarninactivetext['spanish'] = "".$warntextspa1.$warntextspa2.$warntextspa3."";

$warntextbra1 = "Oi,
Gostaríamos de avisar que você não esteve ativo no **siteurl** por mais de **inactwarning_time** dias,
Se você não quiser que sua conta seja excluída, faça o login nela.";
if ($autodel_users_time != 0)
{
$warntextbra2 = "Você tem **autodel_users_time** dias para fazer login a partir de agora.
Caso contrário, excluiremos sua conta permanentemente.";
}
else $warntextbra2 = "";
$warntextbra3 = "
Obrigado **sitename** Administrador
**siteurl**";
$userwarninactivetext['brazilian'] = "".$warntextbra1.$warntextbra2.$warntextbra3."";

$warntextpor1 = "Oi,
Gostaríamos de avisar que você não esteve ativo no **siteurl** por mais de **inactwarning_time** dias,
Se você não quiser que sua conta seja excluída, faça o login nela.";
if ($autodel_users_time != 0)
{
$warntextpor2 = "Você tem **autodel_users_time** dias para fazer login a partir de agora.
Caso contrário, excluiremos sua conta permanentemente.";
}
else $warntextpor2 = "";
$warntextpor3 = "
Obrigado **sitename** Administrador
**siteurl**";

$userwarninactivetext['portuguese'] = "".$warntextpor1.$warntextpor2.$warntextpor3."";

$sql = "SELECT id, email, inactwarning, lastlogin, language, ban FROM ".$db_prefix."_users WHERE id > 0 AND parked != 'false' AND disabled != 'true' AND user_type != 3 AND ban != 1 AND inactwarning != 1 AND lastlogin != '0000-00-00 00:00:00' AND (UNIX_TIMESTAMP(lastlogin) < UNIX_TIMESTAMP(NOW()) - ".$inactwarning_time.") ;";
$res = $db->sql_query($sql);
while ($get_info = $db->sql_fetchrow($res))
{
$replace_markers = Array("**sitename**","**siteurl**","**inactwarning_time**","**autodel_users_time**");
$replace_data = Array ("".$sitename."","".$siteurl."","".($inactwarning_time/86400)."","".($autodel_users_time/86400)."");
if ($get_info['language'] == "") $get_info['language'] = "english";
$warn_mail = new eMail;
$warn_mail->sender = $admin_email;
$warn_mail->subject = $userwarninactivesub[$get_info['language']];
$warn_mail->body = str_replace($replace_markers,$replace_data,$userwarninactivetext[$get_info['language']]);
$warn_mail->Add($get_info['email']);
$warn_mail->Send();
$up_warn = "UPDATE ".$db_prefix."_users SET inactwarning = 1, inactive_warn_time = NOW() WHERE  id = ".$get_info['id'].";";
$db->sql_query($up_warn);
}
}
$db->sql_query("UPDATE ".$db_prefix."_users SET inactwarning = 0, inactive_warn_time = '0000-00-00 00:00:00' WHERE id > 0 AND inactwarning = 1 AND UNIX_TIMESTAMP(lastlogin) > UNIX_TIMESTAMP(NOW()) - (".$inactwarning_time.");");
        #Clean Shoutbox
        if($shout_config['autodelet'] == 'true')
        $db->sql_query("DELETE FROM ".$db_prefix."_shouts WHERE id > 0 AND UNIX_TIMESTAMP(posted) < UNIX_TIMESTAMP(NOW()) - (" . $shout_config['autodelete_time'] . "*60);");
//SET INVITE AMOUNTS ACCORDING TO RATIO/GIGS ETC
autoinvites(10,1,4,.90,1);
autoinvites(10,4,7,.95,2);
autoinvites(10,7,10,1.00,3);
autoinvites(10,10,100000,1.05,4);
//autopromote(10,2,1.1,"Power_User","user");
//autodemote(1.0, "user", "Power_User");
//END INVITES
//Update External Torrents
autoclean();
if ($autodel_users)
{
    $sql = "SELECT id FROM ".$db_prefix."_users WHERE inactwarning = 1 AND UNIX_TIMESTAMP(inactive_warn_time) < UNIX_TIMESTAMP(NOW()) - ".intval($autodel_users_time).";";
    $res = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($res))
    {
     removedinactive($row['id']);
    }
$db->sql_freeresult($res);
}

$db->sql_close();
}
$cmd = "php " . $sourcedir . "cron.php";

if (substr(php_uname(), 0, 7) == "Windows"){
	pclose(popen("start /B ". $cmd, "r"));
}
else {
	exec($cmd . " > /dev/null &"); 
}
//define('BTM_DEBUG', true);
if(defined('BTM_DEBUG'))cleanup();
else
register_shutdown_function("cleanup");

?>