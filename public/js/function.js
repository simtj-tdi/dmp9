// Auto update layout
if (window.layoutHelpers) {
  window.layoutHelpers.setAutoUpdate(true);
}

$(function() {
  // *Initialize sidenav
  $('#layout-sidenav').each(function() {
    new SideNav(this, {
      orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
    });
  });

  // *Initialize sidenav togglers
  $('body').on('click', '.layout-sidenav-toggle', function(e) {
    e.preventDefault();
    window.layoutHelpers.toggleCollapsed();
  });

  // *Swap dropdown menus in RTL mode
  if ($('html').attr('dir') === 'rtl') {
    $('#layout-navbar .dropdown-menu').toggleClass('dropdown-menu-right');
  }
});



/*sidenav 클릭하면 active 클래스 부여하기*/
$("#layout-sidenav").find('ul>li').bind('click', function(){
  var a = $(this);
  a.addClass("active");
  $("#layout-sidenav").find('ul>li').not(a).removeClass("active")
});


/* 모두동의 */
$('#all_checkbox').on("change", function(){
  var checked = $(this).prop('checked'); // checked 문자열 참조(true, false)
  $('input[name="check"]').prop('checked', checked);
});

$('input[name="check"]').change(function () {
  var boxLength = $('input[name="check"]').length;
  // 체크된 체크박스 갯수를 확인하기 위해 :checked 필터를 사용하여 체크박스만 선택한 후 length 프로퍼티를 확인
  var checkedLength = $('input[name="check"]:checked').length;
  var selectAll = (boxLength == checkedLength);

  $('#all_checkbox').prop('checked', selectAll);
});

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

/*side_modal 동작 애니메이션*/
$(".btn_modal").on('click', function(){
  if($(".btn_modal").hasClass("on") === true) {
    $(".side_modal").removeClass("on_click");
    $(".side_modal").addClass("off_click");
    $(".btn_modal").removeClass("on");
  } else {
    $(".side_modal").removeClass("off_click");
    $(".side_modal").addClass("on_click");
    $(".btn_modal").addClass("on");
  }
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