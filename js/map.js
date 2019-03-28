areaList()
typeList()
cronoList()
checkStorage()
initmap()


$('[name=state]').on('click', function() {
  landList($(this).val());
  municipalityList($(this).val(),null);
});
$('[name=land]').on('click', function() { municipalityList(null,$(this).val()); });
$(".filterMsg").hide()
$('[name=submit]').on('click', function(event) {
  event.preventDefault();
  state=$('[name=state]').val();
  land=$('[name=land]').val();
  municipality=$('[name=municipality]').val();
  tipo=$('[name=type]').val();
  cronostart=$('[name=cronostart]').val();
  keywords=$('[name=keywords]').val();
  if (!state && !land && !municipality && !tipo && !cronostart && !keywords) {
    $('.filterMsg').fadeIn('fast');
  }else {
    storage={}
    $('.filterMsg').fadeOut('fast');
    if (state) {
      storage['state.id']=state;
      storage['filterState']=$('[name=state] :selected').text();
    }
    if (land) {
      storage['land.id']=land;
      storage['filterLand']=$('[name=land] :selected').text();
    }
    if (municipality) {
      storage['municipality.id']=municipality;
      storage['filterMunicipality']=$('[name=municipality] :selected').text();
    }
    if (tipo) {
      storage['type.id']=tipo;
      storage['filterType']=$('[name=type] :selected').text();
    }
    if (cronostart) {
      storage['cronostart.cronostart']=cronostart;
      storage['filterChronology']=$('[name=cronostart] :selected').text();
    }
    if (keywords) {
      storage['keywords']=keywords;
      storage['filterKeywords']=keywords;
    }
    setFilter(storage);
    redraw()
    checkStorage()
  }
});
$("[name=reset]").on('click',function(){
  resetForm()
})

function resetForm(){
  localStorage.clear()
  $("#areaForm select").each(function(){this.selectedIndex=0;});
  $("#areaForm input").val('');
  redraw()
  checkStorage()
}

function checkStorage(){
  $(".filterWrap>div").html('')
  if (localStorage.length === 0) {
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
          redraw()
        });
      }
    });
  }
}
function redraw(){
  map.off();
  map.remove();
  $("#map>.wrapInfo>.card").fadeOut(500)
  initmap()
  $('#recordTable').DataTable().clear().destroy();
  if (localStorage.length == 0) {$(".filterRow").hide()}
}

window.addEventListener("orientationchange", function() {
  window.setTimeout(function() {
    $('#recordTable').DataTable().destroy();
    initTable('#recordTable')
  }, 200);
}, false);
