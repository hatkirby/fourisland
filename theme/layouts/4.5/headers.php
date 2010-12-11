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
4::::::::::::::::4  theme/css/headers.php
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

?>
/* Four Island Header CSS */
<?php

include_once('../includes/specialdates.php');

if (sd_ifNoSpecialDay())
{
	$bgimgm = 'main';
} elseif (sd_isSpecialDay('Four Island A'))
{
	$bgimgm = 'islandYearly';
} elseif (sd_isSpecialDay('Mothers Day'))
{
	$bgimgm = 'mothers';
} elseif (sd_isSpecialDay('Memorial Day'))
{
	$bgimgm = 'memorial';
} elseif (sd_isSpecialDay('Hatkirbys B-Day'))
{
	$bgimgm = 'hatkirbybday';
} else if (sd_isSpecialDay('CTNH'))
{
	$bgimgm = 'ctnh';
} else {
	$bgimgm = 'main';
}

if ($bgimgm == 'main')
{
	//Check for page-based headers
?>
/* Category-Based Headers */
body.projects div#banner {
 background-image: url("/theme/images/headers/projects.png");
}
body.wiki div#banner {
 background-image: url("/theme/images/headers/kfm.png");
}
body.fourm div#banner {
 background-image: url("/theme/images/headers/fourm.png");
}
body.misc div#banner {
 background-image: url("/theme/images/headers/random.png");
}
body.webs div#banner {
 background-image: url("/theme/images/headers/links.png");
}
body.quotes div#banner {
 background-image: url("/theme/images/headers/quotes.png");
}
/* AID-Based Headers */
<?php
}
?>
div#banner {
 background-image: url("/theme/images/headers/<?php echo($bgimgm); ?>.png"); /*850x129*/
}
