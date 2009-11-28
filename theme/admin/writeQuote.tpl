<h2><!--TITLE--></h2>

<form action="<!--ACTION-->" method="post" class="uniForm">
	<!--BEGIN ISERROR-->
	<div id="errorMsg">
		<h3>Oops! There was an error!</h3>

		<ol>
			<!--BEGIN ERROR-->
			<li><a href="#error<!--ERROR.ID-->" title="Jump to error"><!--ERROR.TEXT--></a></li>
			<!--END ERROR-->
		</ol>
	</div>
	<!--END ISERROR-->

	<!--BEGIN FLASH-->
	<div id="OKMsg"><p><!--FLASH.TEXT--></p></div>
	<!--END FLASH-->

	<fieldset class="blockLabels">
		<div class="ctrlHolder<!--ISQUOTEERROR-->">
			<!--BEGIN QUOTEERROR-->
			<p id="error<!--QUOTEERROR.ID-->" class="errorField"><strong><!--QUOTEERROR.TEXT--></strong></p>
			<!--END QUOTEERROR-->
			<label for="quote">Quote</label>
			<textarea name="quote" id="quote" style="height: 24em"><!--QUOTEVALUE--></textarea>
		</div>
	</fieldset>

	<div class="buttonHolder">
		<button type="reset" class="resetButton">Reset</button>
		<button type="submit" class="primaryAction">Submit</button>
	</div>
</form>
