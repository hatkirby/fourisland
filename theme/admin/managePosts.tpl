<H2>Manage Posts</H2>

<TABLE WIDTH="100%" CLASS="webmail">
	<TR>
		<TH>Post Title</TH>
		<TH>Post Author</TH>
		<TH>Actions</TH>
	</TR>

	<!--BEGIN POST-->
	<TR>
		<TD><!--POST.TITLE--></TD>
		<TD><!--POST.AUTHOR--></TD>

		<TD>
			<A HREF="/admin/editPost.php?id=<!--POST.ID-->"><IMG SRC="/theme/images/icons/page_edit.png" ALT="Edit"></A>
			<A HREF="/admin/deletePost.php?id=<!--POST.ID-->"><IMG SRC="/theme/images/icons/page_delete.png" ALT="Delete"></A>
			<A HREF="/blog/<!--POST.CODED-->/"><IMG SRC="/theme/images/icons/page_go.png" ALT="View"></A>
		</TD>
	</TR>
	<!--END POST-->
</TABLE>

<A HREF="/admin/">Back to Admin Panel</A>
