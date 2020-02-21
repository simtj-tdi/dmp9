// Auto update layout
if (window.layoutHelpers) {
  window.layoutHelpers.setAutoUpdate(true);
}

$(function() {
  // Initialize sidenav
  $('#layout-sidenav').each(function() {
    new SideNav(this, {
      orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
    });
  });

  // Initialize sidenav togglers
  $('body').on('click', '.layout-sidenav-toggle', function(e) {
    e.preventDefault();
    window.layoutHelpers.toggleCollapsed();
  });

  // Swap dropdown menus in RTL mode
  if ($('html').attr('dir') === 'rtl') {
    $('#layout-navbar .dropdown-menu').toggleClass('dropdown-menu-right');
  }
});



/*sidenav 클릭하면 active 클래스 부여하기*/
// $("#layout-sidenav").find('ul>li').bind('click', function(){
//   var a = $(this);
//   a.addClass("active");
//   $("#layout-sidenav").find('ul>li').not(a).removeClass("active")
// });


/*스와이프.js*/
var swiper = new Swiper('.swiper-container', {
  direction: 'vertical',
  autoplay: {
    delay: 3000,
  },
  loop: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

/*side_modal ul 삭제*/
function deleteOption(that){
  $(that).closest('ul').remove(); 
}

/*질문하기,문의하기 ul 클릭 토글*/
$(".cont>ul").on('click', function(){
  console.log(this);
  console.log($(this).children('.text_answer'));
  $(this).children('.text_answer').toggle();
});

/*contact 글쓰기 클릭 모달*/
function addWriting() {
  $("#add_writing").show();
}
function addWritingDisNone() {
  $("#add_writing").hide();
}

