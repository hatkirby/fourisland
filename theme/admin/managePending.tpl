<h2>Manage Pending</h2>

<table width="100%" class="webmail">
	<tr>
		<th>Pending Post Title</th>
		<th>Pending Post Author</th>
		<th>Actions</th>
	</tr>

	<!--BEGIN PENDING-->
	<tr>
		<td><!--PENDING.TITLE--></td>
		<td><!--PENDING.AUTHOR--></td>

		<td>
			<a href="/admin/editPending.php?id=<!--PENDING.ID-->"><img src="/theme/images/icons/page_edit.png" alt="Edit" /></a>
			<a href="/admin/deletePending.php?id=<!--PENDING.ID-->"><img src="/theme/images/icons/page_delete.png" alt="Delete" /></a>
			<a href="/admin/viewPending.php?id=<!--PENDING.ID-->"><img src="/theme/images/icons/page_go.png" alt="View" /></a>
			<a href="/admin/movePending.php?id=<!--PENDING.ID-->&amp;dir=up"><img src="/theme/images/icons/thumb_up.png" alt="Move Up" /></a>
			<a href="/admin/movePending.php?id=<!--PENDING.ID-->&amp;dir=down"><img src="/theme/images/icons/thumb_down.png" alt="Move Down" /></a>
		</td>
	</tr>
	<!--END PENDING-->
</table>

<a href="/admin/">Back to Admin Panel</a>
