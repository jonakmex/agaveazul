$('.fechas').datepicker({
  autoclose: true,
  format: "yyyy-mm-dd"
});

$(".timepicker").timepicker({
  showInputs: false
});

$('.fechas').each(function(element){
  var date = new Date();
  var current = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  if($( this ).attr('value')){
    current = new Date($( this ).attr('value'));
  }
  $( this ).datepicker('setDate', current);
});

$('.timepicker').each(function(element){
  var current = new Date();
  if($( this ).attr('value')){
    current = new Date($( this ).attr('value'));
  }
  $( this ).timepicker('setTime', formatAMPM(current));
});

function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}
