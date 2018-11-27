$(document).ready(function(){
  navFooter()
  $('body').on('click','.openMenu',function(e){
    e.preventDefault()
    $('.userNavWrap').toggleClass('closed opened');
  })
  $('.leftTip').tooltip({container:'body',placement:'left',trigger:'hover'});
  $('.bottomTip').tooltip({boundary:'window',container:'body',placement:'bottom',trigger:'hover'});
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
