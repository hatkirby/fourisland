<h2>Moderate Quotes</h2>

<div class="clear"></div>

<script type="text/javascript">
function denyQuote(id)
{
	if (confirm("Are you sure you would like to deny this quote?"))
	{
		postwith("/admin/modquotes.php?pageID=<!--PAGEID-->&action=deny",{id:id});
	}
}

function approveQuote(id)
{
	postwith("/admin/modquotes.php?pageID=<!--PAGEID-->&action=approve",{id:id});
}

// following function taken from http://mentaljetsam.wordpress.com/2008/06/02/using-javascript-to-post-data-between-pages/
function postwith (to,p) {
  var myForm = document.createElement("form");
  myForm.method="post" ;
  myForm.action = to ;
  for (var k in p) {
    var myInput = document.createElement("input") ;
    myInput.setAttribute("name", k) ;
    myInput.setAttribute("value", p[k]);
    myForm.appendChild(myInput) ;
  }
  document.body.appendChild(myForm) ;
  myForm.submit() ;
  document.body.removeChild(myForm) ;
}

function bulkAction()
{
	var bulk=new Array();
	$(".the-check:checked").each(function() {
		bulk.push($(this).val());
	});
	var ids = bulk.join(",")

	if (ids != "")
	{
		if ($('#manage-bulk select').val() == "deny")
		{
			if (confirm("Are you sure you would like to deny the selected quotes?"))
			{
				postwith("/admin/modquotes.php?pageID=<!--PAGEID-->&action=denys",{ids:ids});
			}
		} else if ($('#manage-bulk select').val() == "approve")
		{
			if (confirm("Are you sure you would like to approve the selected quotes?"))
			{
				postwith("/admin/modquotes.php?pageID=<!--PAGEID-->&action=approves",{ids:ids});
			}
		}
	}	
}

$(document).ready(function() {
	$("input#all-check").click(function() {
		var what = this.checked;
		$("input.the-check").each(function() {
			this.checked = what;
		});
	});
});
</script>

<!--BEGIN AVAIL-->
<div id="manage-options">
	<div id="manage-bulk">
		<select name="bulk-type">
			<option value="approve">Approve</option>
			<option value="deny">Deny</option>
		</select>

		<button id="bulk" type="button" onclick="bulkAction()">Bulk</button>
	</div>
</div>

<div class="manage-pagination"><!--PAGINATION--></div>

<table>
	<tr class="table-header">
		<td class="table-checkbox"><input type="checkbox" id="all-check" /></td>
		<td>Quote</td>
		<td colspan="2">Actions</td>
	</tr>
	<!--BEGIN QUOTE-->
	<tr<!--QUOTE.ODD-->>
		<td class="table-checkbox"><input class="the-check" type="checkbox" name="bulk" value="<!--QUOTE.ID-->" /></td>
		<td style="line-height: 1.5em;"><!--QUOTE.TEXT--></td>
		<td class="table-img"><a href="#" onclick="approveQuote(<!--QUOTE.ID-->)"><img src="/theme/images/icons/thumb_up.png" alt="Approve" /></a></td>
		<td class="table-img"><a href="#" onclick="denyQuote(<!--QUOTE.ID-->)"><img src="/theme/images/icons/thumb_down.png" alt="Delete" /></a></td>
	</tr>
	<!--END QUOTE-->
</table>

<div class="manage-pagination"><!--PAGINATION--></div>
<!--END AVAIL-->
<!--BEGIN NOTAVAIL-->
<div class="manage-pagination">There are no quotes to moderate.</div>
<!--END NOTAVAIL-->
