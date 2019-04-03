var recordId = document.getElementsByName('recordId')[0].value;
var lat = document.getElementsByName('lat')[0].value;
var lon = document.getElementsByName('lon')[0].value;
var ll=[lat,lon]
initMapPoi(ll)
const closerecordmsg = 'You are changing the record status!\nIf you confirm, the record will be ready to validation.';

$("[name=btnCloseRecord]").on('click',function(){
  if (confirm(closerecordmsg)) {
    closeRecordFunc(recordId)
  }else {
    console.log('azione annullata');
  }
})
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

function closeRecordFunc(recordId){
  dati['oop']={file:'record.class.php',classe:'Record',func:'closeRecord'}
  dati['dati']={record:recordId}
  $.ajax({ url: connector, type: type, dataType: dataType, data: dati})
  .done(function(data) {
    if (data && data=='ok') {
      alert("Success! Record is ready to validation");
      location.reload();
    }else {
      alert("Error! Something gone wrong!");
    }
  })
  .fail(function(response) { alert("error: "+response) });

}
