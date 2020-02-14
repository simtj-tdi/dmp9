//모바일에서 마켓 키워드 슬라이드
(function(){
    
    
    if(screen.width < 800) {
        
        //json 연결
//        var ulNotice = document.getElementById("keyword-list"),
//            currentNoticeTop = 0,
//            currentIndex = 0,
//            maxIndex = 0,
//            currentRollingUp = true,
//            subjectHeight = 20,
//            velocityPerSecond = 20,
//            previousFrame = null,
//            xhr = new XMLHttpRequest();
//        
//        xhr.open("GET","/market_list.json");
//        xhr.reponseType = "json";
//        xhr.onload = function(event){
//            var noticeList = xhr.response,
//                length = noticeList.length,
//                i,
//                fragNoticeList = document.createDocumentFragment(),
//                liNoticeSubject,
//                aNoticeSubejct;
//            
//            for(i=0;i<length;i++) {
//                liNoticeSubject = document.createElement("li");
//                aNoticeSubejct = document.createElement("a");
//                liNoticeSubject.setAttribute("class","fs-search-keyword-item");
//                aNoticeSubejct.appendChild(document.createTextNode(noticeList[i]));
//                liNoticeSubject.appendChild(aNoticeSubejct);
//                fragNoticeList.appendChild(liNoticeSubject);
//            }
//            
//            maxIndex = length-1;
//            ulNotice.replaceChild(fragNoticeList,ulNotice.children[0]);
//            
//            setTimeout(rollNextNotice,0);
//            
//        };
//        xhr.send();
//        
//        function rollNextNotice() {
//            requestAnimationFrame(rollNotice);
//        }
//        
//        function rollNotice(time){
//            var diff = (previousFrame !== null? time-previousFrame : 0);
//            previousFrame = time;
//            currentNoticeTop +=(diff/1000)*velocityPerSecond;
//            if(currentNoticeTop*velocityPerSecond >= currentIndex * -subjectHeight*velocityPerSecond) {
//                if(currentIndex === maxIndex || currentIndex === 0) {
//                    currentRollingUp = !currentRollingUp;
//                    velocityPerSecond = -velocityPerSecond;
//                }
//                
//                currentNoticeTop = currentIndex * -subjectHeight;
//                currentIndex += (currentRollingUp ? -1 : 1);
//                previousFrame = null;
//                
//                setTimeout(rollNextNotice,1000);
//            } else {
//
//                requestAnimationFrame(rollNotice);
//            
//            }
//            ulNotice.style.top = currentNoticeTop + "px";
//        }
        
          var ulNotice = document.getElementById("keyword-list"),
                currentNoticeTop = 0,
                currentIndex = 0,
                maxIndex = ulNotice.getElementsByClassName("fs-search-keyword-item").length-1,
                currentRollingUp = true,
                subjectHeight = 25,
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
                    
                    setTimeout(rollNextNotice, 1000);
                    
                } else {

                    requestAnimationFrame(rollNotice);
                }
                ulNotice.style.top = currentNoticeTop + "px";
            }
     
    }
    
    
}());