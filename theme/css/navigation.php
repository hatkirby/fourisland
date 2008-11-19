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
4::::::::::::::::4  theme/css/navigation.php
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
/* Four Island NavBar CSS */

ul#bannernav {
 list-style: none;
 clear: both;
 margin: 0px;
}

div#banner-nav {
 height: 30px;
 clear: both;
 margin: 1px 30px 0 30px;
 background: url("/theme/images/bg_navbar.gif") repeat-x 0 0;
}

ul#bannernav li {
 float: left;
 margin: 0;
 padding: 0;
 padding-right: 6px;
}

ul#bannernav li a {
 text-decoration: none;
 display: block;
 width: 100;
 height: 30;
}

ul#bannernav li a span {
 visibility: hidden;
}

ul#bannernav li img {
 display: none;
}

ul#bannernav li#bannernav-home a {
 background-image: url("/theme/images/Home.gif");
}

body.home ul#bannernav li#bannernav-home a,
ul#bannernav li#bannernav-home a:hover {
 background-image: url("/theme/images/Home_ro.gif");
}

ul#bannernav li#bannernav-projects a {
 background-image: url("/theme/images/Projects.gif");
}

body.projects ul#bannernav li#bannernav-projects a,
ul#bannernav li#bannernav-projects a:hover {
 background-image: url("/theme/images/Projects_ro.gif");
}

ul#bannernav li#bannernav-wiki a {
 background-image: url("/theme/images/Wiki.gif");
}

body.wiki ul#bannernav li#bannernav-wiki a,
ul#bannernav li#bannernav-wiki a:hover {
 background-image: url("/theme/images/Wiki_ro.gif");
}

ul#bannernav li#bannernav-fourm a {
 background-image: url("/theme/images/Fourm.gif");
}

body.fourm ul#bannernav li#bannernav-fourm a,
ul#bannernav li#bannernav-fourm a:hover {
 background-image: url("/theme/images/Fourm_ro.gif");
}

ul#bannernav li#bannernav-misc a {
 background-image: url("/theme/images/Random.gif");
}

body.misc ul#bannernav li#bannernav-misc a,
ul#bannernav li#bannernav-misc a:hover {
 background-image: url("/theme/images/Random_ro.gif");
}

ul#bannernav li#bannernav-webs a {
 background-image: url("/theme/images/Links.gif");
}

body.webs ul#bannernav li#bannernav-webs a,
ul#bannernav li#bannernav-webs a:hover {
 background-image: url("/theme/images/Links_ro.gif");
}

ul#bannernav li#bannernav-poll a {
 background-image: url("/theme/images/Poll.gif");
}

body.poll ul#bannernav li#bannernav-poll a,
ul#bannernav li#bannernav-poll a:hover {
 background-image: url("/theme/images/Poll_ro.gif");
}

ul#bannernav li#bannernav-quotes a {
 background-image: url("/theme/images/Quotes.gif");
}

body.quotes ul#bannernav li#bannernav-quotes a,
ul#bannernav li#bannernav-quotes a:hover {
 background-image: url("/theme/images/Quotes_ro.gif");
}

ul#bannernav li#bannernav-login a {
 background-image: url("/theme/images/Login.gif");
}

body.login ul#bannernav li#bannernav-login a,
ul#bannernav li#bannernav-login a:hover {
 background-image: url("/theme/images/Login_ro.gif");
}

ul#bannernav li#bannernav-logout a {
 background-image: url("/theme/images/Logout.gif");
}

ul#bannernav li#bannernav-logout a:hover {
 background-image: url("/theme/images/Logout_ro.gif");
}

ul#bannernav li#bannernav-panel a {
 background-image: url("/theme/images/Panel.gif");
}

body.panel ul#bannernav li#bannernav-panel a,
ul#bannernav li#bannernav-panel a:hover {
 background-image: url("/theme/images/Panel_ro.gif");
}

ul#bannernav li#bannernav-search {
 display: block;
 float: right;
 width: 165px;
 height: 30px;
 margin: 0px;
 background: url("/theme/images/bg_search.gif") 0 0 no-repeat;
}

ul#bannernav li#bannernav-search fieldset {
 border: none;
 padding-top: 6px;
 border-width:0pt;
 font-family:Verdana,Helvetica,Arial,sans-serif;
 font-size:1.1em;
}

ul#bannernav li#bannernav-search input {
 width: 125px;
 height: 19px !important;
 margin-left: 13px;
 border: none !important;
 background-color: transparent;
 cursor:pointer;
 font-family:Verdana,Helvetica,Arial,sans-serif;
 font-weight:normal;
 padding:0pt 3px;
 vertical-align:middle;
 line-height:1.3em;
 color:#536482;
 margin-top: -20px;
}

body.fourm ul#bannernav li#bannernav-search input {
 margin-top: 0px;
 font-size: 1.1em !important;
 margin-left: 28px;
}
