removeLib();
$(document).ready(function() {
  $("[name=update]").on('click',function(e){
    var form = $('form[name=accountInfo]');
    isvalidate = form[0].checkValidity();
    if (isvalidate) {
      e.preventDefault();
      oop={file:'user.class.php',classe:'User',func:'updateAccount'}
      dati={}
      dati.email=$('[name=email]').val()
      dati.first_name=$('[name=first]').val()
      dati.last_name=$('[name=last]').val()
      dati.address=$('[name=address]').val()
      if ($('[name=cell]').val()) { dati.cell=$('[name=cell]').val() }
      if ($('[name=description]').val()) { dati.description=$('[name=description]').val() }
      $.ajax({
        type: "POST",
        url: "class/connector.php",
        data: {oop:oop, dati:dati},
        dataType: 'json',
        success: function(data){
          $('#output').removeClass().addClass('text-center my-3 alert alert-' + data[0]).text(data[1])
          setTimeout(function(){ location.reload();}, 5000);
        }
      });
    }
  })
});
