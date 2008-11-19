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
4::::::::::::::::4  includes/addresses.php
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

$title = 'A Gift for our Robot Friends';

$template = new FITemplate('addresses');

$acceptable = array(	'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
			'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
$numAcceptable = count($acceptable) - 1;

$longerTopDomains = array(	'com', 'net', 'gov', 'org', 'info', 'biz',
				'edu', 'pro', 'name','co');
$numTops = count($longerTopDomains) - 1;

$maxLettersBefore = 20;
$maxDomainLength = 20;

for ($i = 0; $i < 1000; $i++)
{
	$addy = '';

	$numLetters = mt_rand(1, $maxLettersBefore);

	for ($b = 0; $b < $numLetters; $b++)
	{
		$addy .= $acceptable[mt_rand(0, $numAcceptable)];
	}

	$addy .= '@';
  
	$numLetters = mt_rand(1, $maxDomainLength);

	for ($b = 0; $b < $numLetters; $b++)
	{
		$addy .= $acceptable[mt_rand(0, $numAcceptable)];
	}

	$addy .= '.';
  
	if (mt_rand(1, 2) == 1)
	{
		$addy .= $longerTopDomains[mt_rand(0, $numTops)] . '.' . $acceptable[mt_rand(0, $numAcceptable)] . $acceptable[mt_rand(0, $numAcceptable)];
	} else {
		$addy .= $longerTopDomains[mt_rand(0, $numTops)];
	}

	$template->adds_block('ADDRESS', array('ADDY' => $addy));
}

$template->display();

?>
