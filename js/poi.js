var recordId = document.getElementsByName('recordId')[0].value;
var lat = document.getElementsByName('lat')[0].value;
var lon = document.getElementsByName('lon')[0].value;
var ll=[lat,lon]
initMapPoi(ll)
const closerecordmsg = 'You are changing the record status!\nIf you confirm, the record will be ready to validation.';
const unlockmsg = 'The record is ready to validation, this means that compiler cannot update the record.\nIf you confirm, the record back in draft status'


// draft2ready
$("[name=btnCloseRecord]").on('click',function(){
  if (confirm(closerecordmsg)) {
    closeRecordFunc(recordId)
  }
})

// ready2draft
$("[name=btnUnlock]").on('click',function(){
  if (confirm(unlockmsg)) {
    unlockFunc(recordId)
  }
})

// validate
$("[name=btnApprove]").on('click',function(){
  if (confirm('You are approving a record!\nIf you confirm, this record will be visible in the catalogue.')) {
    approveFunc(recordId)
  }
})

// delete record
$("[name=btnDelete]").on('click',function(){
  if (confirm('You are deleting a record!\nIf you confirm, the record will be permanently deleted and the data will no longer be available.')) {
    deleteRecord(recordId)
  }
})

function closeRecordFunc(recordId){
  dati['oop']={file:'record.class.php',classe:'Record',func:'closeRecord'}
  dati['dati']={record:recordId}
  $.ajax({ url: connector, type: type, dataType: dataType, data: dati})
  .done(function(data) {
    if (data && data=='ok') {
      alert("Success! Record ready to validation");
      window.location.href='dashboard.php';
    }else {
      alert("Error! Something gone wrong!");
    }
  })
  .fail(function(response) { alert("error: "+response) });
}

function unlockFunc(recordId){
  dati['oop']={file:'record.class.php',classe:'Record',func:'unlockRecord'}
  dati['dati']={record:recordId}
  $.ajax({ url: connector, type: type, dataType: dataType, data: dati})
  .done(function(data) {
    if (data && data=='ok') {
      alert("Success! Record unlocked");
      window.location.href='dashboard.php';
    }else {
      alert("Error! Something gone wrong!");
    }
  })
  .fail(function(response) { alert("error: "+response) });
}
function approveFunc(recordId){
  dati['oop']={file:'record.class.php',classe:'Record',func:'approveRecord'}
  dati['dati']={record:recordId}
  $.ajax({ url: connector, type: type, dataType: dataType, data: dati})
  .done(function(data) {
    if (data && data=='ok') {
      alert("Success! Record approved");
      window.location.href='dashboard.php';
    }else {
      alert("Error! Something gone wrong!");
    }
  })
  .fail(function(response) { alert("error: "+response) });
}

function deleteRecord(recordId){
  dati['oop']={file:'record.class.php',classe:'Record',func:'deleteRecord'}
  dati['dati']={record:recordId}
  $.ajax({ url: connector, type: type, dataType: dataType, data: dati})
  .done(function(data) {
    if (data && data=='ok') {
      alert("Success! Record permanently deleted");
      window.location.href='dashboard.php';
    }else {
      alert("Error! Something gone wrong!");
    }
  })
  .fail(function(response) { alert("error: "+response) });
}
