<DIV CLASS="cleardiv"></DIV>

<H1>Search</H1>

<FORM METHOD="POST" ACTION="/quotes/search.php?fetch=">
	<INPUT TYPE="text" NAME="search" SIZE="28">&nbsp;
	<INPUT TYPE="submit" NAME="submit"><BR>
	Sort: <SELECT NAME="sortby" SIZE="1">
		<OPTION SELECTED>Rating</OPTION>
		<OPTION>ID</OPTION>
	</SELECT>&nbsp;
	How many: <SELECT NAME="number" SIZE="1">
		<OPTION SELECTED>10</OPTION>
		<OPTION>25</OPTION>
		<OPTION>50</OPTION>
		<OPTION>75</OPTION>
		<OPTION>100</OPTION>
	</SELECT>
</FORM>
