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
** File include/bdecoder.php 2018-09-22 00:00:00 Thor
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

/*
WINDOWS WARNING
ICONV.DLL MUST BE IN C:\WINDOWS\SYSTEM32 OR
EXTENSION LOADING WILL FAIL
*/
if (phpversion() < 5) {
        if (!extension_loaded("domxml") AND !defined("DOMXML_LOADED")) dl((PHP_OS=="WINNT" OR PHP_OS=="WIN32") ? "include/extensions/domxml.dll" : "include/extensions/domxml.so");
        require_once("include/bencoder/bdecoder-domxml.php");
        define("DOMXML_LOADED",1);
} else {
        require_once("include/bencoder/bdecoder-domxml.php");
        require_once'include/extensions/domxml-php4-to-php5.php';
}
function joinXML($parent, $child, $tag = null)
    {
        $DOMChild = new DOMDocument();
        $DOMChild->preserveWhiteSpace = false;
        $DOMChild->loadXML($child->dump_mem(true,"UTF-8"));
        $node = $DOMChild->getElementsByTagName("files")->item(0);
        $getnode = array();
        foreach($node->childNodes as $childs)
        {
            if($childs->nodeName != '#text')
            {
                $getnode[] = $childs->tagName;
            }
        }
        $DOMParent = new DOMDocument();
        $DOMParent->preserveWhiteSpace = false;
        $DOMParent->formatOutput = true;
        $DOMParent->loadXML($parent->dump_mem(true,"UTF-8"));
        $node = $DOMParent->importNode($node, true);
        if ($tag !== null)
        {
            $tag = $DOMParent->getElementsByTagName($tag)->item(0);
            foreach($getnode as $children)
            {
                $tag->appendChild($node->getElementsByTagName($children)->item(0));
            }
        }
        else
        {
            foreach($getnode as $children)
            {
                $tag->appendChild($node->getElementsByTagName($children)->item(0));
            }
        }
        $DOMParent->formatOutput = true;
        return $DOMParent->saveXML();
}

?>