<h2>Edit a draft</h2>

<p><form action="/admin/editDraft.php?id=<!--ID-->&amp;submit=" method="post">
	Draft Title: <input type="text" name="title" value="<!--TITLE-->" /><br />
	<textarea name="text" cols="80" rows="20"><!--TEXT--></textarea><br />
	Tags (comma-seperated): <input type="text" name="tags" value="<!--TAGS-->" /><br />
	Post Type: <select name="type" size="4">
		<option value="draft" selected="selected">Draft</option>
		<option value="normal">Normal (Article-style) Post</option>
		<option value="priority">High-Priority Post</option>
		<option value="instant">Instant Post</option>
	</select><br />
	<input type="submit" value="Edit draft" />
</form></p>
