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
4::::::::::::::::4  includes/comments.php
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

include('includes/recaptchalib.php');
$publickey = "6LdIZLwSAAAAAGS77bqSjfRka3TsLeRn71-W441f";

$curID = 0;

$template = new FITemplate('comments');
$template->add('PAGEID',$page_id);
$template->add('USERNAME',(isLoggedIn() ? getSessionUsername() : 'Anonymous'));

if (!isLoggedIn())
{
	$template->add('RECAPTCHA',recaptcha_get_html($publickey));
	$template->adds_block('NOLOG',array('exi'=>1));
}

$getcomments = "SELECT * FROM comments WHERE page_id = \"" . $page_id . "\" ORDER BY posttime";
$getcomments2 = mysql_query($getcomments) or die($getcomments);
$i=0;
while ($getcomments3[$i] = mysql_fetch_array($getcomments2))
{
	if ($getcomments3[$i]['is_anon'] == 0)
	{
		$getuser = "SELECT * FROM phpbb_users WHERE user_id = " . $getcomments3[$i]['user_id'];
		$getuser2 = mysql_query($getuser);
		$getuser3 = mysql_fetch_array($getuser2);

		$username = $getuser3['username'];
		$email = $getuser3['user_email'];
		$website = $getuser3['user_website'];
	} else if ($getcomments3[$i]['is_anon'] == 1)
	{
		$getanon = "SELECT * FROM anon_commenters WHERE id = " . $getcomments3[$i]['user_id'];
		$getanon2 = mysql_query($getanon);
		$getanon3 = mysql_fetch_array($getanon2);

		if ($getanon3['id'] == $getcomments3[$i]['user_id'])
		{
			$username = $getanon3['username'] . ' (Guest)';
			$email = $getanon3['email'];
			$website = $getanon3['website'];
		}
	}

	if (isset($username))
	{
		$template->add_ref($curID, 'COMMENTS', array(	'CODEDEMAIL' => md5(strtolower($email)),
								'USERNAME' => (($website != '') ? '<a href="' . $website . '">' . $username . '</a>' : $username),
								'DATE' => date("F jS Y \a\\t g:i:s a",strtotime($getcomments3[$i]['posttime'])),
								'ID' => $getcomments3[$i]['id'],
								'TEXT' => parseText($getcomments3[$i]['comment'])));

		if (isLoggedIn())
		{
			if ((isAdmin()) || (($getcomments3[$i]['is_anon'] == 0) && (getSessionUserID() === $getcomments3[$i]['user_id'])))
			{
				$template->adds_ref_sub($curID, 'EDITOR', array('BEFORE' => htmlspecialchars($getcomments3[$i]['comment'])));
			}
		}
	}
	$i++;
}
$template->display();

?>
