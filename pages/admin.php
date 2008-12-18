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
4::::::::::::::::4  pages/admin.php
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

$pageCategory = 'panel';

if (isLoggedIn())
{
	if (getUserlevel() == 1)
	{
		if (!isset($_GET['page']))
		{
			$template = new FITemplate('admin/index');
		} else if ($_GET['page'] == 'writePost')
		{
			if (!isset($_GET['submit']))
			{
				$template = new FITemplate('admin/write');
			} else {
				$tags = explode(',', $_POST['tags']);

				if ($_POST['type'] == 'draft')
				{
					$insdraft = "INSERT INTO drafts (title,author,text,slug) VALUES (\"" . addslashes($_POST['title']) . "\",\"" . sess_get('uname') . "\",\"" . addslashes($_POST['text']) . "\",\"" . generateSlug($_POST['title'],'updates') . "\")";
					$insdraft2 = mysql_query($insdraft);

					$id = mysql_insert_id();
					addTags($id, $tags, 'draft');

					$template = new FITemplate('admin/draftSuccess');
					$template->add('ID', $id);
				} else if ($_POST['type'] == 'instant')
				{
					$id = postBlogPost($_POST['title'], sess_get('uname'), $tags, $_POST['text']);

					$getpost = "SELECT * FROM updates WHERE id = " . $id;
					$getpost2 = mysql_query($getpost);
					$getpost3 = mysql_fetch_array($getpost2);

					$template = new FITemplate('admin/postSuccess');
					$template->add('ID', $id);
					$template->add('CODED', $getpost3['slug']);
				} else {
					if ($_POST['type'] == 'normal')
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
					} else if ($_POST['type'] == 'priority')
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
					} else {
						generateError(404);
					}

					$inspending = "INSERT INTO pending (id,title,author,text,slug) VALUES (" . $id . ",\"" . addslashes($_POST['title']) . "\",\"" . sess_get('uname') . "\",\"" . addslashes($_POST['text']) . "\",\"" . generateSlug($_POST['title'],'updates') . "\")";
					$inspending2 = mysql_query($inspending);

					addTags($id, $tags, 'pending');

					$template = new FITemplate('admin/pendingSuccess');
					$template->add('ID', $id);
				}
			}
		} else if ($_GET['page'] == 'manageDrafts')
		{
			$template = new FITemplate('admin/manageDrafts');

			$getdrafts = "SELECT * FROM drafts ORDER BY id ASC";
			$getdrafts2 = mysql_query($getdrafts);
			$i=0;
			while ($getdrafts3[$i] = mysql_fetch_array($getdrafts2))
			{
				$template->adds_block('DRAFT', array(	'TITLE' => $getdrafts3[$i]['title'],
									'AUTHOR' => $getdrafts3[$i]['author'],
									'ID' => $getdrafts3[$i]['id']));
				$i++;
			}
		} else if ($_GET['page'] == 'editDraft')
		{
			$getdraft = "SELECT * FROM drafts WHERE id = " . $_GET['id'];
			$getdraft2 = mysql_query($getdraft);
			$getdraft3 = mysql_fetch_array($getdraft2);

			if ($getdraft3['id'] == $_GET['id'])
			{
				if (!isset($_GET['submit']))
				{
					$template = new FITemplate('admin/editDraft');
					$template->add('ID', $_GET['id']);
					$template->add('TEXT', $getdraft3['text']);
					$template->add('TAGS', implode(',', getTags($getdraft3['id'], 'draft')));
					$template->add('TITLE', $getdraft3['title']);
				} else {
					$tags = explode(',', $_POST['tags']);
					removeTags($_GET['id'], 'draft');

					if ($_POST['type'] == 'draft')
					{
						$setdraft = "UPDATE drafts SET title = \"" . addslashes($_POST['title']) . "\", text = \"" . addslashes($_POST['text']) . "\" WHERE id = " . $_GET['id'];
						$setdraft2 = mysql_query($setdraft);

						addTags($_GET['id'], $tags, 'draft');

						$template = new FITemplate('admin/draftSuccess');
						$template->add('ID', $_GET['id']);
					} else if ($_POST['type'] == 'instant')
					{
						$id = postBlogPost($_POST['title'], sess_get('uname'), $tags, $_POST['text']);

						$deldraft = "DELETE FROM drafts WHERE id = " . $_GET['id'];
						$deldraft2 = mysql_query($deldraft);

						$getpost = "SELECT * FROM updates WHERE id = " . $id;
						$getpost2 = mysql_query($getpost);
						$getpost3 = mysql_fetch_array($getpost2);

						$template = new FITemplate('admin/postSuccess');
						$template->add('ID', $id);
						$template->add('CODED', $getpost3['slug']);
					} else {
						if ($_POST['type'] == 'normal')
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
						} else if ($_POST['type'] == 'priority')
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
						} else {
							generateError(404);
						}

						$inspending = "INSERT INTO pending (id,title,author,text,tags,slug) VALUES (" . $id . ",\"" . addslashes($_POST['title']) . "\",\"" . sess_get('uname') . "\",\"" . addslashes($_POST['text']) . "\",\"" . $tags . "\",\"" . generateSlug($_POST['title'],'updates') . "\")";
						$inspending2 = mysql_query($inspending);

						addTags($id, $tags, 'pending');

						$deldraft = "DELETE FROM drafts WHERE id = " . $_GET['id'];
						$deldraft2 = mysql_query($deldraft);

						$template = new FITemplate('admin/pendingSuccess');
						$template->add('ID', $id);
					}
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that draft doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'deleteDraft')
		{
			$getdraft = "SELECT * FROM drafts WHERE id = " . $_GET['id'];
			$getdraft2 = mysql_query($getdraft);
			$getdraft3 = mysql_fetch_array($getdraft2);

			if ($getdraft3['id'] == $_GET['id'])
			{
				if (!isset($_GET['submit']))
				{
					$template = new FITemplate('admin/deleteDraft');
					$template->add('ID', $_GET['id']);
				} else {
					$deldraft = "DELETE FROM drafts WHERE id = " . $_GET['id'];
					$deldraft2 = mysql_query($deldraft);

					removeTags($_GET['id'], 'draft');

					$template = new FITemplate('admin/deletedDraft');
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that draft doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'viewDraft')
		{
			$getdraft = "SELECT * FROM drafts WHERE id = " . $_GET['id'];
			$getdraft2 = mysql_query($getdraft);
			$getdraft3 = mysql_fetch_array($getdraft2);

			if ($getdraft3['id'] == $_GET['id'])
			{
				$template = new FITemplate('post');
				$template->adds_block('INTERNAL',array('exi'=>1));
				$template->add_ref(0, 'POST', array(	'ID' => $getdraft3['id'],
									'YEARID' => ((date('Y')-2006) % 4),
									'DATE' => date('F dS Y \a\\t g:i:s a'),
									'MONTH' => date('M'),
									'DAY' => date('d'),
									'CODED' => $getdraft3['slug'],
									'TITLE' => $getdraft3['title'],
									'AUTHOR' => $getdraft3['author'],
									'RATING' => 0,
									'TEXT' => parseText($getdraft3['text'])));

				$tags = getTags($getdraft3['id'], 'draft');
				foreach ($tags as $tag)
				{
					$template->adds_ref_sub(0, 'TAGS', array('TAG' => $tag));
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that draft doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'managePending')
		{
			$template = new FITemplate('admin/managePending');

			$getpending = "SELECT * FROM pending ORDER BY id ASC";
			$getpending2 = mysql_query($getpending);
			$i=0;
			while ($getpending3[$i] = mysql_fetch_array($getpending2))
			{
				$template->adds_block('PENDING', array(	'TITLE' => $getpending3[$i]['title'],
									'AUTHOR' => $getpending3[$i]['author'],
									'ID' => $getpending3[$i]['id']));
				$i++;
			}
		} else if ($_GET['page'] == 'editPending')
		{
			$getpending = "SELECT * FROM pending WHERE id = " . $_GET['id'];
			$getpending2 = mysql_query($getpending);
			$getpending3 = mysql_fetch_array($getpending2);

			if ($getpending3['id'] == $_GET['id'])
			{
				if (!isset($_GET['submit']))
				{
					$template = new FITemplate('admin/editPending');
					$template->add('ID', $_GET['id']);
					$template->add('TEXT', $getpending3['text']);
					$template->add('TAGS', implode(',', getTags($getpending3['id'], 'pending')));
					$template->add('TITLE', $getpending3['title']);
				} else {
					$tags = explode(',', $_POST['tags']);

					$setpending = "UPDATE pending SET title = \"" . addslashes($_POST['title']) . "\", text = \"" . addslashes($_POST['text']) . "\" WHERE id = " . $_GET['id'];
					$setpending2 = mysql_query($setpending);

					removeTags($_GET['id'], 'pending');
					addTags($_GET['id'], $tags, 'pending');

					$template = new FITemplate('admin/pendingSuccess');
					$template->add('ID', $_GET['id']);
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that pending post doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'deletePending')
		{
			$getpending = "SELECT * FROM pending WHERE id = " . $_GET['id'];
			$getpending2 = mysql_query($getpending);
			$getpending3 = mysql_fetch_array($getpending2);

			if ($getpending3['id'] == $_GET['id'])
			{
				if (!isset($_GET['submit']))
				{
					$template = new FITemplate('admin/deletePending');
					$template->add('ID', $_GET['id']);
				} else {
					$delpending = "DELETE FROM pending WHERE id = " . $_GET['id'];
					$delpending2 = mysql_query($delpending);

					removeTags($_GET['id'], 'pending');

					$template = new FITemplate('admin/deletedPending');
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that pending post doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'viewPending')
		{
			$getpending = "SELECT * FROM pending WHERE id = " . $_GET['id'];
			$getpending2 = mysql_query($getpending);
			$getpending3 = mysql_fetch_array($getpending2);

			if ($getpending3['id'] == $_GET['id'])
			{
				$template = new FITemplate('post');
				$template->adds_block('INTERNAL',array('exi'=>1));
				$template->add_ref(0, 'POST', array(	'ID' => $getpending3['id'],
									'YEARID' => ((date('Y')-2006) % 4),
									'DATE' => date('F dS Y \a\\t g:i:s a'),
									'MONTH' => date('M'),
									'DAY' => date('d'),
									'CODED' => $getpending3['slug'],
									'TITLE' => $getpending3['title'],
									'AUTHOR' => $getpending3['author'],
									'RATING' => 0,
									'TEXT' => parseText($getpending3['text'])));	

				$tags = getTags($getpending3['id'], 'pending');
				foreach ($tags as $tag)
				{
					$template->adds_ref_sub(0, 'TAGS', array('TAG' => $tag));
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that pending post doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'movePending')
		{
			$getpending = "SELECT * FROM pending WHERE id = " . $_GET['id'];
			$getpending2 = mysql_query($getpending);
			$getpending3 = mysql_fetch_array($getpending2);

			if ($getpending3['id'] == $_GET['id'])
			{
				if ($_GET['dir'] == 'up')
				{
					$get2pending = "SELECT * FROM pending WHERE id = " . ($_GET['id']-1);
					$get2pending2 = mysql_query($get2pending);
					$get2pending3 = mysql_fetch_array($get2pending2);

					if ($get2pending3['id'] == ($_GET['id']-1))
					{
						$otherPending = $get2pending3;
					} else {
						$template = new FITemplate('msg');
						$template->add('BACK', 'the previous page');
						$template->add('MSG', 'I\'m sorry, that pending post is already the first.');
					}
				} else if ($_GET['dir'] == 'down')
				{
					$get2pending = "SELECT * FROM pending WHERE id = " . ($_GET['id']+1);
					$get2pending2 = mysql_query($get2pending);
					$get2pending3 = mysql_fetch_array($get2pending2);

					if ($get2pending3['id'] == ($_GET['id']+1))
					{
						$otherPending = $get2pending3;
					} else {
						$template = new FITemplate('msg');
						$template->add('BACK', 'the previous page');
						$template->add('MSG', 'I\'m sorry, that pending post is already the last.');
					}
				}

				if (isset($otherPending))
				{
					$delpending = "DELETE FROM pending WHERE id = " . $_GET['id'] . " OR id = " . $otherPending['id'];
					$delpending2 = mysql_query($delpending);

					$inspending = "INSERT INTO pending (id, title, author, text, slug) VALUES (" . $_GET['id'] . ",\"" . $otherPending['title'] . "\",\"" . $otherPending['author'] . "\",\"" . $otherPending['text'] . "\",\"" . $otherPending['slug'] . "\")";
					$inspending2 = mysql_query($inspending);

					$ins2pending = "INSERT INTO pending (id, title, author, text, slug) VALUES (" . $otherPending['id'] . ",\"" . $getpending3['title'] . "\",\"" . $getpending3['author'] . "\",\"" . $getpending3['text'] . "\",\"" . $getpending3['slug'] . "\")";
					$ins2pending2 = mysql_query($ins2pending);

					$tags1 = getTags($_GET['id'], 'pending');
					$tags2 = getTags($otherPending['id'], 'pending');
					removeTags($_GET['id'], 'pending');
					removeTags($otherPending['id'], 'pending');
					addTags($_GET['id'], $tags2, 'pending');
					addTags($otherPending['id'], $tags1, 'pending');

					$template = new FITemplate('admin/managePending');

					$getpending = "SELECT * FROM pending ORDER BY id ASC";
					$getpending2 = mysql_query($getpending);
					$i=0;
					while ($getpending3[$i] = mysql_fetch_array($getpending2))
					{
						$template->adds_block('PENDING', array(	'TITLE' => $getpending3[$i]['title'],
											'AUTHOR' => $getpending3[$i]['author'],
											'ID' => $getpending3[$i]['id']));
						$i++;
					}
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that pending post doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'managePosts')
		{
			$template = new FITemplate('admin/managePosts');

			$getposts = "SELECT * FROM updates ORDER BY id ASC";
			$getposts2 = mysql_query($getposts);
			$i=0;
			while ($getposts3[$i] = mysql_fetch_array($getposts2))
			{
				$template->adds_block('POST', array(	'TITLE' => $getposts3[$i]['title'],
									'AUTHOR' => $getposts3[$i]['author'],
									'ID' => $getposts3[$i]['id'],
									'CODED' => $getposts3[$i]['slug']));
				$i++;
			}
		} else if ($_GET['page'] == 'editPost')
		{
			$getpost = "SELECT * FROM updates WHERE id = " . $_GET['id'];
			$getpost2 = mysql_query($getpost);
			$getpost3 = mysql_fetch_array($getpost2);

			if ($getpost3['id'] == $_GET['id'])
			{
				if (!isset($_GET['submit']))
				{
					$template = new FITemplate('admin/editPost');
					$template->add('ID', $_GET['id']);
					$template->add('TEXT', $getpost3['text']);
					$template->add('TAGS', implode(',', getTags($getpost3['id'])));
					$template->add('TITLE', $getpost3['title']);
				} else {
					$tags = explode(',', $_POST['tags']);

					$setpost = "UPDATE updates SET title = \"" . addslashes($_POST['title']) . "\", text = \"" . addslashes($_POST['text']) . "\" WHERE id = " . $_GET['id'];
					$setpost2 = mysql_query($setpost);

					removeTags($_GET['id']);
					addTags($_GET['id'], $tags);

					$template = new FITemplate('admin/postSuccess');
					$template->add('ID', $_GET['id']);
					$template->add('CODED', $getpost3['slug']);
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that post doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'deletePost')
		{
			$getpost = "SELECT * FROM updates WHERE id = " . $_GET['id'];
			$getpost2 = mysql_query($getpost);
			$getpost3 = mysql_fetch_array($getpost2);

			if ($getpost3['id'] == $_GET['id'])
			{
				if (!isset($_GET['submit']))
				{
					$template = new FITemplate('admin/deletePost');
					$template->add('ID', $_GET['id']);
				} else {
					$delpost = "DELETE FROM updates WHERE id = " . $_GET['id'];
					$delpost2 = mysql_query($delpost);

					removeTags($_GET['id']);

					$template = new FITemplate('admin/deletedPost');
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that post doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'moderateComments')
		{
			$template = new FITemplate('admin/moderateComments');

			$getcomments = "SELECT * FROM moderation ORDER BY id ASC";
			$getcomments2 = mysql_query($getcomments);
			$i=0;
			while ($getcomments3[$i] = mysql_fetch_array($getcomments2))
			{
				$comType = substr($getcomments3[$i]['page_id'],0,strpos($getcomments3[$i]['page_id'],'-'));
				$comID = substr($getcomments3[$i]['page_id'],strpos($getcomments3[$i]['page_id'],'-')+1);

				if ($comType == 'updates')
				{
					$getpost = "SELECT * FROM updates WHERE id = " . $comID;
					$getpost2 = mysql_query($getpost);
					$getpost3 = mysql_fetch_array($getpost2);
					$title = $getpost3['title'];
				} else if ($comType = 'polloftheweek')
				{
					$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $comID;
					$getpoll2 = mysql_query($getpoll);
					$getpoll3 = mysql_fetch_array($getpoll2);
					$title = $getpoll3['question'];
				} else if ($comType = 'quotes')
				{
					$getquote = "SELECT * FROM rash_quotes WHERE id = " . $comID;
					$getquote2 = mysql_query($getquote);
					$getquote3 = mysql_fetch_array($getquote2);
					$title = '#' . $getquote3['id'];
				}

				$template->adds_block('COMMENT', array(	'TITLE' => $title,
									'AUTHOR' => $getcomments3[$i]['author'],
									'ID' => $getcomments3[$i]['id']));
				$i++;
			}
		} else if ($_GET['page'] == 'viewComment')
		{
			$getcomment = "SELECT * FROM moderation WHERE id = " . $_GET['id'];
			$getcomment2 = mysql_query($getcomment);
			$getcomment3 = mysql_fetch_array($getcomment2);

			if ($getcomment3['id'] == $_GET['id'])
			{
				$getuser = "SELECT * FROM users WHERE username = \"" . $getcomment3['author'] . "\"";
				$getuser2 = mysql_query($getuser);
				$getuser3 = mysql_fetch_array($getuser2);

				$template = new FITemplate('admin/viewComment');
				$template->add('ID', $_GET['id']);
				$template->add('USERNAME', $getcomment3['author']);
				$template->add('CODEDEMAIL', md5(strtolower($getuser3['email'])));
				$template->add('TEXT', parseText($getcomment3['comment']));
				$template->add('DATE', date("F dS Y \a\\t g:i:s a",strtotime($getcomment3['pubDate'])));
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that comment doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'actionComment')
		{
			$getcomment = "SELECT * FROM moderation WHERE id = " . $_GET['id'];
			$getcomment2 = mysql_query($getcomment);
			$getcomment3 = mysql_fetch_array($getcomment2);

			if ($getcomment3['id'] == $_GET['id'])
			{
				if (isset($_GET['approve']))
				{
					$insanon = "INSERT INTO anon_commenters (username,email,website) VALUES (\"" . $getcomment3['author'] . "\",\"" . $getcomment3['email'] . "\",\"" . $getcomment3['website'] . "\")";
					$insanon2 = mysql_query($insanon);

					$inscomment = "INSERT INTO comments (page_id,username,comment) VALUES (\"" . $getcomment3['page_id'] . "\",\"" . $getcomment3['author'] . "\",\"" . $getcomment3['comment'] . "\")";
					$inscomment2 = mysql_query($inscomment);

					$delcomment = "DELETE FROM moderation WHERE id = " . $getcomment3['id'];
					$delcomment2 = mysql_query($delcomment);

					$template = new FITemplate('msg');
					$template->add('BACK', 'Comment Moderation');
					$template->add('MSG', 'You\'ve successfully approved this comment.');
				} else if (isset($_GET['deny']))
				{
					$delcomment = "DELETE FROM moderation WHERE id = " . $getcomment3['id'];
					$delcomment2 = mysql_query($delcomment);

					$template = new FITemplate('msg');
					$template->add('BACK', 'Comment Moderation');
					$template->add('MSG', 'You\'ve successfully denied this comment.');
				} else {
					$template = new FITemplate('msg');
					$template->add('BACK', 'the previous page');
					$template->add('MSG', "Um, what on earth are you doing?");
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, that comment doesn\'t exist.');
			}
		} else if ($_GET['page'] == 'pollProcess')
		{
			if (!isset($_GET['step']))
			{
				$template = new FITemplate('admin/pollrss');
			} else if ($_GET['step'] == 2)
			{
				$insrss = "INSERT INTO pollrss (author,rss) VALUES (\"" . sess_get('uname') . "\",\"" . addslashes($_POST['text']) . "\")";
				$insrss2 = mysql_query($insrss);

				$template = new FITemplate('admin/newPoll');
			} else if ($_GET['step'] == 3)
			{
				$inspoll = "INSERT INTO polloftheweek (question,option1,option2,option3,option4) VALUES (\"" . addslashes($_POST['question']) . "\",\"" . $_POST['option1'] . "\",\"" . $_POST['option2'] . "\",\"" . $_POST['option3'] . "\",\"" . $_POST['option4'] . "\")";
				$inspoll2 = mysql_query($inspoll);

				$cleardid = "TRUNCATE TABLE didpollalready";
				$cleardid2 = mysql_query($cleardid);

				$template = new FITemplate('msg2');
				$template->add('BACK', 'Back to the Admin Panel');
				$template->add('LINK', '/admin/');
				$template->add('MSG', "You've successfully created a poll!");
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', "Um, what on earth are you doing?");
			}
		} else if ($_GET['page'] == 'managePendingQuotes')
		{
			$template = new FITemplate('admin/managePendingQuotes');

			$getpending = "SELECT * FROM rash_queue ORDER BY id ASC";
			$getpending2 = mysql_query($getpending);
			$i=0;
			while ($getpending3[$i] = mysql_fetch_array($getpending2))
			{
				if ($i % 2 == 1)
				{
					$template->adds_block('QUOTE', array(	'ID' => $getpending3[$i]['id'],
										'TEXT' => nl2br($getpending3[$i]['quote']),
										'EVEN' => 'even'));
				} else {
					$template->adds_block('QUOTE', array(	'ID' => $getpending3[$i]['id'],
										'TEXT' => nl2br($getpending3[$i]['quote'])));
				}

				$i++;
			}
		} else if ($_GET['page'] == 'actionPendingQuotes')
		{
			$getpending = "SELECT * FROM rash_queue WHERE id = " . $_GET['id'];
			$getpending2 = mysql_query($getpending);
			$getpending3 = mysql_fetch_array($getpending2);

			if ($getpending3['id'] == $_GET['id'])
			{
				if (isset($_GET['approve']))
				{
					$today = mktime(date('G'),date('i'),date('s'),date('m'),date('d'),date('Y'));
					$insquote = "INSERT INTO rash_quotes (quote,date) VALUES (\"" . addslashes($getpending3['quote']) . "\",\"" . $today . "\")";
					$insquote2 = mysql_query($insquote);

					$delpending = "DELETE FROM rash_queue WHERE id = " . $_GET['id'];
					$delpending2 = mysql_query($delpending);

					$template = new FITemplate('msg2');
					$template->add('BACK', 'Back to the Admin Panel');
					$template->add('LINK', '/admin/');
					$template->add('MSG', "You've successfully approved this quote.");
				} else if (isset($_GET['deny']))
				{
					$delpending = "DELETE FROM rash_queue WHERE id = " . $_GET['id'];
					$delpending2 = mysql_query($delpending);

					$template = new FITemplate('msg2');
					$template->add('BACK', 'Back to the Admin Panel');
					$template->add('LINK', '/admin/');
					$template->add('MSG', "You've successfully denied this quote.");
				} else {
					$template = new FITemplate('msg');
					$template->add('BACK', 'the previous page');
					$template->add('MSG', "Um, what on earth are you doing?");
				}
			} else {
				$template = new FITemplate('msg');
				$template->add('BACK', 'the previous page');
				$template->add('MSG', 'I\'m sorry, but this pending quote doesn\'t exist.');
			}
		} else {
			generateError(404);
		}
		@$template->display();
	} else {
		generateError(404);
	}
} else {
	generateError(404);
}

?>
