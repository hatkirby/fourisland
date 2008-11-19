<DIV ID="add_all">
	<DIV ID="add_title">Contribute</DIV>

	<!--BEGIN SUBMITTED-->
	<DIV ID="add_outputmsg">
		<DIV ID="add_outputmsg_top">The quote you have submitted is:</DIV>
		<DIV ID="add_outputmsg_quote"><!--SUBMITTED.QUOTE--></DIV>
		<DIV ID="add_outputmsg_bottom">If this is not the quote you have entered, please contact the administrator and explain your problem. Also, there is no need to press the submit button again. You're quote has already been sent.</DIV>
	</DIV>
	<!--END SUBMITTED-->

	<FORM ACTION="/quotes/add.php?submit=" METHOD="POST">
		<TEXTAREA COLS="80" ROWS="5" NAME="rash_quote" ID="add_quote"></TEXTAREA><BR>
		<INPUT TYPE="submit" VALUE="Add Quote!" ID="add_submit">
		<INPUT TYPE="reset" VALUE="Reset" ID="add_reset">
	</FORM>
</DIV>
