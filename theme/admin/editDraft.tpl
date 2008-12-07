<H2>Edit a draft</H2><P>

<FORM ACTION="/admin/editDraft.php?id=<!--ID-->&submit=" METHOD="POST">
	Draft Title: <INPUT TYPE="text" NAME="title" VALUE="<!--TITLE-->"><BR>
	<TEXTAREA NAME="text" COLS="80" ROWS="20"><!--TEXT--></TEXTAREA><P>
	Tags (comma-seperated): <INPUT TYPE="text" NAME="tags" VALUE="<!--TAGS-->"><BR>
	Post Type: <SELECT NAME="type" SIZE="4">
		<OPTION VALUE="draft" SELECTED>Draft</OPTION>
		<OPTION VALUE="normal">Normal (Article-style) Post</OPTION>
		<OPTION VALUE="priority">High-Priority Post</OPTION>
		<OPTION VALUE="instant">Instant Post</OPTION>
	</SELECT><BR>
	<INPUT TYPE="submit" VALUE="Edit draft">
</FORM>
