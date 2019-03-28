var lat = document.getElementsByName('lat')[0].value;
var lon = document.getElementsByName('lon')[0].value;
var ll=[lat,lon]
initMapPoi(ll)



function initMapPoi(ll){
  map = new L.Map('mapPoi').setView(ll,13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
  L.marker(ll).addTo(map)
}
