$(document).ready(function() {
  initNote()
  $('[data-toggle="popusr"]').popover({
    container:'body',
    html:true,
    content:function(){return $(this).data('usrinfo')},
    placement:'left',
    trigger:'focus'
  })

  $("[name=addNoteBtn]").on('click',function(e){
    form = $("[name=noteForm]");
    isvalidate = $(form)[0].checkValidity();
    if (isvalidate) {
      e.preventDefault();
      oop={file:'dashboard.class.php',classe:'Dashboard',func:'addNote'}
      dati={}
      dati.note=$("[name=note]").val();
      $.ajax({
        type: "POST",
        url: "class/connector.php",
        data: {oop:oop, dati:dati},
        dataType: 'json'
      }).done(function(){
        initNote()
        $("[name=toggleNoteForm]").trigger('click');
        $("[name=note]").val('');
      })
    }
  })

  $("body").on('click', '[name=delNoteBtn]', function() {
    msg = 'stai per eliminare una nota!\nSe confermi, la nota non potrà più essere recuperata';
    if (confirm(msg)) {
      dati['oop']={file:'dashboard.class.php',classe:'Dashboard',func:'delNote'}
      dati['dati']={'id':$(this).val()}
      $.ajax({ url: connector, type: type, dataType: dataType, data: dati })
        .done(function(){
          initNote()
        })
        .fail(function(error) {
          log(eval(error));
        });
    }
  });
});

function initNote(){
  dati['oop']={file:'dashboard.class.php',classe:'Dashboard',func:'note'}
  getdata(dati,function(data){
    if (data.length>0) {
      li=[]
      data.forEach( function(v,i){
        data="<small class='d-block'>"+v.data.split('.')[0]+"</small>";
        testo="<p class='m-0'>"+v.note.replace(/([\n]?)(\r\n|\n\r|\r|\n)/g,"<br>")+"</p>";
        delBtn="<button type='button' name='delNoteBtn' class='btn btn-outline-secondary btn-sm float-right mx-2' value='"+v.id+"'>delete</button>";
        li.push("<li class='list-group-item'>"+data+testo+delBtn+"</li>");
      })
      $("#noteList").html(li.join(''));
    }else {
      $("#noteList").html("<li class='list-group-item text-center'>No available note</li>");
    }
  })
}
