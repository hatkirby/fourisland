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
4::::::::::::::::4  admin/comments.php
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
$pageaid = 'comments';

if (isset($_GET['action']))
{
	if (($_GET['action'] == 'deny') || ($_GET['action'] == 'approve'))
	{
		if (is_numeric($_POST['id']))
		{
			$getcomment = "SELECT * FROM moderation WHERE id = " . $_POST['id'];
			$getcomment2 = mysql_query($getcomment);
			$getcomment3 = mysql_fetch_array($getcomment2);

			if ($getcomment3['id'] == $_POST['id'])
			{
				if ($_GET['action'] == 'deny')
				{
					$delpost = "DELETE FROM moderation WHERE id = " . $_POST['id'];
					$delpost2 = mysql_query($delpost);

					$flashmsg = 'The selected comment has been deleted.';
				} else if ($_GET['action'] == 'approve')
				{
					$insanon = "INSERT INTO anon_commenters (username,email,website) VALUES (\"" . $getcomment3['author'] . "\",\"" . $getcomment3['email'] . "\",\"" . $getcomment3['website'] . "\")";
					$insanon2 = mysql_query($insanon);

					$inscomment = "INSERT INTO comments (page_id,user_id,comment,is_anon) VALUES (\"" . $getcomment3['page_id'] . "\"," . mysql_insert_id() . ",\"" . $getcomment3['comment'] . "\",1)";
					$inscomment2 = mysql_query($inscomment);

					$delcomment = "DELETE FROM moderation WHERE id = " . $getcomment3['id'];
					$delcomment2 = mysql_query($delcomment);

					$flashmsg = 'The selected comment has been approved.';
				}
			}
		}
	} else if (($_GET['action'] == 'denys') || ($_GET['action'] == 'approves'))
	{
		$ids = explode(',', $_POST['ids']);

		if (is_array($ids) && !empty($ids))
		{
			foreach ($ids as $id)
			{
				$getcomment = "SELECT * FROM moderation WHERE id = " . $id;
				$getcomment2 = mysql_query($getcomment);
				$getcomment3 = mysql_fetch_array($getcomment2);

				if ($getcomment3['id'] == $id)
				{
					if ($_GET['action'] == 'denys')
					{
						$delpost = "DELETE FROM moderation WHERE id = " . $id;
						$delpost2 = mysql_query($delpost);

						$flashmsg = 'The selected comments have been deleted.';
					} else if ($_GET['action'] == 'approves')
					{
						$insanon = "INSERT INTO anon_commenters (username,email,website) VALUES (\"" . $getcomment3['author'] . "\",\"" . $getcomment3['email'] . "\",\"" . $getcomment3['website'] . "\")";
						$insanon2 = mysql_query($insanon);

						$inscomment = "INSERT INTO comments (page_id,user_id,comment,is_anon) VALUES (\"" . $getcomment3['page_id'] . "\"," . mysql_insert_id() . ",\"" . $getcomment3['comment'] . "\",1)";
						$inscomment2 = mysql_query($inscomment);

						$delcomment = "DELETE FROM moderation WHERE id = " . $getcomment3['id'];
						$delcomment2 = mysql_query($delcomment);

						$flashmsg = 'The selected comments have been approved.';
					}
				}
			}
		}
	}
}

$template = new FITemplate('admin/comments');

$getcomments = "SELECT * FROM moderation ORDER BY id ASC";
$getcomments2 = mysql_query($getcomments);
$i=0;
while ($getcomments3[$i] = mysql_fetch_array($getcomments2))
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
				'itemData' => $getcomments3));

$j=0;

foreach ($pager->getPageData() as $comment)
{
	if (!empty($comment))
	{
		$template->adds_block('COMMENT', array(	'TEXT' => parseText($comment['comment']),
							'AUTHOR' => $comment['author'],
							'ID' => $comment['id'],
							'ODD' => ($j % 2 ? '' : ' class="odd"')));
	}

	$j++;
}

$template->add('PAGEID', $pager->getCurrentPageID());
$template->add('PAGINATION', $pager->links);

$template->display();

?>
