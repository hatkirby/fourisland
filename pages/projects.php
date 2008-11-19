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
4::::::::::::::::4  pages/projects.php
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

include('includes/phpsvnclient.php');

if (!isset($_GET['project']))
{

} else {
	if (!isset($_GET['folder']) && !isset($_GET['file']))
	{
	} else if (isset($_GET['folder']))
	{
		if ($_GET['folder'] == 'browse')
		{
			$template = new FITemplate('projects/browse');

			if (!isset($_GET['id']))
			{
				$path = '/';
			} else {
				$path = '/' . $_GET['id'];
			}
			if (!isset($_GET['rev']))
			{
				$rev = -1;
			} else {
				$rev = $_GET['rev'];
			}

			$svn = new phpSVNclient();
			$svn->setRespository('http://svn.fourisland.com/' . $_GET['project']);
			$svn->setAuth('hatkirby','popstartwo506');
			$data = $svn->getFile($path,$rev);

			if (substr($path,strlen($path)-1,1) != '/')
			{
				$template->add('DATA', str_replace('	','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',str_replace('  ','&nbsp;&nbsp;',nl2br(htmlentities($data)))));
				$template->adds_block('FILE', array('NAME' => $path));
			} else {
				$template->add('DATA', $data);
			}

			$logs = $svn->getFileLogs($path);
			$template->add('LOGDATA', str_replace("\n\n",'<P>',htmlentities($logs[count($logs)-1]['comment'])));
			$template->add('AUTHOR', $logs[count($logs)-1]['author']);
			$template->add('DATE', date('F dS Y \a\\t g:i:s a',strtotime($logs[count($logs)-1]['date'])));

			if ($rev != -1)
			{
				$template->adds_block('FORWARD', array(	'URL' => ('/projects/' . $_GET['project'] . '/browse' . $path . '?rev=' . ($rev+1)),
									'NUM' => ($rev+1)));
			}

			if ($rev == -1)
			{
				$rev = $svn->getVersion();
			}

			if ($rev != 1)
			{
				$template->adds_block('BACK', array(	'URL' => ('/projects/' . $_GET['project'] . '/browse' . $path . '?rev=' . ($rev-1)),
									'NUM' => ($rev-1)));
			}
		}
	} else if (isset($_GET['file']))
	{
	}
}

$template->display();

?>
