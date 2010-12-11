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
4::::::::::::::::4  admin/welcome.php
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

$category = 'home';

$template = new FITemplate('admin/welcome');

$cntposts = "SELECT COUNT(*) FROM updates";
$cntposts2 = mysql_query($cntposts);
$cntposts3 = mysql_fetch_array($cntposts2);
$template->add('POSTS', $cntposts3['COUNT(*)']);

$cntpending = "SELECT COUNT(*) FROM pending";
$cntpending2 = mysql_query($cntpending);
$cntpending3 = mysql_fetch_array($cntpending2);
$template->add('PENDING', $cntpending3['COUNT(*)']);

$cntdrafts = "SELECT COUNT(*) FROM drafts";
$cntdrafts2 = mysql_query($cntdrafts);
$cntdrafts3 = mysql_fetch_array($cntdrafts2);
$template->add('DRAFTS', $cntdrafts3['COUNT(*)']);

$cntcomments = "SELECT COUNT(*) FROM moderation";
$cntcomments2 = mysql_query($cntcomments);
$cntcomments3 = mysql_fetch_array($cntcomments2);
$template->add('COMMENTS', $cntcomments3['COUNT(*)']);

$cntquotes = "SELECT COUNT(*) FROM rash_quotes";
$cntquotes2 = mysql_query($cntquotes);
$cntquotes3 = mysql_fetch_array($cntquotes2);
$template->add('QUOTES', $cntquotes3['COUNT(*)']);

$cntflagged = "SELECT COUNT(*) FROM rash_quotes WHERE flag = 1";
$cntflagged2 = mysql_query($cntflagged);
$cntflagged3 = mysql_fetch_array($cntflagged2);
$template->add('FLAGGED', $cntflagged3['COUNT(*)']);

$cntmodcom = "SELECT COUNT(*) FROM rash_queue";
$cntmodcom2 = mysql_query($cntmodcom);
$cntmodcom3 = mysql_fetch_array($cntmodcom2);
$template->add('MODCOM', $cntmodcom3['COUNT(*)']);

$template->display();

?>
