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
** File site_settings/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ('Error 404 - Page Not Found');
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'YES_NO_NUM' => array('1' => 'Yes',
                          '0' => 'No'),

    '_admsaved'            => 'Settings Saved!',
    '_admconfigttl'        => 'BTManager Configuration',

    '_admconfigttlexplain' => 'Here you can Setup the Basic Operation of your Tracker, Site Name and Description among other Settings where you can Adjust the Default Values for Themes and Languages.<br /><br />',

    'GENERAL_SETTINGS'     => 'General Settings',
    'GENERAL_OPTIONS'      => 'General Options',
    'EDIT_TIME_MINUTES'    => 'Minutes',

    #User
    '_admpallow_change_email'         => 'Allow email Change',

    '_admpallow_change_emailexplain'  => 'Allow Users to Change their email Address.<br />They will be sent an email which they Must Confirm for the Changes to Take Effect.',

    '_admpgive_sign_up_credit'        => 'Give Upload Credit on Signup',
    '_admpgive_sign_up_creditexplain' => 'Gives Users Upload Credit when they Signup to the Site.',

    '_admpoff_line_mess'        => 'Offline Message',
    '_admpoff_line_messexplain' => 'You can Enter a Short (255 Character) Message to Display if you wish.',

    '_admpannounce_url'        => 'Site Announce URL\'s',
    '_admpannounce_urlexplain' => 'Add the Announce URL\'s that will be used by the Site.<br />Enter each one on a <strong>Separate Line</strong>.',

    '_admpon_line'        => 'Site Online',
    '_admpon_lineexplain' => 'Set Site On/Offline.',

    '_admprecap_https'        => 'Use SSL for reCAPTCHA',
    '_admprecap_httpsexplain' => 'Should the Request be made over SSL?',

    '_admpPublic_Key'         => 'reCAPTCHA Public Key',

    '_admpPublic_Keyexplain'  => 'If You have a reCAPTCHA Account and a Public Key you need to Enter it Here.<br />Leave the Field Blank and the Site will use a Base64 CAPTCHA code.<br />For more info on reCAPTCHA visit here <strong><a href=\'http://www.google.com/recaptcha/learnmore\'>What is reCAPTCHA</a></strong>.',

    '_admpPrivate_Key'        => 'reCAPTCHA Private Key',
    '_admpPrivate_Keyexplain' => 'Add your reCAPTCHA Private Key Here.  Leave it Blank if you don\'t have one.',

    '_admptime_zone'        => 'Site Default Time Zone',

    '_admptime_zoneexplain' => 'Set the Default Time Zone for your Site.<br />To find out what Time Zone to use Click on the Links below.<br /><strong><a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.africa.php\'>Africa</a>, '.'<a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.america.php\'>America</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.antarctica.php\'>Antarctica</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.arctic.php\'>Arctic</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.asia.php\'>Asia</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.atlantic.php\'>Atlantic</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.australia.php\'>Australia</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.europe.php\'>Europe</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.indian.php\'>Indian</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.pacific.php\'>Pacific</a>, <a target=\'_blank\' href=\'http://www.php.net/manual/en/timezones.others.php\'>Others</a></strong>',

    '_admpconferm_email'        => 'Force email Confirmation',
    '_admpconferm_emailexplain' => 'Force a User to Confirm their email Address before they can use the Site.',

    #Torrents
    '_admpallow_multy_tracker'        => 'Allow Multi Tracker Torrents',
    '_admpallow_multy_trackerexplain' => 'Allow Users To Upload a Torrent with more than one Announce URL.',

    '_admpallow_external'        => 'Allow External Torrents',
    '_admpallow_externalexplain' => 'Allow Users to Upload Torrents from Other Sites.',

    '_admpauto_clean'        => 'Auto Clean Timer',
    '_admpauto_cleanexplain' => 'Sets the Time Intervals between Cleaning Sessions (in Seconds).',

    '_admppivate_mode'        => 'Private Tracker Mode',

    '_admppivate_modeexplain' => 'Sets the Tracker to Private, this way NO ONE can View the Content unless they are a Member.',

    '_admpaddprivate'        => 'Make ALL Local Torrents Private',

    '_admpaddprivateexplain' => 'Sets ALL Newly Uploaded Local Torrents as Private, if they were NOT done so already when the Uploader Created the Torrent.<br /><br /><strong>The Uploader will need to Download the Torrent from the Site in order to Seed the Torrent..</strong><br />Not All Torrent Client\'s recognise the Private Option.<br />Enabling the Private Option Disables DHT.',

    '_admpmax_members'          => 'Maximum Allowed Members',
    '_admpmax_membersexplain'   => 'Maximum Number of Members Allowed to Join your Site.',

    '_admpinvite_only'          => 'Invite Only',
    '_admpinvite_onlyexplain'   => 'Only Allows Users who have been Sent an Invite to Join.',

    '_admpforce_passkey'        => 'Force Passkey',
    '_admpforce_passkeyexplain' => 'Set this to Force your Members to use the Passkey System',

    '_admpinvites_open'         => 'Invite System',
    '_admpinvites_openexplain'  => 'Turns the Invite System On and Off.',

    '_admpupload_dead'          => 'Allow Dead External Torrents',

    '_admpupload_deadexplain'   => 'Use this to Allow for (apparently) Unseeded External Torrents to be Uploaded to the Tracker.<br />This might be useful if the External Torrent Monitoring System doesn\'t work so well, which depends on your Server Configuration.',

    '_admpsitename'        => 'Site Name',
    '_admpsitenameexplain' => 'The Name of your Site.  This will be Displayed as the Page Title.',

    '_admpsiteurl'         => 'Site URL',
    '_admpsiteurlexplain'  => 'The URL of this Site.  This Must be Entered before using the Tracker.',

    '_admpcookiedomain'        => 'Cookie Domain',

    '_admpcookiedomainexplain' => 'Cookie Domain.  This Must be Set to the Domain Name of this Site (e.g. <strong>yoursite.com</strong>).  Required for User Login to Work.',

    '_admpcookiepath'          => 'Cookie Path',

    '_admpcookiepathexplain'   => 'Cookie Path.  Change this Setting <strong>ONLY</strong> if BTManager is Installed in a <strong>Sub-Directory</strong> on your Server.  If your Installation is in <strong>http://yoursite.com/btmanager</strong>, the Setting should be <strong>/btmanager</strong>',

    '_admpuse_gzip'        => 'Use gzip Compression',

    '_admpuse_gzipexplain' => 'This Option Allows you to Enable or Disable php\'s gzip Compression on HTML and Announce Output. If Enabled, Bandwidth Usage will be Lower <strong>but</strong> CPU Usage will be Higher.  This Setting doesn\'t work on ALL Servers.  If your Users Report any gzip Errors in their Clients, turn it Off.  Verify that your Tracker Reads the Announce Response Correctly.',

    '_admpadmin_email'        => 'Administrator email Address',

    '_admpadmin_emailexplain' => 'The email Address from which ALL emails to Users will be Sent (Signup, PM Notifications, Authorisations, etc..).  Make sure that the email Address is Valid.',

    '_admplanguage'        => 'Default Language',
    '_admplanguageexplain' => 'Set the Default Language the Site will use.',

    '_admptheme'        => 'Theme',

    '_admpthemeexplain' => 'Set the Default Theme for the Site.  Registered Users can Override this Setting from their User Control Panel.',

    '_admpwelcome_message'        => 'Site News',

    '_admpwelcome_messageexplain' => 'Can be used to Post any News Items (e.g. Welcome Message, Donation Drive etc..).  This will be shown on the Site\'s Index Page.',

    '_admpannounce_text'        => 'Tracker Message',

    '_admpannounce_textexplain' => 'This Defines the Message that Users will see in their Torrent Client when they Connect to the Tracker.<br />Useful for Announcements and Publicity.',

    '_admpallow_html'        => 'Use HTML Editor',

    '_admpallow_htmlexplain' => 'Enable this Option to Allow Users to Write Torrent Descriptions using the embedded HTML Editor.  <br /><strong>WARNING</strong>: this Feature is still Experimental!',

    '_admprewrite_engine'        => 'Search Rewrite',

    '_admprewrite_engineexplain' => 'Search Rewrite transforms php\'s Complex URL\'s into Faux HTML Pages, making it easier to type into the Address Bar.  This Feature is also very useful to Increase Search Engine Traffic.<br />Apaches mod_rewrite or IIS\'s ISAPI_Rewrite is <strong>REQUIRED</strong> on your Server.',

    '_admptorrent_prefix'        => 'Torrent Prefix',

    '_admptorrent_prefixexplain' => 'This Option Allows you to Add a Custom Prefix to ALL Torrents Downloaded from this Tracker.  <br />Useful to Spread the Word about your Community.',

    '_admptorrent_per_page'        => 'Torrents Per Page',

    '_admptorrent_per_pageexplain' => 'Indicates how many Torrents can be Displayed on each page, both in Listing and in Search Mode.',

    '_admponlysearch'        => 'Search Only',

    '_admponlysearchexplain' => 'Hides the Torrent List so that Users without Administrator Access (whether Registered or NOT) will have to Perform a Search in order to View any Torrents.',

    '_admpmax_torrent_size'         => 'Maximum Torrent Size',

    '_admpmax_torrent_sizeexplain'  => 'Maximum Byte Size for Uploaded .torrent Files.<br />This DOES NOT put any Limits on the actual Torrent itself but ONLY on the size of the .torrent File itself.',

    '_admpannounce_interval'        => 'Announce Update Interval',

    '_admpannounce_intervalexplain' => 'Recommended Time Interval (in Seconds) between Announce Requests.<br />This Value is Sent to the Torrent Client.',

    '_admpannounce_interval_min'        => 'Minimum Announce Update Interval',

    '_admpannounce_interval_minexplain' => 'Recommended Time Interval between Announce Requests (in Seconds).<br /> More Frequent Requests will be Refused.',

    '_admpdead_torrent_interval'        => 'Dead Torrent Interval',

    '_admpdead_torrent_intervalexplain' => 'Specifies the Amount of Time (in Seconds) that a Dead Torrent (NO Peers) can be kept Visible on the Site, after which period they will Automatically be Hidden.',

    '_admpfree_dl'        => 'Turn Freeleech On or Off',

    '_admpfree_dlexplain' => 'Setting this to ON allows your Members to Download any Torrent on the Site without it effecting their Download Ratio.  Only their Upload Amount will be Recorded',

    '_admpwait_time'        => 'Add Wait Time',

    '_admpwait_timeexplain' => 'Setting this to ON Users who don\'t meet the below Criteria will have to Wait for a Set Amount of Time before their Downloads will Start.<br /><br /><strong>You Must Remember</strong><br />to Set the Announce Access Level to Users and the Torrents Must be Set to Private',

    '_admpGIGSA'         => 'For Members with Uploads (in GB) Less than',
    '_admpGIGSAexplain'  => 'Set the First Minimum Upload in GB for the First Wait Period before a User can Download a Torrent',

    '_admpGIGSB'         => 'For Members with Uploads (in GB) Less than',
    '_admpGIGSBexplain'  => 'Set the Second Minimum Upload in GB for the Second Wait Period before a User can Download a Torrent',

    '_admpGIGSC'         => 'For Members with Uploads (in GB) Less than',
    '_admpGIGSCexplain'  => 'Set the Third Minimum Upload in GB for the Third Wait Period before a User can Download a Torrent',

    '_admpGIGSD'         => 'For Members with Uploads (in GB) Less than',
    '_admpGIGSDexplain'  => 'Set the Fourth Minimum Upload in GB for the Fourth Wait Period before a User can Download a Torrent',

    '_admpRATIOA'        => 'For Member\'s with a Ratio Less than',
    '_admpRATIOAexplain' => 'Set the Fist Minimum Ratio a User must have before they can Download a Torrent',

    '_admpRATIOB'        => 'For Member\'s with a Ratio Less than',
    '_admpRATIOBexplain' => 'Set the Second Minimum Ratio a User must have before they can Download a Torrent',

    '_admpRATIOC'        => 'For Member\'s with a Ratio Less than',
    '_admpRATIOCexplain' => 'Set the Third Minimum Ratio a User must have before they can Download a Torrent',

    '_admpRATIOD'        => 'For Members with a Ratio Less than',
    '_admpRATIODexplain' => 'Set the Fourth Minimum Ratio a User must have before they can Download a Torrent',

    '_admpWAITA'         => 'Members must Wait \'x\' amount of Hours',
    '_admpWAITAexplain'  => 'Set the First Wait Period in Hours a User must Wait before they can Download a Torrent',

    '_admpWAITB'         => 'Members must Wait \'x\' amount of Hours',
    '_admpWAITBexplain'  => 'Set the Second Wait Period in Hours a User must Wait before they can Download a Torrent',

    '_admpWAITC'         => 'Members must Wait \'x\' amount of Hours',
    '_admpWAITCexplain'  => 'Set the Third Wait Period in Hours a User must Wait before they can Download a Torrent',

    '_admpWAITD'         => 'Members must Wait \'x\' amount of Hours',
    '_admpWAITDexplain'  => 'Set the Fourth Wait Period in Hours a User must Wait before they can Download a Torrent',

    '_admpminvotes'        => 'Minimum Votes',
    '_admpminvotesexplain' => 'Minimum Number of Votes Required to Display Torrent Ratings.',

    '_admptime_tracker_update'        => 'Autoscrape Time Interval',
    '_admptime_tracker_updateexplain' => 'Sets the Autoscrape Time Interval (in Seconds).',

    '_admpbest_limit'        => 'Best Torrent Peer Limit',
    '_admpbest_limitexplain' => 'Number of Total Peers above which the Torrent is Included in the Top Torrents List/RSS Feed.',

    '_admpdown_limit'        => 'Dead Torrent Peer Limit',
    '_admpdown_limitexplain' => 'Number of Total Peers below which the Torrent is Treated as Dead.',

    '_admptorrent_complaints'        => 'Torrent Complaints',

    '_admptorrent_complaintsexplain' => 'Allows Users to make a Complaint about a Torrent on the Details Page.  This Helps to Block Undesired Content, such as Child Pornography.  Any Torrent that receives 20 Complaints will Automatically be Banned.',

    '_admptorrent_global_privacy'    => 'Torrent Authorisations',

    '_admptorrent_global_privacyexplain' => 'Switching this ON Allows Registered Uploaders to put Limitations on Who can Download their Torrents.  The Owner of a Torrent can either Authorise Downloads on a Case-by-Case Basis, or Automatically by Setting an Overall Share Ratio that the Downloader has to meet.<br />You have to Set the Tracker Access Level to User in Order for this to Work.',

    '_admpdisclaimer_check'        => 'Disclaimer',

    '_admpdisclaimer_checkexplain' => 'If Checked, Users have to Accept a Disclaimer before they can Register.  You can Change the Disclaimer by Changing the File <strong>/disclaimer/english.txt</strong>',

    '_admpgfx_check'        => 'CAPTCHA Setting',
    '_admpgfx_checkexplain' => 'If Checked, Users will have to Type in a Code from a CAPTCHA Image when Registering and Logging In.',

    '_admpupload_level'        => 'Upload Access Level',

    '_admpupload_levelexplain' => 'Determines the User Level Required to Upload Torrents<ul><li><strong>Everyone</strong> Allows Anyone to Upload Torrent Files to the Site. They won\'t be able to Edit them or Manage Authorisations<li><strong>Registered</strong> Requires Users to be Registered.<li><strong>Premium</strong> ONLY Allows Premium Users to Upload.</ul>',


    '_admplevelopt' => array('all'     => 'Everyone',
                             'user'    => 'Registered',
                             'premium' => 'Premium'),

    '_admpdownload_level'        => 'Download Access Level',

    '_admpdownload_levelexplain' => 'Determines the User Level Required to Download Torrents.<ul><li><strong>Everyone</strong> Allows Anyone to Download Torrent Files from the Site<li><strong>Registered</strong> Requires Users to be Registered<li><strong>Premium</strong> ONLY Allows Premium Users to Download Torrents from the Site</ul>This Setting DOES NOT affect the Tracker.  So if somebody got their hands on a .torrent, they would not be able to Download.',

    '_admpannounce_level'        => 'Tracker Access Level',

    '_admpannounce_levelexplain' => '<ul><li><strong>Everyone</strong> Allows Anyone to Connect to the Tracker (i.e. Announce)<li><strong>Registered</strong> Requires the User to Log In (IP Address is Checked!) before Connecting to the Tracker.  </ul>This Setting DOES NOT Affect Torrents Downloaded from the Site.',

    '_admpannounce_levelopt' => array('all'  => 'Everyone',
                                      'user' => 'Registered'),

    '_admpmax_num_file'        => 'Maximum Amount of Files in a Torrent',

    '_admpmax_num_fileexplain' => 'Maximum Number of Files a Torrent can contain, any amount above this will cause the Upload to Fail.<br />Use it if you\'d like to encourage Users to use Compressed Archives.<br />Setting this to Zero will Disable this Option.',

    '_admpmax_share_size'        => 'Maximum Torrent Share Size',

    '_admpmax_share_sizeexplain' => 'Total Combined Size of Files in a Torrent, any amount above this will cause the Upload to Fail.<br />Setting this to Zero will Disable this Option.',

    '_admpglobal_min_ratio'        => 'Global Minimum Ratio',

    '_admpglobal_min_ratioexplain' => 'Specify the Minimum Upload/Download Ratio.<br />Users will NOT be Allowed to Download any more Torrents if they don\'t meet this criteria.<br />The Option is applicable ONLY if the Announce Level (above) is Set to User on the Download Page.<br />Setting this to Zero will Disable this Option.',

    '_admpautoscrape'        => 'External Torrent Monitoring',

    '_admpautoscrapeexplain' => 'This Allows you to Monitor the Peer Count for Torrents Tracked by Remote Trackers.<br />Be careful here.<br /><br />You can ONLY use this if your Server can Open Sockets to Other Machines.  Many Cheap or Free Hosting Services have Firewalls that Block Outgoing Connections.  If your NOT using a Dedicated/Home Server, it is recommended that you DO NOT Enable this Option unless your sure you know what your doing.<br /><br />If you don\'t Enable it ALL External Torrents will be Displayed as having Zero Sources.<br /><br />If you Enable it, but your Server can\'t Build Connections to Scrape then External Uploads may be Rejected (unless you Check \'Allow Dead External Torrents\')',

    '_admpmax_num_file_day_e'        => 'Maximum Number of Daily Downloads',

    '_admpmax_num_file_day_eexplain' => 'Defines how many Files can be Downloaded Per Day by a Single User.  Any Requests above this will be Refused and the User will be asked to try again the following Day.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.',

    '_admpmax_num_file_week_e'        => 'Maximum Number of Weekly Downloads',

    '_admpmax_num_file_week_eexplain' => 'Defines how many Files can be Downloaded in a Week by a Single User.  Further Requests will be Refused and the User will be asked to try again the following Week.<br />Premium Users are Not affected by this Setting.  Setting this to Zero will Disable this Option.',

    '_admpmin_num_seed_e'        => 'Minimum Seed Number for New Downloads',

    '_admpmin_num_seed_eexplain' => 'Defines how many Torrents a User must be Seeding before Downloading any New Files.<br />Premium Users are NOT affected by this Setting.<br />Setting this to Zero will Disable this Option.',

    '_admpmin_size_seed_e'        => 'Minimum Seed Size for New Downloads',

    '_admpmin_size_seed_eexplain' => 'Defines the Minimum Share Ratio a User must have before Downloading New Files.<br />Premium Users are NOT affected by this setting.<br />Setting this to Zero will Disable this Option.',

    '_admpminupload_size_file'        => 'Minimum File Size for New Torrents',

    '_admpminupload_size_fileexplain' => 'Defines the Minimum File Size a Torrent can be.<br />Premium Users are NOT affected by this Setting.<br />Setting this to Zero will Disable this Option.',

    '_admpmaxupload_day_num'        => 'Maximum Daily Uploads',

    '_admpmaxupload_day_numexplain' => 'Defines how many Torrents can be Uploaded in a Single Day.  Any Uploads above this will NOT be accepted and the User will be asked to try again the following Day.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.',

    '_admpmaxupload_day_share'        => 'Maximum Daily Files Upload',

    '_admpmaxupload_day_shareexplain' => 'Defines the Maximum Total Size of Files (ALL Files within a Torrent Combined) a User can Upload in a Single Day.  Any further Uploads will NOT be Accepted and the User will be asked to try again the following Day.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.',

    '_admpminupload_file_size'        => 'Minimum Torrent Size for Uploads',

    '_admpminupload_file_sizeexplain' => 'Defines the Torrent\'s Minimum Size (ALL Files within a Torrent Combined) for Upload.<br />Premium Users are NOT affected by this Setting.  Setting this to Zero will Disable this Option.',

    '_admpallow_backup_tracker'        => 'Backup Tracker',

    '_admpallow_backup_trackerexplain' => 'Runs your Tracker as a Backup Tracker according to the BitTorrent\'s Announce List extension.<br />Usage is subject to the Announce Level Settings and DOES NOT affect Ratios.<br />This Option is Ignored if Stealth Mode is Enabled.',

    '_admpstealthmode'        => 'Disable Local Tracker',

    '_admpstealthmodeexplain' => 'This will Disable and Hide the Local Tracker.  BTManager will ONLY Accept Externally Tracked Torrents.',

    'SITE_SETTINGS'        => 'Board Configuration',
    'MENU_PRIVATE_MESSAGE' => 'Private Message Settings',
    'MENU_BBCODE'          => 'BBcode Settings',
    'TRACKER_SETTINGS'     => 'Tracker Settings',
    'TRACKER_SETTINGS_EXPLAIN'     => 'This is where you setup your Tracker configurations.',
    'USER_SETTINGS'        => 'User Settings',
    'UPLOAD_SETTINGS'      => 'Torrent Upload Settings',
    'EXT_TORRENT_SETTINGS' => 'External Torrent Upload Settings',

    #Advanced Settings PM
    'PMFULLOPTION' => array('1' => 'Delete Oldest Messages',
                            '2' => 'New Messages will be Held Back'),

    '_admpallow_privmsg'          => 'Private Messaging',
    '_admpallow_privmsgexplain'   => 'Enable or Disable Private Messaging for ALL Users.',
    '_admpallow_pm_attach'        => 'Allow Attachments in Private Messages',
    '_admpallow_pm_attachexplain' => 'Enable or Disable Allowing Attachments in Private Messaging for ALL Users.',

    '_admppm_max_boxes'        => 'Maximum Private Message Folders',
    '_admppm_max_boxesexplain' => 'By Default Users may Create this many Personal Folders for Private Messages.',

    '_admppm_max_msgs'         => 'Maximum Private Messages Per Box',

    '_admppm_max_msgsexplain'  => 'Users can\'t Receive any more than this many Messages in each of their Private Message Boxes.  Set this Value to Zero to Allow Unlimited Messages.',

    '_admpfull_folder_action'        => 'Full Folder Default Action',

    '_admpfull_folder_actionexplain' => 'Default Action to take if a Users Folder is Full, assuming the Users Folder Action is Set at ALL, this is NOT applicable.  The Only exception is for the Sent Messages Folder where the Default Action is always to Delete Old Messages.',

    '_admppm_edit_time'        => 'Limit Editing Time',

    '_admppm_edit_timeexplain' => 'Limits the Time Available to Edit a Private Message that has NOT already been Delivered.  Setting the Value to Zero Disables this Option.',

    '_admpallow_mass_pm'             => 'Allow Sending of Private Messages to Multiple Users and Groups',
    '_admpallow_mass_pmexplain'      => 'Allow Users to Send Private Messages to Multiple Users and Groups',

    '_admpauth_bbcode_pm'            => 'Allow BBCode in Private Messages',
    '_admpauth_bbcode_pmexplain'     => 'Allow Users to use BBCode in Private Messages',

    '_admpauth_smilies_pm'           => 'Allow Smilies in Private Messages',
    '_admpauth_smilies_pmexplain'    => 'Allow Users to use Smilies in Private Messages',

    '_admpallow_sig_pm'              => 'Allow Signature in Private Messages',
    '_admpallow_sig_pmexplain'       => 'Allow Users to use Signatures in Private Messages',

    '_admpprint_pm'                  => 'Allow Print View in Private Messaging',
    '_admpprint_pmexplain'           => 'Allow Users to use the Print View in Private Messaging',

    '_admpforward_pm'                => 'Allow Forwarding of Private Messages',
    '_admpforward_pmexplain'         => 'Allow Users to Forward Private Messages',

    '_admpauth_img_pm'               => 'Allow the use of <em>[IMG]</em> BBCode Tags',
    '_admpauth_img_pmexplain'        => 'Allow Users to use the <em>[IMG]</em> Tag in Private Messages',

    '_admpauth_flash_pm'             => 'Allow the use of <em>[FLASH]</em> BBCode Tags',
    '_admpauth_flash_pmexplain'      => 'Allow Users to use the <em>[FLASH]</em> BBCode Tag in Private Messages',

    '_admpenable_pm_icons'           => 'Enable Topic Icons in Private Messages',
    '_admpenable_pm_iconsexplain'    => 'Allow Users to use Topic Icons in Private Messages',

    '_admpallow_sig'                 => 'Allow Signatures',
    '_admpallow_sigexplain'          => 'Allow Users to use Signatures',

    '_admpallow_sig_bbcode'          => 'Allow BBCode in Users Signatures',
    '_admpallow_sig_bbcodeexplain'   => 'Allow Users to use BBCode in their Signatures',

    '_admpallow_sig_img'             => 'Allow the use of <em>[IMG]</em> BBCode Tag in Users Signatures',
    '_admpallow_sig_imgexplain'      => 'Allow Users to use the <em>[IMG]</em> Tag in User Signatures',

    '_admpallow_sig_flash'           => 'Allow the use of <em>[FLASH]</em> BBCode Tag in User Signatures',
    '_admpallow_sig_flashexplain'    => 'Allow Users to use the <em>[FLASH]</em> BBCode Tag in Users Signatures',

    '_admpallow_sig_smilies'         => 'Allow Smilies in Users Signatures',
    '_admpallow_sig_smiliesexplain'  => 'Allow Users to use Smilies in their Signature',

    '_admpallow_sig_links'           => 'Allow Links in Users Signatures',
    '_admpallow_sig_linksexplain'    => 'Allow Users to use Links in their Signatures',

    '_admpmax_sig_chars'             => 'Maximum Signature Length',
    '_admpmax_sig_charsexplain'      => 'Maximum Number of Characters Allowed in Users Signatures.',

    '_admpmax_sig_urls'              => 'Maximum Signature Links',
    '_admpmax_sig_urlsexplain'       => 'Maximum Number of Links Allowed in Users Signatures.  Set to Zero for Unlimited Links.',

    '_admpmax_sig_font_size'         => 'Maximum Signature Font Size',
    '_admpmax_sig_font_sizeexplain'  => 'Maximum Font Size Allowed in Users Signatures.  Set to Zero for Unlimited Size.',

    '_admpmax_sig_smilies'           => 'Maximum smilies per signature',
    '_admpmax_sig_smiliesexplain'    => 'Maximum Smilies Allowed in Users Signatures.  Set to Zero for Unlimited Smilies.',

    '_admpmax_sig_img_width'         => 'Maximum Signature Image Width',
    '_admpmax_sig_img_widthexplain'  => 'Maximum Width of an Image/Flash File in Users Signatures.  Set to Zero for Unlimited Width.',

    '_admpmax_sig_img_height'        => 'Maximum Signature Image Height',

    '_admpmax_sig_img_heightexplain' => 'Maximum Height of an Image/Flash File in Users Signatures.  Set to Zero for Unlimited Height.',

    '_admpallow_magnet'        => 'Allow eD2K/Magnet Link\'s',
    '_admpallow_magnetexplain' => 'Allow the use of eD2K/Magnet Link\'s',
    '_admpsourcedir'           => 'Sources Directory',

    '_admpsourcedirexplain'    => 'Please give the Full Source Directory Path for System use.<br /><strong>DO NOT</strong> use <strong>/</strong> or <strong>./</strong>',

    'ACP_ATTACHMENTS'          => 'Attachments',
    'ACP_ATTACHMENT_SETTINGS'  => 'Attachment Settings',
    'ACP_BOARD_CONFIGURATION'  => 'Board Configuration',
    'ACP_EXTENSION_GROUPS'     => 'Manage Extension Groups',
    'ACP_MANAGE_EXTENSIONS'    => 'Manage Extensions',
    'ACP_ORPHAN_ATTACHMENTS'   => 'Orphaned Attachments',

    #ADDON 3.0.1
    '_admpannounce_ments'           => 'Announcement\'s',

    '_admpannounce_mentsexplain'    => 'Used for making Site Announcements.<br />These Announcements will be seen by Users in their User - Profile - Edit Section.',

    '_admppm_max_recipients'        => 'Maximum Number of Allowed Recipients',

    '_admppm_max_recipientsexplain' => 'The Maximum Number of Allowed Recipients in a Private Message.  If 0 is Entered, an Unlimited Number is Allowed.  This Setting can be Adjusted for every Group within the Group Settings Page.',

    'PM_SETTING_TITLE_EXPLAIN'      => 'Here you can Set ALL Default Settings for Private Messaging.<br /><br />',
    'PM_SETTING_TITLE'              => 'Private Message Settings',
	'PASSWORD_TYPE'					=> 'Password complexity',
	'PASSWORD_TYPEexplain'			=> 'Determines how complex a password needs to be when set or altered, subsequent options include the previous ones.',
	'PASS_TYPE_ALPHA'				=> 'Must contain letters and numbers',
	'PASS_TYPE_ANY'					=> 'No requirements',
	'PASS_TYPE_CASE'				=> 'Must be mixed case',
	'PASS_TYPE_SYMBOL'				=> 'Must contain symbols',
	'PASSWORD_LENGTH'			=> 'Password length',
	'PASSWORD_LENGTHexplain'	=> 'Minimum and maximum number of characters in passwords.',
	'REG_LIMIT'					=> 'Registration attempts',
	'REG_LIMIT_EXPLAIN'			=> 'Number of attempts users can make at solving the anti-spambot task before being locked out of that session.',
	'USERNAME_ALPHA_ONLY'		=> 'Alphanumeric only',
	'USERNAME_ALPHA_SPACERS'	=> 'Alphanumeric and spacers',
	'USERNAME_ASCII'			=> 'ASCII (no international unicode)',
	'USERNAME_LETTER_NUM'		=> 'Any letter and number',
	'USERNAME_LETTER_NUM_SPACERS'	=> 'Any letter, number, and spacer',
	'USERNAME_CHARS'			=> 'Limit username chars',
	'USERNAME_CHARS_ANY'		=> 'Any character',
	'USERNAME_CHARSexplain'	=> 'Restrict type of characters that may be used in usernames, spacers are: space, -, +, _, [ and ].',
	'USERNAME_LENGTH'			=> 'Username length',
	'USERNAME_LENGTHexplain'	=> 'Minimum and maximum number of characters in usernames.',
	'ACP_REGISTER_SETTINGS_EXPLAIN'		=> 'Here you are able to define registration and profile related settings.',
	'_admplimit_acn_ip'			=> 'Limit Sign Up IP Use',
	'_admplimit_acn_ipexplain'	=> 'Limit the use of the use of a IP from a user to sign up to only ONE.',
	'ACP_REGISTER_SETTINGS'		=> 'Registration Settings',
	'CONFIG_UPDATED_TRACKER'	=> 'The Tracker Settings have been updated',
	'ACP_timezones'		=> array(
		'UTC'					=> 'UTC',
		'UTC_OFFSET'			=> 'UTC%1$s',
		'UTC_OFFSET_CURRENT'	=> 'UTC%1$s - %2$s',

		'Etc/GMT-12'	=> 'UTC+12',
		'Etc/GMT-11'	=> 'UTC+11',
		'Etc/GMT-10'	=> 'UTC+10',
		'Etc/GMT-9'		=> 'UTC+9',
		'Etc/GMT-8'		=> 'UTC+8',
		'Etc/GMT-7'		=> 'UTC+7',
		'Etc/GMT-6'		=> 'UTC+6',
		'Etc/GMT-5'		=> 'UTC+5',
		'Etc/GMT-4'		=> 'UTC+4',
		'Etc/GMT-3'		=> 'UTC+3',
		'Etc/GMT-2'		=> 'UTC+2',
		'Etc/GMT-1'		=> 'UTC+1',
		'Etc/GMT+1'		=> 'UTC-1',
		'Etc/GMT+2'		=> 'UTC-2',
		'Etc/GMT+3'		=> 'UTC-3',
		'Etc/GMT+4'		=> 'UTC-4',
		'Etc/GMT+5'		=> 'UTC-5',
		'Etc/GMT+6'		=> 'UTC-6',
		'Etc/GMT+7'		=> 'UTC-7',
		'Etc/GMT+8'		=> 'UTC-8',
		'Etc/GMT+9'		=> 'UTC-9',
		'Etc/GMT+10'	=> 'UTC-10',
		'Etc/GMT+11'	=> 'UTC-11',
		'Etc/GMT+12'	=> 'UTC-12',

		'Africa/Abidjan'	=> 'Africa/Abidjan',
		'Africa/Accra'		=> 'Africa/Accra',
		'Africa/Addis_Ababa'	=> 'Africa/Addis Ababa',
		'Africa/Algiers'	=> 'Africa/Algiers',
		'Africa/Asmara'		=> 'Africa/Asmara',
		'Africa/Bamako'		=> 'Africa/Bamako',
		'Africa/Bangui'		=> 'Africa/Bangui',
		'Africa/Banjul'		=> 'Africa/Banjul',
		'Africa/Bissau'		=> 'Africa/Bissau',
		'Africa/Blantyre'	=> 'Africa/Blantyre',
		'Africa/Brazzaville'	=> 'Africa/Brazzaville',
		'Africa/Bujumbura'	=> 'Africa/Bujumbura',
		'Africa/Cairo'		=> 'Africa/Cairo',
		'Africa/Casablanca'	=> 'Africa/Casablanca',
		'Africa/Ceuta'		=> 'Africa/Ceuta',
		'Africa/Conakry'	=> 'Africa/Conakry',
		'Africa/Dakar'		=> 'Africa/Dakar',
		'Africa/Dar_es_Salaam'	=> 'Africa/Dar es Salaam',
		'Africa/Djibouti'	=> 'Africa/Djibouti',
		'Africa/Douala'		=> 'Africa/Douala',
		'Africa/El_Aaiun'	=> 'Africa/El Aaiun',
		'Africa/Freetown'	=> 'Africa/Freetown',
		'Africa/Gaborone'	=> 'Africa/Gaborone',
		'Africa/Harare'		=> 'Africa/Harare',
		'Africa/Johannesburg'	=> 'Africa/Johannesburg',
		'Africa/Juba'		=> 'Africa/Juba',
		'Africa/Kampala'	=> 'Africa/Kampala',
		'Africa/Khartoum'	=> 'Africa/Khartoum',
		'Africa/Kigali'		=> 'Africa/Kigali',
		'Africa/Kinshasa'	=> 'Africa/Kinshasa',
		'Africa/Lagos'		=> 'Africa/Lagos',
		'Africa/Libreville'	=> 'Africa/Libreville',
		'Africa/Lome'		=> 'Africa/Lome',
		'Africa/Luanda'		=> 'Africa/Luanda',
		'Africa/Lubumbashi'	=> 'Africa/Lubumbashi',
		'Africa/Lusaka'		=> 'Africa/Lusaka',
		'Africa/Malabo'		=> 'Africa/Malabo',
		'Africa/Maputo'		=> 'Africa/Maputo',
		'Africa/Maseru'		=> 'Africa/Maseru',
		'Africa/Mbabane'	=> 'Africa/Mbabane',
		'Africa/Mogadishu'	=> 'Africa/Mogadishu',
		'Africa/Monrovia'	=> 'Africa/Monrovia',
		'Africa/Nairobi'	=> 'Africa/Nairobi',
		'Africa/Ndjamena'	=> 'Africa/Ndjamena',
		'Africa/Niamey'		=> 'Africa/Niamey',
		'Africa/Nouakchott'	=> 'Africa/Nouakchott',
		'Africa/Ouagadougou'	=> 'Africa/Ouagadougou',
		'Africa/Porto-Novo'	=> 'Africa/Porto-Novo',
		'Africa/Sao_Tome'	=> 'Africa/Sao Tome',
		'Africa/Tripoli'	=> 'Africa/Tripoli',
		'Africa/Tunis'		=> 'Africa/Tunis',
		'Africa/Windhoek'	=> 'Africa/Windhoek',

		'America/Adak'		=> 'America/Adak',
		'America/Anchorage'	=> 'America/Anchorage',
		'America/Anguilla'	=> 'America/Anguilla',
		'America/Antigua'	=> 'America/Antigua',
		'America/Araguaina'	=> 'America/Araguaina',

		'America/Argentina/Buenos_Aires'	=> 'America/Argentina/Buenos Aires',
		'America/Argentina/Catamarca'	=> 'America/Argentina/Catamarca',
		'America/Argentina/Cordoba'		=> 'America/Argentina/Cordoba',
		'America/Argentina/Jujuy'		=> 'America/Argentina/Jujuy',
		'America/Argentina/La_Rioja'	=> 'America/Argentina/La Rioja',
		'America/Argentina/Mendoza'		=> 'America/Argentina/Mendoza',
		'America/Argentina/Rio_Gallegos'	=> 'America/Argentina/Rio Gallegos',
		'America/Argentina/Salta'		=> 'America/Argentina/Salta',
		'America/Argentina/San_Juan'	=> 'America/Argentina/San Juan',
		'America/Argentina/San_Luis'	=> 'America/Argentina/San Luis',
		'America/Argentina/Tucuman'		=> 'America/Argentina/Tucuman',
		'America/Argentina/Ushuaia'		=> 'America/Argentina/Ushuaia',

		'America/Aruba'			=> 'America/Aruba',
		'America/Asuncion'		=> 'America/Asuncion',
		'America/Atikokan'		=> 'America/Atikokan',
		'America/Bahia'			=> 'America/Bahia',
		'America/Bahia_Banderas'	=> 'America/Bahia Banderas',
		'America/Barbados'		=> 'America/Barbados',
		'America/Belem'			=> 'America/Belem',
		'America/Belize'		=> 'America/Belize',
		'America/Blanc-Sablon'	=> 'America/Blanc-Sablon',
		'America/Boa_Vista'		=> 'America/Boa Vista',
		'America/Bogota'		=> 'America/Bogota',
		'America/Boise'			=> 'America/Boise',
		'America/Cambridge_Bay'	=> 'America/Cambridge Bay',
		'America/Campo_Grande'	=> 'America/Campo Grande',
		'America/Cancun'		=> 'America/Cancun',
		'America/Caracas'		=> 'America/Caracas',
		'America/Cayenne'		=> 'America/Cayenne',
		'America/Cayman'		=> 'America/Cayman',
		'America/Chicago'		=> 'America/Chicago',
		'America/Chihuahua'		=> 'America/Chihuahua',
		'America/Costa_Rica'	=> 'America/Costa Rica',
		'America/Creston'		=> 'America/Creston',
		'America/Cuiaba'		=> 'America/Cuiaba',
		'America/Curacao'		=> 'America/Curacao',
		'America/Danmarkshavn'	=> 'America/Danmarkshavn',
		'America/Dawson'		=> 'America/Dawson',
		'America/Dawson_Creek'	=> 'America/Dawson Creek',
		'America/Denver'		=> 'America/Denver',
		'America/Detroit'		=> 'America/Detroit',
		'America/Dominica'		=> 'America/Dominica',
		'America/Edmonton'		=> 'America/Edmonton',
		'America/Eirunepe'		=> 'America/Eirunepe',
		'America/El_Salvador'	=> 'America/El Salvador',
		'America/Fortaleza'		=> 'America/Fortaleza',
		'America/Glace_Bay'		=> 'America/Glace Bay',
		'America/Godthab'		=> 'America/Godthab',
		'America/Goose_Bay'		=> 'America/Goose Bay',
		'America/Grand_Turk'	=> 'America/Grand Turk',
		'America/Grenada'		=> 'America/Grenada',
		'America/Guadeloupe'	=> 'America/Guadeloupe',
		'America/Guatemala'		=> 'America/Guatemala',
		'America/Guayaquil'		=> 'America/Guayaquil',
		'America/Guyana'		=> 'America/Guyana',
		'America/Halifax'		=> 'America/Halifax',
		'America/Havana'		=> 'America/Havana',
		'America/Hermosillo'		=> 'America/Hermosillo',
		'America/Indiana/Indianapolis'	=> 'America/Indiana/Indianapolis',
		'America/Indiana/Knox'		=> 'America/Indiana/Knox',
		'America/Indiana/Marengo'	=> 'America/Indiana/Marengo',
		'America/Indiana/Petersburg'	=> 'America/Indiana/Petersburg',
		'America/Indiana/Tell_City'	=> 'America/Indiana/Tell City',
		'America/Indiana/Vevay'		=> 'America/Indiana/Vevay',
		'America/Indiana/Vincennes'	=> 'America/Indiana/Vincennes',
		'America/Indiana/Winamac'	=> 'America/Indiana/Winamac',
		'America/Inuvik'		=> 'America/Inuvik',
		'America/Iqaluit'		=> 'America/Iqaluit',
		'America/Jamaica'		=> 'America/Jamaica',
		'America/Juneau'		=> 'America/Juneau',
		'America/Kentucky/Louisville'	=> 'America/Kentucky/Louisville',
		'America/Kentucky/Monticello'	=> 'America/Kentucky/Monticello',
		'America/Kralendijk'	=> 'America/Kralendijk',
		'America/La_Paz'		=> 'America/La Paz',
		'America/Lima'			=> 'America/Lima',
		'America/Los_Angeles'	=> 'America/Los Angeles',
		'America/Lower_Princes'	=> 'America/Lower Princes',
		'America/Maceio'		=> 'America/Maceio',
		'America/Managua'		=> 'America/Managua',
		'America/Manaus'		=> 'America/Manaus',
		'America/Marigot'		=> 'America/Marigot',
		'America/Martinique'	=> 'America/Martinique',
		'America/Matamoros'		=> 'America/Matamoros',
		'America/Mazatlan'		=> 'America/Mazatlan',
		'America/Menominee'		=> 'America/Menominee',
		'America/Merida'		=> 'America/Merida',
		'America/Metlakatla'	=> 'America/Metlakatla',
		'America/Mexico_City'	=> 'America/Mexico City',
		'America/Miquelon'		=> 'America/Miquelon',
		'America/Moncton'		=> 'America/Moncton',
		'America/Monterrey'		=> 'America/Monterrey',
		'America/Montevideo'	=> 'America/Montevideo',
		'America/Montreal'		=> 'America/Montreal',
		'America/Montserrat'	=> 'America/Montserrat',
		'America/Nassau'		=> 'America/Nassau',
		'America/New_York'		=> 'America/New York',
		'America/Nipigon'		=> 'America/Nipigon',
		'America/Nome'			=> 'America/Nome',
		'America/Noronha'		=> 'America/Noronha',
		'America/North_Dakota/Beulah'		=> 'America/North Dakota/Beulah',
		'America/North_Dakota/Center'		=> 'America/North Dakota/Center',
		'America/North_Dakota/New_Salem'	=> 'America/North Dakota/New Salem',
		'America/Ojinaga'		=> 'America/Ojinaga',
		'America/Panama'		=> 'America/Panama',
		'America/Pangnirtung'	=> 'America/Pangnirtung',
		'America/Paramaribo'	=> 'America/Paramaribo',
		'America/Phoenix'		=> 'America/Phoenix',
		'America/Port-au-Prince'	=> 'America/Port-au-Prince',
		'America/Port_of_Spain'	=> 'America/Port of Spain',
		'America/Porto_Velho'	=> 'America/Porto Velho',
		'America/Puerto_Rico'	=> 'America/Puerto Rico',
		'America/Rainy_River'	=> 'America/Rainy River',
		'America/Rankin_Inlet'	=> 'America/Rankin Inlet',
		'America/Recife'		=> 'America/Recife',
		'America/Regina'		=> 'America/Regina',
		'America/Resolute'		=> 'America/Resolute',
		'America/Rio_Branco'	=> 'America/Rio Branco',
		'America/Santa_Isabel'	=> 'America/Santa Isabel',
		'America/Santarem'		=> 'America/Santarem',
		'America/Santiago'		=> 'America/Santiago',
		'America/Santo_Domingo'	=> 'America/Santo Domingo',
		'America/Sao_Paulo'		=> 'America/Sao Paulo',
		'America/Scoresbysund'	=> 'America/Scoresbysund',
		'America/Shiprock'		=> 'America/Shiprock',
		'America/Sitka'			=> 'America/Sitka',
		'America/St_Barthelemy'	=> 'America/St. Barthelemy',
		'America/St_Johns'		=> 'America/St. Johns',
		'America/St_Kitts'		=> 'America/St. Kitts',
		'America/St_Lucia'		=> 'America/St. Lucia',
		'America/St_Thomas'		=> 'America/St. Thomas',
		'America/St_Vincent'	=> 'America/St. Vincent',
		'America/Swift_Current'	=> 'America/Swift Current',
		'America/Tegucigalpa'	=> 'America/Tegucigalpa',
		'America/Thule'			=> 'America/Thule',
		'America/Thunder_Bay'	=> 'America/Thunder Bay',
		'America/Tijuana'		=> 'America/Tijuana',
		'America/Toronto'		=> 'America/Toronto',
		'America/Tortola'		=> 'America/Tortola',
		'America/Vancouver'		=> 'America/Vancouver',
		'America/Whitehorse'	=> 'America/Whitehorse',
		'America/Winnipeg'		=> 'America/Winnipeg',
		'America/Yakutat'		=> 'America/Yakutat',
		'America/Yellowknife'	=> 'America/Yellowknife',

		'Antarctica/Casey'		=> 'Antarctica/Casey',
		'Antarctica/Davis'		=> 'Antarctica/Davis',
		'Antarctica/DumontDUrville'	=> 'Antarctica/DumontDUrville',
		'Antarctica/Macquarie'	=> 'Antarctica/Macquarie',
		'Antarctica/Mawson'		=> 'Antarctica/Mawson',
		'Antarctica/McMurdo'	=> 'Antarctica/McMurdo',
		'Antarctica/Palmer'		=> 'Antarctica/Palmer',
		'Antarctica/Rothera'	=> 'Antarctica/Rothera',
		'Antarctica/South_Pole'	=> 'Antarctica/South Pole',
		'Antarctica/Syowa'		=> 'Antarctica/Syowa',
		'Antarctica/Vostok'		=> 'Antarctica/Vostok',

		'Arctic/Longyearbyen'	=> 'Arctic/Longyearbyen',

		'Asia/Aden'			=> 'Asia/Aden',
		'Asia/Almaty'		=> 'Asia/Almaty',
		'Asia/Amman'		=> 'Asia/Amman',
		'Asia/Anadyr'		=> 'Asia/Anadyr',
		'Asia/Aqtau'		=> 'Asia/Aqtau',
		'Asia/Aqtobe'		=> 'Asia/Aqtobe',
		'Asia/Ashgabat'		=> 'Asia/Ashgabat',
		'Asia/Baghdad'		=> 'Asia/Baghdad',
		'Asia/Bahrain'		=> 'Asia/Bahrain',
		'Asia/Baku'			=> 'Asia/Baku',
		'Asia/Bangkok'		=> 'Asia/Bangkok',
		'Asia/Beirut'		=> 'Asia/Beirut',
		'Asia/Bishkek'		=> 'Asia/Bishkek',
		'Asia/Brunei'		=> 'Asia/Brunei',
		'Asia/Choibalsan'	=> 'Asia/Choibalsan',
		'Asia/Chongqing'	=> 'Asia/Chongqing',
		'Asia/Colombo'		=> 'Asia/Colombo',
		'Asia/Damascus'		=> 'Asia/Damascus',
		'Asia/Dhaka'		=> 'Asia/Dhaka',
		'Asia/Dili'			=> 'Asia/Dili',
		'Asia/Dubai'		=> 'Asia/Dubai',
		'Asia/Dushanbe'		=> 'Asia/Dushanbe',
		'Asia/Gaza'			=> 'Asia/Gaza',
		'Asia/Harbin'		=> 'Asia/Harbin',
		'Asia/Hebron'		=> 'Asia/Hebron',
		'Asia/Ho_Chi_Minh'	=> 'Asia/Ho Chi Minh',
		'Asia/Hong_Kong'	=> 'Asia/Hong Kong',
		'Asia/Hovd'			=> 'Asia/Hovd',
		'Asia/Irkutsk'		=> 'Asia/Irkutsk',
		'Asia/Jakarta'		=> 'Asia/Jakarta',
		'Asia/Jayapura'		=> 'Asia/Jayapura',
		'Asia/Jerusalem'	=> 'Asia/Jerusalem',
		'Asia/Kabul'		=> 'Asia/Kabul',
		'Asia/Kamchatka'	=> 'Asia/Kamchatka',
		'Asia/Karachi'		=> 'Asia/Karachi',
		'Asia/Kashgar'		=> 'Asia/Kashgar',
		'Asia/Kathmandu'	=> 'Asia/Kathmandu',
		'Asia/Khandyga'		=> 'Asia/Khandyga',
		'Asia/Kolkata'		=> 'Asia/Kolkata',
		'Asia/Krasnoyarsk'	=> 'Asia/Krasnoyarsk',
		'Asia/Kuala_Lumpur'	=> 'Asia/Kuala Lumpur',
		'Asia/Kuching'		=> 'Asia/Kuching',
		'Asia/Kuwait'		=> 'Asia/Kuwait',
		'Asia/Macau'		=> 'Asia/Macau',
		'Asia/Magadan'		=> 'Asia/Magadan',
		'Asia/Makassar'		=> 'Asia/Makassar',
		'Asia/Manila'		=> 'Asia/Manila',
		'Asia/Muscat'		=> 'Asia/Muscat',
		'Asia/Nicosia'		=> 'Asia/Nicosia',
		'Asia/Novokuznetsk'	=> 'Asia/Novokuznetsk',
		'Asia/Novosibirsk'	=> 'Asia/Novosibirsk',
		'Asia/Omsk'			=> 'Asia/Omsk',
		'Asia/Oral'			=> 'Asia/Oral',
		'Asia/Phnom_Penh'	=> 'Asia/Phnom Penh',
		'Asia/Pontianak'	=> 'Asia/Pontianak',
		'Asia/Pyongyang'	=> 'Asia/Pyongyang',
		'Asia/Qatar'		=> 'Asia/Qatar',
		'Asia/Qyzylorda'	=> 'Asia/Qyzylorda',
		'Asia/Rangoon'		=> 'Asia/Rangoon',
		'Asia/Riyadh'		=> 'Asia/Riyadh',
		'Asia/Sakhalin'		=> 'Asia/Sakhalin',
		'Asia/Samarkand'	=> 'Asia/Samarkand',
		'Asia/Seoul'		=> 'Asia/Seoul',
		'Asia/Shanghai'		=> 'Asia/Shanghai',
		'Asia/Singapore'	=> 'Asia/Singapore',
		'Asia/Taipei'		=> 'Asia/Taipei',
		'Asia/Tashkent'		=> 'Asia/Tashkent',
		'Asia/Tbilisi'		=> 'Asia/Tbilisi',
		'Asia/Tehran'		=> 'Asia/Tehran',
		'Asia/Thimphu'		=> 'Asia/Thimphu',
		'Asia/Tokyo'		=> 'Asia/Tokyo',
		'Asia/Ulaanbaatar'	=> 'Asia/Ulaanbaatar',
		'Asia/Urumqi'		=> 'Asia/Urumqi',
		'Asia/Ust-Nera'		=> 'Asia/Ust-Nera',
		'Asia/Vientiane'	=> 'Asia/Vientiane',
		'Asia/Vladivostok'	=> 'Asia/Vladivostok',
		'Asia/Yakutsk'		=> 'Asia/Yakutsk',
		'Asia/Yekaterinburg'	=> 'Asia/Yekaterinburg',
		'Asia/Yerevan'		=> 'Asia/Yerevan',

		'Atlantic/Azores'		=> 'Atlantic/Azores',
		'Atlantic/Bermuda'		=> 'Atlantic/Bermuda',
		'Atlantic/Canary'		=> 'Atlantic/Canary',
		'Atlantic/Cape_Verde'	=> 'Atlantic/Cape Verde',
		'Atlantic/Faroe'		=> 'Atlantic/Faroe',
		'Atlantic/Madeira'		=> 'Atlantic/Madeira',
		'Atlantic/Reykjavik'	=> 'Atlantic/Reykjavik',
		'Atlantic/South_Georgia'	=> 'Atlantic/South Georgia',
		'Atlantic/St_Helena'	=> 'Atlantic/St. Helena',
		'Atlantic/Stanley'		=> 'Atlantic/Stanley',

		'Australia/Adelaide'	=> 'Australia/Adelaide',
		'Australia/Brisbane'	=> 'Australia/Brisbane',
		'Australia/Broken_Hill'	=> 'Australia/Broken Hill',
		'Australia/Currie'		=> 'Australia/Currie',
		'Australia/Darwin'		=> 'Australia/Darwin',
		'Australia/Eucla'		=> 'Australia/Eucla',
		'Australia/Hobart'		=> 'Australia/Hobart',
		'Australia/Lindeman'	=> 'Australia/Lindeman',
		'Australia/Lord_Howe'	=> 'Australia/Lord Howe',
		'Australia/Melbourne'	=> 'Australia/Melbourne',
		'Australia/Perth'		=> 'Australia/Perth',
		'Australia/Sydney'		=> 'Australia/Sydney',

		'Europe/Amsterdam'	=> 'Europe/Amsterdam',
		'Europe/Andorra'	=> 'Europe/Andorra',
		'Europe/Athens'		=> 'Europe/Athens',
		'Europe/Belgrade'	=> 'Europe/Belgrade',
		'Europe/Berlin'		=> 'Europe/Berlin',
		'Europe/Bratislava'	=> 'Europe/Bratislava',
		'Europe/Brussels'	=> 'Europe/Brussels',
		'Europe/Bucharest'	=> 'Europe/Bucharest',
		'Europe/Budapest'	=> 'Europe/Budapest',
		'Europe/Busingen'	=> 'Europe/Busingen',
		'Europe/Chisinau'	=> 'Europe/Chisinau',
		'Europe/Copenhagen'	=> 'Europe/Copenhagen',
		'Europe/Dublin'		=> 'Europe/Dublin',
		'Europe/Gibraltar'	=> 'Europe/Gibraltar',
		'Europe/Guernsey'	=> 'Europe/Guernsey',
		'Europe/Helsinki'	=> 'Europe/Helsinki',
		'Europe/Isle_of_Man'	=> 'Europe/Isle of Man',
		'Europe/Istanbul'	=> 'Europe/Istanbul',
		'Europe/Jersey'		=> 'Europe/Jersey',
		'Europe/Kaliningrad'	=> 'Europe/Kaliningrad',
		'Europe/Kiev'		=> 'Europe/Kiev',
		'Europe/Lisbon'		=> 'Europe/Lisbon',
		'Europe/Ljubljana'	=> 'Europe/Ljubljana',
		'Europe/London'		=> 'Europe/London',
		'Europe/Luxembourg'	=> 'Europe/Luxembourg',
		'Europe/Madrid'		=> 'Europe/Madrid',
		'Europe/Malta'		=> 'Europe/Malta',
		'Europe/Mariehamn'	=> 'Europe/Mariehamn',
		'Europe/Minsk'		=> 'Europe/Minsk',
		'Europe/Monaco'		=> 'Europe/Monaco',
		'Europe/Moscow'		=> 'Europe/Moscow',
		'Europe/Oslo'		=> 'Europe/Oslo',
		'Europe/Paris'		=> 'Europe/Paris',
		'Europe/Podgorica'	=> 'Europe/Podgorica',
		'Europe/Prague'		=> 'Europe/Prague',
		'Europe/Riga'		=> 'Europe/Riga',
		'Europe/Rome'		=> 'Europe/Rome',
		'Europe/Samara'		=> 'Europe/Samara',
		'Europe/San_Marino'	=> 'Europe/San Marino',
		'Europe/Sarajevo'	=> 'Europe/Sarajevo',
		'Europe/Simferopol'	=> 'Europe/Simferopol',
		'Europe/Skopje'		=> 'Europe/Skopje',
		'Europe/Sofia'		=> 'Europe/Sofia',
		'Europe/Stockholm'	=> 'Europe/Stockholm',
		'Europe/Tallinn'	=> 'Europe/Tallinn',
		'Europe/Tirane'		=> 'Europe/Tirane',
		'Europe/Uzhgorod'	=> 'Europe/Uzhgorod',
		'Europe/Vaduz'		=> 'Europe/Vaduz',
		'Europe/Vatican'	=> 'Europe/Vatican',
		'Europe/Vienna'		=> 'Europe/Vienna',
		'Europe/Vilnius'	=> 'Europe/Vilnius',
		'Europe/Volgograd'	=> 'Europe/Volgograd',
		'Europe/Warsaw'		=> 'Europe/Warsaw',
		'Europe/Zagreb'		=> 'Europe/Zagreb',
		'Europe/Zaporozhye'	=> 'Europe/Zaporozhye',
		'Europe/Zurich'		=> 'Europe/Zurich',

		'Indian/Antananarivo'	=> 'Indian/Antananarivo',
		'Indian/Chagos'		=> 'Indian/Chagos',
		'Indian/Christmas'	=> 'Indian/Christmas',
		'Indian/Cocos'		=> 'Indian/Cocos',
		'Indian/Comoro'		=> 'Indian/Comoro',
		'Indian/Kerguelen'	=> 'Indian/Kerguelen',
		'Indian/Mahe'		=> 'Indian/Mahe',
		'Indian/Maldives'	=> 'Indian/Maldives',
		'Indian/Mauritius'	=> 'Indian/Mauritius',
		'Indian/Mayotte'	=> 'Indian/Mayotte',
		'Indian/Reunion'	=> 'Indian/Reunion',

		'Pacific/Apia'		=> 'Pacific/Apia',
		'Pacific/Auckland'	=> 'Pacific/Auckland',
		'Pacific/Chatham'	=> 'Pacific/Chatham',
		'Pacific/Chuuk'		=> 'Pacific/Chuuk',
		'Pacific/Easter'	=> 'Pacific/Easter',
		'Pacific/Efate'		=> 'Pacific/Efate',
		'Pacific/Enderbury'	=> 'Pacific/Enderbury',
		'Pacific/Fakaofo'	=> 'Pacific/Fakaofo',
		'Pacific/Fiji'		=> 'Pacific/Fiji',
		'Pacific/Funafuti'	=> 'Pacific/Funafuti',
		'Pacific/Galapagos'	=> 'Pacific/Galapagos',
		'Pacific/Gambier'	=> 'Pacific/Gambier',
		'Pacific/Guadalcanal'	=> 'Pacific/Guadalcanal',
		'Pacific/Guam'		=> 'Pacific/Guam',
		'Pacific/Honolulu'	=> 'Pacific/Honolulu',
		'Pacific/Johnston'	=> 'Pacific/Johnston',
		'Pacific/Kiritimati'	=> 'Pacific/Kiritimati',
		'Pacific/Kosrae'	=> 'Pacific/Kosrae',
		'Pacific/Kwajalein'	=> 'Pacific/Kwajalein',
		'Pacific/Majuro'	=> 'Pacific/Majuro',
		'Pacific/Marquesas'	=> 'Pacific/Marquesas',
		'Pacific/Midway'	=> 'Pacific/Midway',
		'Pacific/Nauru'		=> 'Pacific/Nauru',
		'Pacific/Niue'		=> 'Pacific/Niue',
		'Pacific/Norfolk'	=> 'Pacific/Norfolk',
		'Pacific/Noumea'	=> 'Pacific/Noumea',
		'Pacific/Pago_Pago'	=> 'Pacific/Pago Pago',
		'Pacific/Palau'		=> 'Pacific/Palau',
		'Pacific/Pitcairn'	=> 'Pacific/Pitcairn',
		'Pacific/Pohnpei'	=> 'Pacific/Pohnpei',
		'Pacific/Port_Moresby'	=> 'Pacific/Port Moresby',
		'Pacific/Rarotonga'	=> 'Pacific/Rarotonga',
		'Pacific/Saipan'	=> 'Pacific/Saipan',
		'Pacific/Tahiti'	=> 'Pacific/Tahiti',
		'Pacific/Tarawa'	=> 'Pacific/Tarawa',
		'Pacific/Tongatapu'	=> 'Pacific/Tongatapu',
		'Pacific/Wake'		=> 'Pacific/Wake',
		'Pacific/Wallis'	=> 'Pacific/Wallis',
	),
));

?>