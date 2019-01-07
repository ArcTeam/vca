$(document).ready(function(){
  navFooter()
  $('body').on('click','.openMenu',function(e){
    e.preventDefault()
    e.stopPropagation()
    $('.userNavWrap').toggleClass('closed opened')
  })
  $(".userNavWrap").on("click", function (event) { event.stopPropagation(); })
  $('.tip').tooltip({
    boundary:'window',
    container:'body',
    placement:function(tip,element){return $(element).data('placement');},
    html:true,
    trigger:'hover'
  })
})
$(document).on("click", function () {
  if ($('.userNavWrap').hasClass('opened')) {
    $('.userNavWrap').toggleClass('closed opened');
  }
})


function navFooter () {
  $('.mainNav>ul').clone().appendTo($('.navFooter'))
  $('.navFooter>ul').removeClass().find('li').removeClass().find('a').removeClass('nav-link')
  $('.navFooter>ul>li>a').removeClass('openMenu')
  $('.navFooter>ul>li>a>i').remove()
}
function removeLib () {
  const elements = document.getElementsByClassName('listeLib')
  while (elements.length > 0) elements[0].remove()
}

function initTable (disorder) {
  var cols = !disorder ? [] : disorder
  var t = $('.table').DataTable({
    responsive: true,
    fixedHeader: true,
    'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
    'columnDefs': [{ 'orderable': false, 'targets': cols }]
  })
}

function countdown(sec,page){
  document.getElementById("countdowntimer").textContent = sec;
  var downloadTimer = setInterval(function(){
    sec--;
    document.getElementById("countdowntimer").textContent = sec;
    if(sec <= 0){ window.location.href=page; }
    // clearInterval(downloadTimer);
  },1000);
}
