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
4::::::::::::::::4  theme/css.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

require('../headerproc.php');

header('Content-type: text/css');

include('../../security/config.php');
include('../includes/db.php');
include('../includes/specialdates.php');

include("css/website.css");
include("css/bubbles.css");

if (sd_ifNoSpecialDay())
{
	if ($_GET['id'] == 'day')
	{
		include("css/day.css");
	} else if ($_GET['id'] == 'night')
	{
		include("css/night.css");
	}
} else {
	include("css/holiday.php");
}

if ($_GET['cat'] == 'home')
{
	include('css/blog.php');
} else if ($_GET['cat'] == 'panel')
{
	include('css/blog.php');
}

?>
