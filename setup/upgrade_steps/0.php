<?php
$template->set_custom_template('../setup/style/upgrade', 'index.html');
$template->set_filenames(array('index'=>'index.html'));
/*
Operating System Analysis
Useful for setup help
*/
if (strtoupper(substr(PHP_OS,0,3)) == "WIN") $os = "Windows";
else $os = "Linux";
        $template->assign_vars(array(
			'BTMVERSION'		=> sprintf($user->lang['UPDATE_INSTRUCTIONS'],$tchan,$rchan,$ralt),
			'LANGIMG'			=> $langpic,
			'STEPIMG'			=> $stepimg,
			'OPSYSIMG'			=> $os . ".png"
			));
$handle = 'index';
$user->set_lang('httperror',$user->ulanguage);
if (extension_loaded('zlib')){ ob_end_clean();}
if (function_exists('ob_gzhandler') && !ini_get('zlib.output_compression'))
	ob_start('ob_gzhandler');
else
	ob_start();
ob_implicit_flush(0);
$template->display($handle);
die();
?>