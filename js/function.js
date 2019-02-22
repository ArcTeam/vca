// ajax request constant
const connector = 'class/connector.php'
const type = 'POST'
const dataType = 'json'
$(document).ready(function(){
  navFooter()
  $('body').on('click','.openMenu',function(e){e.preventDefault(); e.stopPropagation(); $('.userNavWrap').toggleClass('closed opened') })
  $(".userNavWrap").on("click", function (event) { event.stopPropagation(); })
  $('.tip').tooltip({boundary:'window', container:'body', placement:function(tip,element){return $(element).data('placement');}, html:true, trigger:'hover' })
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
function initTable (disorder) {
  var cols = !disorder ? [] : disorder
  var t = $('.table').DataTable({
    responsive: true,
    fixedHeader: true,
    'lengthMenu': [[15, 30, 50, -1], [15, 30, 50, 'All']],
    'columnDefs': [{ 'orderable': false, 'targets': cols }]
  })
}
function countdown(sec,page){
  document.getElementById("countdowntimer").textContent = sec;
  var downloadTimer = setInterval(function(){
    sec--;
    document.getElementById("countdowntimer").textContent = sec;
    if(sec <= 0){ window.location.href=page; }
    // clearInterval(downloadTimer);
  },1000);
}
function areaList(){
  oop={file:'global.class.php',classe:'Generic',func:'areaList'}
  $.ajax({ url: connector, type: type, dataType: dataType, data: {oop: oop} })
    .done(function(data) {
      data.state.forEach( function(v,i){ $("<option/>",{value:v.state,text:v.name}).appendTo('[name=state]'); })
      data.land.forEach( function(v,i){ $("<option/>",{value:v.land,text:v.name}).appendTo('[name=land]'); })
      data.municipality.forEach( function(v,i){ $("<option/>",{value:v.municipality,text:v.name}).appendTo('[name=municipality]'); })
    }).fail(function() { console.log("error"); });
}
function landList(state){
  oop={file:'global.class.php',classe:'Generic',func:'landList'}
  dati={state:state}
  $('[name=land]').html('<option value="" disabled selected>--district--</option>');
  $.ajax({ url: connector, type: type, dataType: dataType, data: {oop:oop,dati:dati} })
    .done(function(data) {
      data.forEach(function(v,i){$("<option/>",{value:v.land,text:v.name}).appendTo('[name=land]');})
    }).fail(function() { console.log("error"); });
}
function municipalityList(state,land){
  oop={file:'global.class.php',classe:'Generic',func:'municipalityList'}
  dati={state:state,land:land}
  $('[name=municipality]').html('<option value="" disabled selected>--municipality--</option>');
  $.ajax({ url: connector, type: type, dataType: dataType, data: {oop:oop,dati:dati} })
    .done(function(data) {
      data.forEach(function(v,i){$("<option/>",{value:v.municipality,text:v.name}).appendTo('[name=municipality]');})
    }).fail(function() { console.log("error"); });
}
function typeList(){
  oop={file:'global.class.php',classe:'Generic',func:'typeList'}
  $.ajax({ url: connector, type: type, dataType: dataType, data: {oop: oop} })
    .done(function(data) {
      data.forEach( function(v,i){ $("<option/>",{value:v.id,text:v.type}).appendTo('[name=type]'); })
    }).fail(function() { console.log("error"); });
}
function cronoList(){
  oop={file:'global.class.php',classe:'Generic',func:'cronoList'}
  $.ajax({ url: connector, type: type, dataType: dataType, data: {oop: oop} })
    .done(function(data) {
      data.forEach( function(v,i){ $("<option/>",{value:v.id,text:v.definition}).appendTo('[name=cronostart]'); })
    }).fail(function() { console.log("error"); });
}
