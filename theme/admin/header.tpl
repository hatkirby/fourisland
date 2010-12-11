<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Four Island Admin</title>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="/theme/admin/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="/theme/admin/css/uni-form.css" rel="stylesheet" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="/theme/admin/css/ie6.css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="/theme/admin/css/ie7.css" /><![endif]-->
		<script src="/theme/admin/js/jquery.js" type="text/javascript"></script>
		<script src="/theme/admin/js/uni-form.jquery.js" type="text/javascript"></script>
	</head>

	<body>
		<div id="flash"<!--HIDEFLASH-->><!--FLASH--></div>

		<div id="wrapper">
			<div id="header"><h1><a href="/admin/"><span>Four Island</span></a></h1></div>

			<ul id="mainNav">
				<li><a href="/admin/"<!--HOMEACTIVECAT-->>DASHBOARD</a></li>
				<li><a href="/admin/posts.php"<!--POSTSACTIVECAT-->>POSTS</a></li>
				<li><a href="/admin/quotes.php"<!--QUOTESACTIVECAT-->>QUOTES</a></li>
				<li><a href="/admin/links.php"<!--LINKSACTIVECAT-->>LINKS</a></li>
				<li class="logout"><a href="/">FOUR ISLAND</a></li>
			</ul>

			<div id="containerHolder">
				<div id="container">
					<div id="sidebar">
						<ul class="sideNav">
							<!--BEGIN HOMEISACTIVECAT-->
							<li><a href="/admin/update.php"<!--UPDATEACTIVE-->>HG Update</a></li>
							<li><a href="/admin/maintenance.php"<!--MAINTENANCEACTIVE-->>Maintenance Mode</a></li>
							<!--END HOMEISACTIVECAT-->
							<!--BEGIN POSTSISACTIVECAT-->
							<li><a href="/admin/newPost.php"<!--NEWPOSTACTIVE-->>Write a new post</a></li>
							<li><a href="/admin/posts.php"<!--POSTSACTIVE-->>Manage Posts</a></li>
							<li><a href="/admin/drafts.php"<!--DRAFTSACTIVE-->>Manage Drafts</a></li>
							<li><a href="/admin/pending.php"<!--PENDINGACTIVE-->>Manage Pending Posts</a></li>
							<li><a href="/admin/comments.php"<!--COMMENTSACTIVE-->>Moderate Comments</a></li>
							<!--END POSTSISACTIVECAT-->
							<!--BEGIN QUOTESISACTIVECAT-->
							<li><a href="/admin/quotes.php"<!--QUOTESACTIVE-->>Manage Quotes</a></li>
							<li><a href="/admin/modquotes.php"<!--MODQUOTESACTIVE-->>Moderate Quotes</a></li>
							<li><a href="/admin/quotes.php?flagged="<!--FLAGGEDACTIVE-->>Manage Flagged Quotes</a></li>
							<!--END QUOTESISACTIVECAT-->
							<!--BEGIN LINKSISACTIVECAT-->
							<li><a href="/admin/newLink.php"<!--NEWLINKACTIVE-->>Add a new link</a></li>
							<li><a href="/admin/links.php"<!--AFFILIATESACTIVE-->>Manage Affiliates</a></li>
							<li><a href="/admin/links.php?type=webprojs"<!--WEBPROJSACTIVE-->>Manage Website Projects</a></li>
							<!--END LINKSISACTIVECAT-->
						</ul>
					</div>

					<div id="main">
