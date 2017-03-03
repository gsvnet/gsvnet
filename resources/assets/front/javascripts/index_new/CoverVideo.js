class CoverVideo {

    constructor(container, videoId, overlay, pauseTreshold = 0, audioControls) {
        this.$container,
        this.$overlay = $(overlay),
        this.videoId = videoId;
        this.videoAspectRatio = 1;
        this.muted = true;
        this.preMuteAudio = 1;
        this.$audioControls = $(audioControls);

        // API ready event listener
        window.dmAsyncInit = () => {
            this.initPlayer(container, pauseTreshold);
        };
        this.loadAPI();
        this.getVideoAspectRatio();

        // Add event listener for audio controls
        $(audioControls).on('click', () => {
            this.toggleAudio();
        });
    }

    toggleAudio() {
        let $container = this.$audioControls.children().first(),
            $unmuted = $container.children().eq(1),
            $muted = $container.children().last();
        if(!this.muted) {
            this.muted = true;
            $unmuted.hide();
            $muted.show();
            this.preMuteAudio = this.player.volume;
            this.player.setVolume(0);
        } else {
            this.muted = false;
            $muted.hide();
            $unmuted.show();
            this.player.setVolume(this.preMuteAudio);
        }
    }

    loadAPI() {
        $('script').first().before(
            $('<script></script>').attr('src', 'https://api.dmcdn.net/all.js')
        );
    }

    initPlayer(container, pauseTreshold) {
        this.player = DM.player($(container)[0], {
            video: this.videoId,
            width: '100%',
            height: '100%',
            params: {
                'api': true,
                'autoplay': true,
                'mute': this.muted,
                'controls': false,
                'quality': ['720', '1080'],
                'endscreen-enable': false,
                'sharing-enable': false,
                'ui-logo': false,
                'ui-start-screen-info': false,
                'ui-highlight': '4f267e' //TODO: make dynamic
            }
        });

        // Placeholder container element has been replaced with player iframe
        this.$container = $(container);
        this.$container[0].allowFullscreen = false;

        this.loadOverlay();

        this.resize();
        
        // Add resize event listener
        if (Utils.isTouchDevice()) {
            fullHeightMobile(this.resize.bind(this));
        } else {
            $(window).resize(() => {
                this.resize();
            });
        }

        // Player events
        $(this.player).one('video_start', () => {
            // Player scroll control
            this.loadScrollHandler(pauseTreshold);
            // Trigger scroll event to set appropriate player settings for current scroll level
            this.$container.parent().fracs('check');
        }).on('video_end', () => {
            // Loop video
            this.player.load(this.videoId, {autoplay:true});
        });
    }

    loadScrollHandler(pauseTreshold = 0) {
        let autoPaused = false;
        // Video will mute/pause at this visible percentage
        $(this.$container.parent()).fracs((now, previously) => {
            if(now.visible <= pauseTreshold) {
                if(!this.player.paused) {
                    autoPaused = true;
                    this.player.pause();
                }
            } else {
                if(previously && previously.visible <= pauseTreshold && autoPaused) {
                    this.player.play();
                    autoPaused = false;
                }
                if(!this.muted) {
                    let volume = 1 - (1 - now.visible) * (1 / (1 - pauseTreshold));
                    if(volume > .95) volume = 1;
                    this.player.setVolume(volume);
                }
            }
        });
    }

    loadOverlay() {
        //let overlay = $('<div></div>').addClass(className);
        //this.$container.after(overlay);
        this.$overlay.click(() => {
            this.player.paused ? this.player.play() : this.player.pause();
        });
        this.$overlay.find('button, a').click((e) => {
            e.stopPropagation();
        });
        //this.overlay = overlay;
    }

    getVideoAspectRatio() {
        $.getJSON({url: `https://api.dailymotion.com/video/${this.videoId}?fields=aspect_ratio`, success: ({aspect_ratio}) => {
            this.videoAspectRatio = aspect_ratio;
        }});
    }

    resize() {
        let parent = this.$container.parent(),
            containerAspect = parent.width() / parent.height(),
            containerToVid = containerAspect / this.videoAspectRatio;

        console.log('resizing', parent, this.$container, containerAspect, this.videoAspectRatio, containerToVid);

        if(containerToVid > 1) {
            this.fillHeight(containerToVid);
        } else {
            this.fillWidth(1 / containerToVid);
        }
    }

    fillWidth(percentage) {
        console.log('filling width');
        this.$container.css({
            width: (percentage * 100) + '%',
            height: '100%',
            top: 0,
            left: (-(percentage - 1) * 100 / 2) + '%'
        });
    }

    fillHeight(percentage) {
        console.log('filling height')
        this.$container.css({
            width: '100%',
            height: (percentage * 100) + '%',
            top: (-(percentage - 1) * 100 / 2) + '%',
            left: 0
        });
    }
}