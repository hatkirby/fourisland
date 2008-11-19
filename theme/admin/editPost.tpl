<H2>Edit a post</H2><P>

<FORM ACTION="/admin/editPost.php?id=<!--ID-->&submit=" METHOD="POST">
	Post Title: <INPUT TYPE="text" NAME="title" VALUE="<!--TITLE-->"><BR>
	<TEXTAREA NAME="text" COLS="80" ROWS="20"><!--TEXT--></TEXTAREA><P>
	Tag 1: <INPUT TYPE="text" NAME="tag1" VALUE="<!--TAG1-->"><BR>
	Tag 2: <INPUT TYPE="text" NAME="tag2" VALUE="<!--TAG2-->"> (Optional)<BR>
	Tag 3: <INPUT TYPE="text" NAME="tag3" VALUE="<!--TAG3-->"> (Optional)<BR>
	<INPUT TYPE="submit" VALUE="Edit post">
</FORM>
