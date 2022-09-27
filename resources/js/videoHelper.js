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
                        addScript('https://study-laravel-project.co.kr/vod/js/one_script.js', data.iframeBody, function () {
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
