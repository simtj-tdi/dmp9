


//모바일 메뉴

function mobileMenu() {

    var winWidth = $(window).width();
    var winHeight = $(window).height();
    var $asideMenu = $('.fsMbMainNev');
    var $innerMenu = $('.fs-mb-nav-box');



    //모바일인지 체크
    if(winWidth < 700) {
        $asideMenu.css({
            'min-height' : winHeight,
            'left' : -winWidth,
        });


        $('.fs-menu-icon').on('click',function(){
            $asideMenu.css({
                left : '0px',
            });
            //window.FS9.navBarControl(true);
        })






        //닫기 버튼 클릭시 사라짐

        $('.fs-left-nav-close-icon,.fsMbMainNev').on('click',function() {
            var easing = 'swing';
            $asideMenu.css({
                'left':-winWidth,
            });
            //window.FS9.navBarControl(false);
        });

    } else {

    }


}














$(function(){


    //마켓 메뉴 리스트

    $('.fs-market-link').on('click',function(e){
        var $market_inside_list = $('.fs-market-menu-inside-list');
        
        e.preventDefault();
        
        //alert('yeah');
        if($market_inside_list.hasClass('unclick_market')){
            $market_inside_list.removeClass('unclick_market').addClass('click_market');
        } else {
            $market_inside_list.removeClass('click_market').addClass('unclick_market');
        }
    });
    
    //메뉴
    // $('.fs-menu-icon').on('click',function(){
    //     var easing = 'swing';
    //     var $asideMenu = $('.fs-main-layout-left-nav');
    //     $asideMenu.css({
    //         'left' : '0px'
    //     });
    //
    //     $('.fs-layout-opacity-box').fadeIn(500);
    //
    //
    //
    // });//Menu Open
    // $('.fs-left-nav-close-icon').on('click',function(){
    //     var easing = 'swing';
    //     var $asideMenu = $('.fs-main-layout-left-nav');
    //     $asideMenu.css({
    //         'left' : '-240px'
    //     });
    //
    //     $('.fs-layout-opacity-box').hide();
    // });//Menu Close
    
    $('.fs-layout-opacity-box').on('click',function(){
        var easing = 'swing';
        var $asideMenu = $('.fs-main-layout-left-nav');
        $asideMenu.animate({
            left : '-240px'
        },100,easing);
        
        $('.fs-layout-opacity-box').hide();
    });//바탕 클릭시 메뉴 들어감.
    
    //widnwo size 상시 확인 
        $(window).resize(function (){
  // width값을 가져오기
  var width_size = window.outerWidth;
  
  // 700 이상인지 check
  if (width_size => 700) {
    //alert('Curren width = 800px');
      //$('.fs-main-layout-left-nav').css('left','0px');
  }
        $('.fs-layout-opacity-box').hide();
        
    if(width_size <= 700) {
        //$('.fs-main-layout-left-nav').css('left','-240px');
    }
    });

    var slideMaenu = (function(){

        var normalMenuHeight = $('.fs-left-nav-item').height();

        $('.myPageCon').each(function(){

            var $this = $(this);
            var listNum = $this.find('.fsMypageMenu').height();

            $this.on('click',function() {

                if($(this).height() == normalMenuHeight) {
                    $(this).stop(true).animate({
                        height : normalMenuHeight+listNum
                    });
                } else {
                    $(this).stop(true).animate({
                        height : normalMenuHeight
                    });
                }


            });



        });








    })();


    mobileMenu();

    
});

$(window).resize(function(){
    mobileMenu();
});