<h2>Edit a pending post</h2>

<form action="/admin/editPending.php?id=<!--ID-->&amp;submit=" method="post">
	Post Title: <input type="text" name="title" value="<!--TITLE-->" /><br />
	<textarea name="text" cols="80" rows="20"><!--TEXT--></textarea><br />
	Tags (comma-seperated): <input type="text" name="tags" value="<!--TAGS-->" /><br />
	<input type="submit" value="Edit post" />
</form>
