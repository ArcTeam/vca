$(document).ready(function(){
  navFooter()
  $('body').on('click','.openMenu',function(){
    $('.userNavWrap').toggleClass('closed opened');
  })
})

function navFooter () {
  $('.mainNav>ul').clone().appendTo($('.navFooter'))
  $('.navFooter>ul').removeClass().find('li').removeClass().find('a').removeClass('nav-link')
  $('.navFooter>ul>li>a>i').remove()
}
function removeLib () {
  const elements = document.getElementsByClassName('listeLib')
  while (elements.length > 0) elements[0].remove()
}
