<?php

#This document contains all the Javascript needed to run our web-app

?>

<!-- jQuery -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<!-- jQuery UI -->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<!-- TinyMCE -->
<script src="js/tinymce/tinymce.min.js"></script>

<!-- Dropzone -->
<script src="js/dropzone.js"></script>


<script>

	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})


	$(document).ready(function() {
		
		$("#console-debug").hide();	/* hides debug window by default */
		$("#btn-debug").click(function() {
			$("#console-debug").toggle(); /* shows debug window when console button clicked */
		});
		
		
		$(".btn-delete").on("click", function(){ /* when delete post button is clicked, */
			var selected = $(this).attr("id");	
			var pageid = selected.split("del_").join("");
			var confirmed = confirm("Are you sure you want to delete this page?");
			if(confirmed == true){
				$.get("ajax/pages.php?id="+pageid);
				$("#page_"+pageid).remove();	/* deletes the specified post from the Pages view */
			}
		})
		
		
		$("#sort-nav").sortable({	/* for drag-and-drop sorting of nav bar */
			cursor: "move",	//IMPERFECT: doesn't display correctly, to be fixed
			update: function() {
				var order = $(this).sortable("serialize");
				$.get("ajax/list-sort.php", order);
			}
		});
		
		
		$('.nav-form').submit(function(event){	/* for auto-loading new label of pages on nav bar */
			var navData = $(this).serializeArray();
			var navLabel = $('input[name=label]').val();
			var navID = $('input[name=id]').val();
			$.ajax({
				url: "ajax/navigation.php",
				type: "POST",
				data: navData
			}).done(function(){
				$("#label_"+navID).html(navLabel);
			});
			event.preventDefault(); /* prevents the label from performing the default behavior */
			
		});
		
	});	//END document.ready();
	
	//following chunk is for the TinyMCE widget, which applies to all divs with class "editor"
	tinymce.init({
		selector: ".editor",
		theme: "modern",
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor"
		]
	});
	
</script>

