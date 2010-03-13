<h2><!--TITLE--></h2>

<div class="clear"></div>

<script type="text/javascript">
function deleteLink(id)
{
	if (confirm("Are you sure you would like to delete this link?"))
	{
		postwith("/admin/links.php?pageID=<!--PAGEID-->&action=delete",{id:id});
	}
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
		if ($('#manage-bulk select').val() == "delete")
		{
			if (confirm("Are you sure you would like to delete the selected links?"))
			{
				postwith("/admin/links.php?pageID=<!--PAGEID-->&action=deletes",{ids:ids});
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
			<option value="delete">Delete</option>
		</select>

		<button id="bulk" type="button" onclick="bulkAction()">Bulk</button>
	</div>
</div>

<div class="manage-pagination"><!--PAGINATION--></div>

<table>
	<tr class="table-header">
		<td class="table-checkbox"><input type="checkbox" id="all-check" /></td>
		<td>Post Name</td>
		<td colspan="3">Actions</td>
	</tr>
	<!--BEGIN LINK-->
	<tr<!--LINK.ODD-->>
		<td class="table-checkbox"><input class="the-check" type="checkbox" name="bulk" value="<!--LINK.ID-->" /></td>
		<td><!--LINK.TITLE--></td>
		<td class="table-img"><a href="/admin/editLink.php?id=<!--LINK.ID-->"><img src="/theme/images/icons/page_edit.png" alt="Edit" /></a></td>
		<td class="table-img"><a href="#" onclick="deleteLink(<!--LINK.ID-->)"><img src="/theme/images/icons/page_delete.png" alt="Delete" /></a></td>
		<td class="table-img"><a href="<!--LINK.URL-->"><img src="/theme/images/icons/page_go.png" alt="View" /></a></td>
	</tr>
	<!--END LINK-->
</table>

<div class="manage-pagination"><!--PAGINATION--></div>
<!--END AVAIL-->
<!--BEGIN NOTAVAIL-->
<div class="manage-pagination">There are no links.</div>
<!--END NOTAVAIL-->
