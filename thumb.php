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
4::::::::::::::::4  thumb.php
4444444444:::::444
          4::::4   Please do not use, reproduce or steal the
          4::::4   contents of this file without explicit
          4::::4   permission from Hatkirby.
        44::::::44
        4::::::::4
        4444444444
*/

require('headerproc.php');

if ($_GET['mode'] != 'scalegif')
{
	header('Content-type: image/png');
} else {
	header('Content-type: image/gif');
}

$filename = $_GET['file'];

switch ($_GET['mode'])
{
	case 'scale':
		$mode = 'scale';
		$side = $_GET['side'];
		$by = $_GET['by'];
		if (file_exists($filename)) {
			$im2    = imagecreatefrompng($filename);
			list($width, $height, $type, $attr) = getimagesize($filename);
			if ($side == 0) {
				if ($by < $width)
				{
					$width2 = $by;
				} else {
					$width2 = $width;
				}
			} else {
				if ($by < $height)
				{
					$width2 = ($width/100)*($height/$by*100);
				} else {
					$width2 = $width;
				}
			}
			if ($side == 1) {
				if ($by < $height)
				{
					$height2 = $by;
				} else {
					$height2 = $height;
				}
			} else {
				if ($by < $width)
				{
					$height2 = ($height/100)*($by/$width*100);
				} else {
					$height2 = $height;
				}
			}
			$im     = imagecreatetruecolor($width2,$height2);
			$b      = imagecopyresized($im,$im2,0,0,0,0,$width2,$height2,$width,$height);
			imagepng($im);
			imagedestroy($im);
			exit;
		}
	case 'scalegif':
		$mode = 'scalegif';
		$side = $_GET['side'];
		$by = $_GET['by'];
		if (file_exists($filename)) {
			$im2    = imagecreatefromgif($filename);
			list($width, $height, $type, $attr) = getimagesize($filename);
			if ($side == 0) {
				if ($by < $width)
				{
					$width2 = $by;
				} else {
					$width2 = $width;
				}
			} else {
				if ($by < $height)
				{
					$width2 = ($width/100)*($height/$by*100);
				} else {
					$width2 = $width;
				}
			}
			if ($side == 1) {
				if ($by < $height)
				{
					$height2 = $by;
				} else {
					$height2 = $height;
				}
			} else {
				if ($by < $width)
				{
					$height2 = ($height/100)*($by/$width*100);
				} else {
					$height2 = $height;
				}
			}
			$im     = imagecreatetruecolor($width2,$height2);
			$b      = imagecopyresized($im,$im2,0,0,0,0,$width2,$height2,$width,$height);
			imagegif($im);
			imagedestroy($im);
			exit;
		}
	case 'percent':
		$mode = 'percent';
		$by = $_GET['by'];
		if (file_exists($filename)) {
			$im2    = imagecreatefrompng($filename);
			list($width, $height, $type, $attr) = getimagesize($filename);
			$width2 = ($width/100)*$by;
			$height2 = ($height/100)*$by;
			$im     = imagecreatetruecolor($width2,$height2);
			$b      = imagecopyresized($im,$im2,0,0,0,0,$width2,$height2,$width,$height);
			imagepng($im);
			imagedestroy($im);
			exit;
		}				
	default:
		$string = 'An error was encountered.';
		$im2    = imagecreatefrompng("theme/images/blue.PNG");
		$im     = imagecreate(200,30);
		$b      = imagecopyresized($im,$im2,0,0,0,0,400,400,1,1);
		$orange = imagecolorallocate($im, 220, 210, 60);
		$px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
		imagestring($im, 3, $px, 9, $string, $orange);
		imagepng($im);
		imagedestroy($im);
		exit;
}

?>
