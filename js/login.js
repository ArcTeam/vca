removeLib()
$(document).ready(function () {
  var form,oop,dati;
  $('[name=login]').on('click', function (e) {
    form = $("form[name=login]")
    isvalidate = $(form)[0].checkValidity()
    if (isvalidate) {
      e.preventDefault()
      $('.output').removeClass('text-danger text-success')
      oop={file:'user.class.php',classe:'User',func:'login'}
      dati={}
      dati.email=$("[name=email]").val()
      dati.pwd=$("[name=password]").val()
      $.ajax({
        type: "POST",
        url: "class/connector.php",
        data: {oop:oop, dati:dati},
        dataType: 'json',
        success: function(data){
          if (data==1) {
            output = 'invalid email'
            textClass = 'text-danger'
          }else if (data==2) {
            output = 'invalid password'
            textClass = 'text-danger'
          }else {
            output = 'ok, you are in!'
            textClass = 'text-success'
            setTimeout(function(){
              window.location.href='dashboard.php';
            }, 3000);
          }
          $('.output').removeClass('d-none').addClass(textClass).text(output)
        }
      });
    }
  })
})
