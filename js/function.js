// ajax request constant
const connector = 'class/connector.php'
const type = 'POST'
const dataType = 'json'
var datatable;
dati={};
$(document).ready(function(){
  navFooter()
  $('body').on('click','.openMenu',function(e){e.preventDefault(); e.stopPropagation(); $('.userNavWrap').toggleClass('closed opened') })
  $(".userNavWrap").on("click", function (event) { event.stopPropagation(); })
  $('.tip').tooltip({boundary:'window', container:'body', placement:function(tip,element){return $(element).data('placement');}, html:true, trigger:'hover' })
  $(".catalogueLink").on('click', function(){localStorage.clear()})
})
$(document).on("click", function () { if ($('.userNavWrap').hasClass('opened')) {  $('.userNavWrap').toggleClass('closed opened'); } })
function navFooter () {
  $('.mainNav>ul').clone().appendTo($('.navFooter'))
  $('.navFooter>ul').removeClass().find('li').removeClass().find('a').removeClass('nav-link')
  $('.navFooter>ul>li>a').removeClass('openMenu')
  $('.navFooter>ul>li>a>i').remove()
}
function removeLib () {
  const elements = document.getElementsByClassName('listeLib')
  while (elements.length > 0) elements[0].remove()
}

function countdown(sec,page){
  document.getElementById("countdowntimer").textContent = sec;
  var downloadTimer = setInterval(function(){
    sec--;
    document.getElementById("countdowntimer").textContent = sec;
    if(sec <= 0){ window.location.href=page; }
    clearInterval(downloadTimer);
  },1000);
}
function areaList(){
  dati['oop']={file:'global.class.php',classe:'Generic',func:'areaList'}
  getdata(dati,function(data){
    data.state.forEach( function(v,i){ $("<option/>",{value:v.state,text:v.name}).appendTo('[name=state]'); })
    data.land.forEach( function(v,i){ $("<option/>",{value:v.land,text:v.name}).appendTo('[name=land]'); })
    data.municipality.forEach( function(v,i){ $("<option/>",{value:v.municipality,text:v.name}).appendTo('[name=municipality]'); })
  })
}
function landList(state){
  dati['oop']={file:'global.class.php',classe:'Generic',func:'landList'}
  dati['dati']={state:state}
  $('[name=land]').html('<option value="" disabled selected>--district--</option>');
  getdata(dati,function(data){
    data.forEach(function(v,i){$("<option/>",{value:v.land,text:v.name}).appendTo('[name=land]');})
  })
}
function municipalityList(state,land){
  dati['oop']={file:'global.class.php',classe:'Generic',func:'municipalityList'}
  dati['dati']={state:state,land:land}
  $('[name=municipality]').html('<option value="" disabled selected>--municipality--</option>');
  getdata(dati,function(data){
    data.forEach(function(v,i){$("<option/>",{value:v.municipality,text:v.name}).appendTo('[name=municipality]');})
  })
}
function typeList(){
  dati['oop']={file:'global.class.php',classe:'Generic',func:'typeList'}
  getdata(dati,function(data){
    data.forEach( function(v,i){ $("<option/>",{value:v.id,text:v.type}).appendTo('[name=type]'); })
  })
}
function cronoList(){
  dati['oop']={file:'global.class.php',classe:'Generic',func:'cronoList'}
  getdata(dati,function(data){
    data.forEach( function(v,i){
      $("<option/>",{value:v.id,text:v.definition}).appendTo('[name=cronostart]');
    })
  })
}
function getval(id, callback ) { $.getJSON('json/crono.php',{start:id}).done(function(data) {callback(data);}); }
function crono(list) {
  list.forEach(function(v){
    $("<option/>",{value:v.id,text:v.definition}).appendTo('[name=cronostart]');
  })
}
function cronoend(list) {
  $('[name=cronoend]').html('');
  $("<option/>",{value:'',text:'--select end chronology--'}).appendTo('[name=cronoend]');
  list.forEach(function(v){
    $("<option/>",{value:v.id,text:v.definition}).appendTo('[name=cronoend]');
  })
}
function getdata(dati, callback){
  $.ajax({ url: connector, type: type, dataType: dataType, data: dati })
    .done(callback)
    .fail(function(error) {
      console.log(eval(error));
    });
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
    link = $("<a/>",{href:'poi.php?poi='+prop.id, class:'btn btn-sm btn-light border-0 bg-white text-success'}).html('<i class="fas fa-link"></i>');
    tr=$("<tr/>").appendTo(table);
    $("<td/>",{text:prop.statename}).appendTo(tr);
    $("<td/>",{text:prop.landname}).appendTo(tr);
    $("<td/>",{text:prop.municipalityname}).appendTo(tr);
    $("<td/>",{text:prop.name}).appendTo(tr);
    $("<td/>",{text:prop.typedef}).appendTo(tr);
    $("<td/>",{text:prop.cronostartdef}).appendTo(tr);
    $("<td/>",{text:prop.cronoenddef}).appendTo(tr);
    $("<td/>").append(mapBtn).appendTo(tr);
    $("<td/>").append(link).appendTo(tr);
  })
  initTable('#recordTable')
}
function initTable(el){
  table = $(el).removeAttr('width').DataTable({
    retrieve:true,
    dom: 't<"col-6 d-inline-block"i><"col-6 d-inline-block"f>',
    responsive: true,
    scrollY: "50vh",
    scrollX: false,
    scrollCollapse: true,
    paging: false,
    oLanguage: {
      sInfo: "_MAX_ records",
      sInfoFiltered: " / _TOTAL_ filtered",
      sInfoEmpty: "No record to show",
      sSearch: "_INPUT_",
      sSearchPlaceholder: "Search records..."
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
  map = new L.Map('map');
  osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
  osm = new L.TileLayer(osmUrl, {minZoom: 5, attribution: osmAttrib}).addTo(map);
  cluster = L.markerClusterGroup({maxClusterRadius:50});
  $.getJSON('class/poi.php',filterBtn,function (data) {
    if (!data.features) {
      map.setView(new L.LatLng(46, 13), 4);
      $("#noPoi").css("display","flex")
    }else {
      $("#noPoi").css("display","none")
      punti = L.geoJSON(data);
      cluster.addLayer(punti);
      map.addLayer(cluster);
      map.fitBounds(cluster.getBounds());
      punti.on('click',bindPopUp)
    }
    buildTable(data.features);
  });
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

  map.on('loading', function (event) { $("#loader").show();});
  map.on('load', function (event) {
    map.options.minZoom = map.getZoom() - 2;
    $("#loader").hide();
  });

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
  localization = [prop.statename,prop.landname,prop.municipalityname];
  popup="<h5 class='card-title border-bottom'>"+prop.name+"</h5>"+
    "<ul class='card-text'>"+
    "<li><span>localization: </span><span>"+localization.join(', ')+"</span></li>"+
    "<li><span>coordinates: </span><span>"+prop.lat+","+prop.lon+"</span></li>"+
    "<li><span>type: </span><span>"+prop.typedef+"</span></li>"+
    "<li><span>start: </span><span>"+prop.cronostartdef+"</span></li>";
  if (prop.cronoenddef) {
    popup += "<li><span>end: </span><span>"+prop.cronoenddef+"</span></li>";
  }
  popup += "</ul>";
  popup += "<a href='poi.php?poi="+prop.id+"' title='view complete poi info' class='text-success card-link'>...more info</a>";
  $("#map > .wrapInfo >.card >.card-body").html(popup)
  $("#map > .wrapInfo >.card").fadeIn(500);
}

function initMapPoi(ll){
  map = new L.Map('mapPoi').setView(ll,13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
  L.marker(ll).addTo(map)
}

function setFilter(storage){
  console.log(storage);
  localStorage.clear();
  Object.keys(storage).forEach(function(key){
    localStorage.setItem(key, storage[key]);
  })
}
function removeFilter(storage){
  switch (storage) {
    case 'filterChronology': localStorage.removeItem('cronostart.cronostart'); break;
    case 'filterKeywords': localStorage.removeItem('keywords'); break;
    case 'filterState': localStorage.removeItem('state.id'); break;
    case 'filterLand': localStorage.removeItem('land.id'); break;
    case 'filterMunicipality': localStorage.removeItem('municipality.id'); break;
    case 'filterType': localStorage.removeItem('type.id'); break;
    default:
  }
  localStorage.removeItem(storage);
  map.off();
  map.remove();
  $('#recordTable').DataTable().clear().destroy();
  initmap()
  if (localStorage.length == 0) {$(".filterWrap").hide()}
}
