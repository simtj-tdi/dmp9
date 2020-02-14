function openPurchase(thisTitle, thisData, thisPrice, chargePrice, targetID, description, exportTimeInfo) {

    //금액 변환
    var realNum = thisPrice.trim().slice(0, -1);

    //소수점 제거
    var trueNum = unNumberFormat(realNum);

    //보유 금액 소수점 제거
    var realCharge = unNumberFormat(chargePrice.trim());

    //보유 금액 - 구매 금액
    var totalNum = String(realCharge - trueNum);

    //구매 금액 반환
    var lastNum = String(numberFormat(realNum));

    //잔여금액 반환
    var lastTotalNum = numberFormat(totalNum);

    $('.purchase-title').text(thisTitle);
    $('.fs-purchase-right-detail-title').text(thisTitle);
    $('.purchase-db-num').text(thisData);
    $('.purchase-totla-price-num').text(lastNum);
    //$('.purchase-have-price-num').text($chargePrice);
    $('.purchase-last-price-num').text(lastTotalNum);
    //console.log(typeof thisPrice);
    //console.log(thisPrice);
    if (thisPrice == "") {
        $('#fs-purchase-detail-price').text("구매완료");
        //console.log('aaa');
    } else {
        $('#fs-purchase-detail-price').text(thisPrice);
    }

    $('#target_id').val(targetID);
    $('#hidden_description').html('<p>' + description + '</p>');

    //추출 시간
    $('#data_export_time_display').html(exportTimeInfo.export_time);

    //사용 기간
    $('#data_use_time_display').html(exportTimeInfo.use_time);

    $('.fs-purchase-notice-account').html(
        $('.fs-purchase-select-account-title option:selected').text()
    );

    if (totalNum < 0) {
        $('.fs-purchase-right-warning').addClass('purchase-warning-box-open');
        $('.fs-purchase-notice-box').css('font-size', '0em');
    } else {
        $('.fs-purchase-right-warning').removeClass('purchase-warning-box-open');
        $('.fs-purchase-notice-box').css('font-size', '1.4em');
    }
}

function countNumPrice () {
    var contentWidth = $('#infinite_scroll').width(),
        containerWidth = $('#fsScrollContainer').width(),
        fsM = containerWidth - contentWidth,
        countPosition = $('.fsShowCount');

    if(fsM <= 0) {
        countPosition.css({
            'left' : 0
        })
    } else {
        var cP = fsM/2;

        countPosition.css({
            'left' : cP
        })

    }



}

function wrapPurchase() {
    var $purchaseBackground = $('.fs-purchase-background'),
        $purchaseWrapper = $('.fs-purchase-wrapper'),
        $title = $('.purchase-title');

    //$purchaseBackground.fadeIn(1000);
    //$purchaseBackground.fadeTo("slow",0.6);

    $purchaseBackground.stop(true).animate({
        'opacity': '0.6'
    }, '1000');

    $purchaseBackground.removeClass('fs-purchase-background-hide').addClass('fs-purchase-background-show');
    $purchaseWrapper.removeClass('fs-purchase-wrapper-hide').addClass('fs-purchase-wrapper-show');

    //    var leftPurchase = ($(window).scrollLeft()+($(window).width() - $purchaseWrapper.width())/2);
    //    var topPurchase = ($(window).scrollTop()+($(window).height() - $purchaseWrapper.height())/2);

    $purchaseWrapper.show();

    $title.stop(true).animate({
        bottom: '0px'
    }, 1000);

}

function closePurchase() {
    var $purchaseBackground = $('.fs-purchase-background'),
        $purchaseWrapper = $('.fs-purchase-wrapper'),
        $title = $('.purchase-title');

    $purchaseBackground.stop(true).animate({
        'opacity': '0'
    }, '1000');
    $purchaseBackground.removeClass('fs-purchase-background-show').addClass('fs-purchase-background-hide');
    $purchaseWrapper.hide();
    $purchaseWrapper.removeClass('fs-purchase-wrapper-show').addClass('fs-purchase-wrapper-hide');
    $title.stop(true).animate({
        bottom: '-100px'
    }, 500);
}

