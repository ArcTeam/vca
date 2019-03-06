initmap()
areaList()
typeList()
cronoList()
var punti;
$('[name=state]').on('click', function() {
  landList($(this).val());
  municipalityList($(this).val(),null);
  storage={"filterState":}

});
$('[name=land]').on('click', function() { municipalityList(null,$(this).val()); });
if (localStorage.length == 0) {
  $(".filterRow").hide()
}else {
  Object.keys(localStorage).forEach(function(key){
      fidx=key.match("^filter");
      if(fidx){
        $("<button/>",{class:'btn btn-info btn-sm mr-1', name:'removeFilter',value:key,text:localStorage[key]+" x", title:'remove filter'})
        .appendTo('.filterWrap')
        .on('click', function(){
          storage = $(this).val();
          removeFilter(storage)
          $(this).remove();
        });
      }
  });
}

window.addEventListener("orientationchange", function() {
  window.setTimeout(function() {
    $('#recordTable').DataTable().destroy();
    initTable('#recordTable')
  }, 200);
}, false);
