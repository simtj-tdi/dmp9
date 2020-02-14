
function marketTitleSplit() {
    
    $('.fs-target-list-box').each(function(index){

        
        var marketTitle = $(this).find('.title-text-hidden').val(),
            titleSplit = marketTitle.split('_'),
            mainTitle = $('.title-text');
        
        if($.isNumeric(titleSplit[1])) {
          $(this).find('.title-text').text(marketTitle);
        }else {
            $(this).find('.title-text').text(titleSplit[0]);
            $(this).find('.fs-place-list').append('<li class="fs-place">' + titleSplit[1]+'<li>');
        }
        
        
        //console.log(titleSplit);        
        
  
    });
    
    
}







$(function(){
  

    //marketTitleSplit();

    
    
});
 