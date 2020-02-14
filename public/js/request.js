 function wrapRequestWindowByMask(){
        // 화면의 높이와 너비를 변수로 만듭니다.
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
 
        // fade 애니메이션 : 1초 동안 검게 됐다가 50%의 불투명으로 변합니다.
        $('.request_mask').fadeIn(1000);
        $('.request_mask').fadeTo("slow",0.5);
        
        $('.request_mask').removeClass('request_mask_hide').addClass('request_mask_show');
        $('.request_window_wrapper').removeClass('request_window_wrapper_hide').addClass('request_window_wrapper_show');
 
        // 레이어 팝업을 가운데로 띄우기 위해 화면의 높이와 너비의 가운데 값과 스크롤 값을 더하여 변수로 만듭니다.
        var left = ( $(window).scrollLeft() + ( $(window).width() - $('.request_fs-popup').width()) / 2 );
        var top = ( $(window).scrollTop() + ( $(window).height() - $('.request_fs-popup').height()) / 2 );
 
        // css 스타일을 변경합니다.
        //$('.window').css({'left':left,'top':top, 'position':'absolute'});
 
        // 레이어 팝업을 띄웁니다.
        $('.request_fs-popup').show();
    }


 function wrapTaxWindowByMask(){
        // 화면의 높이와 너비를 변수로 만듭니다.
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
 
        // fade 애니메이션 : 1초 동안 검게 됐다가 50%의 불투명으로 변합니다.
        $('.tax_mask').fadeIn(1000);
        $('.tax_mask').fadeTo("slow",0.5);
        
        $('.tax_mask').removeClass('tax_mask_hide').addClass('tax_mask_show');
        $('.tax_window_wrapper').removeClass('tax_window_wrapper_hide').addClass('tax_window_wrapper_show');
 
        // 레이어 팝업을 가운데로 띄우기 위해 화면의 높이와 너비의 가운데 값과 스크롤 값을 더하여 변수로 만듭니다.
        var left = ( $(window).scrollLeft() + ( $(window).width() - $('.tax_fs-popup').width()) / 2 );
        var top = ( $(window).scrollTop() + ( $(window).height() - $('.tax_fs-popup').height()) / 2 );
 
        // css 스타일을 변경합니다.
        //$('.window').css({'left':left,'top':top, 'position':'absolute'});
 
        // 레이어 팝업을 띄웁니다.
        $('.tax_fs-popup').show();
    }
 
    $(document).ready(function(){
        //문의하기 popup
        $('.request_showMask').click(function(e){
            e.preventDefault();
            wrapRequestWindowByMask();
        });
        
        //세금계산서 popup
    $('.tax_showMask').click(function(e){
        e.preventDefault();
        wrapTaxWindowByMask();
    });
 
        // 닫기(close)를 눌렀을 때 작동합니다.
        $('.request_close-icon').click(function (e) {
            e.preventDefault();
            $('.request_mask').hide();
            $('.request_mask').removeClass('request_mask_show').addClass('request_mask_hide');
            $('.request_window_wrapper').removeClass('request_window_wrapper_show').addClass('request_window_wrapper_hide');
            $('.tax_mask').hide();
            $('.tax_mask').removeClass('tax_mask_show').addClass('tax_mask_hide');
            $('.tax_window_wrapper').removeClass('tax_window_wrapper_show').addClass('tax_window_wrapper_hide');
            
        });
        
            $(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape key maps to keycode `27`
      $('.request_mask').hide();
            $('.request_mask').removeClass('request_mask_show').addClass('request_mask_hide');
            $('.request_window_wrapper').removeClass('request_window_wrapper_show').addClass('request_window_wrapper_hide');
         $('.tax_mask').hide();
            $('.tax_mask').removeClass('tax_mask_show').addClass('tax_mask_hide');
            $('.tax_window_wrapper').removeClass('tax_window_wrapper_show').addClass('tax_window_wrapper_hide');
    }
});

        
        

    });//Loading...