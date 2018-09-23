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
** File include/proxy_detector.class.php 2018-09-22 00:00:00 Thor
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


/**
*   Proxy Detector v0.1
*       copyrights by: Daantje Eeltink (me@daantje.nl)
*                       http://www.daantje.nl
*
*       first build: Mon Sep 18 21:43:48 CEST 2006
*       last build: Tue Sep 19 10:37:12 CEST 2006
*
*   Description:
*       This class can detect if a visitor uses a proxy server by scanning the
*       headers returned by the user client. When the user uses a proxy server,
*       most of the proxy servers alter the header. The header is returned to
*       PHP in the array $_SERVER.
*
*   License:
*       GPL v2 licence. (http://www.gnu.org/copyleft/gpl.txt)
*
*   Support:
*       If you like this class and find it usefull, please donate one or two
*       coins to my PayPal account me@daantje.nl
*
*   Todo:
*       Add open proxy black list scan.
*/

class proxy_detector {

    /**
    * CONSTRUCTOR
    *   Set defaults...
    */
    function proxy_detector(){
        $this->config = array();
        $this->lastLog = "";

        //set default headers
        $this->scan_headers = array(
            'HTTP_VIA',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED',
            'HTTP_CLIENT_IP',
            'HTTP_FORWARDED_FOR_IP',
            'VIA',
            'X_FORWARDED_FOR',
            'FORWARDED_FOR',
            'X_FORWARDED',
            'FORWARDED',
            'CLIENT_IP',
            'FORWARDED_FOR_IP',
            'HTTP_PROXY_CONNECTION'
        );
    }


    /**
    * VOID setHeader( STRING $trigger )
    *   Set new header trigger...
    */
    function setHeader($trigger){
        $this->scan_headers[] = $trigger;
    }


    /**
    * ARRAY $triggers = getHeaders( VOID )
    *   Get all triggers in one array
    */
    function getHeaders(){
        return $this->scan_headers;
    }


    /**
    * VOID setConfig( STRING $key,  STRING $value)
    *   Set config line...
    */
    function setConfig($key,$value){
        $this->config[$key] = $value;
    }


    /**
    * MIXED $config = getConfig( [STRING $key] )
    *   Get all config in one array, or only one config value as a string.
    */
    function getConfig($key=''){
        if($key)
            return $this->config[$key];
        else
            return $this->config;
    }


    /**
    * STRING $log = getLog( VOID )
    *   Get last logged information. Only works AFTER calling detect()!
    */
    function getLog(){
        return $this->lastLog;
    }


    /**
    * BOOL $proxy = detect( VOID )
    *   Start detection and return true if a proxy server is detected...
    */
    function detect(){
        $log = "";

        //scan all headers
        foreach($this->scan_headers as $i){
            //proxy detected? lets log...
            if($_SERVER[$i])
                $log.= "trigger $i: ".$_SERVER[$i]."\n";
        }

        //let's do something...
        if($log){
            $log = $this->lastLog = date("Y-m-d H:i:s")."\nDetected proxy server: ".gethostbyaddr($_SERVER['REMOTE_ADDR'])." ({$_SERVER['REMOTE_ADDR']})\n".$log;

            //mail message
            if($this->getConfig('MAIL_ALERT_TO'))
                mail($this->getConfig('MAIL_ALERT_TO'),"Proxy detected at {$_SERVER['REQUEST_URI']}",$log);

            //write to file
            $f = $this->getConfig('LOG_FILE');
            if($f){
                if(is_writable($f)){
                    $fp = fopen($f,'a');
                    fwrite($fp,"$log\n");
                    fclose($fp);
                }else{
                    die("<strong>Fatal Error:</strong> Couldn't write to file: '<strong>$f</strong>'<br>Please check if the path exists and is writable for the webserver or php...");
                }
            }

            //done
            return true;
        }

        //nope, no proxy was logged...
        return false;
    }
}

?>