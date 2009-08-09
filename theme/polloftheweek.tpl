<!--BEGIN FORM-->
<div id="potw-ajax">
	<span style="font-size: 16px; text-align: center">
		<!--QUESTION-->
	</span>

	<br />

	<input type="radio" name="options" value="1" class="option1" />
	<!--OPTION1-->

	<br />

	<input type="radio" name="options" value="2" class="option2" />
	<!--OPTION2-->

	<br />

	<input type="radio" name="options" value="3" class="option3" />
	<!--OPTION3-->

	<br />

	<input type="radio" name="options" value="4" class="option4" />
	<!--OPTION4-->

	<p align="center">
		<button type="button" onclick="jQuery('#potw-ajax').slideUp().load('/poll-results.php?id='+jQuery('#potw-ajax input:radio[name=options]:checked').val()).slideDown();">Vote!</button>
	</p>
</div>
<!--END FORM-->

<!--BEGIN DISPLAY-->
<span style="font-size: 16px; text-align: center">
	<!--QUESTION-->
</span>

<table width="100%" border="0" style="font-size: 12px">
	<tr>
		<td>%<!--PERCENT1--></td>
		<td><!--OPTION1--></td>
	</tr>

	<tr>
		<td>%<!--PERCENT2--></td>
		<td><!--OPTION2--></td>
	</tr>

	<tr>
		<td>%<!--PERCENT3--></td>
		<td><!--OPTION3--></td>
	</tr>

	<tr>
		<td>%<!--PERCENT4--></td>
		<td><!--OPTION4--></td>
	</tr>
</table>
<!--END DISPLAY-->
