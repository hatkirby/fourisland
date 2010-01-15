<h2>Maintenance Mode</h2>

<p>Here you can enable/disable Maintenance Mode. When Maintenance Mode is enabled, no one can access Four Island except localhost and a logged in administrator.</p>

<form action="/admin/maintenance.php?submit=" method="post">
	<p>
		Maintenance Mode:
		<select name="mode">
			<option value="on"<!--ON-->>On</option>
			<option value="off"<!--OFF-->>Off</option>
		</select>
	</p>

	<p>
		<button type="submit">Submit</button>
	</p>
</form>
