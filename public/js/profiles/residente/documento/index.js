$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	$('#tblDocumentos').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});

});
