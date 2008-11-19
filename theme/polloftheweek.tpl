<!--BEGIN FORM-->
<FORM ACTION="/polloftheweek.php?potw=" METHOD="POST" ID="pollOfTheWeek">
	<TABLE BORDER=1 STYLE="background: #d3d3d3; font-size: 12px" ALIGN="center">
		<TR>
			<TD WIDTH="100%" COLSPAN=2><!--QUESTION--></TD>
		</TR>

		<TR>
			<TD>
				<INPUT TYPE="radio" NAME="options" VALUE="1" ID="option1">
				<LABEL FOR="option1"><!--OPTION1--></LABEL>
			</TD>

			<TD>
				<INPUT TYPE="radio" NAME="options" VALUE="2" ID="option2">
				<LABEL FOR="option2"><!--OPTION2--></LABEL>
			</TD>
		</TR>

		<TR>
			<TD>
				<INPUT TYPE="radio" NAME="options" VALUE="3" ID="option3">
				<LABEL FOR="option3"><!--OPTION3--></LABEL>
			</TD>

			<TD>
				<INPUT TYPE="radio" NAME="options" VALUE="4" ID="option4">
				<LABEL FOR="option4"><!--OPTION4--></LABEL>
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=2>
				<CENTER>
					<INPUT TYPE="submit" VALUE="Vote!">
				</CENTER>
			</TD>
		</TR>
	</TABLE>
</FORM>
<!--END FORM-->

<!--BEGIN DISPLAY-->
<TABLE BORDER=1 STYLE="background: #d3d3d3; font-size: 12px" ALIGN="center" ID="pollOfTheWeek">
	<TR>
		<TD WIDTH="100%" COLSPAN=2><!--QUESTION--></TD>
	</TR>

	<TR>
		<TD>%<!--PERCENT1--><IMG SRC="/theme/images/blue.PNG" WIDTH="<!--PERCENT1-->" HEIGHT="8" ALT="%<!--PERCENT1-->"><BR><!--OPTION1--></TD>
		<TD>%<!--PERCENT2--><IMG SRC="/theme/images/blue.PNG" WIDTH="<!--PERCENT2-->" HEIGHT="8" ALT="%<!--PERCENT2-->"><BR><!--OPTION2--></TD>
	</TR>

	<TR>
		<TD>%<!--PERCENT3--><IMG SRC="/theme/images/blue.PNG" WIDTH="<!--PERCENT3-->" HEIGHT="8" ALT="%<!--PERCENT3-->"><BR><!--OPTION3--></TD>
		<TD>%<!--PERCENT4--><IMG SRC="/theme/images/blue.PNG" WIDTH="<!--PERCENT4-->" HEIGHT="8" ALT="%<!--PERCENT4-->"><BR><!--OPTION4--></TD>
	</TR>
</TABLE>
<!--END DISPLAY-->
