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
4::::::::::::::::4  admin/editLink.php
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

$category = 'links';

$template = new FITemplate('admin/writeLink');
$template->add('TITLE', 'Edit Link');
$template->add('ACTION', '/admin/editLink.php?id=' . $_GET['id'] . '&amp;submit=');

$getlink = "SELECT * FROM links WHERE id = " . $_GET['id'];
$getlink2 = mysql_query($getlink);
$getlink3 = mysql_fetch_array($getlink2);

$pageaid = $getlink3['type'];

if (isset($_GET['submit']))
{
	if (empty($_POST['title']))
	{
		$errors[] = array(	'field' => 'title',
					'text' => 'Title is a required field');
	}

	if (empty($_POST['url']))
	{
		$errors[] = array(	'field' => 'url',
					'text' => 'URL is a required field');
	} else if (!preg_match("/^(http(s?):\\/\\/|ftp:\\/\\/{1})((\w+\.)+)\w{2,}(\/?)$/i", $_POST['url']))
	{
		$errors[] = array(	'field' => 'url',
					'text' => 'URL must be a valid URL');
	}

        if (isset($errors))
        {
                $template->adds_block('ISERROR',array('exi'=>1));

                $eid = 0;
                foreach ($errors as $error)
                {
                        $template->adds_block('ERROR', array(   'ID' => $eid,
                                                                'TEXT' => $error['text']));
                        $template->add('IS' . strtoupper($error['field']) . 'ERROR', ' error');
                        $template->adds_block(strtoupper($error['field']) . 'ERROR', array(     'ID' => $eid,
                                                                                                'TEXT' => $error['text']));

                        $eid++;
                }
        } else {
		$inslink = "UPDATE links SET title = \"" . mysql_real_escape_string($_POST['title']) . "\", url = \"" . mysql_real_escape_string($_POST['url']) . "\" WHERE id = " . $_GET['id'];
		$inslink2 = mysql_query($inslink);

		$template->adds_block('FLASH', array('TEXT' => 'Your link has been sucessfully edited.'));
	}

	$template->add('TITLEVALUE', htmlentities($_POST['title']));
	$template->add('URLVALUE', $_POST['url']);
} else {
	$template->add('TITLEVALUE', htmlentities($getlink3['title']));
	$template->add('URLVALUE', $getlink3['url']);
}

$template->add('TYPEDISABLED', ' readonly="readonly"');
$template->add(strtoupper($getlink3['type']) . 'SELECTED', ' checked="checked"');

$template->display();

?>
