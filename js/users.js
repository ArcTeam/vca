$(document).ready(function(){
  sessionClass=$("[name=sessionClass]").val()
  initUsersTable()
  $("[name=closeAlert]").on('click', function(){ $(".alertModalWrap").fadeOut('fast');})
  $("[name=status]").on('click', function(){
    id=$('[name=idusr]').val()
    //act=$('[name=statususr]').val()
    oop={file:'admin.class.php',classe:'Admin',func:'userMod'}
    dati={id:id,field:'act'}
    // console.log(dati);
    modUserFunc(oop,dati)
  })
  $("[name=modclass]").on('click', function(){
    id=$('[name=idusr]').val()
    classe=$('[name=usrlistval]:checked').val()
    oop={file:'admin.class.php',classe:'Admin',func:'userMod'}
    dati={id:id,field:'class',val:classe}
    modUserFunc(oop,dati)
  })
})

function modUserFunc(oop,dati){
  $.ajax({
    type: "POST",
    url: "class/connector.php",
    data: {oop:oop, dati:dati},
    dataType: 'json',
    success: function(data){
      alert(data);
      location.reload();
    }
  });
}

function initUsersTable(){
  oop={file:'admin.class.php',classe:'Admin',func:'userList'}
  tbody=$("#usrtable>tbody")
  $.ajax({
    type: "POST",
    url: "class/connector.php",
    data: {oop:oop},
    dataType: 'json',
    success: function(data){
      data.forEach(function(v,i){
        var classe = buildClass(v.idclass)
        var attivo,usrstatustitle,usrstatusp
        if (v.act===true) {
          attivo = 'success'
          usrstatustitle = 'disable'
          act = 'false';
          usrstatusp = 'if you confirm, the user will remain in the database but can no longer login.<br>The user can be reactivated at any time'
        }else {
          attivo = 'danger'
          act = 'true';
          usrstatustitle = 'able'
          usrstatusp = 'if you confirm, all the functions available to the user will be reactivated'
        }
        tr = $("<tr/>").appendTo(tbody)
        $("<td/>",{text:v.last_name +" "+ v.first_name}).appendTo(tr)
        $("<td/>",{text:v.email}).appendTo(tr)
        $("<td/>",{text:v.address}).appendTo(tr)
        $("<td/>",{text:v.cell}).appendTo(tr)
        $("<td/>",{text:v.description}).appendTo(tr)
        if (sessionClass > 2) {
        $("<td/>",{html:classe,title:'change user class',class:'align-middle'})
          .addClass('cursor animation moduser text-center')
          .appendTo(tr)
          .on('click', function(){
            if (sessionClass==4) {
              $("[name=idusr]").val(v.id)
              $(".usrclasschecklist").find('label').removeClass('active').eq(parseInt(v.idclass) - 1).addClass('active')
              $("#alertClassWrap").fadeIn('fast')
            }
          })
        $("<td/>",{text:v.act, title:'able/disable user status',class:'align-middle'})
          .addClass('cursor animation moduser text-center font-weight-bold text-'+attivo)
          .appendTo(tr)
          .on('click', function(){
            if (sessionClass==4) {
              $("[name=idusr]").val(v.id)
              $("[name=statususr]").val(act)
              $(".usrstatustitle").text(usrstatustitle)
              $(".usrstatusp").html(usrstatusp)
              $("#alertDelWrap").fadeIn('fast')
            }
          })
          edit = $("<td/>")
            .addClass('cursor animation moduser text-center align-middle')
            .appendTo(tr)
            .on('click',function(){
              if (sessionClass >= v.idclass) {
                $(this).find('form').submit()
              }
            })
          form = $("<form/>",{action:'usrInfo.php',method:'post'}).appendTo(edit)
          input=$("<input/>",{type:'hidden',name:'idusr'}).val(v.id).appendTo(form)
          i=$("<i/>").addClass('fas fa-edit fa-lg text-info').appendTo(form)
        }
      })
      table = $('#usrtable').removeAttr('width').DataTable({
        retrieve:true,
        responsive: true,
        paging: true,
        oLanguage: {
          sInfo: "_MAX_ records",
          sInfoFiltered: " / _TOTAL_ filtered",
          sInfoEmpty: "No record to show",
          sSearch: "_INPUT_",
          sSearchPlaceholder: "Search records..."
        }
      });
      var legend = $('#legend').detach();
      $("#usrtable_filter").addClass('d-inline').parent().prepend(legend)
      $("#usrtable_filter").find('input[type=search]').removeClass('form-control-sm')
    }
  });
}

function buildClass(idclasse){
  var icoClass
  switch (idclasse) {
    case 1: icoClass = 'fas fa-user fa-lg text-success'; break;
    case 2: icoClass = 'fas fa-user-edit fa-lg text-primary'; break;
    case 3: icoClass = 'fas fa-user-cog fa-lg text-warning'; break;
    case 4: icoClass = 'fas fa-user-secret fa-lg text-danger'; break;
    default:
  }
  return "<i class='"+icoClass+"'></i>";
}
