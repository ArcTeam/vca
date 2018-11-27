var newPwd = document.getElementById("new")
var check = document.getElementById("check");
$(document).ready(function() {
  $('.pwdTip').hide()
  $('#new').on({
    focus: function(){ $('.pwdTip').fadeIn('fast')},
    blur: function(){$('.pwdTip').fadeOut('fast')}
  })
  $('[name=change]').on('click',function(e){
    checkPwd()
    form = $("form[name=changePwd]");
    isvalidate = $(form)[0].checkValidity();
    if (isvalidate) {
      e.preventDefault();
      oop={file:'user.class.php',classe:'User',func:'changePwd'}
      dati={}
      dati.oldpwd=$("#old").val()
      dati.newpwd=$(newPwd).val()
      $.ajax({
        type: "POST",
        url: "class/connector.php",
        data: {oop:oop, dati:dati},
        dataType: 'json',
        success: function(data){
          $("#output").removeClass().addClass('text-center my-3 alert alert-' + data[0]).text(data[1])
        }
      });
    }
  })
});

function checkPwd(){
  if(newPwd.value != check.value) {
    check.setCustomValidity("Passwords Don't Match");
  } else {
    check.setCustomValidity('');
  }
}
