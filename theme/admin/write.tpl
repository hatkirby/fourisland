<h2>Write a post</h2>

<form action="/admin/writePost.php?submit=" method="post">
	Post Title: <input type="text" name="title" /><br />
	<textarea name="text" cols="80" rows="20"></textarea><br />
	Tags (comma-seperated): <input type="text" name="tags" value="update" /><br />
	Post Type: <select name="type" size="4">
		<option value="draft">Draft</option>
		<option value="normal" selected="selected">Normal (Article-style) Post</option>
		<option value="priority">High-Priority Post</option>
		<option value="instant">Instant Post</option>
	</select><br />
	<input type="submit" value="Write post" />
</form>
