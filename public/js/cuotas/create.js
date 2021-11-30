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

	$('#tblCuotas').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});
	//var routeUrl = "{!! route('cuotas.create') !!}";
	//console.log(routeUrl);
	$("div.toolbar").html('<a href="#" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></a> ');

	$('#fecPago').datepicker({
		autoclose: true,
		dateFormat: "yy-mm-dd"
	});



	$('#chkRpt').click(function(){
    console.log('Ok');
		if(!this.checked){
			$("#dvRpt").hide();
			$("#dvNPeriodos").hide();
		}
		else{
			$("#dvRpt").show();
			$("#dvNPeriodos").show();
		}
	});

	//Money Euro
	$("#importe").inputmask({ alias : "pesos", prefix: '$' });
	$("#multaImporte").inputmask({ alias : "pesos", prefix: '$' });
	$("#nPeriodos").inputmask({ alias : "integer" });
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
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
});
