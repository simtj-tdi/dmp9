/**
 * Created by user on 2018-02-22.
 */

function ajaxRequest (url, type, data, successfunc, errofunc) {
    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'json',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: successfunc,
        error: errofunc
    });
}

//iPhone Check
function isIos() {
    var userAgent = navigator.userAgent.toLocaleLowerCase();
    return userAgent.match(/iphone/) ? true : (userAgent.match(/ipad/) ? true : (userAgent.match(/ipod/) ? true : false));
}

function hideURLbar(node) {
    var scrollNode = document.getElementById(node);
    scrollNode.scrollTo(0,1);

}



window.onload = function(){

    // if(navigator.userAgent.indexOf('iPhone') != -1) {
    //     addEventListener('load',function(){
    //         setTimeout(hideURLbar,0);
    //     },false)
    // } else {
    //     hideURLbar();
    // }


}