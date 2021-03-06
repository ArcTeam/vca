removeLib()
$(document).ready(function(){
  var form,oop,dati;
  $("[name=send ]").on('click', function(e){
    form = $("form[name=subscribe]");
    isvalidate = $(form)[0].checkValidity();
    if (isvalidate) {
      e.preventDefault();
      oop={file:'user.class.php',classe:'User',func:'subscribe'}
      dati={}
      dati.tipo=$(this).data('func');
      dati.email=$("[name=email]").val();
      dati.first_name=$("[name=firstName]").val();
      dati.last_name=$("[name=lastName]").val();
      dati.address=$("[name=address]").val();
      if($("[name=mobile]").val()){ dati.cell=$("[name=mobile]").val();}
      if($("[name=description]").val()){dati.description=$("[name=description]").val();}
      $.ajax({
        type: "POST",
        url: "class/connector.php",
        data: {oop:oop, dati:dati},
        dataType: 'json',
        success: function(data){
          var alertClass = (data.code == 1) ? 'alert-danger' : 'alert-success';
          $(".outputMsg").addClass(alertClass).html(data.msg+"<small class='d-block text-center'>Go back to the home page in 5 seconds</small>");
          $(".alertWrap").fadeIn('fast')
          setTimeout(function(){
            $(".alertWrap").fadeOut('fast');
            window.location.href='index.php';
          }, 5000);
        }
      });
    }
  })
})
