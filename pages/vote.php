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

$pageCategory = 'home';
$pageAID = 'archive';

$getpost = "SELECT * FROM updates WHERE id = " . $_GET['id'];
$getpost2 = mysql_query($getpost);
$getpost3 = mysql_fetch_array($getpost2);

if ($getpost3['id'] == $_GET['id'])
{
	$template = new FITemplate('msg2');
	$template->add('BACK','Back to ' . stripslashes($getpost3['title']));
	$template->add('LINK','/blog/' . $getpost3['slug'] . '/');

	if ($_GET['dir'] == 'plus')
	{
		if (updatePop($_GET['id'],'rating'))
		{
			$template->add('MSG','Thank you for voting!');
		} else {
			$template->add('MSG','I\'m sorry, but you\'ve already voted on this post.');
		}
	} else if ($_GET['dir'] == 'minus')
	{
		if (updatePop($_GET['id'],'rating',-1))
		{
			$template->add('MSG','Thank you for voting!');
		} else {
			$template->add('MSG','I\'m sorry, but you\'ve already voted on this post.');
		}
	} else {
		$template = new FITemplate('msg');
		$template->add('BACK','the previous page');
		$template->add('MSG','Um, what on earth are you doing?');
	}
} else {
	$template = new FITemplate('msg');
	$template->add('BACK','the previous page');
	$template->add('MSG','Um, what on earth are you doing?');
}

$template->display();

?>
