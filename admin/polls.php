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
4::::::::::::::::4  admin/polls.php
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

$category = 'polls';
$pageaid = 'polls';

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'delete')
	{
		if (is_numeric($_POST['id']))
		{
			$delpoll = "DELETE FROM polloftheweek WHERE id = " . $_POST['id'];
			$delpoll2 = mysql_query($delpoll);

			$flashmsg = 'The selected poll has been deleted.';
		}
	} else if ($_GET['action'] == 'deletes')
	{
		$ids = explode(',', $_POST['ids']);

		if (is_array($ids) && !empty($ids))
		{
			foreach ($ids as $id)
			{
				$delpoll = "DELETE FROM polloftheweek WHERE id = " . $id;
				$delpoll2 = mysql_query($delpoll);
			}

			$flashmsg = 'The selected polls have been deleted.';
		}
	}
}

$template = new FITemplate('admin/polls');

$getposts = "SELECT * FROM polloftheweek ORDER BY id DESC";
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
		$template->adds_block('POST', array(	'TITLE' => htmlentities($post['question']),
							'ID' => $post['id'],
							'ODD' => ($j % 2 ? '' : ' class="odd"')));
	}

	$j++;
}

$template->add('PAGEID', $pager->getCurrentPageID());
$template->add('PAGINATION', $pager->links);

$template->display();

?>
