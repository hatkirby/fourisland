<!--BEGIN INTERNAL-->
<!--BEGIN BACK--><span class="back-post">&laquo; <a href="/blog/<!--BACK.CODED-->/"><!--BACK.TITLE--></a></span><!--END BACK-->
<!--BEGIN NEXT--><span class="next-post"><a href="/blog/<!--NEXT.CODED-->/"><!--NEXT.TITLE--></a> &raquo;</span><!--END NEXT-->
<!--END INTERNAL-->

<script type="text/javascript">

function ratePost(id, dir)
{
	jQuery("#post-"+id+" .post-rating-up").addClass("post-action-done").html("&lt;img src='/theme/images/icons/thumb_up.png' alt='+1' /&gt;");
	jQuery("#post-"+id+" .post-rating-down").addClass("post-action-done").html("&lt;img src='/theme/images/icons/thumb_down.png' alt='-1' /&gt;");
	jQuery("#flash").text("Processing....").slideDown();
	jQuery.ajax({
		type: "GET",
		url: "/vote.php",
		data: "id="+id+"&amp;dir="+dir,
		dataType: "text",
		success: function(msg) {
			if (msg != "")
			{
				jQuery("#post-"+id+" .post-rating").text(msg);
				jQuery("#flash").text("Your vote has been sucessfully placed.");
			} else {
				jQuery("#flash").text("There was an error in placing your vote.");
			}
		},
		error: function() {
			jQuery("#flash").text("There was an error in placing your vote.");
		}
	});
}

</script>

<!--BEGIN POST-->
<div class="post vevent" id="post-<!--POST.ID-->">
	<div class="post-date-<!--POST.YEARID-->">
		<abbr class="dtstart" title="<!--POST.DATE-->">
			<span class="post-month"><!--POST.MONTH--></span>
			<span class="post-day"><!--POST.DAY--></span>
		</abbr>
	</div>

	<div class="post-title">
		<h2>
			<!--BEGIN EXTERNAL-->
			<a class="url" href="/blog/<!--POST.CODED-->/" rel="bookmark" title="Permalink for <!--POST.TITLE-->"><span class="summary"><!--POST.TITLE--></span></a>
			<!--END EXTERNAL-->
			<!--BEGIN INTERNAL-->
			<span class="summary light-at-night"><!--POST.TITLE--></span>
			<!--END INTERNAL-->
		</h2>

		<span class="post-cat-<!--POST.AUTHOR--> category">
			<a href="/blog/author/<!--POST.AUTHOR-->.php"><!--POST.AUTHOR--></a>
		</span>

		<span class="post-tag-3 category">
			<!--BEGIN POST.TAGS-->
			<a class="noVisit" href="/blog/tag/<!--POST.TAGS.TAG-->.php" rel="tag" title="<!--POST.TAGS.TAG-->"><!--POST.TAGS.TAG--></a>
			<!--END POST.TAGS-->
		</span>

		<!--BEGIN EXTERNAL-->
		<span class="post-comment<!--POST.PLURALCOMMENT-->">
			<a class="noVisit" href="/blog/<!--POST.CODED-->/#comments"><!--POST.COMMENTS-->&nbsp;&#187;</a>
		</span>
		<!--END EXTERNAL--><!--BEGIN INTERNAL-->
		<span class="mini-add-comment">
			<a class="noVisit" href="/blog/<!--POST.CODED-->/#comments">Add Comment&nbsp;&#187;</a>
		</span>
		<!--END INTERNAL-->
	</div>

	<div class="entry description">
		<div class="module rounded">
			<!--POST.TEXT-->

			<!--BEGIN POST.EXCERPT-->
			<p>[....] <a href="/blog/<!--POST.CODED-->/">Click here to read the rest of this post</a>.</p>
			<!--END POST.EXCERPT-->
		</div>
			
		<cite class="rounded light-at-night"><strong><!--POST.AUTHOR--></strong> on <!--POST.DATE--></cite>

		<span class="post-vote">
			<!--BEGIN POST.CANVOTE-->
			<span class="post-rating-up"><a href="javascript:ratePost('<!--POST.ID-->','plus');" rel="nofollow"><img src="/theme/images/icons/thumb_up.png" alt="+1" /></a></span>
			<!--END POST.CANVOTE-->
			<!--BEGIN POST.NOVOTE-->
			<span class="post-rating-up post-action-done"><img src="/theme/images/icons/thumb_up.png" alt="-1" /></span>
			<!--END POST.NOVOTE-->
			<span class="post-rating light-at-night"><!--POST.RATING--></span>
			<!--BEGIN POST.CANVOTE-->
			<span class="post-rating-down"><a href="javascript:ratePost('<!--POST.ID-->','minus');" rel="nofollow"><img src="/theme/images/icons/thumb_down.png" alt="-1" /></a></span>
			<!--END POST.CANVOTE-->
			<!--BEGIN POST.NOVOTE-->
			<span class="post-rating-down post-action-done"><img src="/theme/images/icons/thumb_down.png" alt="-1" /></span>
			<!--END POST.NOVOTE-->
		</span>
	</div>
</div>
<!--END POST-->
