<A NAME="comments"></A>

<!--BEGIN COMMENTS-->
<A NAME="comment-<!--COMMENTS.ID-->"></A>

<!--BEGIN COMMENTS.EDITOR-->
<FORM ACTION="/edit-comment.php?id=<!--COMMENTS.ID-->" METHOD="POST">
<!--END COMMENTS.EDITOR-->

<DIV CLASS="bubble" ID="comment-<!--COMMENTS.ID-->">
	<BLOCKQUOTE>
		<DIV ID="textBubble-<!--COMMENTS.ID-->">
			<IMG SRC="http://www.gravatar.com/avatar/<!--COMMENTS.CODEDEMAIL-->?s=32&amp;d=identicon&amp;r=G">
			<!--COMMENTS.TEXT-->
		</DIV>

		<!--BEGIN COMMENTS.EDITOR-->

		<DIV ID="postBubble-<!--COMMENTS.ID-->" CLASS="invisible">
	                <TEXTAREA ROWS="4" CLASS="comments_field" NAME="comment" COLS="73"><!--COMMENTS.EDITOR.BEFORE--></TEXTAREA>
                </DIV>

		<!--END COMMENTS.EDITOR-->
	</BLOCKQUOTE>
	<CITE><STRONG><!--COMMENTS.USERNAME--></STRONG> on <!--COMMENTS.DATE--></CITE>

	<!--BEGIN COMMENTS.EDITOR-->

	<SPAN CLASS="post-vote">
		<A HREF="#comment-<!--COMMENTS.ID-->" ONCLICK="openEditor('<!--COMMENTS.ID-->');"><IMG SRC="/theme/images/icons/note_edit.png" ALT="Edit"></A>
		<A HREF="/delete-comment.php?id=<!--COMMENTS.ID-->"><IMG SRC="/theme/images/icons/note_delete.png" ALT="Delete"></A>
	</SPAN>

	<!--END COMMENTS.EDITOR-->
</DIV>

<!--BEGIN COMMENTS.EDITOR-->
	<DIV ID="editComment-<!--COMMENTS.ID-->" CLASS="invisible" STYLE="text-align: center">
		<INPUT TYPE="submit" VALUE="Edit">
		<BUTTON TYPE="button" ONCLICK="closeEditor(<!--COMMENTS.ID-->);">Cancel</BUTTON>
	</DIV>

</FORM>
<!--END COMMENTS.EDITOR-->

<!--END COMMENTS-->

<SCRIPT TYPE="text/javascript">

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

</SCRIPT>

<DIV ID="newComment">
	<FORM ACTION="/post.php?id=<!--PAGEID-->" METHOD="POST">
		<DIV CLASS="bubble">
			<BLOCKQUOTE>
				<DIV ID="postBubble">
					<TEXTAREA ROWS="4" CLASS="comments_field" NAME="comment" COLS="73"></TEXTAREA>
				</DIV>
			</BLOCKQUOTE>
			<CITE><STRONG><!--USERNAME--></STRONG>, feel free to post a comment</CITE>
		</DIV>

		<CENTER>
			<!--BEGIN NOLOG-->
			<!--RECAPTCHA-->
			<P>
			Name: <INPUT TYPE="text" NAME="username"><BR>
			Email: <INPUT TYPE="text" NAME="email"><BR>
			Website (Optional): <INPUT TYPE="text" NAME="website">
			<P>
			<!--END NOLOG-->
			<INPUT TYPE="submit" VALUE="Post">
		</CENTER>
	</FORM>
</DIV>
