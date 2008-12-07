<H2>Edit a post</H2><P>

<FORM ACTION="/admin/editPost.php?id=<!--ID-->&submit=" METHOD="POST">
	Post Title: <INPUT TYPE="text" NAME="title" VALUE="<!--TITLE-->"><BR>
	<TEXTAREA NAME="text" COLS="80" ROWS="20"><!--TEXT--></TEXTAREA><P>
	Tags (comma-seperated): <INPUT TYPE="text" NAME="tags" VALUE="<!--TAGS-->"><BR>
	<INPUT TYPE="submit" VALUE="Edit post">
</FORM>
