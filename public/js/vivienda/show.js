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

	$('#tblContactos').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});
	$("#tblContactos_wrapper div.toolbar").html('<button data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></button> ');

  $('#tblRecibos').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});
	$("#tblRecibos_wrapper div.toolbar").html('<button data-target="#addModalRecibo" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></button> ');


	var date = new Date();
  		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
      $('.fechas').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
      });
  		$('.fechas').datepicker('setDate', today);
      //Money Euro
      $(".currency").inputmask({ alias : "pesos", prefix: '$' ,removeMaskOnSubmit: true});
  		//$("#ajuste").inputmask({ alias : "pesos", prefix: '$' ,removeMaskOnSubmit: true});
  		//Timepicker
      $(".timepicker").timepicker({
        showInputs: false
      });

    console.log('XXX');
});
