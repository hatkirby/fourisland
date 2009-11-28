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
4::::::::::::::::4  pages/blog.php
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

$pageCategory = 'blog';
$pageAID = 'archive';

$hatNav = array(        array(  'title' => 'Archive',
                                'url' => 'http://fourisland.com/blog/',
                                'icon' => '16-file-archive'));

$template = new FITemplate('post');
$template->add('IFXAMP', $xhtml ? '&amp;' : '&');
$template->add('IFXLT', $xhtml ? '&lt;' : '<');
$template->add('IFXGT', $xhtml ? '&gt;' : '>');

if (isset($_GET['post']))
{
	$template->adds_block('INTERNAL',array('exi'=>1));

	$getpost = "SELECT * FROM updates WHERE slug = \"" . urldecode($_GET['post']) . "\"";
	$getpost2 = mysql_query($getpost);
	$getpost3 = mysql_fetch_array($getpost2);

	if ($getpost3['slug'] == urldecode($_GET['post']))
	{
		updatePop($getpost3['id'],'views');

		$title = stripslashes(htmlentities($getpost3['title'])) . ' - Blog Archive';

		$getback = "SELECT * FROM updates WHERE id < " . $getpost3['id'] . " ORDER BY id DESC LIMIT 0,1";
		$getback2 = mysql_query($getback);
		$getback3 = mysql_fetch_array($getback2);
		if (isset($getback3['title']))
		{
			$template->adds_block('BACK', array(	'CODED' => $getback3['slug'],
								'TITLE' => htmlentities(stripslashes($getback3['title']))));
		}

		$getnext = "SELECT * FROM updates WHERE id > " . $getpost3['id'] . " ORDER BY id ASC LIMIT 0,1";
		$getnext2 = mysql_query($getnext);
		$getnext3 = mysql_fetch_array($getnext2);
		if (isset($getnext3['title']))
		{
			$template->adds_block('NEXT', array(	'CODED' => $getnext3['slug'],
								'TITLE' => htmlentities(stripslashes($getnext3['title']))));
		}

		$template->add_ref(0, 'POST', array(	'ID' => $getpost3['id'],
							'YEARID' => ((date('Y',strtotime($getpost3['pubDate']))-2006) % 4),
							'DATE' => date('F jS Y \a\\t g:i:s a',strtotime($getpost3['pubDate'])),
							'MONTH' => date('M',strtotime($getpost3['pubDate'])),
							'DAY' => date('d',strtotime($getpost3['pubDate'])),
							'CODED' => $getpost3['slug'],
							'TITLE' => htmlentities(stripslashes($getpost3['title'])),
							'AUTHOR' => $getpost3['author'],
							'RATING' => $getpost3['rating'],
							'TEXT' => parseText(stripslashes($getpost3['text']))));

		$tags = getTags($getpost3['id']);
		foreach ($tags as $tag)
		{
			$template->adds_ref_sub(0, 'TAGS', array('TAG' => $tag));
		}

		$gettrack = "SELECT * FROM tracking WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
		$gettrack2 = mysql_query($gettrack);
		$gettrack3 = mysql_fetch_array($gettrack2);

		$trackArr = explode(',',$gettrack3['rating']);

		if (($gettrack3['ip'] != $_SERVER['REMOTE_ADDR']) || (array_search($getpost3['id'],$trackArr) === FALSE))
		{
			$template->adds_ref_sub(0, 'CANVOTE', array('exi'=>1));
		} else {
			$template->adds_ref_sub(0, 'NOVOTE', array('exi'=>1));
		}

		$template->display();

		$getpings = "SELECT * FROM pingbacks WHERE post_id = " . $getpost3['id'];
		$getpings2 = mysql_query($getpings);
		$i=0;
		while ($getpings3[$i] = mysql_fetch_array($getpings2))
		{
			if ($i==0)
			{
				$template = new FITemplate('pingbacks');
			}

			$template->adds_block('PINGBACK', array(	'TITLE' => $getpings3[$i]['title'],
									'URL' => htmlspecialchars($getpings3[$i]['url']),
									'DATE' => date('F jS Y', strtotime($getpings3[$i]['pubDate']))));
			$i++;
		}

		if ($i > 0)
		{
			$template->display();
		}

		$page_id = 'updates-' . $getpost3['id'];
		include('includes/comments.php');

		displayRelated($getpost3['title'], $getpost3['id']);
	} else {
		generateError('404');
	}
} else {
	$template->adds_block('EXTERNAL',array('exi'=>1));

	$curID = 0;

	$gettrack = "SELECT * FROM tracking WHERE ip = \"" . $_SERVER['REMOTE_ADDR'] . "\"";
	$gettrack2 = mysql_query($gettrack);
	$gettrack3 = mysql_fetch_array($gettrack2);

	$trackArr = explode(',',$gettrack3['rating']);

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
								'DATE' => date('F jS Y \a\\t g:i:s a',strtotime($getpost3['pubDate'])),
								'MONTH' => date('M',strtotime($getpost3['pubDate'])),
								'DAY' => date('d',strtotime($getpost3['pubDate'])),
								'CODED' => $getpost3['slug'],
								'TITLE' => htmlentities(stripslashes($getpost3['title'])),
								'AUTHOR' => $getpost3['author'],
								'PLURALCOMMENT' => (isset($plural) ? $plural : ''),
								'COMMENTS' => $comText,
								'RATING' => $getpost3['rating'],
								'TEXT' => parseText(stripslashes($getpost3['text']))));

		$tags = getTags($getpost3['id']);
		foreach ($tags as $tag)
		{
			$template->adds_ref_sub($curID, 'TAGS', array('TAG' => $tag));
		}

		if (($gettrack3['ip'] != $_SERVER['REMOTE_ADDR']) || (array_search($getpost3['id'],$trackArr) === FALSE))
		{
			$template->adds_ref_sub($curID, 'CANVOTE', array('exi'=>1));
		} else {
			$template->adds_ref_sub($curID, 'NOVOTE', array('exi'=>1));
		}

		$curID++;
	}

	$template->display();
}

?>
