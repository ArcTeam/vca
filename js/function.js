$(document).ready(function(){
  navFooter()
  $('body').on('click','.openMenu',function(e){
    e.preventDefault()
    e.stopPropagation()
    $('.userNavWrap').toggleClass('closed opened');
  })
  $(".userNavWrap").on("click", function (event) { event.stopPropagation(); });
  $('.leftTip').tooltip({container:'body',placement:'left',html:true,trigger:'hover'});
  $('.bottomTip').tooltip({boundary:'window',container:'body',html:true, placement:'bottom',trigger:'hover'});
  $('.topTip').tooltip({boundary:'window',container:'body',html:true,placement:'top',trigger:'hover'});
})
$(document).on("click", function () {
  if ($('.userNavWrap').hasClass('opened')) {
    $('.userNavWrap').toggleClass('closed opened');
  }
});


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
