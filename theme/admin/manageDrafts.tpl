<H2>Manage Drafts</H2>

<TABLE WIDTH="100%" CLASS="webmail">
	<TR>
		<TH>Draft Title</TH>
		<TH>Draft Author</TH>
		<TH>Actions</TH>
	</TR>

	<!--BEGIN DRAFT-->
	<TR>
		<TD><!--DRAFT.TITLE--></TD>
		<TD><!--DRAFT.AUTHOR--></TD>

		<TD>
			<A HREF="/admin/editDraft.php?id=<!--DRAFT.ID-->"><IMG SRC="/theme/images/icons/page_edit.png" ALT="Edit"></A>
			<A HREF="/admin/deleteDraft.php?id=<!--DRAFT.ID-->"><IMG SRC="/theme/images/icons/page_delete.png" ALT="Delete"></A>
			<A HREF="/admin/viewDraft.php?id=<!--DRAFT.ID-->"><IMG SRC="/theme/images/icons/page_go.png" ALT="View"></A>
		</TD>
	</TR>
	<!--END DRAFT-->
</TABLE>

<A HREF="/admin/">Back to Admin Panel</A>
