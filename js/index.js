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
    state=$('[name=state]').val();
    land=$('[name=land]').val();
    municipality=$('[name=municipality]').val();
    tipo=$('[name=type]').val();
    cronostart=$('[name=cronostart]').val();
    keywords=$('[name=keywords]').val();
    if (!state && !land && !municipality && !tipo && !cronostart && !keywords) {
      $('.filterMsg').fadeIn('fast');
    }else {
      localStorage.clear();
      if (state) {
        localStorage.setItem('state', state);
        localStorage.setItem('filterState', $('[name=state] :selected').text());
      }
      if (land) {
        localStorage.setItem('land', land);
        localStorage.setItem('filterLand', $('[name=land] :selected').text());
      }
      if (municipality) {
        localStorage.setItem('municipality', municipality);
        localStorage.setItem('filterMunicipality', $('[name=municipality] :selected').text());
      }
      if (tipo) {
        localStorage.setItem('type', tipo);
        localStorage.setItem('filterType', $('[name=type] :selected').text());
      }
      if (cronostart) {
        localStorage.setItem('cronostart', cronostart);
        localStorage.setItem('filterChronology', $('[name=cronostart] :selected').text());
      }
      if (keywords) {
        localStorage.setItem('keywords', keywords);
        localStorage.setItem('filterKeywords', keywords);
      }
      window.location.href="catalogue.php"
    }
  });
});
