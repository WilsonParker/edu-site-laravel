document.domain = window.location.protocol+"//"+window.location.host;
function onLoadFunc(str) {
    var fa = parent.document.frmListen.log_num.value;
    parent.document.frmListen.log_num.value = fa + str + ',';
}

let videoTag;
$(function() {
    onLoadFunc(now_page);
    window.addEventListener('message', function (e) {
        console.log(e.data);
        switch (e.data.key) {
            case 'init' :
                videoTag = document.getElementsByTagName('video')[0];
                if (videoTag != undefined) {
                    $('.video_select').show();
                } else {
                    $('.video_select').hide();
                }
                break;
            case 'changeRate' :
                videoHelper.player.changeSpeed(videoTag, e.data.data);
                break;
            case 'url' :
                callParent('url', window.location.href);
                break;
        }
    });
});

function callParent(key, data) {
    window.parent.postMessage({
        key: key,
        data : data,
    }, '*');
}
