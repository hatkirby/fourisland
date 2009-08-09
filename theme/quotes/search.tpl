<div class="cleardiv"></div>

<h1 class="light-at-night">Search</h1>

<form method="POST" action="/quotes/search.php?fetch=">
	<input type="text" name="search" size="28" />&nbsp;
	<input type="submit" name="submit" /><br />
	<span class="light-at-night">Sort:</span> <select name="sortby" size="1">
		<option selected="selected">Rating</option>
		<option>ID</option>
	</select>&nbsp;
	<span class="light-at-night">How many:</span> <select name="number" size="1">
		<option selected="selected">10</option>
		<option>25</option>
		<option>50</option>
		<option>75</option>
		<option>100</option>
	</select>
</form>
