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
4::::::::::::::::4  pages/delete-comment.php
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

if (!isset($_GET['id']))
{
	generateError('404');
} else {
	if (isLoggedIn())
	{
		$getcomment = "SELECT * FROM comments WHERE id = " . $_GET['id'];
		$getcomment2 = mysql_query($getcomment);
		$getcomment3 = mysql_fetch_array($getcomment2);

		if ($getcomment3['id'] == $_GET['id'])
		{
			if ((isAdmin()) || (($getcomment3['is_anon'] == 0) && (getSessionUserID() === $getcomment3['user_id'])))
			{
				$delcomment = "DELETE FROM comments WHERE id = " . $_GET['id'];
				$delcomment2 = mysql_query($delcomment);

				header('Location: ' . getCommentUrl($getcomment3));
			} else {
				generateError('404');
			}
		} else {
			generateError('404');
		}
	} else {
		generateError('404');
	}
}

?>
