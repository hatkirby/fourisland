<div class="cleardiv"></div>

<script type="text/javascript">

function voteQuote(id, dir)
{
	jQuery("#quote-"+id+" .quote-rating-up").addClass("quote-action-done").text("+");
	jQuery("#quote-"+id+" .quote-rating-down").addClass("quote-action-done").text("-");
	jQuery("#quote-"+id+" .quote-update-result").text("Processing....");
	jQuery.ajax({
		type: "GET",
		url: "/quotes/vote.php",
		data: "id="+id+"<!--IFXAMP-->dir="+dir,
		dataType: "text",
		success: function(msg) {
			if (msg != "")
			{
				jQuery("#quote-"+id+" .quote-vote-count").text(msg);
				jQuery("#quote-"+id+" .quote-update-result").text("Done");
			} else {
				jQuery("#quote-"+id+" .quote-update-result").text("Error");
			}
		},
		error: function() {
			jQuery("#quote-"+id+" .quote-update-result").text("Error");
		}
	});
}

function flagQuote(id)
{
	jQuery("#quote-"+id+" .quote-report").addClass("quote-action-done").text("[X]");
	jQuery("#quote-"+id+" .quote-update-result").text("Processing....");
	jQuery.ajax({
		type: "GET",
		url: "/quotes/flag.php",
		data: "id="+id,
		dataType: "text",
		success: function(msg) {
			if (msg == "1")
			{
				jQuery("#quote-"+id+" .quote-update-result").text("Done");
			} else {
				jQuery("#quote-"+id+" .quote-update-result").text("Error");
			}
		},
		error: function() {
			jQuery("#quote-"+id+" .quote-update-result").text("Error");
		}
	});
}

</script>

<!--BEGIN PAGENUMBERS-->
<!--INCLUDE quotes/pagenumbers-->
<!--END PAGENUMBERS-->

<h2 class="light-at-night"><!--ORIGIN--></h2>

<ul class="quote-list">
<!--BEGIN QUOTES-->
	<li id="quote-<!--QUOTES.NUMBER-->" class="quote">
		<h3 class="quote-header">
			<a class="quote-permalink" href="/quotes/<!--QUOTES.NUMBER-->.php">#<!--QUOTES.NUMBER--></a>
			<!--BEGIN QUOTES.CANVOTE-->
			<span class="quote-rating-up"><a href="javascript:voteQuote('<!--QUOTES.NUMBER-->','plus');" rel="nofollow">+</a></span>
			(<span class="quote-vote-count"><!--QUOTES.RATING--></span>)
			<span class="quote-rating-down"><a href="javascript:voteQuote('<!--QUOTES.NUMBER-->','minus');" rel="nofollow">-</a></span>
			<!--END QUOTES.CANVOTE-->
			<!--BEGIN QUOTES.NOVOTE-->
			<span class="quote-rating-up quote-action-done">+</span>
			(<span class="quote-vote-count"><!--QUOTES.RATING--></span>)
			<span class="quote-rating-down quote-action-done">-</span>
			<!--END QUOTES.NOVOTE-->
			<!--BEGIN QUOTES.CANFLAG-->
			<span class="quote-report"><a href="javascript:flagQuote('<!--QUOTES.NUMBER-->');" rel="nofollow">[X]</a></span>
			<!--END QUOTES.CANFLAG-->
			<!--BEGIN QUOTES.NOFLAG-->
			<span class="quote-report quote-action-done">[X]</span>
			<!--END QUOTES.NOFLAG-->
			<span class="quote-date"><!--QUOTES.DATE--></span>
			<span class="quote-update-result"><!--QUOTES.COMMENTS--></span>
		</h3>

		<blockquote class="quote-body"><!--QUOTES.QUOTE--></blockquote>
	</li>
<!--END QUOTES-->
</ul>

<!--BEGIN PAGENUMBERS-->
<!--INCLUDE quotes/pagenumbers-->
<!--END PAGENUMBERS-->
