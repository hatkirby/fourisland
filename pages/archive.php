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
4::::::::::::::::4  header.inc
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

$template = new FITemplate('archive');
if (isset($_GET['author']))
{
	$title = 'Author: ' . $_GET['author'] . ' - Blog Archive';
	$template->add('HEADER', 'Posts by ' . $_GET['author']);
	$getposts = "SELECT * FROM updates AS u WHERE author = \"" . $_GET['author'] . "\" ORDER BY id DESC";
	$getbio = "SELECT * FROM bio WHERE username = \"" . $_GET['author'] . "\"";
	$getbio2 = mysql_query($getbio);
	$getbio3 = mysql_fetch_array($getbio2);
	if ($getbio3['username'] == $_GET['author'])
	{
		$template->adds_block('BIO', array(	'TEXT' => $getbio3['text'],
							'USERNAME' => $getbio3['username'],
							'DATE' => date('F jS Y \a\\t g:i:s a',strtotime($getbio3['lastUpdated']))));
	}
} elseif (isset($_GET['tag']))
{
	$title = 'Tag: ' . $_GET['tag'] . ' - Blog Archive';
	$template->add('HEADER', 'Posts tagged with ' . $_GET['tag']);
	$getposts = "SELECT * FROM updates AS u, tags AS t WHERE u.id = t.post_id AND t.post_type = \"published\" AND t.tag = \"" . $_GET['tag'] . "\" ORDER BY u.id DESC";
} else {
	$title = 'Blog Archive';
	$template->add('HEADER', 'Blog Archive');
	$getposts = "SELECT * FROM updates AS u ORDER BY id DESC";
}
$getposts2 = mysql_query($getposts);
$i=0;
while ($getposts3[$i] = mysql_fetch_array($getposts2))
{
	if ((!isset($lastmonth)) || ($lastmonth != date('m-Y',strtotime($getposts3[$i]['pubDate']))))
	{
		if (!isset($curID))
		{
			$curID = 0;
		} else {
			$curID++;
		}
		$template->add_ref($curID, 'MONTH', array('TITLE' => date('F Y',strtotime($getposts3[$i]['pubDate']))));
		$lastmonth = date('m-Y',strtotime($getposts3[$i]['pubDate']));
	}

	$page_id = 'updates-' . $getposts3[$i]['id'];
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

	$template->adds_ref_sub($curID, 'SMALL',array(	'DATE' => date('m-d-Y',strtotime($getposts3[$i]['pubDate'])),
							'CODED' => $getposts3[$i]['slug'],
							'TITLE' => doAprilFoolsDay(htmlspecialchars($getposts3[$i]['title']))));
	$i++;
}
if ($i==0)
{
	generateError('404');
}
$template->display();

?>
