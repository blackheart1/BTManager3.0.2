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
** File actb.php 2018-10-03 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
** 2018-10-03 - Changed Path to js Files
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

global $db, $db_prefix, $search_cloud, $search_cloud_user_only, $user, $template;
include_once 'include/function_posting.php';
if($search_cloud)
{
    if(($search_cloud_user_only AND $user->user) OR !$search_cloud_user_only)
    {
        $search = utf8_normalize_nfc(request_var('search', '',true));
        if(!empty($search))
        {
            $val = preg_replace("/[^0-9a-z -#\(\)\:\/\-\_\'\"\]\[]/i",'', $search);
            if (preg_match("/http:/i", $val)) $val="";
            if(strlen($val) > 1)
            {
                $compl = "UPDATE ".$db_prefix."_search_text SET hit = hit + '1'  WHERE text = '".$db->sql_escape($val)."';";
                $complinsert = "INSERT INTO ".$db_prefix."_search_text  VALUES (0, '".$db->sql_escape($val)."', '1')";
                $res = $db->sql_query($compl);
                if (!$db->sql_affectedrows($res))
                {
                    $db->sql_query($complinsert);
                }
            }
        }
    }
}
$abc = array(0=>'a');
                        $sql ="SELECT text FROM ".$db_prefix."_search_text  ORDER BY id LIMIT 200;";
                        $result = $db->sql_query($sql);
                while($row = $db->sql_fetchrow($result)){
                    $s_text = str_replace(","," ",$row["text"]);
                    $s_text = str_replace("'"," ",$s_text);
                    $s_text = str_replace('"'," ",$s_text);
                    $abc[] = $s_text;
                    //$i++;
                }

$db->sql_freeresult($result);
$template->assign_vars(array(
        'S_ACTB'            => "<SCRIPT type=\"text/javascript\" language=\"JavaScript\">
 var customarray=new Array('".implode("', '",$abc)."');
</SCRIPT>
<script type=\"text/javascript\" src=\"{SITE_URL}/js/actb.js\"></script>"
));

?>