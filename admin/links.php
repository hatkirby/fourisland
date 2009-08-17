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
4::::::::::::::::4  admin/links.php
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

if (isset($_GET['type']))
{
	$type = $_GET['type'];
} else {
	$type = 'affiliates';
}

$category = 'links';
$pageaid = $type;

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'delete')
	{
		if (is_numeric($_POST['id']))
		{
			$dellink = "DELETE FROM links WHERE id = " . $_POST['id'];
			$dellink2 = mysql_query($dellink);

			$flashmsg = 'The selected link has been deleted.';
		}
	} else if ($_GET['action'] == 'deletes')
	{
		$ids = explode(',', $_POST['ids']);

		if (is_array($ids) && !empty($ids))
		{
			foreach ($ids as $id)
			{
				$dellink = "DELETE FROM links WHERE id = " . $id;
				$dellink2 = mysql_query($dellink);
			}

			$flashmsg = 'The selected links have been deleted.';
		}
	}
}

$template = new FITemplate('admin/links');

if ($type == 'affiliates')
{
	$template->add('TITLE', 'Manage Affiliates');
} else if ($type == 'webprojs')
{
	$template->add('TITLE', 'Manage Website Projects');
}

$getlinks = "SELECT * FROM links WHERE type = \"" . mysql_real_escape_string($type) . "\" ORDER BY id ASC";
$getlinks2 = mysql_query($getlinks);
$i=0;
while ($getlinks3[$i] = mysql_fetch_array($getlinks2))
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
				'itemData' => $getlinks3));

$j=0;

foreach ($pager->getPageData() as $link)
{
	if (!empty($link))
	{
		$template->adds_block('LINK', array(	'TITLE' => $link['title'],
							'URL' => $link['url'],
							'ID' => $link['id'],
							'ODD' => ($j % 2 ? '' : ' class="odd"')));
	}

	$j++;
}

$template->add('PAGEID', $pager->getCurrentPageID());
$template->add('PAGINATION', $pager->links);

$template->display();

?>
