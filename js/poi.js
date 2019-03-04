$(document).ready(function() {
  id = $("body").data('poi');
  oop={file:'record.class.php',classe:'Record',func:'poiInfo'}
  dati={"id":id};
  $.ajax({
    type: "POST",
    url: "class/connector.php",
    data: {oop:oop, dati:dati},
    dataType: 'json'})
  .done (function(data){
    console.log(data);
  })
  .fail(function() {
    console.log("error");
  })
});
