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
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File mcp_categories/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'INTRO'              => 'Torrent Categories',

    'INTRO_EXP'          => 'In this Section you can Manage Torrent Categories that Users can Upload to.<br /><br />The Installation provides this Tracker with some Common Categories for Torrents.<br /><br />You can <strong>Add/Edit</strong> or <strong>Delete</strong> Categories, you can also Attach an Image to the Category  Images are in the <em><strong>cat_pics</strong></em> Directory of the Tracker\'s Root Directory.<br />If the Theme has a <em><strong>pics/cat_pics</strong></em> Directory within it, Images that are in that Directory will be Displayed instead of Global Images.<br /><br />',

    'INTRO_EDIT'         => 'Add New Torrent Category Icon',

    'INTRO_EXP_EDIT'     => 'In this Section you can Upload New Images to use for you Category Icons.<br /><br />At this time you are Only Allowed to use <strong>png</strong>, <strong>gif</strong>, <strong>jpg</strong> and <strong>jpeg</strong> Extensions.  Remember that you have to make the <em><strong>/cat_pics</strong></em> Folder Writeable first.<br />Icons must NOT exceed <strong>48px x 48px</strong> and must NOT be Larger than <strong>17kb</strong>.  Once you have Uploaded the New Icon, you can choose it from the Drop Down List above.<br /><br />',

    'NO_CATEGORIES'      => 'No Categories to Administer',
    'DELETE_CON'         => 'Delete Category',
    'DELETE_CON_CONFIRM' => 'Are you sure you wish to Remove this Category?',
    'ADD_EDIT_CAT'       => 'Add/Edit Torrent Category',
    'POSITION'           => 'Position',
    'PARENT'             => 'Parent',
    'AT_END'             => 'At the End',
    'AT_BEGIN'           => 'At the Beginning',
    'AFTER'              => 'After %1$s',
    'SETASPARENT'        => 'Set as Parent',
    'UPLOAD_CAT'         => 'Upload Category Icon',
    'CAT_UPLOAD_TOBIG'   => 'Category Icon is Too Large',
    'INVALID_ICON'       => 'Invalid Category Icon',
    'EMPTY_FILE'         => 'The Icon you are Uploading is Empty',
    'FATAL_ERROR_UPLOAD' => 'Fatal Error in the Uploaded Category Icon.',
    'UPLOAD_SUCCESSFUL'  => 'New Category Icon was Successfully Uploaded.',
    'UPLOAD_FAILED'      => 'The Upload has Failed.  Please Check the Permissions of the <em>cat_pics</em> Directory and make sure that the Permissions are Set Correctly!',
));

?>