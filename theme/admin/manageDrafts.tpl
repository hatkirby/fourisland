<h2>Manage Drafts</h2>

<table width="100%" class="webmail">
	<tr>
		<th>Draft Title</th>
		<th>Draft Author</th>
		<th>Actions</th>
	</tr>

	<!--BEGIN DRAFT-->
	<tr>
		<td><!--DRAFT.TITLE--></td>
		<td><!--DRAFT.AUTHOR--></td>

		<td>
			<a href="/admin/editDraft.php?id=<!--DRAFT.ID-->"><img src="/theme/images/icons/page_edit.png" alt="Edit" /></a>
			<a href="/admin/deleteDraft.php?id=<!--DRAFT.ID-->"><img src="/theme/images/icons/page_delete.png" alt="Delete" /></a>
			<a href="/admin/viewDraft.php?id=<!--DRAFT.ID-->"><img src="/theme/images/icons/page_go.png" alt="View" /></a>
		</td>
	</tr>
	<!--END DRAFT-->
</table>

<a href="/admin/">Back to Admin Panel</a>
