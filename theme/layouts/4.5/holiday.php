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
4::::::::::::::::4  theme/css/holiday.php
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

if (sd_isSpecialDay('Four Island A'))
{
	$bgimgm = 'islandYearly';
} elseif (sd_isSpecialDay('Christmas Eve'))
{
	$bgimgm = 'christmasEve';
	$bgcolor = 'black';
} elseif (sd_isSpecialDay('Christmas Day'))
{
	$bgimgm = 'christmas';
} elseif (sd_isSpecialDay('New Years Eve'))
{
	$bgimgm = 'newYearsEve';
	$bgcolor = 'black';
} elseif (sd_isSpecialDay('Veterans Day'))
{
	$bgimgm = 'veterans';
} elseif (sd_isSpecialDay('Independance Day'))
{
	$bgimgm = '4ofjuly';
	$bgcolor = 'black';
} elseif (sd_isSpecialDay('Fathers Day'))
{
	$bgimgm = 'fathers';
} elseif (sd_isSpecialDay('Hatkirbys B-Day'))
{
	$bgimgm = 'hatkirbybday';
} elseif (sd_isSpecialDay('Kirby Week'))
{
	$bgimgm = 'kirbyweek';
} elseif (sd_isSpecialDay('Memorial Day'))
{
	$bgimgm = 'memorial';
	$bgcolor = 'gray';
} elseif (sd_isSpecialDay('Mothers Day'))
{
	$bgimgm = 'mothers';
} elseif (sd_isSpecialDay('New Years Day'))
{
	$bgimgm = 'newYear';
} elseif (sd_isSpecialDay('Columbus Day'))
{
	$bgimgm = 'columbus';
} elseif (sd_isSpecialDay('Easter'))
{
	$bgimgm = 'easter';
} elseif (sd_isSpecialDay('Flag Day'))
{
	$bgimgm = 'flagDay';
} elseif (sd_isSpecialDay('Groundhog Day'))
{
	$bgimgm = 'groundhog';
} elseif (sd_isSpecialDay('Halloween'))
{
	$bgimgm = 'halloween';
	$bgcolor = 'black';
} elseif (sd_isSpecialDay('Mardi Gras'))
{
	$bgimgm = 'mardiGras';
} elseif (sd_isSpecialDay('Martin Luther King Day'))
{
	$bgimgm = 'martinLuther';
} elseif (sd_isSpecialDay('Valentines Day'))
{
	$bgimgm = 'valentines';
} else {
	$bgimgm = 'island6';
}

$bodyID = $_GET['id'];
if (!isset($bgcolor))
{
	$bgcolor='aqua';

	include("layouts/4.5/day.css");
} else {
	include("layouts/4.5/night.css");
}

?>

body {
 background-image: url(/theme/images/backgrounds/<?php echo($bgimgm); ?>.PNG) !important;
}
