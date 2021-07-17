Inputmask.extendAliases({
  pesos: {
            prefix: "₱ ",
            groupSeparator: ".",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 2,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1
        }
});

$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	$('#tblCuentas').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});

	var btnAdd = '<button data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></button> ';
	var btnSearch = '<button data-target="#searchCuentaModal" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="search"></ion-icon></button> ';
	$("div.toolbar").html(btnAdd+btnSearch);

	//Money Euro
    $("#saldo").inputmask({ alias : "pesos", prefix: '$' ,removeMaskOnSubmit: true});

});
