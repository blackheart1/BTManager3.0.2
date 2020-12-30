<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2021
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File steps/3.php 2020-12-22 00:00:00 Black_Heart
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_BTM')
** 2020-12-22 - Updated File location in header
**/

$error = ((!isset($gpl) OR $gpl != "yes" OR !isset($lgpl) OR $lgpl != "yes") AND !isset($postback));
$errors = Array("db_host"=>false,"db_host_msg"=>"","db_user"=>false,"db_user_msg"=>"","db_name"=>false,"upload_directory"=>false,"upload_directory"=>false);

if (!isset($db_type)) $db_type = "MySQL";
if (!isset($db_host)) $db_host = "localhost";
if (!isset($db_user)) $db_user = "root";
if (!isset($db_pass)) $db_pass = "";
if (!isset($db_name)) $db_name = "phpMyBitTorrent";
if (!isset($db_prefix)) $db_prefix = "torrent";
if (!isset($db_persistency)) $db_persistency = "false";
if (!isset($upload_directory)) $upload_directory = "torrent";
if (!isset($use_rsa)) $use_rsa = "false";
if (!isset($rsa_modulo)) $rsa_modulo = 0;
if (!isset($rsa_public)) $rsa_public = 0;
if (!isset($rsa_private)) $rsa_private = 0;

$showpanel = false;


//Configuration file prototype. Copyright Notice included ;)
$configproto = <<<EOF
<?php
/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2021
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File include/configdata.php 2020-12-22 00:00:00 Black_Heart
**
**/

if (!defined('IN_BTM'))
{
    die ('Error 404 - Page Not Found');
}

/* ---------------------------------
Database Configuration
You have to Configure your Database
Connection Here. Here is a Quick
Explanation:

db_type: your Database Type
    Possible Options:
        MySQL
        MySQL4
        MySQLi
        Postgres
        MSSQL
        Oracle
        MSAccess
        MSSQL-ODBC
        DB2

db_host     : Host where your Database Runs
db_port     : Not Used
db_user     : Database Username
db_password : Database Password
db_name     : Database Name on Server
db_prefix   : Prefix for Tables
persistency : Connection Persistency
--------------------------------- */
\$db_type        = "$db_type";
\$db_host        = "$db_host";
\$db_user        = "$db_user";
\$db_pass        = "$db_pass";
\$db_name        = "$db_name";
\$db_prefix      = "$db_prefix"; //Without "_"
\$db_persistency = $db_persistency;

/* ---------------------------------
RSA Engine Configuration
Make sure you ran rsa_keygen BEFORE
Configuring RSA. You NEED a VALID
Key Pair to Enable RSA.
You can Copy & Paste the rsa_keygen Output
--------------------------------- */
\$use_rsa     = $use_rsa;
\$rsa_modulo  = $rsa_modulo;
\$rsa_public  = $rsa_public;
\$rsa_private = $rsa_private;

/*----------------------------------
Torrent Upload Directory
You can Change the Default Setting,
but Remember that it MUST be Writeable
by httpd/IUSR_MACHINE User
----------------------------------*/
\$torrent_dir = "$upload_directory";

?>
EOF;
?>
<?php

if (isset($postback)) {
        switch ($db_type) {
                case "MySQL":
                case "MySQL5":
                case "MySQL4": {
                        $db = @mysql_connect($db_host,$db_user,$db_pass);
						if($db_type == "MySQL5")$db_type = "MySQL4";
                        if (!$db) {
                                $myerr = mysql_errno();
                                if ($myerr > 2000 AND $myerr < 2100) { //Connection error
                                        $showpanel = true;
                                        $errors["db_host"] = true;
                                        $errors["db_host_msg"] = mysql_error();

                                } elseif($myerr == 1045 OR $myerr == 1251) { //Authentication error
                                        $showpanel = true;
                                        $errors["db_user"] = true;
                                        $errors["db_user_msg"] = mysql_error();
                                }
                                //echo "<p>".mysql_error()."<br />".mysql_errno()."</p>";
                                break;
                        }
                        if (!mysql_select_db($db_name,$db)) { //Can't access database
                                $showpanel = true;
                                $errors["db_name"] = true;
                                $errors["db_name_msg"] = mysql_error();
                                //echo "<p>".mysql_error()."<br />".mysql_errno()."</p>";
                                @mysql_close($db);
                                break;
                        }
                        @mysql_close($db);
                        break;
                }
                case "MySQLi": {
                        $db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);
                        if (!$db) {
                                $myerr = mysqli_errno();
                                if ($myerr > 2000 AND $myerr < 2100) { //Connection error
                                        $showpanel = true;
                                        $errors["db_host"] = true;
                                        $errors["db_host_msg"] = mysqli_error();

                                } elseif($myerr == 1045 OR $myerr == 1251) { //Authentication error
                                        $showpanel = true;
                                        $errors["db_user"] = true;
                                        $errors["db_user_msg"] = mysqli_error();
                                }
                                //echo "<p>".mysql_error()."<br />".mysql_errno()."</p>";
                                break;
                        }
                        if (!mysqli_select_db($db, $db_name)) { //Can't access database
                                $showpanel = true;
                                $errors["db_name"] = true;
                                $errors["db_name_msg"] = mysqli_error();
                                //echo "<p>".mysql_error()."<br />".mysql_errno()."</p>";
                                @mysqli_close($db);
                                break;
                        }
                        @mysqli_close($db);
                        break;
                }
        }
        if (!is_dir("../".$upload_directory)) {
                $showpanel = true;
                $errors["upload_directory"] = true;
                $errors["upload_directory_msg"] = _updirnoexist;
        } else {
                $fp = @fopen("../".$upload_directory."/testfile","w");
                if (!$fp) {
                        $showpanel = true;
                        $errors["upload_directory"] = true;
                        $errors["upload_directory_msg"] = _updirnowrite;
                } else {
                        if (!fputs($fp,"Test Write")) {
                                $showpanel = true;
                                $errors["upload_directory"] = true;
                                $errors["upload_directory_msg"] = _updirnowrite;
                        }
                }
                @unlink("../".$upload_directory."/testfile"); //Deleting the mess we just done
                @fclose($fp);
        }


} else $showpanel = true;



