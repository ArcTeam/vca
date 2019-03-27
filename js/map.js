areaList()
typeList()
cronoList()
checkStorage()
$('[name=state]').on('click', function() {
  landList($(this).val());
  municipalityList($(this).val(),null);
});
$('[name=land]').on('click', function() { municipalityList(null,$(this).val()); });
$(".filterMsg").hide()

function checkStorage(){
  if (localStorage.length == 0) {
    $(".filterWrap").hide()
  } else {
    Object.keys(localStorage).forEach(function(key){
      fidx=key.match("^filter");
      if(fidx){
        $("<button/>",{class:'btn btn-info btn-sm mr-1', name:'removeFilter',value:key,text:localStorage[key]+" x", title:'remove filter'})
        .appendTo('.filterWrap>div')
        .on('click', function(){
          storage = $(this).val();
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
          $(this).remove();
          map.off();
          map.remove();
          initmap()
          $('#recordTable').DataTable().clear().destroy();
          if (localStorage.length == 0) {$(".filterRow").hide()}
        });
      }
    });
  }
}

initmap()
window.addEventListener("orientationchange", function() {
  window.setTimeout(function() {
    $('#recordTable').DataTable().destroy();
    initTable('#recordTable')
  }, 200);
}, false);
