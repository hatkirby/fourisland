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
4::::::::::::::::4  pages/vote.php
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

$getpost = "SELECT * FROM updates WHERE id = " . $_GET['id'];
$getpost2 = mysql_query($getpost);
$getpost3 = mysql_fetch_array($getpost2);

if ($getpost3['id'] == $_GET['id'])
{
	if ($_GET['dir'] == 'plus')
	{
		$add = 1;
	} else if ($_GET['dir'] == 'minus')
	{
		$add = -1;
	} else {
		die;
	}

	if (updatePop($_GET['id'],'rating',$add))
	{
		$getpost = "SELECT * FROM updates WHERE id = " . $_GET['id'];
		$getpost2 = mysql_query($getpost);
		$getpost3 = mysql_fetch_array($getpost2);

		die($getpost3['rating']);
	} else {
		die;
	}
} else {
	generateError('404');
}

?>