if ($error) {
        //Step back
        include("steps/2.php");
} elseif($showpanel) {
        //Proceed with step 3
        echo "<input type=\"hidden\" name=\"step\" value=\"3\" />\n";
        echo "<input type=\"hidden\" name=\"truestep\" value=\"3\" />\n"; //Used to display correct image


        echo "<p align=\"center\"><font size=\"5\">"._step3."</font></p>\n";

        echo "<p>&nbsp;</p>\n";
        echo "<p>"._step3explain."</p>\n";

        echo "<p>&nbsp;</p>\n";

        #Database Settings
        echo "<p><b>"._dbconfig."</b></p>\n";
        echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";

        //DB Type
        echo "<tr><td width=\"30%\"><p>"._dbtype."</p></td><td width=\"70%\"><p><select size=\"1\" name=\"db_type\">";
        echo "<option value=\"MySQL\" "; if ($db_type == "MySQL") echo "selected"; echo ">MySQL >=5.6.5</option>";
        echo "<option value=\"MySQL5\" "; if ($db_type == "MySQL5") echo "selected"; echo ">MySQL 4.1 to 5.6.4</option>";
        echo "<option value=\"MySQL4\" "; if ($db_type == "MySQL4") echo "selected"; echo ">MySQL < 4.1</option>";
        echo "<option value=\"MySQLi\" "; if ($db_type == "MySQLi") echo "selected"; echo ">MySQLi</option>";
        echo "</select></p></td></tr>\n";

        //DB Host
        echo "<tr><td width=\"30%\"><p>"._dbhost."</p></td><td width=\"70%\"><p><input type=\"text\" name=\"db_host\" value=\"".$db_host."\" />";
        if ($errors["db_host"]) echo "<font class=\"err\"><br />"._dbhosterror."<br />".str_replace("**msg**",$errors["db_host_msg"],_serverreturned)."</font>";
        echo "</p></td></tr>\n";

        //DB User
        echo "<tr><td width=\"30%\"><p>"._dbuser."</p></td><td width=\"70%\"><p><input type=\"text\" name=\"db_user\" value=\"".$db_user."\" />";
        if ($errors["db_user"]) echo "<font class=\"err\"><br />"._dbusererror."<br />".str_replace("**msg**",$errors["db_user_msg"],_serverreturned)."</font>";
        echo "</p></td></tr>\n";

        //DB Pass
        echo "<tr><td width=\"30%\"><p>"._dbpass."</p></td><td width=\"70%\"><p><input type=\"text\" name=\"db_pass\" value=\"".$db_pass."\" /></p></td></tr>\n";

        //DB Name
        echo "<tr><td width=\"30%\"><p>"._dbname."</p></td><td width=\"70%\"><p><input type=\"text\" name=\"db_name\" value=\"".$db_name."\" />";
        if ($errors["db_name"]) echo "<font class=\"err\"><br />"._dbnameerror."<br />".str_replace("**msg**",$errors["db_name_msg"],_serverreturned)."</font>";
        echo "</p></td></tr>\n";

        //DB Prefix
        echo "<tr><td width=\"30%\"><p>"._dbprefix."</p></td><td width=\"70%\"><p><input type=\"text\" name=\"db_prefix\" value=\"".$db_prefix."\" /></p></td></tr>\n";

        //DB Persistency
        echo "<tr><td width=\"30%\"><p>"._dbpers."</p></td><td width=\"70%\"><p><input type=\"checkbox\" name=\"db_persistency\" value=\"true\" "; if ($db_persistency == "true") echo "checked"; echo "/></p></td></tr>\n";
        echo "</table>\n";

        echo "<p>&nbsp;</p>\n";

        #Upload Directory
        echo "<p><b>"._moresettings."</b></p>\n";
        echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
        echo "<tr><td width=\"30%\"><p>"._uploaddirectory."</p></td><td width=\"70%\"><p><input type=\"text\" name=\"upload_directory\" value=\"".$upload_directory."\" />";
        if ($errors["upload_directory"]) {
                echo "<br />";
                $currentfile = (array_key_exists("SCRIPT_FILENAME",$_SERVER)) ? stripslashes($_SERVER["SCRIPT_FILENAME"]) : stripslashes($_SERVER["PATH_TRANSLATED"]);
                $dirchar = ($os == "Windows") ? "\\" : "/";
                $setupdir = substr($currentfile,0,strrpos($currentfile,$dirchar));
                $pmbtdir = substr($currentfile,0,strrpos($currentfile,$dirchar));
                if ($os == "Windows") {
                        //cacls %path% /E /G IUSR_MACHINE:RWCF
                        $machinename = $_SERVER["COMPUTERNAME"];
                        $superuser = "Administrator";
                        $command = "cacls ".$pmbtdir."\\".$upload_directory." /E /G IUSR_".$machinename.":RWCF";
                } else {
                        $superuser = "root";
                        $command = "chmod -R 0666 ".$pmbtdir."/".$upload_directory;
                }
                //Determining the right command to make directory writable
                echo "<br /><b><font class=\"err\">";
                echo $errors["upload_directory_msg"];
                if ($errors["upload_directory_msg"] == _updirnoexist) { //The directory does not exist. Telling how to create one
                        echo "</font><br />";
                        echo "<font class=\"err\">"; //Just to respect HTML
                        echo str_replace(Array("**cmd**","**user**"),Array($command, $superuser),_permissioncmd);
                }
                echo "</font></b>";
        }
        echo "</p></td></tr>\n";
        echo "</table>\n";

        echo "<p>&nbsp;</p>\n";


        if (!$rsa_modulo OR !$rsa_public OR !$rsa_private) {
                require_once("include/rsa.php");
                list ($rsa_modulo, $rsa_public, $rsa_private) = generate_keys();
        }

        #RSA Configuration
        echo "<p><b>"._securecookies."</b></p>\n";
        echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
        echo "<tr><td width=\"30%\"><p>"._rsacookies."</p></td><td width=\"70%\"><p><input type=\"checkbox\" onClick=\"javascript:expand('rsa');\" name=\"use_rsa\" value=\"true\" "; if ($use_rsa == "true") echo "checked"; echo " /></p></td></tr>\n";
        $rsaclass =  ($use_rsa == "true") ? "visible" : "hide";
        echo "<tr id=\"rsa_1\" class=\"".$rsaclass."\"><td width=\"30%\"><p>"._rsamod."</p></td><td width=\"70%\"><p><input type=\"text\" readonly name=\"rsa_modulo\" value=\"".$rsa_modulo."\" /></p></td></tr>\n";
        echo "<tr id=\"rsa_2\" class=\"".$rsaclass."\"><td width=\"30%\"><p>"._pubkey."</p></td><td width=\"70%\"><p><input type=\"text\" readonly name=\"rsa_public\" value=\"".$rsa_public."\" /></p></td></tr>\n";
        echo "<tr id=\"rsa_3\" class=\"".$rsaclass."\"><td width=\"30%\"><p>"._privkey."</p></td><td width=\"70%\"><p><input type=\"text\" readonly name=\"rsa_private\" value=\"".$rsa_private."\" /></p></td></tr>\n";
        echo "</table>\n";

        echo "<p><input type=\"submit\" name=\"postback\" value=\""._nextstep."\" /></p>\n";
} else {
        echo "<p align=\"center\"><font size=\"5\">"._step3."</font></p>\n";
        //Get ready for step 4
        //Write to configuration file, else display to user
        echo "<input type=\"hidden\" name=\"step\" value=\"4\" />\n";
        @unlink("../include/configdata.php");
        $err = false;
        $fp = fopen("../include/configdata.php","w");
        if ($fp) {
                if (!fputs($fp,$configproto)) $err = true;
                fclose($fp);
        } else $err = true;
        if ($err) {
                echo "<p>"._cannotwriteconfig."</p>";
                echo "<p><textarea>".htmlspecialchars($configproto)."</textarea></p>";
        } else {

        }
        echo "<p>"._step3complete."</p>";
        echo "<p><input type=\"submit\" name=\"postback\" value=\""._nextstep."\" /></p>\n";
}

?>