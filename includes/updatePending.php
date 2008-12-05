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
4::::::::::::::::4  includes/updatePending.php
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

//$disablePendingQueue = 1; // Use this when Four Island goes down

if ((!isset($disablePendingQueue)) && (date('j') != 'Sat'))
{
	$gettime = "SELECT * FROM config WHERE name = \"lastUpdate\"";
	$gettime2 = mysql_query($gettime);
	$gettime3 = mysql_fetch_array($gettime2);
	if (($gettime3['value'] != date('md')) && (time() > strtotime('12:30')))
	{
		$cntpending = "SELECT COUNT(*) FROM pending";
		$cntpending2 = mysql_query($cntpending);
		$cntpending3 = mysql_fetch_array($cntpending2);
		if ($cntpending3[0] != 0)
		{
			$getpost = "SELECT * FROM pending ORDER BY id ASC LIMIT 0,1";
			$getpost2 = mysql_query($getpost);
			$getpost3 = mysql_fetch_array($getpost2);

			postBlogPost($getpost3['title'], $getpost3['author'], $getpost3['tag1'], $getpost3['tag2'], $getpost3['tag3'], $getpost3['text']);

			$delpost = "DELETE FROM pending WHERE id = " . $getpost3['id'];
			$delpost2 = mysql_query($delpost);
		}
	}
}

?>
