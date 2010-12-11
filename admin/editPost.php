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
4::::::::::::::::4  admin/editPost.php
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

$category = 'posts';

if ($_GET['type'] == 'updates')
{
	$pageaid = 'posts';
} else {
	$pageaid = $_GET['type'];
}

$tableToForm = array(	'drafts' => 'draft',
			'pending' => 'article',
			'updates' => 'instant');
$tableToTags = array(	'drafts' => 'draft',
			'pending' => 'pending',
			'updates' => 'published');

if (!isset($_GET['type']) || !isset($_GET['id']) || !is_numeric($_GET['id']))
{
	generateError('404');
} else if (!(($_GET['type'] == 'drafts') || ($_GET['type'] == 'pending') || ($_GET['type'] == 'updates')))
{
	generateError('404');
} else {
	$getpost = 'SELECT * FROM ' . $_GET['type'] . ' WHERE id = ' . $_GET['id'];
	$getpost2 = mysql_query($getpost);
	$getpost3 = mysql_fetch_array($getpost2);

	if ($getpost3['id'] == $_GET['id'])
	{
		$template = new FITemplate('admin/writePost');

		$template->add('TITLE', 'Edit Post');

		if (isset($_GET['submit']))
		{
			if (empty($_POST['title']))
			{
				$errors[] = array(	'field' => 'title',
							'text' => 'Title is a required field');
			}

			if (empty($_POST['text']))
			{
				$errors[] = array(	'field' => 'text',
							'text' => 'The content of a blog post cannot be empty');
			}

			if (empty($_POST['tags']))
			{
				$errors[] = array(	'field' => 'tags',
							'text' => 'Tags is a required field');
			}

			if (
				(strpos($_POST['tags'], ',') === 0) ||
				(strrpos($_POST['tags'], ',') === strlen($_POST['tags'])-1) ||
				(strpos($_POST['tags'], ',,') !== FALSE)
			)
			{
				$errors[] = array(	'field' => 'tags',
							'text' => 'Blank tags are not allowed');
			}

			if (empty($_POST['type']))
			{
				$errors[] = array(	'field' => 'type',
							'text' => 'Type is a required field');
			}
	
			if (isset($errors))
			{
				$template->adds_block('ISERROR',array('exi'=>1));

				$eid = 0;
				foreach ($errors as $error)
				{
					$template->adds_block('ERROR', array(	'ID' => $eid,
										'TEXT' => $error['text']));
					$template->add('IS' . strtoupper($error['field']) . 'ERROR', ' error');
					$template->adds_block(strtoupper($error['field']) . 'ERROR', array(	'ID' => $eid,
														'TEXT' => $error['text']));

					$eid++;
				}

				$template->add('ACTION', '/admin/editPost.php?type=' . $_GET['type'] . '&amp;id=' . $_GET['id'] . '&amp;submit=');
			} else {
				$tags = explode(',', $_POST['tags']);
				removeTags($_GET['id'], $tableToTags[$_GET['type']]);

				if ($tableToForm[$_GET['type']] != $_POST['type'])
				{
					$delold = "DELETE FROM " . $_GET['type'] . " WHERE id = " . $_GET['id'];
					$delold2 = mysql_query($delold);

					if ($_POST['type'] == 'draft')
					{
						$insdraft = "INSERT INTO drafts (title,author,text,slug) VALUES (\"" . mysql_real_escape_string($_POST['title']) . "\",\"" . getSessionUsername() . "\",\"" . mysql_real_escape_string($_POST['text']) . "\",\"" . generateSlug($_POST['title'],'updates') . "\")";
						$insdraft2 = mysql_query($insdraft);

						$id = mysql_insert_id();
						$type = 'drafts';
						addTags($id, $tags, 'draft');
					} else if ($_POST['type'] == 'instant')
					{
						$id = postBlogPost($_POST['title'], getSessionUsername(), $tags, $_POST['text']);
						$type = 'updates';
					} else {
						if ($_POST['type'] == 'article')
						{
							$getpending = "SELECT * FROM pending ORDER BY id DESC LIMIT 0,1";
							$getpending2 = mysql_query($getpending);
							$getpending3 = mysql_fetch_array($getpending2);
							if (isset($getpending3['id']) === FALSE)
							{
								$id = 50;
							} else {
								$id = $getpending3['id']+1;
							}
						} else if ($_POST['type'] == 'high')
						{
							$getpending = "SELECT * FROM pending ORDER BY id ASC LIMIT 0,1";
							$getpending2 = mysql_query($getpending);
							$getpending3 = mysql_fetch_array($getpending2);
							if (isset($getpending3['id']) === FALSE)
							{
								$id = 50;
							} else {
								$id = $getpending3['id']-1;
							}
						}

						$inspending = "INSERT INTO pending (id,title,author,text,slug) VALUES (" . $id . ",\"" . mysql_real_escape_string($_POST['title']) . "\",\"" . getSessionUsername() . "\",\"" . mysql_real_escape_string($_POST['text']) . "\",\"" . generateSlug($_POST['title'],'updates') . "\")";
						$inspending2 = mysql_query($inspending);

						$type = 'pending';
						addTags($id, $tags, 'pending');
					}
				} else if ($_POST['type'] == 'draft')
				{
					$setdraft = "UPDATE drafts SET title = \"" . mysql_real_escape_string($_POST['title']) . "\", text = \"" . mysql_real_escape_string($_POST['text']) . "\" WHERE id = " . $_GET['id'];
					$setdraft2 = mysql_query($setdraft);

					$type = 'drafts';
					$id = $_GET['id'];
					addTags($_GET['id'], $tags, 'draft');
				} else if ($_POST['type'] == 'article')
				{
					$setpending = "UPDATE pending SET title = \"" . mysql_real_escape_string($_POST['title']) . "\", text = \"" . mysql_real_escape_string($_POST['text']) . "\" WHERE id = " . $_GET['id'];
					$setpending2 = mysql_query($setpending);

					$type = 'pending';
					$id = $_GET['id'];
					addTags($_GET['id'], $tags, 'pending');
				} else if ($_POST['type'] == 'instant')
				{
					$setpost = "UPDATE updates SET title = \"" . mysql_real_escape_string($_POST['title']) . "\", text = \"" . mysql_real_escape_string($_POST['text']) . "\" WHERE id = " . $_GET['id'];
					$setpost2 = mysql_query($setpost);

					$type = 'updates';
					$id = $_GET['id'];
					addTags($_GET['id'], $tags);
				}

				if ($type == 'updates')
				{
					$getpost = "SELECT * FROM updates WHERE id = " . $id;
					$getpost2 = mysql_query($getpost);
					$getpost3 = mysql_fetch_array($getpost2);

					$url = '/blog/' . $getpost3['slug'] . '/';
				} else {
					$url = '/viewPost.php?type=' . $type . '&amp;id=' . $id;
				}

				$template->adds_block('FLASH', array('TEXT' => 'Your post has been sucessfully edited. <a href="' . $url . '">View post</a>.'));
				$template->add('ACTION', '/admin/editPost.php?type=' . $type . '&amp;id=' . $id . '&amp;submit=');
			}

			$template->add('TITLEVALUE', htmlspecialchars($_POST['title']));
			$template->add('TEXTVALUE', $_POST['text']);
			$template->add('TAGSVALUE', $_POST['tags']);
			$template->add(strtoupper($_POST['type']) . 'SELECTED', ' checked="checked"');
			if ($_POST['type'] != 'draft') $template->add('TAGSDISABLED', ' readonly="readonly"');
		} else {
			$template->add('TITLEVALUE', htmlspecialchars($getpost3['title']));
			$template->add('TEXTVALUE', $getpost3['text']);
			$template->add('TAGSVALUE', implode(',', getTags($_GET['id'], $tableToTags[$_GET['type']])));
			$template->add(strtoupper($tableToForm[$_GET['type']]) . 'SELECTED', ' checked="checked"');
			if ($_GET['type'] != 'drafts') $template->add('TAGSDISABLED', ' readonly="readonly"');
			$template->add('ACTION', '/admin/editPost.php?type=' . $_GET['type'] . '&amp;id=' . $_GET['id'] . '&amp;submit=');
		}

		$template->display();
	} else {
		generateError('404');
	}
}

?>
