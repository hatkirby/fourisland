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
4::::::::::::::::4  pages/poll.php
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

$pageCategory = 'poll';

if (!isset($_GET['id']))
{
	$template = new FITemplate('pollIndex');

	$getpolls = "SELECT * FROM polloftheweek ORDER BY id DESC";
	$getpolls2 = mysql_query($getpolls);
	$i=0;
	while ($getpolls3[$i] = mysql_fetch_array($getpolls2))
	{
		$template->adds_block('POLL', array(	'ID' => $getpolls3[$i]['id'],
							'QUESTION' => $getpolls3[$i]['question'],
							'WEEK' => date('F jS Y', strtotime($getpolls3[$i]['week']))));
		$i++;
	}

	include('pages/polloftheweek.php');

	$template->display();
} else {
	$template = new FITemplate('poll');

	$getpoll = "SELECT * FROM polloftheweek WHERE id = " . $_GET['id'];
	$getpoll2 = mysql_query($getpoll);
	$getpoll3 = mysql_fetch_array($getpoll2);

	$template->add('QUESTION', $getpoll3['question']);

	$getrss = "SELECT * FROM pollrss WHERE id = " . $_GET['id'];
	$getrss2 = mysql_query($getrss);
	$getrss3 = mysql_fetch_array($getrss2);

	if ($getrss3['id'] == $_GET['id'])
	{
		$template->adds_block('COMPLETE', array(	'RSS' => parseBBCode($getrss3['rss']),
								'AUTHOR' => $getrss3['author'],
								'DATE' => date("F dS Y \a\\t g:i:s a",strtotime($getrss3['date'])),
								'OPTION1' => $getpoll3['option1'],
								'OPTION2' => $getpoll3['option2'],
								'OPTION3' => $getpoll3['option3'],
								'OPTION4' => $getpoll3['option4'],
								'CLICKS1' => $getpoll3['clicks1'],
								'CLICKS2' => $getpoll3['clicks2'],
								'CLICKS3' => $getpoll3['clicks3'],
								'CLICKS4' => $getpoll3['clicks4']));
	} else {
		$template->adds_block('INCOMPLETE', array('exi'=>1));
	}

	$forceDisplay = $_GET['id'];
	include('pages/polloftheweek.php');
	unset($forceDisplay);

	$template->display();

	$page_id = 'polloftheweek-' . $getpoll3['id'];
	include('includes/comments.php');
}

?>
