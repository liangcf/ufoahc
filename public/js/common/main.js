/**
 * 常用的js方法
 */

/* ajax 请求 */
function _ajax_post(url, data, cb) {
    $.ajax({
        url: url,
        type: 'post',
        async: true,
        cache: false,
        data: data,
        dataType: 'json',
        success: function (ret) {
            if(cb){
                cb(ret);
            }
        },
        error: function (e) {
            p('_ajax_post_error');
            p(e);
        }
    });
}
/* 跳转请求*/
function _my_href(url) {
    window.location.href=url;
}
/* 刷新 */
function _reload(){
    window.location.reload();
}
/* 命令打印 */
function p(ret) {
    console.log(ret);
}
/*新窗口方式打开*/
function open(url){
    window.open('http://'+window.location.host+url);
}
/*判断是否是手机*/
function _is_phone(){
    if(/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))){
        return true;
    }
    return false;
}