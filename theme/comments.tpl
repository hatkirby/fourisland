<A NAME="comments" />

<!--BEGIN COMMENTS-->
<A NAME="comment-<!--COMMENTS.ID-->" />

<DIV CLASS="bubble">
	<BLOCKQUOTE>
		<DIV>
			<IMG SRC="http://www.gravatar.com/avatar.php?gravatar_id=<!--COMMENTS.CODEDEMAIL-->&amp;rating=G&amp;size=40&amp;default=<!--CODEDDEF-->">
			<!--COMMENTS.TEXT-->
		</DIV>
	</BLOCKQUOTE>
	<CITE><STRONG><!--COMMENTS.USERNAME--></STRONG> on <!--COMMENTS.DATE--></CITE>

	<SPAN STYLE="float: right">
		<A HREF="/vote.php?id=<!--COMMENTS.ID-->&amp;dir=plus&amp;mode=comment" REL="nofollow"><IMG SRC="/theme/images/icons/thumb_up.png"></A>
		<!--COMMENTS.RATING-->
		<A HREF="/vote.php?id=<!--COMMENTS.ID-->&amp;dir=minus&amp;mode=comment" REL="nofollow"><IMG SRC="/theme/images/icons/thumb_down.png"></A>
	</SPAN>
</DIV>
<!--END COMMENTS-->

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
		<INPUT TYPE="submit" VALUE="Post"></INPUT>
	</CENTER>
</FORM>
