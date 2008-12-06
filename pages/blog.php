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

if ((strpos($_SERVER['REQUEST_URI'],'index.php')) && (isset($_GET['post'])))
{
	header('Location: /blog/' . $_GET['post'] . '/');
}

$pageCategory = 'home';
$pageAID = 'archive';

if (isset($_GET['post']))
{
	$template = new FITemplate('post');
	$template->adds_block('INTERNAL',array('exi'=>1));

	$getpost = "SELECT * FROM updates WHERE slug = \"" . urldecode($_GET['post']) . "\"";
	$getpost2 = mysql_query($getpost);
	$getpost3 = mysql_fetch_array($getpost2);

	if ($getpost3['slug'] == urldecode($_GET['post']))
	{
		updatePop($getpost3['id'],'views');

		$title = stripslashes($getpost3['title']) . ' - Blog Archive';

		$getback = "SELECT * FROM updates WHERE id = " . ($getpost3['id']-1);
		$getback2 = mysql_query($getback);
		$getback3 = mysql_fetch_array($getback2);
		if (isset($getback3['title']))
		{
			$template->adds_block('BACK', array(	'CODED' => $getback3['slug'],
								'TITLE' => $getback3['title']));
		}

		$getnext = "SELECT * FROM updates WHERE id = " . ($getpost3['id']+1);
		$getnext2 = mysql_query($getnext);
		$getnext3 = mysql_fetch_array($getnext2);
		if (isset($getnext3['title']))
		{
			$template->adds_block('NEXT', array(	'CODED' => $getnext3['slug'],
								'TITLE' => $getnext3['title']));
		}

		$template->adds_block('POST', array(	'ID' => $getpost3['id'],
							'YEARID' => ((date('Y',strtotime($getpost3['pubDate']))-2006) % 4),
							'DATE' => date('F dS Y \a\\t g:i:s a',strtotime($getpost3['pubDate'])),
							'MONTH' => date('M',strtotime($getpost3['pubDate'])),
							'DAY' => date('d',strtotime($getpost3['pubDate'])),
							'CODED' => $getpost3['slug'],
							'TITLE' => $getpost3['title'],
							'AUTHOR' => $getpost3['author'],
							'TAG1' => $getpost3['tag1'],
							'TAG2' => $getpost3['tag2'],
							'TAG3' => $getpost3['tag3'],
							'RATING' => $getpost3['rating'],
							'TEXT' => parseBBCode($getpost3['text'])));

		$template->display();
		$page_id = 'updates-' . $getpost3['id'];
		include('includes/comments.php');

		$getrelated = "SELECT *, MATCH (title, text) AGAINST (\"" . addslashes($getpost3['title']) . "\") AS score FROM updates WHERE MATCH (title, text) AGAINST (\"" . addslashes($getpost3['title']) . "\") AND id <> " . $getpost3['id'] . " LIMIT 0,5";
		$getrelated2 = mysql_query($getrelated);
		$i=0;
		while ($getrelated3[$i] = mysql_fetch_array($getrelated2))
		{
			if ($i==0)
			{
				$template = new FITemplate('related');
			}

			$template->adds_block('POST', array(	'TITLE' => $getrelated3[$i]['title'],
								'CODED' => $getrelated3[$i]['slug'],
								'AUTHOR' => $getrelated3[$i]['author'],
								'DATE' => date('F d<\S\U\P>S</\S\U\P> Y',strtotime($getrelated3[$i]['pubDate']))));
			$i++;
		}

		if ($i > 0)
		{
			$template->display();
		}
	} else {
		generateError('404');
	}
} else {
	$template = new FITemplate('archive');
	if (isset($_GET['author']))
	{
		$title = 'Author: ' . $_GET['author'] . ' - Blog Archive';
		$getposts = "SELECT * FROM updates WHERE author = \"" . $_GET['author'] . "\" ORDER BY id DESC";
		$getbio = "SELECT * FROM bio WHERE username = \"" . $_GET['author'] . "\"";
		$getbio2 = mysql_query($getbio);
		$getbio3 = mysql_fetch_array($getbio2);
		if ($getbio3['username'] == $_GET['author'])
		{
			$template->adds_block('BIO', array(	'TEXT' => $getbio3['text'],
								'USERNAME' => $getbio3['username'],
								'DATE' => date('F dS Y \a\\t g:i:s a',strtotime($getbio3['lastUpdated']))));
		}
	} elseif (isset($_GET['tag']))
	{
		$title = 'Tag: ' . $_GET['tag'] . ' - Blog Archive';
		$getposts = "SELECT * FROM updates WHERE tag1 = \"" . $_GET['tag'] . "\" OR tag2 = \"" . $_GET['tag'] . "\" OR tag3 = \"" . $_GET['tag'] . "\" ORDER BY id DESC";
	} else {
		$title = 'Blog Archive';
		$getposts = "SELECT * FROM updates ORDER BY id DESC";
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
			if ($curID == 0)
			{
				$template->adds_ref_sub($curID, 'BIGEND',array('exi'=>1));
			}
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

		if ($curID == 0)
		{
			$template->adds_ref_sub($curID, 'BIG',array(	'DATE' => date('m-d-Y',strtotime($getposts3[$i]['pubDate'])),
									'CODED' => $getposts3[$i]['slug'],
									'TITLE' => $getposts3[$i]['title'],
									'ID' => $getposts3[$i]['id'],
									'YEARID' => ((date('Y',strtotime($getposts3[$i]['pubDate']))-2006) % 4),
									'MONTH' => date('M',strtotime($getposts3[$i]['pubDate'])),
									'DAY' => date('d',strtotime($getposts3[$i]['pubDate'])),
									'AUTHOR' => $getposts3[$i]['author'],
									'PLURALCOMMENT' => (isset($plural) ? $plural : ''),
									'COMMENTS' => $comText,
									'TAG1' => $getposts3[$i]['tag1'],
									'TAG2' => $getposts3[$i]['tag2'],
									'TAG3' => $getposts3[$i]['tag3']));
		} else {
			$template->adds_ref_sub($curID, 'SMALL',array(	'DATE' => date('m-d-Y',strtotime($getposts3[$i]['pubDate'])),
									'CODED' => $getposts3[$i]['slug'],
									'TITLE' => $getposts3[$i]['title']));
		}
		$i++;
	}
	if ($i==0)
	{
		generateError('404');
	}
	$template->display();
}

?>
