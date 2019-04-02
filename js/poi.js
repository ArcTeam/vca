var lat = document.getElementsByName('lat')[0].value;
var lon = document.getElementsByName('lon')[0].value;
var ll=[lat,lon]
initMapPoi(ll)

$("[name=btnApprove]").on('click',function(){
  if (confirm('You are approving a record!\nIf confirm, this record will be visible in the catalogue.')) {
    console.log('approvata');
  }else {
    console.log('non approvata');
  }
})
$("[name=btnDelete]").on('click',function(){
  if (confirm('You are deleting a record!\nIf you confirm, the record will be permanently deleted and the data will no longer be available.')) {
    console.log('eliminato');
  }else {
    console.log('non eliminato');
  }
})
