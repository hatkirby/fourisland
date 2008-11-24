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
4::::::::::::::::4  theme/css/website.php
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

?>
/* Four Island General CSS */

body {
 background-repeat: repeat-x;
 background-attachment: fixed;
 background-position: bottom left;
 font-family: Arial, FreeSans;
 margin: 0px;
 padding: 0px 0px 30px !important;
}

body.fourm {
 font-family: Verdana, Helvetica, Arial, sans-serif ;
}
 

ul#bannernav, p {
 margin:0pt;
 padding:0pt;
}

p {margin-top: 1em}

ul, ol {margin-top: 1em; margin-bottom: 1em}

::selection {
	background: pink;
}
::-moz-selection {
	background: pink;
}

/* A (Links) */

A:link {
 color: blue;
 font-weight: bold;
 text-decoration: none;
}

A:visited {
 color: blue;
 text-decoration: none;
}

A:hover {
 color: blue;
 font-weight: bold;
 text-decoration: none;
 font-variant: small-caps;
 text-transform: capitalize;
}

A:active {
 color: blue;
 text-decoration: none;
}

a img {
 border: 0;
}

/* Random Elements */
			
hr {
 height:1px;
 color: gray;
 background: gray;
 border: none;
 text-align: left;
 margin-left: 0;
}

.center {
	text-align: center;
}

img.center, img[align="center"] {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

acronym, abbr, span.caps {
 cursor: help;
}

acronym, abbr {
 border-bottom: 1px dashed #999;
}

blockquote {
 padding-left: 10px;
 border-left: 3px solid #CCC;
 font-family: helvetica;
 font-size: 14px;
 margin-top: 10px;
 margin-bottom: 10px;
 margin-left: 50px;
}

pre {
 line-height: 12px;
}

.toolTip {
 border-bottom: 1px dashed #999;
 cursor: help;
}

#wrap {
 width: 910px;
 margin: 10px auto;
 text-align: left;
 padding: 0;
 margin-top: 25px;
}

span.fcorners-bottom {
	background-position: 0 0;
}
span.fcorners-bottom span {
	background-position: 100% -20px;
}

/* Banner */
		
div#banner, div#fi-banner {
 background-repeat: no-repeat;
 width: 900px; /*728*/
 height: 200px;
 float: left;
 margin-top: 21px;
}

div#banner {
 background-image: url("/theme/images/fourisland_header.png");
}

body div#banner h1, body div#fi-banner h1 {
 margin: 0;
}

body div#banner h1 a, body div#fi-banner h1 a {
 display: block;
 width: 900px;
 height: 200px;
 text-indent: -5000px;
 text-decoration: none;
 margin: 0;
}

div#banner h1, div#fi-banner h1 {
 margin: 0;
 font-size: 3.0em;
 font-weight: normal;
}
				
div#bannernav {
 text-align: center;
}

#page-body {
 margin: 0 30px;
 clear: both;
 position: relative;
}

body.fourm #page-body {
 margin-left: 25;
 margin-right: 10;
 width: 95%;
 font-size: 62.5%;
}

#phpBB3-page-body {
 margin: 4px 0 !important;
 clear: both;
}

div#pageTabs {
 float: left;
 margin-left: -40px;
 padding-top: 140px;
}

body.fourm div#pageTabs {
 margin-left: 0;
}

div#pageTabs ul li {
 list-style-type: none;
 background-image: url("/theme/images/tabUn.png");
 display: block;
 height: 37;
 width: 100;
 margin-bottom: 2px;
 text-align: right;
}

div#pageTabs ul li * {
 padding-top: 4px;
 padding-right: 2px;
}

body.main div#pageTabs ul li#bannernav-home,
body.projects div#pageTabs ul li#bannernav-proj,
body.wiki div#pageTabs ul li#bannernav-wiki,
body.fourm div#pageTabs ul li#bannernav-fourm,
body.misc div#pageTabs ul li#bannernav-misc,
body.webs div#pageTabs ul li#bannernav-webs,
body.login div#pageTabs ul li#bannernav-login {
 background-image: url("/theme/images/tabSe.png");
}

/* Sidebar */

div#rightbar {
 float: left;
 width: 250px; /*210*/
 padding: 0 10;
}

div#iconbar {
 text-align: center;
 margin-left: 20px;
}

div#iconbar ul li {
 list-style-type: none;
}

div.sidebar {
 width: 250px; /*250*/ /*240*/ /*210*/
 padding: 0 10px;
 margin-bottom: 5px;
}

div.sidebar h3 {
 font-family: Verdana, Helvetica, Arial, sans-serif;
 margin: 5px 0 0 0;
 font-weight: bold;
 color: #333333;
}

div.sidebar p {
 font-size: 0.8em;
 margin: 3px 0;
}

span.corners-top,
span.corners-bottom {
 margin: 0 -10px;
 background-image: url("/theme/images/corners_left.png");
}

span.corners-top span,
span.corners-bottom span {
 background-image: url("/theme/images/corners_right.png");
}

span.corners-top span {
 background-position: 100% 0pt;
}

span.corners-bottom {
 background-position: 0pt 100%;
}

span.corners-bottom span {
 background-position: 100% 100%;
}

