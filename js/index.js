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
    state=$('[name=state]').val();
    land=$('[name=land]').val();
    municipality=$('[name=municipality]').val();
    tipo=$('[name=type]').val();
    cronostart=$('[name=cronostart]').val();
    keywords=$('[name=keywords]').val();
    if (!state && !land && !municipality && !tipo && !cronostart && !keywords) {
      event.preventDefault();
      $('.filterMsg').fadeIn('fast');
    }else {
      $('[name=filterForm]').trigger();
    }
  });
});
