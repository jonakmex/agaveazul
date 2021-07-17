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
	
	var btnSearch = '<button data-target="#viviendaSearch" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="search"></ion-icon></button> ';
	$("div.toolbar").html(btnSearch);

});
