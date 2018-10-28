$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	$('#tblViviendas').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});

	$("div.toolbar").html('<button data-target="#addEmployeeModal" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></button> ');

});
