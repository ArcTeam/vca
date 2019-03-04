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
    info = data.info[0];
    $(".namePoi").text(info.name);
    position = [info.state,info.land,info.municipality];
    $(".position").text(position.join(', '));
    $(".address").text(info.address);
    $(".gps").text(info.lat+","+info.lon+" (EPSG:4326)");
    $(".category").text(info.type);
    chronology = "from "+info.cronostart;
    chronology += info.cronoend ? " to " + info.cronoend : "";
    $(".chronology").text(chronology);
    $(".period").text(info.period);
    $(".info").html(info.info.replace('\n','<br>','g'));
    $(".compiler").text(info.first_name+" "+info.last_name+" ("+info.data+")")
    $.each($.parseJSON(info.tag), function(i,tag){
      $("<small/>",{class:'bg-primary text-white py-1 px-2 mr-1 rounded'}).text(tag).appendTo('.poiTag')
    })
    console.log(data);
  })
  .fail(function() {
    console.log("error");
  })
});