//콤마 넣기
function numberFormat(num) {
    var pattern = /(-?[0-9]+)([0-9]{3})/;
    while (pattern.test(num)) {
        num = num.replace(pattern, "$1,$2");
    }
    return num;
}

//콤마 제거
function unNumberFormat(num) {
    return (num.replace(/\,/g, ""));
}

//타겟이 없을 경우

function noTarget() {

    var noTargetWidth = $('.fs-fbaccount-box-content').width(),
        noTargetHeight = $('.fs-fbaccount-box-container').height() - 40;


    $('.fs-no-target-box').css({
        width: noTargetWidth,
        height: noTargetHeight
    });



}


//마켓 50% 할인 이벤트(~4/16)
function fsEvent() {


    $('.price-event-box').each(function (index) {

        var priceWidth = $(this).width();
        var priceBoxWidth = $('.target-price').width(),
            eventBoxWidth = priceBoxWidth - priceWidth - 20,
            index = index;

        //event box width setting
        // $(this).siblings('.price-percent').width(eventBoxWidth);

    });

    function comma(num) {
        var len, point, str;

        num = num + "";
        point = num.length % 3;
        len = num.length;

        str = num.substring(0, point);
        while (point < len) {
            if (str != "") str += ",";
            str += num.substring(point, point + 3);
            point += 3;
        }

        return str;

    }



    //마켓 이벤트
    $('.target-price').each(function () {

        var originalPrice = Number($(this).find('.originalPriceInput').val()),
            count = 100,
            eventPrice = Math.floor((originalPrice * 0.5) / count) * count,
            eventComma = comma(eventPrice);

        //console.log(eventComma);

        if ($(this).find('.price_text').text() == '구매완료') {
            $(this).find('.event-price').text('구매완료');
        } else {
            $(this).find('.event-price').text(eventComma + '원');
        }




    });


}


//hashTag말줄임
function hashTag() {
    $('.fs-target-tag').each(function () {

        var hashTagLength = $(this).find('.tag-item').length;

        //console.log(hashTagLength);

        for (var i = 0; i < hashTagLength; i++) {

            if (i > 4) {
                for (var j = 4; j < hashTagLength; j++)
                    $(this).find('.tag-item').eq(j).addClass('hidden-hash-tag');
            }
        }
    });
}

function marketListClick() {
    if ($('.fs-purchase-select-account-title').val() == '') {
        if (confirm("페이스북 광고주 계정이 없을 경우 타겟 구매를 하실 수 없습니다.\n계정을 등록 하시겠습니까?")) {
            location.href = '/account'
        }
    }
}

function marketEvent() {
    //예시 해쉬태그 클릭시 검색창에 해당 값 넘겨주기
    $('.fs-search-keyword-item > a').click(function (e) {
        e.preventDefault();
        var thisHash = $(this).text();
        $('.fs-search-box_input').val(thisHash);
        $('.search-form-box').submit();
    });

    //mobile market 설정(layout 배치 등등)

    var mobielListBtn = (function () {
        if ($(window).width() < 800) {
            $('.fs-search-box_input').attr('placeholder', '원하시는 타겟을 검색해 보세요');
        } else {
            $('.fs-search-box_input').attr('placeholder', '해쉬태그 또는 타이틀로 원하시는 타겟을 검색해 보세요');
        }
    }());

    //모바일 계정 선택

    var mobileAccountWidth = (function () {

        var accountWidth = 0,
            listLength = $('.fs-purchase-select-account-mobile-account').length,
            totalWidth = $('.fs-purchase-select-account-mobile'),
            listWidth = 0,
            sideMargin = 30,
            totalMargin = 0;

        //console.log(listLength);

        for (var i = 0; i < listLength; i++) {
            listWidth += $('.fs-purchase-select-account-mobile-account').eq(i).width();

            //console.log(listWidth);
            //return listWidth;
        }

        totalMargin += sideMargin * listLength;

        listWidth += totalMargin;


        totalWidth.width(listWidth);


    }());


    //계정 선택

    // $('.fs-show-account-text').on('click', function () {
    //     if ($('.fs-market-select-account-container').hasClass('account-visible')) {
    //
    //         $('.fs-market-select-account-container').fadeIn(1000);
    //     }
    //
    // }); //click

    $('a[href="/market"]').on('click', function () {
        $('.fs-market-select-account-container').fadeIn(100);
    });

} //market event

