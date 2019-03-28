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
$('[name=submit]').on('click', function(event) {
  event.preventDefault();
  localStorage.clear()
  $(".filterWrap>div").html('')

  state=$('[name=state]').val();
  land=$('[name=land]').val();
  municipality=$('[name=municipality]').val();
  tipo=$('[name=type]').val();
  cronostart=$('[name=cronostart]').val();
  keywords=$('[name=keywords]').val();
  if (!state && !land && !municipality && !tipo && !cronostart && !keywords) {
    $('.filterMsg').fadeIn('fast');
  }else {
    $('.filterMsg').fadeOut('fast');
    localStorage.clear();
    if (state) {
      localStorage.setItem('state.id', state);
      localStorage.setItem('filterState', $('[name=state] :selected').text());
    }
    if (land) {
      localStorage.setItem('land.id', land);
      localStorage.setItem('filterLand', $('[name=land] :selected').text());
    }
    if (municipality) {
      localStorage.setItem('municipality.id', municipality);
      localStorage.setItem('filterMunicipality', $('[name=municipality] :selected').text());
    }
    if (tipo) {
      localStorage.setItem('type.id', tipo);
      localStorage.setItem('filterType', $('[name=type] :selected').text());
    }
    if (cronostart) {
      localStorage.setItem('cronostart.cronostart', cronostart);
      localStorage.setItem('filterChronology', $('[name=cronostart] :selected').text());
    }
    if (keywords) {
      localStorage.setItem('keywords', keywords);
      localStorage.setItem('filterKeywords', keywords);
    }
    checkStorage()
    map.off();
    map.remove();
    initmap()
    $('#recordTable').DataTable().clear().destroy();
    $("[name=filterForm]").reset();
  }
});
function checkStorage(){
  if (localStorage.length == 0) {
    $(".filterWrap").hide()
  } else {
    $(".filterWrap").fadeIn(500)
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
