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
	var btnAdd = '<a href="'+createUrl+'" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></a> ';
	var btnSearch = '<button data-target="#searchCuotaModal" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="search"></ion-icon></button> ';
	$("div.toolbar").html(btnAdd+btnSearch);

});
