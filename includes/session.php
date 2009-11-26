<?php
/*
       444444444  
      4::::::::4  
     4:::::::::4  
    4::::44::::4  
   4::::4 4::::4   Four Island
  4::::4  4::::4  
 4::::4   4::::4   Written and maintained by Starla Insigna
4::::444444::::444
4::::::::::::::::4  includes/session.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

if (!defined('S_INCLUDE_FILE')) {define('S_INCLUDE_FILE',1);}

require('headerproc.php');

@session_start();

function getSessionID()
{
	$getconfig = "SELECT * FROM phpbb_config WHERE config_name LIKE \"cookie_name\"";
	$getconfig2 = mysql_query($getconfig);
	$getconfig3 = mysql_fetch_array($getconfig2);

	if (isset($_COOKIE[$getconfig3['config_value'] . '_sid']))
	{
		return $_COOKIE[$getconfig3['config_value'] . '_sid'];
	}

	return false;
}

function getSessionUserID()
{
	$getconfig = "SELECT * FROM phpbb_config WHERE config_name LIKE \"cookie_name\"";
	$getconfig2 = mysql_query($getconfig);
	$getconfig3 = mysql_fetch_array($getconfig2);

	if (isset($_COOKIE[$getconfig3['config_value'] . '_sid']))
	{
		$getsession = "SELECT * FROM phpbb_sessions WHERE session_id LIKE \"" . mysql_real_escape_string($_COOKIE[$getconfig3['config_value'] . '_sid']) . "\"";
		$getsession2 = mysql_query($getsession) or die($getsession);
		$getsession3 = mysql_fetch_array($getsession2);

		return $getsession3['session_user_id'];
	}

	return false;
}

function getSessionUsername()
{
	$getconfig = "SELECT * FROM phpbb_config WHERE config_name LIKE \"cookie_name\"";
	$getconfig2 = mysql_query($getconfig);
	$getconfig3 = mysql_fetch_array($getconfig2);

	if (isset($_COOKIE[$getconfig3['config_value'] . '_sid']))
	{
		$getsession = "SELECT * FROM phpbb_sessions AS s, phpbb_users AS u WHERE s.session_id LIKE \"" . mysql_real_escape_string($_COOKIE[$getconfig3['config_value'] . '_sid']) . "\" AND u.user_id = s.session_user_id";
		$getsession2 = mysql_query($getsession) or die($getsession);
		$getsession3 = mysql_fetch_array($getsession2);

		return $getsession3['username'];
	}

	return false;
}

function isLoggedIn()
{
	$getconfig = "SELECT * FROM phpbb_config WHERE config_name LIKE \"cookie_name\"";
	$getconfig2 = mysql_query($getconfig);
	$getconfig3 = mysql_fetch_array($getconfig2);

	if (isset($_COOKIE[$getconfig3['config_value'] . '_sid']))
	{
		$getsession = "SELECT * FROM phpbb_sessions WHERE session_id LIKE \"" . mysql_real_escape_string($_COOKIE[$getconfig3['config_value'] . '_sid']) . "\"";
		$getsession2 = mysql_query($getsession);
		$getsession3 = mysql_fetch_array($getsession2);

		if ($getsession3['session_user_id'] != '1')
		{
			return true;
		}
	}

	return false;
}

function isAdmin()
{
	if (isLoggedIn())
	{
		$getgroup = "SELECT COUNT(*) FROM phpbb_user_group, phpbb_users WHERE phpbb_user_group.user_id = phpbb_users.user_id AND phpbb_users.username = \"" . getSessionUsername() . "\" AND phpbb_user_group.group_id = 5";
		$getgroup2 = mysql_query($getgroup);
		$getgroup3 = mysql_fetch_array($getgroup2);

		if ($getgroup3['COUNT(*)'] == '1')
		{
			return true;
		}
	}

	return false;
}

?>
