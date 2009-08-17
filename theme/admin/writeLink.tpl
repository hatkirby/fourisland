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
			<label for="title">Title</label>
			<input type="text" name="title" id="title" value="<!--TITLEVALUE-->" />
		</div>

		<div class="ctrlHolder<!--ISURLERROR-->">
			<!--BEGIN URLERROR-->
			<p id="error<!--URLERROR.ID-->" class="errorField"><strong><!--URLERROR.TEXT--></strong></p>
			<!--END URLERROR-->
			<label for="url">URL</label>
			<input type="text" name="url" id="url" value="<!--URLVALUE-->" />
		</div>

		<div class="ctrlHolder<!--ISTYPEERROR-->">
			<!--BEGIN TYPEERROR-->
			<p id="error<!--TYPEERROR.ID-->" class="errorField"><strong><!--TYPEERROR.TEXT--></strong></p>
			<!--END TYPEERROR-->
			<p class="label"><em>*</em> Link Type</p>
			<div class="multiField">
				<label for="type_affiliates" class="inlineLabel"><input name="type" id="type_affiliates" value="affiliates" type="radio"<!--AFFILIATESSELECTED--><!--TYPEDISABLED--> /> Affiliates</label>
				<label for="type_webprojs" class="inlineLabel"><input name="type" id="type_webprojs" value="webprojs" type="radio"<!--WEBPROJSSELECTED--><!--TYPEDISABLED--> /> Website Projects</label>
			</div>
		</div>
	</fieldset>

	<div class="buttonHolder">
		<button type="reset" class="resetButton">Reset</button>
		<button type="submit" class="primaryAction">Submit</button>
	</div>
</form>
