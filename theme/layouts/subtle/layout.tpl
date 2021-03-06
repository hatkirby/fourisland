<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><!--EXTRATITLE-->Four Island</title>
		<link href="/fourm/styles/prosilver/theme/print.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="/theme/css.php" />
		<!--[if IE]><link rel="stylesheet" type="text/css" href="/theme/css/ie.css" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="/theme/css/print.css" media="print" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en" />
		<link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/FourIsland?format=xml" title="Four Island" />
		<link rel="shortcut" href="/images/kirbyfolder.ico" />
		<link rel="icon" href="/images/kirbyfolder.ico" />
		<link rel="pingback" href="http://fourisland.com/xmlrpc.php" />
		<script type="text/javascript" src="/theme/js/jquery.js"></script>
		<script type="text/javascript" src="/theme/js/audio-player/audio-player.js"></script>  
		<script type="text/javascript">  
AudioPlayer.setup("http://fourisland.com/theme/js/audio-player/player.swf", {  
	width: 290,
	transparentpagebg: "yes"
});  
		</script>
	</head>

	<body id="<!--CATEGORY-->">
		<div id="flash"><!--FLASH--></div>

		<div id="header">
			<div id="banner"><a href="/">Four Island</a></div>
		</div>
		
		<div id="page-content">
			<div id="content">
				<ul class="navbar">
					<li<!--BLOGACTIVE-->>
						<a href="/">
							<img src="/theme/images/icons/newspaper.png" alt="Blog" />
							<span>Blog</span>
						</a>
					</li>

					<li>
						<a href="http://projects.fourisland.com/">Projects</a>
					</li>

					<li<!--FOURMACTIVE-->>
						<a href="/fourm/">
							<img src="/theme/images/icons/comment.png" alt="The Fourm" />
							<span>The Fourm</span>
						</a>
					</li>

					<li<!--WIKIACTIVE-->>
						<a href="/wiki/">
							<img src="/theme/images/icons/report.png" alt="Wiki" />
							<span>Wiki</span>
						</a>
					</li>

					<li<!--QUOTESACTIVE-->>
						<a href="/quotes/">
							<img src="/theme/images/icons/16-file-page.png" alt="Quotes" />
							<span>Quotes</span>
						</a>
					</li>

					<!--BEGIN MEMBERS-->
					<li<!--LOGACTIVE-->>
						<a href="/fourm/ucp.php?mode=log<!--LOGDATA-->&amp;redirect=<!--REDIRPAGE-->&amp;sid=<!--SID-->">
							<img src="/theme/images/icons/door_in.png" alt="Log<!--LOGDATA-->" />
							<span>Log<!--LOGDATA--></span>
						</a>
					</li>
					<!--END MEMBERS-->

					<!--BEGIN ADMIN-->
					<li<!--PANELACTIVE-->>
						<a href="/admin/">
							<img src="/theme/images/icons/rainbow.png" alt="Admin" />
							<span>Admin</span>
						</a>
					</li>
					<!--END ADMIN-->
				</ul>

				<hr />

				<!--BEGIN CREATE_HATNAV-->
				<ul class="navbar">
				<!--END CREATE_HATNAV-->
				
				<!--BEGIN HATNAV-->
					<li>
						<a href="<!--HATNAV.URL-->">
							<img src="/theme/images/icons/<!--HATNAV.ICON-->.png" alt="<!--HATNAV.TITLE-->" />
							<span><!--HATNAV.TITLE--></span>
						</a>
					</li>
				<!--END HATNAV-->
				
				<!--BEGIN CREATE_HATNAV-->
				</ul>
				<!--END CREATE_HATNAV-->

				<div id="actual-content">
					<!--CONTENT-->
				</div>
			</div>

			<div id="sidebar">
				<!--EXTRASIDEBAR-->

				<div class="module rounded sidebar">
					<h3>Affiliates</h3>

					<ul>
						<!--BEGIN AFFILIATES-->
						<li>
							<img src="/theme/images/icons/tag_<!--AFFILIATES.COLOR-->.png" alt="<!--AFFILIATES.TITLE-->" />
							<a href="<!--AFFILIATES.URL-->"><!--AFFILIATES.TITLE--></a>
						</li>
						<!--END AFFILIATES-->
					</ul>
				</div>

				<div class="module rounded sidebar">
					<h3>Website Projects</h3>

					<ul>
						<!--BEGIN WEBPROJS-->
						<li>
							<img src="/theme/images/icons/tag_<!--WEBPROJS.COLOR-->.png" alt="<!--WEBPROJS.TITLE-->" />
							<a href="<!--WEBPROJS.URL-->"><!--WEBPROJS.TITLE--></a>
						</li>
						<!--END WEBPROJS-->
					</ul>
				</div>

				<div class="module rounded sidebar">
					<h3>HatBar</h3>

					<p>
						Hits: <!--HITS--><br />
						Today: <!--TODAY--><br />
						<!--DATEFINDER-->
					</p>

					<p align="center">
						<a href="/addresses.php" title="goodemail@happybobby.com"><img src="/images/btn_bot.png" alt="Addresses galore!" /></a>
						<a href="http://www.prchecker.info/" target="_blank"><img src="http://pr.prchecker.info/getpr.php?codex=aHR0cDovL2ZvdXJpc2xhbmQuY29t&amp;tag=3" alt="Page Rank Check" border="0" /></a>
						<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/us/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/us/80x15.png" /></a>
						<a href="http://whos.amung.us/show/t1sj4g2u"><img src="http://whos.amung.us/swidget/t1sj4g2u.gif" alt="website stats" width="80" height="15" border="0" /></a>
						<a href="http://feeds2.feedburner.com/FourIsland"><img src="http://feeds2.feedburner.com/~fc/FourIsland?bg=99CCFF&amp;fg=444444&amp;anim=0" height="26" width="88" style="border:0" alt="" /></a>
					</p>

					<p>
						<strong>Theme Switcher</strong>:
						<select style="width: 55%" onchange="document.location='<!--ME-->?layout='+this.options[this.selectedIndex].value">
							<option value="subtle" selected="selected">Subtle Mode</option>
							<option value="7">7</option>
							<option value="6.2">6.2</option>
							<option value="4.5">4.5</option>
						</select>
					</p>
				</div>
			</div>
			
			<div class="cleardiv"></div>
		</div>
		
		<div id="footer">
			<div class="foot-module">
				<h3>Recent Comments</h3>

				<ul>
					<!--BEGIN COMMENTS-->
					<li style="font-size: 0.9em"><!--COMMENTS.AUTHOR--> on <a href="/<!--COMMENTS.AREA-->/<!--COMMENTS.CODED--><!--COMMENTS.ENDING-->#comment-<!--COMMENTS.ID-->"><!--COMMENTS.TITLE--></a></li>
					<!--END COMMENTS-->
				</ul>
			</div>

			<div class="foot-module">
				<h3>Recent Fourm Posts</h3>

				<ul>
					<!--BEGIN FOURM-->
					<li style="font-size: 0.9em"><!--FOURM.USERNAME--> on <a href="/fourm/viewtopic.php?t=<!--FOURM.TOPIC-->&amp;p=<!--FOURM.POST-->#p<!--FOURM.POST-->"><!--FOURM.SUBJECT--></a></li>
					<!--END FOURM-->
				</ul>
			</div>

			<div class="foot-module">
				<h3>Top Commenters</h3>

				<ul>
					<!--BEGIN TOP-->
					<li style="font-size: 0.9em"><!--TOP.USERNAME--> (<!--TOP.COUNT-->)</li>
					<!--END TOP-->
				</ul>
			</div>

			<div class="foot-module">
				<h3>Popular Posts</h3>

				<ul>
					<!--BEGIN POPULAR-->
					<li style="font-size: 0.9em"><a href="/blog/<!--POPULAR.CODED-->/"><!--POPULAR.TITLE--></a></li>
					<!--END POPULAR-->
				</ul>
			</div>
			
			<div class="cleardiv"></div>
			
			<p>
				Four Island (<a href="http://code.fourisland.com/fourisland/">r<!--REVISION--></a>) is by <a href="http://fourisland.com">Starla Insigna</a>.
				Licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/us/">Creative Commons Attribution-Noncommercial-Share Alike 3.0 United States License</a>.
				<a href="http://jigsaw.w3.org/css-validator/"><img src="/theme/images/icons/css_valid.png" alt="Valid CSS" /></a>
				<a href="http://validator.w3.org/check/referer"><img src="/theme/images/icons/xhtml_valid.png" alt="Valid XHTML" /></a>
				<a class="noVisit" href="/rss.php"><img src="/theme/images/icons/feed.png" alt="RSS Feed" /></a>
			</p>
		</div>

		<!--Google Analytics-->
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
			var pageTracker = _gat._getTracker("UA-2895652-1");
			pageTracker._initData();
			pageTracker._trackPageview();
		</script>
		<!--Google Analytics-->
	</body>
</html>
