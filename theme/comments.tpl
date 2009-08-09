<a name="comments" />

<!--BEGIN COMMENTS-->
<a name="comment-<!--COMMENTS.ID-->" />

<!--BEGIN COMMENTS.EDITOR-->
<form action="/edit-comment.php?id=<!--COMMENTS.ID-->" method="post">
<!--END COMMENTS.EDITOR-->

<div class="module unrounded" id="comment-<!--COMMENTS.ID-->">
	<div id="textBubble-<!--COMMENTS.ID-->" class="comment">
		<img src="http://www.gravatar.com/avatar/<!--COMMENTS.CODEDEMAIL-->?s=32&amp;d=identicon&amp;r=G" alt="" />
		<!--COMMENTS.TEXT-->
	</div>

	<!--BEGIN COMMENTS.EDITOR-->

	<div id="postBubble-<!--COMMENTS.ID-->" class="invisible">
		<textarea rows="4" class="comments_field" name="comment" cols="100"><!--COMMENTS.EDITOR.BEFORE--></textarea>
	</div>

	<!--END COMMENTS.EDITOR-->
</div>

<cite class="light-at-night"><strong><!--COMMENTS.USERNAME--></strong> on <!--COMMENTS.DATE--></cite>

<!--BEGIN COMMENTS.EDITOR-->

	<span class="post-vote">
		<a href="#comment-<!--COMMENTS.ID-->" onclick="openEditor('<!--COMMENTS.ID-->');"><img src="/theme/images/icons/note_edit.png" alt="Edit" /></a>
		<a href="#comment-<!--COMMENTS.ID-->" onclick="if (confirm('Are you sure you would like to delete this comment?')) {window.location='/delete-comment.php?id=<!--COMMENTS.ID-->';}"><img src="/theme/images/icons/note_delete.png" alt="Delete" /></a>
	</span>

	<div id="editComment-<!--COMMENTS.ID-->" class="invisible" style="text-align: center">
		<input type="submit" value="Edit" />
		<button type="button" onclick="closeEditor(<!--COMMENTS.ID-->);">Cancel</button>
	</div>
</form>
<!--END COMMENTS.EDITOR-->

<!--END COMMENTS-->

<div class="cleardiv"></div>

<script type="text/javascript">

function openEditor(id)
{
	jQuery("#textBubble-" + id).addClass("invisible");
	jQuery("#postBubble-" + id).removeClass("invisible");
	jQuery(".post-vote").addClass("invisible");
	jQuery("#newComment").addClass("invisible");
	jQuery("#editComment-" + id).removeClass("invisible");
}

function closeEditor(id)
{
	jQuery("#textBubble-" + id).removeClass("invisible");
	jQuery("#postBubble-" + id).addClass("invisible");
	jQuery(".post-vote").removeClass("invisible");
	jQuery("#newComment").removeClass("invisible");
	jQuery("#editComment-" + id).addClass("invisible");
}

function postComment()
{
	jQuery("#newComment textarea, #newComment input, #newComment button").attr("disabled", "disabled");
	jQuery("#flash").text("Processing....").slideDown();
	jQuery.ajax({
		type: "POST",
		url: "/post.php",
		data: ({
			id: "<!--PAGEID-->",
			comment: jQuery("#newComment textarea").val(),
			username: jQuery("#newComment input:text[name=username]").val(),
			email: jQuery("#newComment input:text[name=email]").val(),
			website: jQuery("#newComment input:text[name=website]").val(),
			recaptcha_challenge_field: jQuery("#newComment input[name=recaptcha_challenge_field]").val(),
			recaptcha_response_field: jQuery("#newComment input[name=recaptcha_response_field]").val()
		}),
		dataType: "text",
		success: function(msg) {
			if (msg.indexOf("textBubble") != -1)
			{
				jQuery("#flash").text("Your comment has been posted.");
				jQuery("#newComment").html(msg);
			} else {
				jQuery("#newComment textarea, #newComment input, #newComment button").removeAttr("disabled");
				jQuery("#flash").text(msg);
			}
		},
		error: function() {
			jQuery("#newComment textarea, #newComment input, #newComment button").removeAttr("disabled");
			jQuery("#flash").text("There was an error posting your comment.");
		}
	});
}

</script>

<div id="newComment">
	<form action="/post.php?id=<!--PAGEID-->" method="post">
		<div class="module unrounded" id="postBubble">
			<textarea rows="4" class="comments_field" name="comment" cols="100"></textarea>
		</div>
		
		<cite class="light-at-night"><strong><!--USERNAME--></strong>, feel free to post a comment</cite>

		<center class="light-at-night">
			<!--BEGIN NOLOG-->
			<!--RECAPTCHA-->
			<p>
			Name: <input type="text" name="username" /><br />
			Email: <input type="text" name="email" /><br />
			Website (Optional): <input type="text" name="website" />
			</p>
			<!--END NOLOG-->
			<button type="button" onclick="postComment();">Post</button>
		</center>
	</form>
</div>
