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
4::::::::::::::::4  pages/welcome.php
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

$template = new FITemplate('post');
$template->adds_block('EXTERNAL',array('exi'=>1));

$curID = 0;

$getpost = "SELECT * FROM updates ORDER BY id DESC LIMIT 0,4";
$getpost2 = mysql_query($getpost);
while ($getpost3 = mysql_fetch_array($getpost2))
{
	updatePop($getpost3['id'],'home_views');

	$page_id = 'updates-' . $getpost3['id'];
	$getcomments = "SELECT * FROM comments WHERE page_id = \"" . $page_id . "\" ORDER BY posttime";
	$getcomments2 = mysql_query($getcomments);
	$total_post=0;
	while ($getcomments3[$total_post] = mysql_fetch_array($getcomments2))
	{
		$total_post++;
	}
	if ($total_post >= 2)
	{
		$plural = 's';
	}
	if ($total_post == 0)
	{
		$comText = 'No Comments';
	} elseif ($total_post == 1)
	{
		$comText = '1 Comment';
	} else {
		$comText = $total_post . ' Comments';
	}

	$template->add_ref($curID, 'POST', array(	'ID' => $getpost3['id'],
							'YEARID' => ((date('Y',strtotime($getpost3['pubDate']))-2006) % 4),
							'DATE' => date('F dS Y \a\\t g:i:s a',strtotime($getpost3['pubDate'])),
							'MONTH' => date('M',strtotime($getpost3['pubDate'])),
							'DAY' => date('d',strtotime($getpost3['pubDate'])),
							'CODED' => $getpost3['slug'],
							'TITLE' => $getpost3['title'],
							'AUTHOR' => $getpost3['author'],
							'PLURALCOMMENT' => (isset($plural) ? $plural : ''),
							'COMMENTS' => $comText,
							'RATING' => $getpost3['rating'],
							'TEXT' => parseBBCode($getpost3['text'])));

	$tags = unserialize($getpost3['tags']);
	foreach ($tags as $tag)
	{
		$template->adds_ref_sub($curID, 'TAGS', array('TAG' => $tag));
	}

	$curID++;
}

$template->display();

?>
