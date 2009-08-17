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
4::::::::::::::::4  admin/newLink.php
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
$pageaid = 'newlink';

$template = new FITemplate('admin/writeLink');

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
                        $template->adds_block('ERROR', array(   'ID' => $eid,
                                                                'TEXT' => $error['text']));
                        $template->add('IS' . strtoupper($error['field']) . 'ERROR', ' error');
                        $template->adds_block(strtoupper($error['field']) . 'ERROR', array(     'ID' => $eid,
                                                                                                'TEXT' => $error['text']));

                        $eid++;
                }

		$template->add('TITLE', 'New Link');
		$template->add('ACTION', '/admin/newLink.php?submit=');
        } else {
		$inslink = "INSERT INTO links (title,url,type) VALUES (\"" . mysql_real_escape_string($_POST['title']) . "\",\"" . mysql_real_escape_string($_POST['url']) . "\",\"" . mysql_real_escape_string($_POST['type']) . "\")";
		$inslink2 = mysql_query($inslink);

		$template->adds_block('FLASH', array('TEXT' => 'Your link has been sucessfully created.'));

		$template->add('TITLE', 'Edit Link');
		$template->add('ACTION', '/admin/editLink.php?id=' . mysql_insert_id() . '&amp;submit=');
		$template->add('TYPEDISABLED', ' readonly="readonly"');
	}

	$template->add('TITLEVALUE', $_POST['title']);
	$template->add('URLVALUE', $_POST['url']);
	$template->add(strtoupper($_POST['type']) . 'SELECTED', ' checked="checked"');
} else {
	$template->add('TITLE', 'New Link');
	$template->add('ACTION', '/admin/newLink.php?submit=');
}

$template->display();

?>
