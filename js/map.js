var punti;
if (localStorage.length == 0) {$(".filterRow").remove()}
else {
  Object.keys(localStorage).forEach(function(key){
      fidx=key.match("^filter");
      if(fidx){
        $("<button/>",{class:'btn btn-info btn-sm mr-1', name:'removeFilter',value:key,text:localStorage[key]+" x", title:'remove filter'})
        .appendTo('.filterWrap')
        .on('click', function(){
          storage = $(this).val();
          switch (storage) {
            case 'filterChronology': localStorage.removeItem('cronostart'); break;
            case 'filterKeywords': localStorage.removeItem('keywords'); break;
            case 'filterState': localStorage.removeItem('state'); break;
            case 'filterLand': localStorage.removeItem('land'); break;
            case 'filterMunicipality': localStorage.removeItem('municipality'); break;
            case 'filterType': localStorage.removeItem('type'); break;
            default:

          }
          localStorage.removeItem(storage);
          $(this).remove();
        });
      }
  });
}
function initmap() {
  filterBtn={}
  Object.keys(localStorage).forEach(function(key){
    reqIdx=!key.match("^filter");
    if (reqIdx) {
      filterBtn[key]=localStorage[key]
    }
  });
  console.log(filterBtn);
  map = new L.Map('map');
  osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
  osm = new L.TileLayer(osmUrl, {minZoom: 5, attribution: osmAttrib}).addTo(map);
  cluster = L.markerClusterGroup({maxClusterRadius:50});
  $.getJSON('class/poi.php',filterBtn,function (data) {
    console.log(data);
    // punti = L.geoJSON(data);
    // cluster.addLayer(punti);
    // map.addLayer(cluster);
    // map.fitBounds(cluster.getBounds());
    // punti.on('click',bindPopUp)
    // buildTable(data.features);
  });
  map.on('load', function(){ map.options.minZoom = map.getZoom() - 2; })
  resetMap = L.Control.extend({
    options: { position: 'topleft'},
    onAdd: function (map) {
      var container = L.DomUtil.create('div', 'extentControl leaflet-bar leaflet-control leaflet-touch');
      btn=$("<a/>",{href:'#'}).appendTo(container);
      $("<i/>",{class:'fas fa-home'}).appendTo(btn)
      btn.on('click', function () {map.fitBounds(punti.getBounds());});
      return container;
    }
  })

  map.addControl(new resetMap());
  L.control.scale({imperial:false}).addTo(map);

  prevView='';
  $('body').on('click', '.flyTo', function() {
    $("#map>.wrapInfo>.card").fadeOut(500)
    raw = $(this).data('latlon');
    ll = raw.split(',');
    map.flyTo([ll[0],ll[1]],18)
    if (prevView==raw) {$("#map>.wrapInfo>.alert").fadeIn(500)}else {$("#map>.wrapInfo>.alert").fadeOut(500)}
    prevView = raw;
  });
  $(".alertCloseBtn").on('click', function(){$("#map>.wrapInfo>.alert").fadeOut(500)})
  $(".cardCloseBtn").on('click', function(){$("#map>.wrapInfo>.card").fadeOut(500)})
}

function bindPopUp (e) {
  prop = e.sourceTarget.feature.properties;
  localization = [prop.state,prop.land,prop.municipality];
  popup="<h5 class='card-title border-bottom'>"+prop.name+"</h5>"+
    "<ul class='card-text'>"+
    "<li><span>localization: </span><span>"+localization.join(', ')+"</span></li>"+
    "<li><span>coordinates: </span><span>"+prop.lat+","+prop.lon+"</span></li>"+
    "<li><span>type: </span><span>"+prop.type+"</span></li>"+
    "<li><span>start: </span><span>"+prop.cronostart+"</span></li>";
  if (prop.cronoend) {
    popup += "<li><span>end: </span><span>"+prop.cronoend+"</span></li>";
  }
  popup += "</ul>";
  popup += "<a href='poi.php?poi="+prop.id+"' title='view complete poi info' class='text-success card-link'>...more info</a>";
  $("#map > .wrapInfo >.card >.card-body").html(popup)
  $("#map > .wrapInfo >.card").fadeIn(500);
  // layer.bindPopup(popup);
}
function buildTable(dati){
  table = $("#recordTable>tbody");
  dati.forEach(function(val,idx){
    prop = val.properties;
    mapBtn = $("<button/>",{
      type:'button',
      class:'btn btn-sm btn-light border-0 bg-white text-primary flyTo'
    })
    .attr("data-latlon",prop.lat+","+prop.lon)
    .html('<i class="fas fa-map-marker-alt"></i>');
    link = $("<a/>",{href:'poi.php?poi='+prop.id,class:'btn btn-sm btn-light border-0 bg-white text-success'}).html('<i class="fas fa-link"></i>');
    tr=$("<tr/>").appendTo(table);
    $("<td/>",{text:prop.state}).appendTo(tr);
    $("<td/>",{text:prop.land}).appendTo(tr);
    $("<td/>",{text:prop.municipality}).appendTo(tr);
    $("<td/>",{text:prop.name}).appendTo(tr);
    $("<td/>",{text:prop.type}).appendTo(tr);
    $("<td/>",{text:prop.cronostart}).appendTo(tr);
    $("<td/>",{text:prop.cronoend}).appendTo(tr);
    $("<td/>").append(mapBtn).appendTo(tr);
    $("<td/>").append(link).appendTo(tr);
  })
  initTable('#recordTable')
}
window.addEventListener("orientationchange", function() {
  window.setTimeout(function() {
    $('#recordTable').DataTable().destroy();
    initTable('#recordTable')
  }, 200);
}, false);
