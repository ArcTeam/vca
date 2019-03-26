// $(document).ready(function() {
//   id = $("body").data('poi');
//   oop={file:'record.class.php',classe:'Record',func:'poiInfo'}
//   dati={"id":id};
//   $.ajax({
//     type: "POST",
//     url: "class/connector.php",
//     data: {oop:oop, dati:dati},
//     dataType: 'json'})
//   .done (function(data){
//     info = data.info[0];
//     biblio = data.biblio
//     relByTag = data.relPoiTag
//     relByCoo = data.relPoiCoo
//     $(".namePoi").text(info.name);
//     position = [info.state,info.land,info.municipality];
//     $(".position").text(position.join(', '));
//     $(".address").text(info.address);
//     $(".gps").text(info.lat+","+info.lon+" (EPSG:4326)");
//     $(".category").text(info.type);
//     chronology = "from "+info.cronostart;
//     chronology += info.cronoend ? " to " + info.cronoend : "";
//     $(".chronology").text(chronology);
//     $(".period").text(info.period);
//     $(".info").html(info.info.replace('\n','<br>','g'));
//     $(".compiler").text(info.first_name+" "+info.last_name+" ("+info.data+")")
//     $.each($.parseJSON(info.tag), function(i,tag){
//       $("<a/>",{href:'#'+tag, title:'search POI with tag '+tag, class:'btn btn-outline-secondary btn-sm py-1 px-2 mr-1 mb-1 d-inline-block', text:tag}).css("font-size","80%").appendTo('.poiTag');
//     })
//     $.each(biblio,function(i,v){
//       item = "<div class='d-inline-block align-top' style='width:30px;'>"
//       item += "<a href='#"+v[0].id+"' class='text-info pr-1' title='view full record'>"
//       item += "<i class='fas fa-link fa-fw'></i>"
//       item += "</a>"
//       item += "</div>"
//       item += "<div class='d-inline-block' style='width:calc(100% - 30px);'>"
//       item += "<strong>"+v[0].title+"</strong>"
//       item += ", "+v[0].author
//       item += ", "+v[0].year
//       item += ", "+v[0].type
//       item += "</div>"
//       $("<li/>",{class:'list-group-item'}).html(item).appendTo('.listBiblio');
//     })
//     $.each(relByTag,function(i,v){
//       $("<a/>",{href:'poi.php?poi='+v.id, title:'link to POI page',class:'btn btn-outline-secondary btn-sm py-1 px-2 mr-1 mb-1 d-inline-block', text:v.name}).css("font-size","80%").appendTo('.relRecByTag');
//     })
//     $.each(relByCoo,function(i,v){
//       $("<a/>",{href:'poi.php?poi='+v.id, title:'link to POI page',class:'btn btn-outline-secondary btn-sm py-1 px-2 mr-1 mb-1 d-inline-block', text:v.name}).css("font-size","80%").appendTo('.relRecByLatLon');
//     })
//     ll=[info.lat,info.lon]
//     initMapPoi(ll)
//   })
//   .fail(function() { console.log("error"); })
//
// });
// function initMapPoi(ll){
//   map = new L.Map('mapPoi').setView(ll,13);
//   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
//   L.marker(ll).addTo(map)
// }
