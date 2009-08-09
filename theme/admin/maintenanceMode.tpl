<h2>Maintenance Mode</h2>

<p>Here you can enable/disable Maintenance Mode. When Maintenance Mode is enabled, no one can access Four Island except localhost.</p>

<form action="/admin/maintenanceMode.php?submit=" method="post">
	<center>
		<input type="radio" name="mode" value="on"<!--ON--> />On<br />
		<input type="radio" name="mode" value="off"<!--OFF--> />Off<br />
		<input type="submit" />
	</center>
</form>

<p>
	<a href="/admin/">Back to Admin Panel</a>
</p>
