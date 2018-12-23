


$(document).ready(function(){
  // Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;
			});
		} else{
			checkbox.each(function(){
				this.checked = false;
			});
		}
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});


 var errors = $('#errors').data('errors');
 
 if(errors != ""){
	  $("#errorModal .modal-body").text(errors);
	 	$('#errorModal').modal('show');
 }



});
