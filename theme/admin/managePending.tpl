<H2>Manage Pending</H2>

<TABLE WIDTH="100%" CLASS="webmail">
	<TR>
		<TH>Pending Post Title</TH>
		<TH>Pending Post Author</TH>
		<TH>Actions</TH>
	</TR>

	<!--BEGIN PENDING-->
	<TR>
		<TD><!--PENDING.TITLE--></TD>
		<TD><!--PENDING.AUTHOR--></TD>

		<TD>
			<A HREF="/admin/editPending.php?id=<!--PENDING.ID-->"><IMG SRC="/theme/images/icons/page_edit.png" ALT="Edit"></A>
			<A HREF="/admin/deletePending.php?id=<!--PENDING.ID-->"><IMG SRC="/theme/images/icons/page_delete.png" ALT="Delete"></A>
			<A HREF="/admin/viewPending.php?id=<!--PENDING.ID-->"><IMG SRC="/theme/images/icons/page_go.png" ALT="View"></A>
			<A HREF="/admin/movePending.php?id=<!--PENDING.ID-->&amp;dir=up"><IMG SRC="/theme/images/icons/thumb_up.png" ALT="Move Up"></A>
			<A HREF="/admin/movePending.php?id=<!--PENDING.ID-->&amp;dir=down"><IMG SRC="/theme/images/icons/thumb_down.png" ALT="Move Down"></A>
		</TD>
	</TR>
	<!--END PENDING-->
</TABLE>

<A HREF="/admin/">Back to Admin Panel</A>
