//Date Picker liste management
$( function() {
  $( "#EndDate" ).datepicker();
  $( "#EndDate" ).datepicker("option", "dateFormat", "yy-mm-dd");
  $( "#EndDate" ).datepicker("setDate",$(this).val());
} );


$(document).ready(function(){
    $('#mylists').DataTable();
});

$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").alert('close');
});
