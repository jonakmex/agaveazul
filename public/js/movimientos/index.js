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


  $('#tblMovimientos').DataTable( {
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"dom": '<"toolbarx">frtip'
  });
  
  var btnChildSearch = '<button data-target="#searchMovModal" data-toggle="modal" class="btn btn-sm btn-success"><ion-icon name="search"></ion-icon></button> ';
  
  $("div.toolbarx").html(btnChildSearch);



    //movimientos
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#fecTransfer').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $('#fecIngreso').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $('#fecEgreso').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $('#fecIngreso').datepicker('setDate', today);
    $('#fecEgreso').datepicker('setDate', today);
    $('#fecTransfer').datepicker('setDate', today);

    $('#fecInicio').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $('#fecFin').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });

    
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });

});
