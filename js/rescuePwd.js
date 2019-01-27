removeLib()
$(document).ready(function(){
  var form,oop,dati;
  $("[name=send ]").on('click', function(e){
    form = $("form[name=rescue]");
    isvalidate = $(form)[0].checkValidity();
    if (isvalidate) {
      e.preventDefault();
      oop={file:'user.class.php',classe:'User',func:'rescuePwd'}
      dati={}
      dati.email=$("[name=email]").val();
      $.ajax({
        type: "POST",
        url: "class/connector.php",
        data: {oop:oop, email:$("[name=email]").val()},
        dataType: 'json',
        success: function(data){
          $('#output').text(data[0])
          $('#output').removeClass().addClass('text-center my-3 alert alert-' + data[0]).text(data[1])
          if (data[0].indexOf('success') > -1) {
            setTimeout(function(){ window.location.href='index.php'; }, 5000);
          }
        }
      });
    }
  })
})
