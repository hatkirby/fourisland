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
4::::::::::::::::4  pages/comic.php
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

$pageCategory = 'wiki';

if (isset($_GET['comic']))
{
	$template = new FITemplate('comic');
	$template->adds_block('INTERNAL',array('exi'=>1));

	$getcomic = "SELECT * FROM comic WHERE slug = \"" . urldecode($_GET['comic']) . "\"";
	$getcomic2 = mysql_query($getcomic);
	$getcomic3 = mysql_fetch_array($getcomic2);

	if ($getcomic3['slug'] == urldecode($_GET['comic']))
	{
		$title = stripslashes($getcomic3['title']) . ' - Kirby Fan Mail';

		$getback = "SELECT * FROM comic WHERE id = " . ($getcomic3['id']-1);
		$getback2 = mysql_query($getback);
		$getback3 = mysql_fetch_array($getback2);
		if (isset($getback3['title']))
		{
			$template->adds_block('BACK', array(	'CODED' => $getback3['slug'],
								'TITLE' => $getback3['title']));
		}

		$getnext = "SELECT * FROM comic WHERE id = " . ($getcomic3['id']+1);
		$getnext2 = mysql_query($getnext);
		$getnext3 = mysql_fetch_array($getnext2);
		if (isset($getnext3['title']))
		{
			$template->adds_block('NEXT', array(	'CODED' => $getnext3['slug'],
								'TITLE' => $getnext3['title']));
		}

		if (stripos($getcomic3['image'], 'gif') !== FALSE)
		{
			$mode = 'scalegif';
		} else {
			$mode = 'scale';
		}

		$template->adds_block('COMIC', array(	'ID' => $getcomic3['id'],
							'YEARID' => ((date('Y',strtotime($getcomic3['pubDate']))-2006) % 4),
							'DATE' => date('F dS Y \a\\t g:i:s a',strtotime($getcomic3['pubDate'])),
							'MONTH' => date('M',strtotime($getcomic3['pubDate'])),
							'DAY' => date('d',strtotime($getcomic3['pubDate'])),
							'CODED' => $getcomic3['slug'],
							'TITLE' => $getcomic3['title'],
							'RATING' => $getcomic3['rating'],
							'TEXT' => parseBBCode($getcomic3['text']),
							'IMAGE' => $getcomic3['image'],
							'MODE' => $mode));

		$template->display();
		$page_id = 'kfm-' . $getcomic3['id'];
		include('includes/comments.php');

		$getrelated = "SELECT *, MATCH (title, text) AGAINST (\"" . addslashes($getcomic3['title']) . "\") AS score FROM comic WHERE MATCH (title, text) AGAINST (\"" . addslashes($getcomic3['title']) . "\") AND id <> " . $getcomic3['id'] . " LIMIT 0,5";
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
								'AUTHOR' => 'Hatkirby',
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
	$template = new FITemplate('comicarchive');
	$title = 'Kirby Fan Mail';
	$getcomics = "SELECT * FROM comic ORDER BY id DESC";
	$getcomics2 = mysql_query($getcomics);
	$i=0;
	while ($getcomics3[$i] = mysql_fetch_array($getcomics2))
	{
		if ((!isset($lastmonth)) || ($lastmonth != date('m-Y',strtotime($getcomics3[$i]['pubDate']))))
		{
			if (!isset($curID))
			{
				$curID = 0;
			} else {
				$curID++;
			}
			$template->add_ref($curID, 'MONTH', array('TITLE' => date('F Y',strtotime($getcomics3[$i]['pubDate']))));
			if ($curID == 0)
			{
				$template->adds_ref_sub($curID, 'BIGEND',array('exi'=>1));
			}
			$lastmonth = date('m-Y',strtotime($getcomics3[$i]['pubDate']));
		}

		$page_id = 'kfm-' . $getcomics3[$i]['id'];
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
			$template->adds_ref_sub($curID, 'BIG',array(	'DATE' => date('m-d-Y',strtotime($getcomics3[$i]['pubDate'])),
									'CODED' => $getcomics3[$i]['slug'],
									'TITLE' => $getcomics3[$i]['title'],
									'ID' => $getcomics3[$i]['id'],
									'YEARID' => ((date('Y',strtotime($getcomics3[$i]['pubDate']))-2006) % 4),
									'MONTH' => date('M',strtotime($getcomics3[$i]['pubDate'])),
									'DAY' => date('d',strtotime($getcomics3[$i]['pubDate'])),
									'AUTHOR' => 'Hatkirby',
									'PLURALCOMMENT' => (isset($plural) ? $plural : ''),
									'COMMENTS' => $comText));
		} else {
			$template->adds_ref_sub($curID, 'SMALL',array(	'DATE' => date('m-d-Y',strtotime($getcomics3[$i]['pubDate'])),
									'CODED' => $getcomics3[$i]['slug'],
									'TITLE' => $getcomics3[$i]['title']));
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
