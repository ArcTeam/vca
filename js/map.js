var punti;
function initmap() {
  map = new L.Map('map');
  osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
  osm = new L.TileLayer(osmUrl, {minZoom: 5, attribution: osmAttrib}).addTo(map);

  $.getJSON('class/stateJson.php',function (data) {
    // console.log(data);
    punti = L.geoJSON(data, {
      onEachFeature: bindPopUp
    }).addTo(map);
    map.fitBounds(punti.getBounds());
    buildTable(data.features);
  });
  map.on('load', function(){ map.options.minZoom = map.getZoom() - 2; })

  resetMap = L.Control.extend({
    options: { position: 'topleft'},
    onAdd: function (map) {
      var container = L.DomUtil.create('div', 'extentControl leaflet-bar leaflet-control leaflet-touch');
      btn=$("<a/>",{href:'#'}).appendTo(container);
      $("<i/>",{class:'fas fa-home'}).appendTo(btn)
      btn.on('click', function () { map.fitBounds(punti.getBounds()); });
      return container;
    }
  })
  map.addControl(new resetMap());
  L.control.scale({imperial:false}).addTo(map);
}

function bindPopUp (feature, layer) {
  prop = feature.properties;
  localization = [prop.state,prop.land,prop.municipality];
  popup="<h6 class='border-bottom'>"+prop.name+"</h6>"+
    "<ul>"+
    "<li><span>localization: </span><span>"+localization.join(', ')+"</span></li>"+
    "<li><span>coordinates: </span><span>"+prop.lat+","+prop.lon+"</span></li>"+
    "<li><span>type: </span><span>"+prop.type+"</span></li>"+
    "<li><span>start: </span><span>"+prop.cronostart+"</span></li>";
    if (prop.cronoend) {
      popup += "<li><span>end: </span><span>"+prop.cronoend+"</span></li>";
    }
    popup += "<li class='text-right'><a href='poi.php?poi="+prop.id+"' title='view complete poi info' class='text-success'>...more info</a></li>";
    popup += "</ul>";

  layer.bindPopup(popup);
}
function buildTable(dati){
  table = $("#recordTable>tbody");
  dati.forEach(function(val,idx){
    prop = val.properties;
    map = $("<button/>",{type:'button',class:'btn btn-sm btn-light border-0 bg-white text-primary'}).html('<i class="fas fa-map-marker-alt"></i>');
    link = $("<a/>",{href:'poi.php?poi='+prop.id,class:'btn btn-sm btn-light border-0 bg-white text-success'}).html('<i class="fas fa-link"></i>');
    tr=$("<tr/>").appendTo(table);
    $("<td/>",{text:prop.state}).appendTo(tr);
    $("<td/>",{text:prop.land}).appendTo(tr);
    $("<td/>",{text:prop.municipality}).appendTo(tr);
    $("<td/>",{text:prop.name}).appendTo(tr);
    $("<td/>",{text:prop.type}).appendTo(tr);
    $("<td/>",{text:prop.cronostart}).appendTo(tr);
    $("<td/>",{text:prop.cronoend}).appendTo(tr);
    $("<td/>").append(map).appendTo(tr);
    $("<td/>").append(link).appendTo(tr);
  })
  $('#recordTable').removeAttr('width').DataTable( {
    responsive: true,
    fixedHeader: true,
    scrollY:        "600px",
    scrollX:        false,
    scrollCollapse: true,
    paging:         false,
    columnDefs: [
      { width: 200, targets: 0 }
    ],
    fixedColumns: true
  } );
}
