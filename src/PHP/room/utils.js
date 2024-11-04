// utils.js
function isSafari() {
    var ua = navigator.userAgent.toLowerCase();
    return ua.includes('safari') && !ua.includes('chrome');
}
