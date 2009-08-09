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
4::::::::::::::::4  pages/poll-results.php
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

if ((isset($_GET['id'])) && (is_numeric($_GET['id'])) && ($_GET['id'] >= 1) && ($_GET['id'] <= 4))
{
	if (isLoggedIn())
	{
		$getip = "SELECT * FROM didpollalready WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
		$getip2 = mysql_query($getip);
		$getip3 = mysql_fetch_array($getip2);

		if ($getip3['ip'] != $_SERVER['REMOTE_ADDR'])
		{
			$setip = "INSERT INTO didpollalready SET ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
			$setip2 = mysql_query($setip);
			$getpoll = "SELECT * FROM polloftheweek ORDER BY id DESC LIMIT 0,1";
			$getpoll2 = mysql_query($getpoll);
			$getpoll3 = mysql_fetch_array($getpoll2);
			$setpoll = "UPDATE polloftheweek SET clicks" . $_GET['id'] . " = " . ($getpoll3['clicks' . $_GET['id']]+1) . " WHERE id = " . $getpoll3['id'];
			$setpoll2 = mysql_query($setpoll);

			die(getPollOfTheWeek());
		} else {
			generateError('404');
		}
	} else {
		generateError('404');
	}
} else {
	generateError('404');
}

?>
