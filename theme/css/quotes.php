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
4::::::::::::::::4  theme/css/quotes.php
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
/* site-wide */
div#site_all{
	font-family: serif;
	font-size: 12pt;
	margin-left: 9%;
	margin-right: 9%;
}
a#site_nav_admin{
	color: #c08000;
}
a#site_nav_logout{
	color: #000000;
}
a#site_admin_flag, a#site_admin_queue{
	color: #336699;
}


/* quote-output styles */

div.quote_quote{
	padding-bottom: 5pt;	
}
div.quote_whole{
	padding-top: 10pt;
}

/* searchpage */
input#search_submit-button{
	background-color: #c08000;
}
input#search_query-box{
	background-color: #f0f0f0;
}
select#search_sortby-dropdown{
	background-color: #f0f0f0;
}
select#search_limit-dropdown{
	background-color: #f0f0f0;
}


/* home_*: styles for the default homepage */

div.home_news_date{
	font-weight: bold;
}
div#home_greeting{
	float: left;
	width: 50%;
}
div#home_news{
	width: 100%;
}


/* *admin*: used on administration pages and admin-only content */

div#site_admin_nav{
	position: relative;
	margin-top: 90pt;
	clear: both;
	margin-top: -.1pt;
}
div#site_admin_nav_upper_linkbar{
	background-color: #f0f0f0;
}
div#site_admin_nav_lower_infobar{
	background-color: #c08000;
	text-align: right;
}
html>body div#site_admin_nav{ /* hack for firefox, disabled in opera and ie */
	margin-top: 0pt;
}
.admin_queue_alt1{
	background-color: #ffffff;
}
.admin_queue_alt2{
	background-color: #f0f0f0;
}
input#admin_login_username-box{
	background-color: #f0f0f0;
}
input#admin_login_password-box{
	background-color: #f0f0f0;
}
input#admin_login_submit-button{
	background-color: #c08000;
}


/* site_nav_*: navigation on the top, for everyone */

div#site_nav_lower{
	background-color: #f0f0f0;
}
div#site_nav_lower_linkbar{
	clear: both;
	text-align: right;
}
div#site_nav_upper{
	background-color: #c08000;
	padding: 3px;
}
div#site_nav_upper_qms{
	position: relative;
	z-index: 1;
	float: left;
	font-size: 14pt;
	font-weight: bold;
	font-style: italic;
}
div#site_nav_upper_qms-long{
	position: relative;
	z-index: 1;
	float: right;
	font-weight: bold;
	font-size: 15pt;
}
div#site_nav{
	position: relative;
	z-index: 0;
}


/* user-based functions */
div#add_outputmsg_quote{
	padding-top: 10pt;
	font-family: monospace;
	padding-bottom: 10pt;
}


/* page titles */
div#quote_origin-name{
	font-size: 23.6pt;
	font-weight: bold;
}
div#search_title{
	font-size: 23.6pt;
	font-weight: bold;
}
div#admin_add-news_title{
	font-size: 23.6pt;
	font-weight: bold;
}
div#add_title{
	font-size: 23.6pt;
	font-weight: bold;
}
div#admin_queue_title{
	font-size: 23.6pt;
	font-weight: bold;
}
div#admin_flag_title{
	font-size: 23.6pt;
	font-weight: bold;
}
div#admin_change-pw_title{
	font-size: 23.6pt;
	font-weight: bold;
}
div#admin_users_title{
	font-size: 23.6pt;
	font-weight: bold;
}
div#admin_add-user_title{
	font-size: 23.6pt;
	font-weight: bold;
}

div.quote_pagenums{
	text-align: center;
}
