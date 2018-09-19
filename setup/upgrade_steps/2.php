<?php
$template->set_custom_template('../setup/style/upgrade', 'database.html');
$template->set_filenames(array('index'=>'database.html'));
$op			= request_var('op', '');
if($op == 'backup')
{
	$today = getdate();
	$day = $today['mday'];
	if ($day < 10) {
		$day = "0$day";
	}
	$month = $today['mon'];
	if ($month < 10) {
		$month = "0$month";
	}
	$year = $today['year'];
	$hour = $today['hours'];
	$min = $today['minutes'];
	$sec = "00";
	$name = $db_name."-".$day."-".$month."-".$year;
	if($name = backup_tables('*',true,true,$name))
	{
		$wite = 'BACKUP_SUCCESS';
		$pass = true;
	}
	else
	{
		$wite = 'FILE_WRITE_FAIL';
		$pass = false;
	}
        $template->assign_vars(array(
			'BTMVERSION'		=> $user->lang[$wite],
			'LANGIMG'			=> $langpic,
			'STEPIMG'			=> $stepimg,
			'NAME'				=> $name,
			'SITE_URL'			=> $siteurl,
			'OPSYSIMG'			=> $os . ".png",
			'S_LANG'			=> $language,
			'DONE'				=> $pass,
			));
}
else
{
}
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

