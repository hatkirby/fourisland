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
4::::::::::::::::4  includes/db.php
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

// Make the database connection.
mysql_connect($dbwebhost, $dbwebuser, $dbwebpasswd);
mysql_select_db($dbwebname);

function db_single_select($query)
{
	$getitem1 = $query;
	$getitem2 = mysql_query($getitem1) or die($getitem1);
	$getitem3 = mysql_fetch_array($getitem2);
	return $getitem3;
}

function db_multi_select($query, $callback)
{
	$getitem1 = $query;
	$getitem2 = mysql_query($getitem1) or die($getitem1);
	$i=0;
	while ($getitem3[$i] = mysql_fetch_array($getitem2))
	{
		$callback($getitem3[$i]);
		$i++;
	}
}

function db_count($query)
{
	$cntitem = $query;
	$cntitem2 = mysql_query($cntitem) or die($cntitem);
	$cntitem3 = mysql_fetch_array($cntitem2);

	return $cntitem3['COUNT(*)'];
}

?>
