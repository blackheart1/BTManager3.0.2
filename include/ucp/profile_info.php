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
** File profile_info.php 2018-09-22 00:00:00 Thor
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

        if(isset($userrow["birthday"]) OR !$userrow["birthday"]=='')$bday = explode("-", $userrow["birthday"]);
        else
        $bday = array('0','0','0');
        $now = getdate(time() - date('Z'));
if ($config['allow_birthdays'])
{
    $template->assign_vars(array(
        'U_BITH_D'              =>  $bday[0],
        'U_BITH_M'              =>  $bday[1],
        'U_BITH_Y'              =>  $bday[2],
        'S_BIRTHDAYS_ENABLED'       => true,
    ));
}
$template->assign_vars(array(
        'LOCATION'              => $countries,
        'U_ICQ'                 => (!empty($userrow["icq"])) ? $userrow["icq"] : '',
        'U_AIM'                 => (!empty($userrow["aim"])) ? $userrow["aim"] : '',
        'U_YIM'                 => (!empty($userrow["yahoo"])) ? $userrow["yahoo"] : '',
        'U_MSN'                 => (!empty($userrow["msn"])) ? $userrow["msn"] : '',
        'U_JABBER'              => (!empty($userrow["jabber"])) ?$userrow["jabber"] : '',
        'U_SKYPE'               => (!empty($userrow["skype"])) ? $userrow["skype"] : '',
));

?>