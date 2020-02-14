$(function(){
    
    $('.fs-top-nav_userInfo,.fs-top-nav-logout').on('click',function(){
        if($(window).width() > 700) {
            $('.fs-account-info-box').toggle('slow',function(){
                opacity : '1'
            })
        }
    });
    
    //my account 수정하기
    
//    $('.fs-change-info').on('click',function(){
//        
//        $(this).toggleClass('changeInfo');
//        
//        
//        if($(this).hasClass('changeInfo')) {
//            //정보 수정하기 눌렀을때
//            $(this).text('정보 저장하기');
//            $('.fs-account-info').attr('readonly',false).css({
//                'cursor' : 'text',
//                'border-bottom':'1px solid #242424'
//            });
//            $('.fs-account-info').eq(0).focus();
//            
//            
//        } else {
//            //정보 저장하기 눌렀을때
//            $(this).text('정보 수정하기');
//            $('.fs-account-info').attr('readonly',true).css({
//                'cursor' : 'default',
//                'border-bottom':'0px solid #242424'
//            });
//            alert('수정되었습니다.');
//        }
//        
//        
//        
//    });
    
    
    
    
});//loading..