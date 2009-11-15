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
4::::::::::::::::4  theme/css/blog.php
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
include_once('../../security/config.php');
include_once('../includes/db.php');

?>

div.post {
 clear: both;
 padding-top: 15px;
}

span.back-post {
 float: left;
 font-size: 0.9em;
}

span.back-post:before {
 content: "\ab\a0";
}

span.next-post {
 float: right;
 font-size: 0.9em;
}

span.next-post:after {
 content: "\a0\bb";
}

div.post-date-1 {
 width: 45px;
 height: 49px;
 float: left;
 background: url(/theme/images/date-bg-1.gif) no-repeat;
}

div.post-date-0 {
 width: 45px;
 height: 49px;
 float: left;
}

div.post-date-0 span.post-month {
 color: #999999;
 font-size: 18px;
}

span.post-month {
 font-size: 11px;
 text-transform: uppercase;
 color: #FFFFFF;
 text-align: center;
 display: block;
 line-height: 11px;
 padding-top: 2px;
 margin-left: -3px;
}

span.post-day {
 font-size: 18px;
 text-transform: uppercase;
 color: #999999;
 text-align: center;
 display: block;
 line-height: 18px;
 padding-top: 7px;
 margin-left: -3px;
}

div.post-title {
 float: left;
 margin-left: 10px;
 width: 90%; /* 500px */
}

div.entry {
 clear: both;
 padding-top: 10px;
 /*font-size: 75%;
 line-height: 150%;*/
}

div.entry ol,
div.entry ul,
a[name|="comment"]+div.bubble ol,
a[name|="comment"]+div.bubble ul {
 margin-left: 3em;
}

<?php

$getupdates = "SELECT * FROM updates";
$getupdates2 = mysql_query($getupdates);
$i=0;
$k=0;
while ($getupdates3[$i] = mysql_fetch_array($getupdates2))
{
	$j=0;
	for ($j=0;$j<$k;$j++)
	{
		if ($authors[$j] == $getupdates3[$i]['author'])
		{
			break;
		}
	}
	if ($j==$k)
	{
		$authors[$k] = $getupdates3[$i]['author'];
		$k++;
	}
	$i++;
}
$i=0;
for ($i=0;$i<$k;$i++)
{
?>
span.post-cat-<?php echo($authors[$i]); ?> {
 background: url(/theme/images/authors/<?php echo($authors[$i]); ?>.ico) no-repeat;
 padding-left: 20px;
 float: left;
 font-size: 95%;
 color: #999999;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
}

<?php
}

?>
span.post-comment {
 background: url(/theme/images/icons/comment.png) no-repeat;
 padding-left: 20px;
 float: right;
 font-size: 95%;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
}

span.mini-add-comment {
 background: url(/theme/images/icons/comment_add.png) no-repeat;
 padding-left: 18px;
 float: right;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
}

span.post-comments {
 background: url(/theme/images/icons/comments.png) no-repeat;
 padding-left: 20px;
 float: right;
 font-size: 95%;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
}

span.post-tag-1 {
 background: url(/theme/images/icons/tag.png) no-repeat;
 padding-left: 20px;
 margin-left: 90px;
 float: left;
 font-size: 95%;
 color: #999999;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
 text-transform: capitalize;
}

span.post-tag-2 {
 background: url(/theme/images/icons/tag.png) no-repeat;
 padding-left: 20px;
 margin-left: 75px;
 float: left;
 font-size: 95%;
 color: #999999;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
 text-transform: capitalize;
}

span.post-tag-3 {
 background: url(/theme/images/icons/tag.png) no-repeat;
 padding-left: 20px;
 margin-left: 35px;
 float: left;
 font-size: 95%;
 color: #999999;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
 text-transform: capitalize;
}

div.post-date-2 {
 width: 45px;
 height: 49px;	
 float: left;
 background: url(/theme/images/date-bg-2.gif) no-repeat;
}

div.post-date-3 {
 width: 45px;
 height: 49px;
 float: left;
 background: url(/theme/images/date-bg-3.gif) no-repeat;
}

div.post-date-4 {
 width: 45px;
 height: 49px;
 float: left;
 background: url(/theme/images/date-bg-4.gif) no-repeat;
}

span.post-vote {
 float: right;
 position: relative;
 top: -2em;
 right: 1em;
}

span.post-rating {
 font-size: big;
}

span.post-action-done {
        opacity: 0.2;
}
