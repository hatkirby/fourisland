<DIV CLASS="search_all">
	<DIV ID="search_title">Search</DIV>

	<FORM METHOD="POST" ACTION="/quotes/search.php?fetch=">
		<INPUT TYPE="text" NAME="search" SIZE="28" ID="search_query-box">&nbsp;
		<INPUT TYPE="submit" NAME="submit" ID="search_submit-button"><BR>
		Sort: <SELECT NAME="sortby" SIZE="1" ID="search_sortby-dropdown">
			<OPTION SELECTED>Rating</OPTION>
			<OPTION>ID</OPTION>
		</SELECT>&nbsp;
		How many: <SELECT NAME="number" SIZE="1" ID="search_limit-dropdown">
			<OPTION SELECTED>10</OPTION>
			<OPTION>25</OPTION>
			<OPTION>50</OPTION>
			<OPTION>75</OPTION>
			<OPTION>100</OPTION>
		</SELECT>
	</FORM>
</DIV>
