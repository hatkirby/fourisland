<h2>Manage Pending</h2>

<div class="clear"></div>

<script type="text/javascript">
function deletePost(id)
{
	if (confirm("Are you sure you would like to delete this pending post?"))
	{
		postwith("/admin/pending.php?pageID=<!--PAGEID-->&action=delete",{id:id});
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
			if (confirm("Are you sure you would like to delete the selected posts?"))
			{
				postwith("/admin/pending.php?pageID=<!--PAGEID-->&action=deletes",{ids:ids});
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
		<td>Author</td>
		<td colspan="5">Actions</td>
	</tr>
	<!--BEGIN POST-->
	<tr<!--POST.ODD-->>
		<td class="table-checkbox"><input class="the-check" type="checkbox" name="bulk" value="<!--POST.ID-->" /></td>
		<td><!--POST.TITLE--></td>
		<td class="table-author"><!--POST.AUTHOR--></td>
		<!--BEGIN POST.CANMOVEUP-->
		<td class="table-img"><a href="/admin/pending.php?pageID=<!--PAGEID-->&amp;action=moveup&amp;id=<!--POST.ID-->"><img src="/theme/images/icons/thumb_up.png" alt="Move Up" /></a></td>
		<!--END POST.CANMOVEUP-->
		<!--BEGIN POST.NOMOVEUP-->
		<td class="table-img"><img src="/theme/images/icons/thumb_up.png" alt="Move Up" style="opacity: 0.2" /></td>
		<!--END POST.NOMOVEUP-->
		<!--BEGIN POST.CANMOVEDOWN-->
		<td class="table-img"><a href="/admin/pending.php?pageID=<!--PAGEID-->&amp;action=movedown&amp;id=<!--POST.ID-->"><img src="/theme/images/icons/thumb_down.png" alt="Move Down" /></a></td>
		<!--END POST.CANMOVEDOWN-->
		<!--BEGIN POST.NOMOVEDOWN-->
		<td class="table-img"><img src="/theme/images/icons/thumb_down.png" alt="Move Down" style="opacity: 0.2" /></td>
		<!--END POST.NOMOVEDOWN-->
		<td class="table-img"><a href="/admin/editPost.php?type=pending&amp;id=<!--POST.ID-->"><img src="/theme/images/icons/page_edit.png" alt="Edit" /></a></td>
		<td class="table-img"><a href="#" onclick="deletePost(<!--POST.ID-->);"><img src="/theme/images/icons/page_delete.png" alt="Delete" /></a></td>
		<td class="table-img"><a href="/viewPost.php?type=pending&amp;id=<!--POST.ID-->"><img src="/theme/images/icons/page_go.png" alt="View" /></a></td>
	</tr>
	<!--END POST-->
</table>

<div class="manage-pagination"><!--PAGINATION--></div>
<!--END AVAIL-->
<!--BEGIN NOTAVAIL-->
<div class="manage-pagination">There are no pending posts in the queue.</div>
<!--END NOTAVAIL-->
