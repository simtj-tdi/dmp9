    function banner(){
        
        var windowWidth = $(window).width(),
            bannerWidth = $('.fs-main-banner');
        
        if(windowWidth > 1400) {
            
            bannerWidth.width(windowWidth-240);
            
        } else if (windowWidth > 700 && windowWidth < 1400) {
            bannerWidth.width(windowWidth-160);
        } else if (windowWidth < 700) {
            bannerWidth.width(windowWidth);
        }

    }

//jquery

$(function(){
    

    
    banner();

    
});

$(window).resize(function(){
    
    banner();
    
});

//js

(function(){
    
    
  
        
          var ulNotice = document.getElementById("main-banner"),
                currentNoticeTop = 0,
                currentIndex = 0,
                maxIndex = ulNotice.getElementsByClassName("banner-list").length-1,
                currentRollingUp = true,
                subjectHeight = 50,
                velocityPerSecond = 30,
                previousFrame = null;
            
            setTimeout(rollNextNotice,0);
            
            function rollNextNotice(){

                requestAnimationFrame(rollNotice);
            
            
            }
            function rollNotice(time){
                var diff = (previousFrame !== null ? time - previousFrame : 0);
                previousFrame = time;
                currentNoticeTop += (diff/1000) * velocityPerSecond;
                if(currentNoticeTop * velocityPerSecond >= currentIndex * -subjectHeight * velocityPerSecond) {

                    if(currentIndex === maxIndex || currentIndex === 0) {
                        currentRollingUp = !currentRollingUp;
                        velocityPerSecond = -velocityPerSecond;
                    }
                    currentNoticeTop = currentIndex * -subjectHeight;
                    currentIndex += (currentRollingUp ? -1 : 1);
                    previousFrame = null;
                    
                    setTimeout(rollNextNotice, 10000);
                    
                } else {

                    requestAnimationFrame(rollNotice);
                }
                ulNotice.style.top = currentNoticeTop + "px";
            }
     
    
    
}());