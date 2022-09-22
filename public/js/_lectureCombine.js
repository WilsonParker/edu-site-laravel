const videoHelper = {
    props: {
        type: [],
        validations: [],
    },
    init: function () {
        let self = this;
        this.validation.init();
        this.player.init();
    },

    validation: {
        init: function () {
            this.self = videoHelper;

            this.self.getTypes()['one'] =
                {
                    validation: (data) => {
                        return typeof data.iframe.contentWindow.Dirnumber != 'undefined';
                    },
                    callback: function (data) {
                        addScript('https://edu-site-laravel.co.kr/vod/js/one_script.js', data.iframeBody, function () {
                        });
                    }
                }
        },

        validate: function (data) {
            for (let type in this.self.getTypes()) {
                let obj = this.self.getTypes()[type];
                if (obj.validation(data)) {
                    obj.callback(data);
                }
            }
        },

        /**
         * 주소에서 차시 번호를 가져 옵니다
         * @param   url
         * @return  string
         * @author  dev9163
         * @added   2021/11/29
         * @updated 2021/11/29
         */
        extractClassNumber: function (url) {
            return url.substr(url.lastIndexOf('.') - 1, 1);
        },
    },

    player: {
        init: function () {
            this.self = videoHelper;
        },
        updatePlayer: function (iframe) {
            let iframeBody = iframe.contentWindow.document.body;

            self.validation.validate({
                iframe: iframe,
                iframeBody: iframeBody
            });
        },
        changeSpeed: function (video, rate) {
            video.playbackRate = rate;
        }
    },

    getProps: function () {
        return this.props;
    },
    getTypes: function () {
        return this.getProps().type;
    },
    getValidations: function () {
        return this.getProps().validations;
    },
};

export {videoHelper}

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
