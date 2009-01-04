<A NAME="comments"></A>

<!--BEGIN COMMENTS-->
<A NAME="comment-<!--COMMENTS.ID-->"></A>

<DIV CLASS="bubble">
	<BLOCKQUOTE>
		<DIV>
			<IMG SRC="http://www.gravatar.com/avatar/<!--COMMENTS.CODEDEMAIL-->?s=32&amp;d=identicon&amp;r=G">
			<!--COMMENTS.TEXT-->
		</DIV>
	</BLOCKQUOTE>
	<CITE><STRONG><!--COMMENTS.USERNAME--></STRONG> on <!--COMMENTS.DATE--></CITE>
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
		<INPUT TYPE="submit" VALUE="Post">
	</CENTER>
</FORM>
