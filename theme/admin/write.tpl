<H2>Write a post</H2><P>

<FORM ACTION="/admin/writePost.php?submit=" METHOD="POST">
	Post Title: <INPUT TYPE="text" NAME="title"><BR>
	<TEXTAREA NAME="text" COLS="80" ROWS="20"></TEXTAREA><P>
	Tag 1: <INPUT TYPE="text" NAME="tag1" VALUE="update"><BR>
	Tag 2: <INPUT TYPE="text" NAME="tag2"> (Optional)<BR>
	Tag 3: <INPUT TYPE="text" NAME="tag3"> (Optional)<BR>
	Post Type: <SELECT NAME="type" SIZE="4">
		<OPTION VALUE="draft">Draft</OPTION>
		<OPTION VALUE="normal" SELECTED>Normal (Article-style) Post</OPTION>
		<OPTION VALUE="priority">High-Priority Post</OPTION>
		<OPTION VALUE="instant">Instant Post</OPTION>
	</SELECT><BR>
	<INPUT TYPE="submit" VALUE="Write post">
</FORM>
