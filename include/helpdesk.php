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
** File include/helpdesk.php 2018-09-22 00:00:00 Thor
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

include("header.php");
include("include/config_lite.php");
$problem = trim($_POST["problem"]);
$answer = trim($_POST["answer"]);
$id = $_POST["id"];
$addedbyid = $_POST["addedbyid"];
$title = trim($_POST["Problem Title"]);

$action = $_GET["action"];
$solve = $_GET["solve"];
if (($problem != "") && ($title != "")){

  $dt = sqlesc(get_date_time());
$query = mysql_query("INSERT INTO ".$db_prefix."_helpdesk` (`title`, `problem`,  `solved`, `answer`) VALUES  (".$title.", ".$problem.", $dt)") or sqlerr();

// mysql_query("INSERT INTO ".$db_prefix."_helpdesk (added) VALUES ($dt)") or sqlerr();

  stdmsg("Help desk", "Message sent! Await for reply.");
  end_main_frame();
  stdfoot();
  exit;
}
{
print("<center><a href=problems.php><h1>PROBLEMS</h1></a></center><br/>");
}
?>
<!-- Start Darks Help Desk -->
<center><font color=red size=2><blockquote>Before using <b>Our Help Desk</b> make sure to read <a href=faq.php><b>FAQ</b></a> and search the <a href=phpBB.php><b>Forums</b></a> first!</blockquote></font><br/></center>
<center><font color="red"><h1>Darks Help Desk @2009 All Rights PMBT</h1></center></font>
<center><font color="red" size="2"><b>Please Note This Help Desk Is In The Testing Stage</b></font></center><br/>

<form method="post" action="helpdesk.php">
<table border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td align="right">&nbsp;<b>Problem Title:</b></td>
    <td align="left"><input type="text" size="73" maxlength="60" name="title"></td>
  </tr>
<!--
  <tr>
    <td align="left" colspan="2"></td>
  </tr>
-->
  <tr>
    <td colspan="2"><textarea name="problem" cols="90" rows="20"><?php print($problem);?></textarea><!--<br>(<a href=tags.php class=altlink>BB</a> tags are <b>allowed</b>.)--></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input type="submit" value="SEND FOR HELP!" class="btn"></td>
  </tr>
</table>
</form>


<?php
include("footer.php");

?>