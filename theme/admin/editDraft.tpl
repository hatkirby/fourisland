<H2>Edit a draft</H2><P>

<FORM ACTION="/admin/editDraft.php?id=<!--ID-->&submit=" METHOD="POST">
	Draft Title: <INPUT TYPE="text" NAME="title" VALUE="<!--TITLE-->"><BR>
	<TEXTAREA NAME="text" COLS="80" ROWS="20"><!--TEXT--></TEXTAREA><P>
	Tag 1: <INPUT TYPE="text" NAME="tag1" VALUE="<!--TAG1-->"><BR>
	Tag 2: <INPUT TYPE="text" NAME="tag2" VALUE="<!--TAG2-->"> (Optional)<BR>
	Tag 3: <INPUT TYPE="text" NAME="tag3" VALUE="<!--TAG3-->"> (Optional)<BR>
	Post Type: <SELECT NAME="type" SIZE="4">
		<OPTION VALUE="draft" SELECTED>Draft</OPTION>
		<OPTION VALUE="normal">Normal (Article-style) Post</OPTION>
		<OPTION VALUE="priority">High-Priority Post</OPTION>
		<OPTION VALUE="instant">Instant Post</OPTION>
	</SELECT><BR>
	<INPUT TYPE="submit" VALUE="Edit draft">
</FORM>