function marketMobileEvent() {
    var lastScrollTop = 0,
        delta = 15;
    //console.log('mobile scroll event start');

    //스크롤 멈춤 감지
    $.fn.scrollStopped = function (callback) {
        var that = this,
            $this = $(that);
        $this.scroll(function (ev) {
            clearTimeout($this.data('scrollTimeout'));
            $this.data('scrollTimeout', setTimeout(callback.bind(that), 250, ev));
        });
    };

    $('.fs-fbaccount-box-container').scroll(function (event) {

        var st = $(this).scrollTop();
        var isScroll;
        if (Math.abs(lastScrollTop - st) <= delta) return;
        if ((st > lastScrollTop) && (lastScrollTop > 0)) {
            isScroll = true;
        } else if(lastScrollTop > 120){
            isScroll = false;
        }
        lastScrollTop = st;
        // if(lastScrollTop <= 20) {
        //     $('.fs-sub-layout-header').stop(true).animate({
        //         'top' : '0px'
        //     },100,function(){
        //         $('#fsScrollContainer').stop(true).animate({
        //             'top' : '0px'
        //         },300);
        //     });
        //
        // }


        //console.log(event);

        if(isScroll) {
            $('.fs-sub-layout-header').css({
                'top' : '-50px'
            });
            $('#fsScrollContainer').css({
                'top' : '-40px'
            });
            //console.log(isScroll);
        } else if(isScroll === false) {
            $('.fs-sub-layout-header').css({
                'top' : '0px'
            });
            $('#fsScrollContainer').css({
                'top' : '0px'
            });
            //console.log('down'+isScroll);
        }


    });

    //스크롤 멈출경우 btn
    $('.fs-fbaccount-box-container').scrollStopped(function (ev) {
        //console.log(ev);
        //alert('scroll stopped');
        $('.fs-mobile-want-target').css({
            //'bottom': '20px'
        });
    });




}

