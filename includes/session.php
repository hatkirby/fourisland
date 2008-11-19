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

session_start();

function sess_exists($name)
{
	return(isset($_SESSION[$name]));
}

function sess_set($name,$value)
{
	$_SESSION[$name] = $value;
}

function sess_get($name)
{
	return $_SESSION[$name];
}


function sess_getifset($name)
{
	if (sess_exists($name))
	{
		return sess_get($name);
	} else {
		return false;
	}
}

function sess_delete($name)
{
	if (sess_exists($name))
	{
		unset($_SESSION[$name]);
	}
}

?>
