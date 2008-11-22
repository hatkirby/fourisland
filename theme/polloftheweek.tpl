<!--BEGIN FORM-->
<FORM ACTION="/polloftheweek.php?potw=" METHOD="POST" ID="pollOfTheWeek">
	<SPAN STYLE="font-size: 16px; text-align: center">
		<!--QUESTION-->
	</SPAN>

	<P>
		<INPUT TYPE="radio" NAME="options" VALUE="1" ID="option1">
		<LABEL FOR="option1"><!--OPTION1--></LABEL>

		<BR />

		<INPUT TYPE="radio" NAME="options" VALUE="2" ID="option2">
		<LABEL FOR="option2"><!--OPTION2--></LABEL>

		<BR />

		<INPUT TYPE="radio" NAME="options" VALUE="3" ID="option3">
		<LABEL FOR="option3"><!--OPTION3--></LABEL>

		<BR />

		<INPUT TYPE="radio" NAME="options" VALUE="4" ID="option4">
		<LABEL FOR="option4"><!--OPTION4--></LABEL>
	</P>

	<P>
		<CENTER>
			<INPUT TYPE="submit" VALUE="Vote!">
		</CENTER>
	</P>
</FORM>
<!--END FORM-->

<!--BEGIN DISPLAY-->
<SPAN STYLE="font-size: 16px; text-align: center">
	<!--QUESTION-->
</SPAN>

<P>
	<TABLE WIDTH="100%" BORDER="0" STYLE="font-size: 12px">
		<TR>
			<TD>%<!--PERCENT1--></TD>
			<TD><!--OPTION1--></TD>
		</TR>

		<TR>
			<TD>%<!--PERCENT2--></TD>
			<TD><!--OPTION2--></TD>
		</TR>

		<TR>
			<TD>%<!--PERCENT3--></TD>
			<TD><!--OPTION3--></TD>
		</TR>

		<TR>
			<TD>%<!--PERCENT4--></TD>
			<TD><!--OPTION4--></TD>
		</TR>
	</TABLE>
</P>
<!--END DISPLAY-->
