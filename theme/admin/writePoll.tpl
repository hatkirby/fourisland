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

	<fieldset class="inlineLabels">
		<div class="ctrlHolder<!--ISQUESTIONERROR-->">
			<!--BEGIN QUESTIONERROR-->
			<p id="error<!--QUESTIONERROR.ID-->" class="errorField"><strong><!--QUESTIONERROR.TEXT--></strong></p>
			<!--END QUESTIONERROR-->
			<label for="question"><em>*</em> Question</label>
			<input name="question" id="question" value="<!--QUESTIONVALUE-->" type="text" class="textInput" />
		</div>

		<div class="ctrlHolder<!--ISOPTION1ERROR-->">
			<!--BEGIN OPTION1ERROR-->
			<p id="error<!--OPTION1ERROR.ID-->" class="errorField"><strong><!--OPTION1ERROR.ID--></strong></p>
			<!--END OPTION1ERROR-->
			<label for="option1"><em>*</em> Option 1</label>
			<input name="option1" id="option1" value="<!--OPTION1VALUE-->" type="text" class="textInput" />
		</div>

		<div class="ctrlHolder<!--ISOPTION2ERROR-->">
			<!--BEGIN OPTION2ERROR-->
			<p id="error<!--OPTION2ERROR.ID-->" class="errorField"><strong><!--OPTION2ERROR.ID--></strong></p>
			<!--END OPTION2ERROR-->
			<label for="option2"><em>*</em> Option 2</label>
			<input name="option2" id="option2" value="<!--OPTION2VALUE-->" type="text" class="textInput" />
		</div>

		<div class="ctrlHolder<!--ISOPTION3ERROR-->">
			<!--BEGIN OPTION3ERROR-->
			<p id="error<!--OPTION3ERROR.ID-->" class="errorField"><strong><!--OPTION3ERROR.ID--></strong></p>
			<!--END OPTION3ERROR-->
			<label for="option3"><em>*</em> Option 3</label>
			<input name="option3" id="option3" value="<!--OPTION3VALUE-->" type="text" class="textInput" />
		</div>

		<div class="ctrlHolder<!--ISOPTION4ERROR-->">
			<!--BEGIN OPTION4ERROR-->
			<p id="error<!--OPTION4ERROR.ID-->" class="errorField"><strong><!--OPTION4ERROR.ID--></strong></p>
			<!--END OPTION4ERROR-->
			<label for="option4"><em>*</em> Option 4</label>
			<input name="option4" id="option4" value="<!--OPTION4VALUE-->" type="text" class="textInput" />
		</div>
	</fieldset>

	<fieldset class="blockLabels">
		<div class="ctrlHolder<!--ISTEXTERROR-->">
			<!--BEGIN TEXTERROR-->
			<p id="error<!--TEXTERROR.ID-->" class="errorField"><strong><!--TEXTERROR.TEXT--></strong></p>
			<!--END TEXTERROR-->
			<label for="text">Text</label>
			<textarea name="text" id="text"><!--TEXTVALUE--></textarea>
		</div>
	</fieldset>

	<div class="buttonHolder">
		<button type="reset" class="resetButton">Reset</button>
		<button type="submit" class="primaryAction">Submit</button>
	</div>
</form>