function windowOnLoadMarketEvent() {

    //마켓 상세 팝업이 띄워집니다.
   $('.fs-target-list-box').click(function() {
        var thisTitle = $(this).find('.title-text').text(),
            thisData = $(this).find('.data-text').text(),
            thisPrice = $(this).find('.price_text').text(),
            thisevent = $(this).find('.event-price').text(),
            chargePrice = $('.fs-top-nav-charge_num').text(),
            targetID = $(this).find('.hidden-target-id').text(),
            description = $(this).find('.hidden-description-text').text(),
            totalPrice = $.trim($(this).find('.price_text').text()),
            nextBtn = $('#fs-purchase-next-btn');


        var exportTimeInfo = {
            "export_time":$(this).find('.data_export_time_hidden').val(),
            "use_time":$(this).find('.data_use_time_hidden').val(),
        };

        /*
        console.log($(this));
        console.log(exportTimeInfo);
        console.log(thisTitle);
        console.log(thisData);
        console.log(thisPrice);
        console.log(thisevent);
        console.log(chargePrice);
        console.log(targetID);
        console.log(description);
        console.log(totalPrice);
        console.log(nextBtn);
        */

        if ($('.fs-purchase-select-account-title').val() == '') {
            //alert('계정을 선택해주세요.');
            $('.fs-purchase-select-account-title').focus();
            return false;
        }

        openPurchase(thisTitle, thisData, thisPrice, chargePrice, targetID, description, exportTimeInfo);

        wrapPurchase();
        //console.log(totalPrice);
        if (totalPrice === "구매완료") {
            nextBtn.text('구매완료');
        } else {
            nextBtn.text('다음');
        }

    });

    $('.fs-purchase-wrapper .close').click(function (e) {
        e.preventDefault();
        closePurchase();

        $('.fs-purchase-total-full-box').css('left', '0px');
    });

    $(document).keyup(function (e) {
        if (e.keyCode == 27) { // escape key maps to keycode `27`
            closePurchase();

            $('.fs-purchase-total-full-box').css('left', '0px');
        }
    });

    //마켓 상세보기에서 다음버튼을 누르면 이동합니다.

    $('#fs-purchase-next-btn').unbind('click').bind('click', function () {

        var purchaseFirst = $('.fs-purchase-total-full-box');
        var width_size = window.outerWidth;
        var totalPrice = $.trim($('#fs-purchase-next-btn').text());
        var outerWidth = $('.fs-purchase-first-box').width();


        if (totalPrice === "구매완료") {
            alert('구매완료된 상품입니다.');
        } else {
            purchaseFirst.stop(true).animate({
                'left': -outerWidth
            });
        }

        //숫자 카운트 효과를 넣습니다.
        //         $('.counter').counterUp({
        //            delay: 20,
        //            time: 1000
        //        });
    });


    //이전버튼 클릭시 돌아갑니다.
    $('#fs-purchase-before-btn').on('click', function () {
        $('.fs-purchase-total-full-box').stop(true).animate({
            'left': '0px'
        });
    });

    // showMask를 클릭시 작동하며 검은 마스크 배경과 레이어 팝업을 띄웁니다.
    $('.showMask').click(function (e) {
        e.preventDefault();
        wrapWindowByMask();
    });

    // 닫기(close)를 눌렀을 때 작동합니다.
    $('.fs-popup .close').click(function (e) {
        e.preventDefault();
        //$('.mask').css('opacity','1');

        $('.mask').removeClass('mask_show').addClass('mask_hide');
        $('.window_wrapper').removeClass('window_wrapper_show').addClass('window_wrapper_hide');



    });

    $(document).keyup(function (e) {
        if (e.keyCode == 27) { // escape key maps to keycode `27`
            $('.mask').css('opacity', '1');
            $('.mask').removeClass('mask_show').addClass('mask_hide');
            $('.window_wrapper').removeClass('window_wrapper_show').addClass('window_wrapper_hide');
        }
    });

    $('[data-toggle="my"]').tooltip()




    //마켓 팝업창 사이즈 설정 및 반응형 설정
    var marketPopup = (function () {
        var width_size_global = $(window).width(),
            movingBox = $('.fs-purchase-total-full-box');

        if (width_size_global <= 800) {
            //console.log(width_size_global);
            movingBox.css('width', width_size_global * 2);
            $('#fs-purchase-next-btn').on('click', function () {
                var totalPrice = $.trim($('#fs-purchase-detail-price').text());

                if (totalPrice == "구매완료") {

                } else {
                    movingBox.stop(true).animate({
                        'left': -width_size_global
                    });
                }
            });
            $('.fs-purchase-total-full-box').on('scroll touchmove mousewheel', function (event) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            });
        }
    }());



    $('.market-select-account-list-text').on('click', function () {
        $('.fs-market-select-account-container').css('display', 'none');
    })



} //function windowOnLoadMarektEvent

