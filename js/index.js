areaList()
typeList()
cronoList()
$(document).ready(function() {
  $('[name=state]').on('click', function() {
    landList($(this).val());
    municipalityList($(this).val(),null);
  });
  $('[name=land]').on('click', function() { municipalityList(null,$(this).val()); });
  $('.shortSel').on({
    mousedown: function() {if($(this).find('option').length > 8 ){ $(this).attr('size',8); }},
    change: function(){$(this).attr('size',0);},
    blur: function(){$(this).attr('size',0);}
  });
  $('[name=submit]').on('click', function(event) {
    event.preventDefault();
    storage={}
    state=$('[name=state]').val();
    land=$('[name=land]').val();
    municipality=$('[name=municipality]').val();
    tipo=$('[name=type]').val();
    cronostart=$('[name=cronostart]').val();
    keywords=$('[name=keywords]').val();
    if (!state && !land && !municipality && !tipo && !cronostart && !keywords) {
      $('.filterMsg').fadeIn('fast');
    }else {
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
      window.location.href="catalogue.php"
    }
  });
});
