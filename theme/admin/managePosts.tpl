<h2>Manage Posts</h2>

<table width="100%" class="webmail">
	<tr>
		<th>Post Title</th>
		<th>Post Author</th>
		<th>Actions</th>
	</tr>

	<!--BEGIN POST-->
	<tr>
		<td><!--POST.TITLE--></td>
		<td><!--POST.AUTHOR--></td>

		<td>
			<a href="/admin/editPost.php?id=<!--POST.ID-->"><img src="/theme/images/icons/page_edit.png" alt="Edit" /></a>
			<a href="/admin/deletePost.php?id=<!--POST.ID-->"><img src="/theme/images/icons/page_delete.png" alt="Delete" /></a>
			<a href="/blog/<!--POST.CODED-->/"><img src="/theme/images/icons/page_go.png" alt="View" /></a>
		</td>
	</tr>
	<!--END POST-->
</table>

<a href="/admin/">Back to Admin Panel</a>