function fsShow(){
    if($(window).width() < 700) {
        $('.fs-show-account').removeClass('fs-show-account-top');
        $('.fs-show-account').addClass('fs-show-account-down');
        $('#fsAcBx').removeClass('fsMarketAccountBox').addClass('fsMobileMarkerAccountBox');

        $('.fsShowList').css({
            'width' : $(window).width(),
            'left' : '0px'
        });
        $('.fs-show-account-text').on('click',function(){
            $(this).toggleClass('fsOpen');

            if($(this).hasClass('fsOpen')){
                $('.fsMobileMarkerAccountBox').stop(true).animate({
                    'bottom' : '0px'
                });
                $('.fsMobileOp').css({
                    'display' : 'block'
                });

            } else {
                $('.fsMobileMarkerAccountBox').stop(true).animate({
                    'bottom' : '-300px'
                });
                $('.fsMobileOp').css({
                    'display' : 'none'
                });
            }

        });
        $('#fsMoSe').removeClass('fsMarketSelectList');
        $('#fsMoSe').addClass('fsMarketMobileSelectList');

        $('.fsMarketShowSelect').on('click',function(){
            $('.fsSeMoOp').css({
                'display' : 'block'
            });
            $('.fsMarketMobileSelectList').stop(true).animate({
                'bottom' : '0px'
            });
        });

        $('.fsSeMoOp').on('click',function(){
            $('.fsSeMoOp').css({
                'display' : 'none'
            });
            $('.fsMarketMobileSelectList').stop(true).animate({
                'bottom' : '-200px'
            });
        })





    } else {

        console.log('aaddd');
        $('.fs-show-account').removeClass('fs-show-account-bottom');
        $('.fs-show-account').addClass('fs-show-account-top');
        $('#fsAcBx').removeClass('fsMobileMarkerAccountBox').addClass('fsMarketAccountBox');
        $('#fsMoSe').removeClass('fsMarketMobileSelectList');
        $('#fsMoSe').addClass('fsMarketSelectList');
        $('.fsMarketSelectList').removeAttr('style');
        $('.fsMarketAccount').on('click',function(){

        });
        $('.fs-show-account-text').on('click',function(){

            $('.fsMarketAccountBox').toggleClass('fsShowList');
        });
        $('.fsMarketShowSelect').on('click',function(){

            if($('#fsMoSe').hasClass('fsMarketSelectListShow')) {
                $('#fsMoSe').removeClass('fsMarketSelectListShow');

            } else {
                $('#fsMoSe').addClass('fsMarketSelectListShow');

            }

        });

        $('.fs-fbaccount-box-container,.fs-sub-header').on('click',function(){
            $('.fsMarketAccountBox').removeClass('fsShowList');
            $('.fsMarketSelectList').removeClass('fsMarketSelectListShow');

        })

    }
}

//window on load
$(function () {
    fsShow();
    windowOnLoadMarketEvent();
    fsEvent();
    marketEvent();

    if ($(window).width() < 700) {
        marketMobileEvent();
    } else {
        countNumPrice();
    }

    //모바일 dropdown 메뉴

    $('.fs-market-mobile-dropdown-box .dropdown-list ').on('click', function () {
        $('.mobile-dropdown-container').css('display', 'flex');
    });





}); //window on load


//윈도우 리사이즈 시 반응형 반응
$(window).resize(function () {
    fsShow();
    // width값을 가져오기
    var width_size = $(window).width(),
        movingBox = $('.fs-purchase-total-full-box'),
        boxWidth = movingBox.width();
    if (width_size <= 800) {
        movingBox.css('width', width_size * 2);
        $('#fs-purchase-next-btn').on('click', function () {

            var totalPrice = $.trim($('#fs-purchase-detail-price').text());

            if (totalPrice == "구매완료") {


            } else {
                movingBox.stop(true).animate({
                    'left': -width_size
                });
            }

        });
    } else if ($(window).width() > 1400) {
        $('#fs-purchase-next-btn').on('click', function () {

            var totalPrice = $.trim($('#fs-purchase-detail-price').text());

            if (totalPrice == "구매완료") {


            } else {
                movingBox.stop(true).animate({
                    'left': boxWidth / 2
                });
            }

        });
    }
    if($(window).width() > 700) {
        countNumPrice();
        // $('.selectOp').css('display','none');
        // $('.fsMarketOpacity').css('display','none');
        // $('#fsAcBx').css('display','none');
    }



});
