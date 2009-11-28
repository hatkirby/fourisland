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
		<div class="ctrlHolder<!--ISTITLEERROR-->">
			<!--BEGIN TITLEERROR-->
			<p id="error<!--TITLEERROR.ID-->" class="errorField"><strong><!--TITLEERROR.TEXT--></strong></p>
			<!--END TITLEERROR-->
			<label for="title"><em>*</em> Title</label>
			<input name="title" id="title" value="<!--TITLEVALUE-->" type="text" class="textInput" />
		</div>
	</fieldset>

	<fieldset class="blockLabels">
		<div class="ctrlHolder<!--ISTEXTERROR-->">
			<!--BEGIN TEXTERROR-->
			<p id="error<!--TEXTERROR.ID-->" class="errorField"><strong><!--TEXTERROR.TEXT--></strong></p>
			<!--END TEXTERROR-->
			<label for="text">Text</label>
			<textarea name="text" id="text" style="height: 24em"><!--TEXTVALUE--></textarea>
		</div>
	</fieldset>

	<fieldset class="inlineLabels">
		<div class="ctrlHolder<!--ISTAGSERROR-->">
			<!--BEGIN TAGSERROR-->
			<p id="error<!--TAGSERROR.ID-->" class="errorField"><strong><!--TAGSERROR.TEXT--></strong></p>
			<!--END TAGSERROR-->
			<label for="tags"><em>*</em> Tags</label>
			<input name="tags" id="tags" value="<!--TAGSVALUE-->" type="text" class="textInput" />
			<p class="formHint">Each tag should be seperated by a comma.</p>
		</div>

		<div class="ctrlHolder<!--ISTYPEERROR-->">
			<!--BEGIN TYPEERROR-->
			<p id="error<!--TYPEERROR.ID-->" class="errorField"><strong><!--TYPEERROR.TEXT--></strong></p>
			<!--END TYPEERROR-->
			<p class="label"><em>*</em> Post Type</p>
			<div class="multiField">
				<label for="type_draft" class="inlineLabel"><input name="type" id="type_draft" value="draft" type="radio"<!--DRAFTSELECTED--><!--TAGSDISABLED--> /> Draft</label>
				<label for="type_article" class="inlineLabel"><input name="type" id="type_article" value="article" type="radio"<!--ARTICLESELECTED--><!--TAGSDISABLED--> /> Queued Post (Article-style)</label>
				<label for="type_high" class="inlineLabel"><input name="type" id="type_high" value="high" type="radio"<!--HIGHSELECTED--><!--TAGSDISABLED--> /> High Priority Queued Post (Article-style)</label>
				<label for="type_instant" class="inlineLabel"><input name="type" id="type_instant" value="instant" type="radio"<!--INSTANTSELECTED--><!--TAGSDISABLED--> /> Instant Post</label>
			</div>
		</div>
	</fieldset>

	<div class="buttonHolder">
		<button type="reset" class="resetButton">Reset</button>
		<button type="submit" class="primaryAction">Submit</button>
	</div>
</form>
