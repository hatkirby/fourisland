<div class="cleardiv"></div>

<h1 class="light-at-night">Contribute</h1>

<!--BEGIN SUBMITTED-->
	<p class="light-at-night">The quote you have submitted is:</p>
	<p class="light-at-night"><code><!--SUBMITTED.QUOTE--></code></p>
	<p class="light-at-night">If this is not the quote you have entered, please contact the administrator and explain your problem. 
	   Also, there is no need to press the submit button again. You're quote has already been sent.</p>
<!--END SUBMITTED-->

<!--BEGIN ERROR-->
  <p class="light-at-night">Sorry, for the time being, because of the massive problem we are having with spam, anonymous submission of quotes is disabled. If you have an account, you can still log in and submit a quote.</p>
<!--END ERROR-->

<form action="/quotes/add.php?submit=" method="POST">
	<textarea cols="80" rows="5" name="rash_quote"></textarea><br />
	<input type="submit" value="Add Quote!" />
	<input type="reset" value="Reset" />
</form>
