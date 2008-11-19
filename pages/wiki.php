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
4::::::::::::::::4  pages/wiki.php
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

$page = (isset($_GET['page']) ? $_GET['page'] : '');

if (!isset($_GET['action']))
{
	$getpage = "SELECT * FROM wiki_pages WHERE slug = \"" . $page . "\"";
	$getpage2 = mysql_query($getpage);
	$getpage3 = mysql_fetch_array($getpage2);

	if ($getpage3['slug'] == $page)
	{
		$getrev = "SELECT * FROM wiki_revisions WHERE id = " . $getpage3['revision'];
		$getrev2 = mysql_query($getrev);
		$getrev3 = mysql_fetch_array($getrev2);

		$title = $getpage3['title'] . ' - Wiki';

		$template = new FITemplate('wiki/page');
		$template->add('TITLE', $getpage3['title']);
		$template->add('CONTENT', parseBBCode($getrev3['text']));
		$template->display();
	} else {
		if (isLoggedIn())
		{
			header('Location: ./?action=create');
			exit;
		} else {
			$template = new FITemplate('msg');
			$template->add('MSG', "The wiki page you are trying to access does not yet exist, and as you are not logged in, you cannot create it. If you would like to, why not log in and create this page?");
			$template->add('BACK', "the previous page");
			$template->display();
		}
	}
} else if ($_GET['action'] == 'create')
{
	if (isLoggedIn())
	{
		$template = new FITemplate('wiki/create');
		$template->display();
	} else {
		$template = new FITemplate('msg');
		$template->add('MSG', "I'm sorry, but you are attempting to create a wiki page while you aren't logged in. Please log in and then return.");
		$template->add('BACK', "the previous page");
		$template->display();
	}
} else if ($_GET['action'] == 'edit')
{
	if (isLoggedIn())
	{
		$getpage = "SELECT * FROM wiki_pages WHERE slug = \"" . $page . "\"";
		$getpage2 = mysql_query($getpage);
		$getpage3 = mysql_fetch_array($getpage2);

		if ($getpage3['slug'] == $page)
		{
			$getrev = "SELECT * FROM wiki_revisions WHERE id = " . $getpage3['revision'];
			$getrev2 = mysql_query($getrev);
			$getrev3 = mysql_fetch_array($getrev2);

			$template = new FITemplate('wiki/edit');
			$template->add('PAGENAME', $getpage3['title']);
			$template->add('PAGETEXT', $getrev3['text']);
			$template->display();
		} else {
			header('Location: ./?action=create');
			exit;
		}
	} else {
		$template = new FITemplate('msg');
		$template->add('MSG', "I'm sorry, but you are attempting to edit a wiki page while you aren't logged in. Please log in and then return.");
		$template->add('BACK', "the previous page");
		$template->display();
	}
} else if ($_GET['action'] == 'submit')
{
	if (isLoggedIn())
	{
		if ($_GET['submit'] == 'create')
		{
			$insrev = "INSERT INTO wiki_revisions (author,text) VALUES (\"" . sess_get('uname') . "\",\"" . addslashes($_POST['text']) . "\")";
			$insrev2 = mysql_query($insrev);

			$getrev = "SELECT * FROM wiki_revisions WHERE author = \"" . sess_get('uname') . "\" AND text = \"" . addslashes($_POST['text']) . "\" ORDER BY id DESC LIMIT 0,1";
			$getrev2 = mysql_query($getrev);
			$getrev3 = mysql_fetch_array($getrev2);

			$slug = generateSlug($_POST['title'],'wiki-pages');

			$inspage = "INSERT INTO wiki_pages (title,slug,revision) VALUES (\"" . $_POST['title'] . "\",\"" . $slug . "\"," . $getrev3['id'] . ")";
			$inspage2 = mysql_query($inspage);

			$template = new FITemplate('msg2');
			$template->add('MSG', 'YAY! You\'ve just created a page!');
			$template->add('LINK', '/wiki/' . $slug . '/');
			$template->add('BACK', 'View the page you just created');
			$template->display();
		} else if ($_GET['submit'] == 'edit')
		{
			$getpage = "SELECT * FROM wiki_pages WHERE slug = \"" . $_GET['page'] . "\"";
			$getpage2 = mysql_query($getpage);
			$getpage3 = mysql_fetch_array($getpage2);

			$insrev = "INSERT INTO wiki_revisions (author,text,previous) VALUES (\"" . sess_get('uname') . "\",\"" . addslashes($_POST['text']) . "\"," . $getpage3['revision'] . ")";
			$insrev2 = mysql_query($insrev);

			$getrev4 = "SELECT * FROM wiki_revisions WHERE author = \"" . sess_get('uname') . "\" AND text = \"" . addslashes($_POST['text']) . "\" AND previous = " . $getpage3['revision'] . " ORDER BY id DESC LIMIT 0,1";
			$getrev5 = mysql_query($getrev4);
			$getrev6 = mysql_fetch_array($getrev5);

			$setpage = "UPDATE wiki_pages SET revision = " . $getrev6['id'] . " WHERE revision = " . $getpage3['revision'];
			$setpage2 = mysql_query($setpage);

			$template = new FITemplate('msg2');
			$template->add('MSG', 'YAY! You\'ve just edited a page!');
			$template->add('LINK', './');
			$template->add('BACK', 'View the page you just edited');
			$template->display();
		}
	} else {
		$template = new FITemplate('msg');
		$template->add('MSG', "I'm sorry, but you are attempting to edit a wiki page while you aren't logged in. Please log in and then return.");
		$template->add('BACK', "the previous page");
		$template->display();
	}
} else if ($_GET['action'] == 'index')
{
	$template = new FITemplate('wiki/index');
	$getpages = "SELECT * FROM wiki_pages, wiki_revisions WHERE wiki_revisions.id = wiki_pages.revision ORDER BY title ASC";
	$getpages2 = mysql_query($getpages);
	$i=0;
	$lastLetter='';
	while ($getpages3[$i] = mysql_fetch_array($getpages2))
	{
		if (substr($getpages3[$i]['title'],0,1) != $lastLetter)
		{
			if (!isset($curID))
			{
				$curID = 0;
			} else {
				$curID++;
			}
			$template->add_ref($curID, 'LETTER', array('TITLE' => substr($getpages3[$i]['title'],0,1)));
			$lastLetter = substr($getpages3[$i]['title'],0,1);
		}

		$template->adds_ref_sub($curID, 'PAGE', array(	'TITLE' => $getpages3[$i]['title'],
								'CODED' => ($getpages3[$i]['slug'] != '' ? $getpages3[$i]['slug'] . '/' : ''),
								'DATE' => date('m-d-y',strtotime($getpages3[$i]['pubDate']))));
		$i++;
	}
	$template->display();
}

?>
