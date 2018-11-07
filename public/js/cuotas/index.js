$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	$('#tblCuotas').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});

	$("div.toolbar").html('<a href="'+createUrl+'" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></a> ');

});
