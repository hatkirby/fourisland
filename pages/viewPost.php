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
4::::::::::::::::4  pages/viewPost.php
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

if (!isAdmin())
{
	generateError('404');
} else {
	$template = new FITemplate('post');
	$template->adds_block('INTERNAL',array('exi'=>1));

	$getpost = "SELECT * FROM " . $_GET['type'] . " WHERE id = " . $_GET['id'];
	$getpost2 = mysql_query($getpost);
	$getpost3 = mysql_fetch_array($getpost2);

	if ($getpost3['id'] == $_GET['id'])
	{
		$template->add_ref(0, 'POST', array(	'ID' => $getpost3['id'],
							'YEARID' => (((date('Y')-2007) % 4) + 1),
							'DATE' => date('F jS Y \a\\t g:i:s a'),
							'MONTH' => date('M'),
							'DAY' => date('d'),
							'CODED' => $getpost3['slug'],
							'TITLE' => $getpost3['title'],
							'AUTHOR' => $getpost3['author'],
							'RATING' => $getpost3['rating'],
							'TEXT' => parseText($getpost3['text'])));

		$tags = getTags($getpost3['id']);
		foreach ($tags as $tag)
		{
			$template->adds_ref_sub(0, 'TAGS', array('TAG' => $tag));
		}

		$template->adds_ref_sub(0, 'NOVOTE', array('exi'=>1));
		$template->display();
	} else {
		generateError('404');
	}
}

?>
