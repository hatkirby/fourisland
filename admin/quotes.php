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
4::::::::::::::::4  admin/quotes.php
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

$category = 'quotes';

if (isset($_GET['flagged']))
{
	$pageaid = 'flagged';
} else {
	$pageaid = 'quotes';
}

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'delete')
	{
		if (is_numeric($_POST['id']))
		{
			$delpost = "DELETE FROM rash_quotes WHERE id = " . $_POST['id'];
			$delpost2 = mysql_query($delpost);

			$flashmsg = 'The selected quote has been deleted.';
		}
	} else if ($_GET['action'] == 'deletes')
	{
		$ids = explode(',', $_POST['ids']);

		if (is_array($ids) && !empty($ids))
		{
			foreach ($ids as $id)
			{
				$delpost = "DELETE FROM rash_quotes WHERE id = " . $id;
				$delpost2 = mysql_query($delpost);
			}

			$flashmsg = 'The selected quotes have been deleted.';
		}
	}
}

$template = new FITemplate('admin/quotes');

if (isset($_GET['flagged']))
{
	$template->add('TITLE', 'Manage Flagged Quotes');
	$template->add('FLAGGED', 'flagged=&amp;');

	$getposts = "SELECT * FROM rash_quotes WHERE flag = 1 ORDER BY id DESC";
} else {
	$template->add('TITLE', 'Manage Quotes');
	$template->add('FLAGGED', '');

	$getposts = "SELECT * FROM rash_quotes ORDER BY id DESC";
}

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

foreach ($pager->getPageData() as $post)
{
	if (!empty($post))
	{
		$template->adds_block('QUOTE', array(	'EXCERPT' => htmlspecialchars(strpos($post['quote'],"\n") !== FALSE ? substr($post['quote'],0,strpos($post['quote'],"\n")) : $post['quote']),
							'ID' => $post['id'],
							'ODD' => ($j % 2 ? '' : ' class="odd"')));
	}

	$j++;
}

$template->add('PAGEID', $pager->getCurrentPageID());
$template->add('PAGINATION', $pager->links);

$template->display();

?>
