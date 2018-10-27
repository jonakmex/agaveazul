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

	$('#tblHeader').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbar">frtip'
	});


	$("div.toolbar").html('<a href="'+exportUrl+'" class="edit"><ion-icon name="download" title="Exportar"></i></a>');

  var date = new Date();
	var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  $('.fechas').datepicker({
    autoclose: true,
    format: "yyyy-mm-dd"
  });
	$('.fechas').datepicker('setDate', today);
  //Money Euro
  $(".currency").inputmask({ alias : "pesos", prefix: '$' ,removeMaskOnSubmit: true});

	//Timepicker
  $(".timepicker").timepicker({
    showInputs: false
  });

});
