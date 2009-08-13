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
4::::::::::::::::4  admin/pending.php
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
require_once('Pager.php');

$category = 'posts';
$pageaid = 'pending';

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'delete')
	{
		if (is_numeric($_POST['id']))
		{
			$delpost = "DELETE FROM pending WHERE id = " . $_POST['id'];
			$delpost2 = mysql_query($delpost);

			$flashmsg = 'The selected pending post has been deleted.';
		}
	} else if (($_GET['action'] == 'moveup') || ($_GET['action'] == 'movedown'))
	{
		if (is_numeric($_GET['id']))
		{
			$getpending = "SELECT * FROM pending WHERE id = " . $_GET['id'];
			$getpending2 = mysql_query($getpending);
			$getpending3 = mysql_fetch_array($getpending2);

			if ($getpending3['id'] == $_GET['id'])
			{
				if ($_GET['action'] == 'moveup')
				{
					$get2pending = "SELECT * FROM pending WHERE id < " . $_GET['id'] . " ORDER BY id DESC LIMIT 0,1";
					$get2pending2 = mysql_query($get2pending);
					$get2pending3 = mysql_fetch_array($get2pending2);

					if (isset($get2pending3['id']))
					{
						$otherPending = $get2pending3;
					}
				} else if ($_GET['action'] == 'movedown')
				{
					$get2pending = "SELECT * FROM pending WHERE id > " . $_GET['id'] . " ORDER BY id ASC LIMIT 0,1";
					$get2pending2 = mysql_query($get2pending);
					$get2pending3 = mysql_fetch_array($get2pending2);

					if (isset($get2pending3['id']))
					{
						$otherPending = $get2pending3;
					}
				}

				if (isset($otherPending))
				{
					$delpending = "DELETE FROM pending WHERE id = " . $_GET['id'] . " OR id = " . $otherPending['id'];
					$delpending2 = mysql_query($delpending);

					$inspending = "INSERT INTO pending (id, title, author, text, slug) VALUES (" . $_GET['id'] . ",\"" . $otherPending['title'] . "\",\"" . $otherPending['author'] . "\",\"" . mysql_real_escape_string($otherPending['text']) . "\",\"" . $otherPending['slug'] . "\")";
					$inspending2 = mysql_query($inspending);

					$ins2pending = "INSERT INTO pending (id, title, author, text, slug) VALUES (" . $otherPending['id'] . ",\"" . $getpending3['title'] . "\",\"" . $getpending3['author'] . "\",\"" . mysql_real_escape_string($getpending3['text']) . "\",\"" . $getpending3['slug'] . "\")";
					$ins2pending2 = mysql_query($ins2pending) or die($ins2pending);

					$tags1 = getTags($_GET['id'], 'pending');
					$tags2 = getTags($otherPending['id'], 'pending');
					removeTags($_GET['id'], 'pending');
					removeTags($otherPending['id'], 'pending');
					addTags($_GET['id'], $tags2, 'pending');
					addTags($otherPending['id'], $tags1, 'pending');

					$flashmsg = 'The selected post was moved sucessfully.';
				}
			}
		}
	} else if ($_GET['action'] == 'deletes')
	{
		$ids = explode(',', $_POST['ids']);

		if (is_array($ids) && !empty($ids))
		{
			foreach ($ids as $id)
			{
				$delpost = "DELETE FROM pending WHERE id = " . $id;
				$delpost2 = mysql_query($delpost);
			}

			$flashmsg = 'The selected posts have been deleted.';
		}
	}
}

$template = new FITemplate('admin/pending');

$getposts = "SELECT * FROM pending ORDER BY id ASC";
$getposts2 = mysql_query($getposts);
$i=0;
while ($getposts3[$i] = mysql_fetch_array($getposts2))
{
	$i++;
}

if ($i != 0)
{
	$template->adds_block('AVAIL',array('exi'=>1));
} else {
	$template->adds_block('NOTAVAIL',array('exi'=>1));
}

$pager = &Pager::factory(array(	'mode' => 'Sliding',
				'perPage' => 20,
				'delta' => 2,
				'itemData' => $getposts3));

$j=0;

if ($pager->isLastPage())
{
	foreach (array_reverse($pager->getPageData()) as $post)
	{
		if (!empty($post))
		{
			$last = $post;
			break;
		}
	}
}

foreach ($pager->getPageData() as $post)
{
	if (!empty($post))
	{
		$template->add_ref($j, 'POST', array(	'TITLE' => $post['title'],
							'AUTHOR' => $post['author'],
							'ID' => $post['id'],
							'CODED' => $post['slug'],
							'ODD' => ($j % 2 ? '' : ' class="odd"')));

		if ($pager->isFirstPage() && ($j == 0))
		{
			$template->adds_ref_sub($j, 'NOMOVEUP', array('exi'=>1));
		} else {
			$template->adds_ref_sub($j, 'CANMOVEUP', array('exi'=>1));
		}

		if ($pager->isLastPage() && ($post == $last))
		{
			$template->adds_ref_sub($j, 'NOMOVEDOWN', array('exi'=>1));
		} else {
			$template->adds_ref_sub($j, 'CANMOVEDOWN', array('exi'=>1));
		}
	}

	$j++;
}

$template->add('PAGEID', $pager->getCurrentPageID());
$template->add('PAGINATION', $pager->links);

$template->display();

?>