span.corners-top,
span.corners-bottom,
span.corners-top span,
span.corners-bottom span {
 background-repeat:no-repeat;
 display:block;
 font-size:1px;
 height:5px;
 line-height:1px;
}

div.sidebar ul {
 list-style-type: none;
 padding: 0;
 margin: 0;
 line-height: normal !important;
 list-style-image: none !important;
}
							
div#sidebar ul li {
 margin-top: 4px;
}
				
div#sidebar ul li a {
 display: block;
 width: 230px;
}
				
body.main div#sidebar div#hatnav ul li a#main,
body.about div#sidebar div#hatnav ul li a#about,
body.archive div#sidebar div#hatnav ul li a#archive,
body.winProg div#sidebar div#hatnav ul li a#winProg,
body.winGames div#sidebar div#hatnav ul li a#winGames,
body.flash div#sidebar div#hatnav ul li a#flash,
body.challenge div#sidebar div#hatnav ul li a#challenge,
body.experiment div#sidebar div#hatnav ul li a#experiment,
body.kfm div#sidebar div#hatnav ul li a#kfm,
body.mailchat div#sidebar div#hatnav ul li a#mailchat,
body.articles div#sidebar div#hatnav ul li a#articles,
body.poll div#sidebar div#hatnav ul li a#poll,
body.subversion div#sidebar div#hatnav ul li a#subversion {
 background: #FEFFB2;
 font-weight: bold;
 text-decoration: none;
 color: black;
}

div#sidebar li img {
 border: 0;
 height: 16px;
 width: 16px;
}

/* Content */
															
div#content, div#fi-content {
 float: right;
 width: 555px; /*465*/ /*555*/
}

body#day div#page div#content code {
 display: block;
 border: solid black 1px;
 background-color: #FFFF64;
 width: 485px;
 overflow: visible;
}

div#content h2 {
 color: #59770e;
 margin: 0px 0px 2px;
 border-bottom: 1px dotted #CCCCCC;
 letter-spacing: -1px;
 font: normal 140%/100% "Trebuchet MS", Tahoma, Arial;
 padding-bottom: 3px;
}

/* Random Divs/Spans */

div#stripe {
 position: fixed;
 top: 0;
 left: 0;
 width: 100%;
 background-color: #FBEC5D;
 height: 20px;
 z-index: 99;
 padding-top: 5px;
 text-align: center;
}

* > html div#stripe {
 position: absolute;
}

div.autosize {
 display: table;
 width: 1px;
}

div.autosize > div {
 display: table-cell;
}

div#chat {
 float: right;
 position: fixed;
 bottom: 0;
 background-color: brown;
 color: white;
 right: 20;
 height: 100%;
 width: 40%;
}

div.cleardiv {
 clear: both;
 height: 1em;
}
				
div#footer {
 clear: both;
 padding-bottom: 1em;
 padding-top: .5em;
 margin-top: .5em;
 text-align: center;
 font-size: .68em;
 width: 100%;
 border-top: 1px black solid;
 border-bottom: 4px gray solid;
}

div#footer ul.rows li {
 display: list-item;
}

#rightbar-bottom {
 background: url("/theme/images/bg_footer.gif") repeat-x 0 100%;
}
				
#pollOfTheWeek {
 color: black;
}

div.post {
 clear: both;
 padding-top: 15px;
}

span.back-post {
 float: left;
 font-size: 0.9em;
}

span.next-post {
 float: right;
 font-size: 0.9em;
}

span.up-post {
 font-size: 0.9em;
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
 width: 500px; /* 430px */
}

div.entry {
 clear: both;
 padding-top: 10px;
 font: 75%/150% Arial, "Trebuchet MS", Tahoma;
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

div#page {
 padding: 0;
 width: 850px;
 position: relative;
 left: 50%;
 margin-left: -422px;
}

div#footer ul {
 padding: 0;
 margin: 0;
 list-style-type: none;
}

div#footer ul li {
 display: inline;
 margin-right: 1em;
}

div#footer ul li img {
 width: 20px;
 height: 20px;
 vertical-align: top;
}

div#content ul {
 list-style: url(/theme/images/bullet_disk_big.png);
}

div.push {
 clear: both;
 height: 20px;
}

span.print {
 display: none;
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

form textarea:focus, form input:focus {
 border: 2px solid #900;
 background-color: #FEFFB2;
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

div#content a img {
 border: solid transparent 1px;
}

div#content a:hover img {
 border: dashed gray 1px;
}

div.morePost {
 border-top: gray 1px dashed;
}

div.plainText {
 font-family: Courier New;
 font-size: small;
}

div.breadcrumb {
 margin-bottom: 10px;
 font-size: 10px;
 border-bottom: 1px dotted black;
}

/* Tables */

table.webmail {
 border: 0;
 width: 100%;
}

table.webmail, table.webmail td {
 border-spacing: 0;
}

table.webmail tr {
 background-color: #3CE4ED;
}

table.webmail tr.even {
 background-color: #39B7CD;
}

table.webmail th {
 background-color: #FF9912;
 text-align: left;
}

table.webmail td {
 word-wrap: break-word;
}

div#top-fade {
 position: absolute;
 top: 0;
 left: 0;
 width: 100%;
 background-image: url(/theme/images/top_fade.png);
 height: 400px;
 z-index: 0;
}
