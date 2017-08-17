class InstagramFeed {
    
    constructor (settings = {
        template: '<a href="{{link}}" target="_blank" style="background-image:url(\'{{image}}\');"><img src="{{image}}" style="visibility: hidden;"><p>{{caption}}</p></a>',
        limit: {
            min: 3,
            max: 8,
            rows: 2
        },
        doubleWidth: {
            minAspectRatio: 1.4
        },
        targetId: 'instafeed',
        classNames: {
            hidden: 'hidden',
            removed: 'removed',
            double: 'double'
        }
    }) {
        this.settings = settings;

        let userFeed = new Instafeed({
            targetId: settings.targetId,
            get: 'user',
            userId: '2954757734',
            clientId: '618db5465e8c4643b2fca8d852d582f0',
            accessToken: '5718886847.618db54.739aac1e0411410d8eb8dcb2622b32b3',
            limit: settings.limit.max,
            resolution: 'standard_resolution',
            template: settings.template,
            after: this._initialize.bind(this)
        });
        userFeed.run();
    }

    _initialize () {
        this.$target = $(`#${this.settings.targetId}`);
        this.elementTag = this.$target.children().first().prop("tagName");
        this.tileCount = this.$target.children().length;
        this.doubleCount = 0;
        this.gridWidth;

        this._getAspectRatios();

        $(window).on('resize', this.realign.bind(this));
    }

    _initialized () {
        this.realign();
    }

    // Recalculate grid
    realign () {
        this._getGridWidth();
        this._doubleTiles();

        if(this.settings.limit.rows) {
            this._limitRows();
        }

        this._alignTiles();
    }

    // Get all the instagram image's aspect ratio's and store them as data attributes
    _getAspectRatios () {
        let timeoutCount = 0;
        const TIMEOUT_MAX = 40;

        let async = () => {
            // If the images aren't loaded yet, try again in a bit, as we need their proper dimensions
            if(!Utils.imgLoaded(this.$target.children().find('img').last()[0])) {
                if(timeoutCount >= TIMEOUT_MAX) {
                    console.error('The images on the instagram feed don\'t appear to be loading.');
                    return;
                }
                setTimeout(async, 100);
                return;
            }

            this.$target.children().each((i, instaPost) => {
                let $instaPost = $(instaPost),
                    $img = $instaPost.find('img');
                $instaPost.data('aspectRatio', $img.width() / $img.height());
            });

            this._initialized();
        };
        async();
    }

    _getGridWidth () {
        return this.gridWidth = Math.floor(100 / parseInt(this.$target.children().not(`.${this.settings.classNames.double}`).first().css('flex-basis')));
    }

    // Pick tiles to be double in width
    _doubleTiles () {
        let candidates = [],
            candidateCount = 0;

        this.$target.children().removeClass(this.settings.classNames.double);
        
        if(this.gridWidth > 2) {

            let desiredTileCount = this._getDesiredTileCount();

            this.$target.children().each((i, instaPost) => {
                if(i + candidateCount >= desiredTileCount) {               
                    return false;
                }

                let $instaPost = $(instaPost),
                    aspectRatio = $instaPost.data('aspectRatio'),
                    gridNumber = i + candidateCount + 1,
                    row = Math.floor(gridNumber / this.gridWidth);
                
                // Tiles at the end of a row are not eligible
                if (gridNumber / this.gridWidth == row) return true;
                
                if (
                    aspectRatio > this.settings.doubleWidth.minAspectRatio 
                    && (!candidates[row]
                    || aspectRatio > candidates[row].data('aspectRatio'))
                ) {
                    if(!candidates[row]) candidateCount++;
                    candidates[row] = $instaPost;
                }
            });

            $(candidates).each((undefined, instaPost) => {
                if(instaPost) {
                    instaPost.addClass(this.settings.classNames.double);
                }
            });

        }

        this.doubleCount = candidateCount;
    }
    
    // Limit the amount of rows that will be displayed, the post minimum takes precedence over this
    _limitRows () {
        let settings = this.settings,
            classNames = settings.classNames,
            desiredTileCount = this._getDesiredTileCount(this.doubleCount);
        
        this.$target.children().removeClass(classNames.removed);
        this.$target.children().filter(`:gt(${desiredTileCount - 1})`).addClass(classNames.removed);
    }

    // Insert dummy tiles to make sure the last row is also aligned in a proper grid
    _alignTiles () {
        let $target = this.$target,
            classNames = this.settings.classNames,
            visibleTileCount = $target.children().not(`.${classNames.hidden}, .${classNames.removed}`).length,
            mod = (visibleTileCount + this.doubleCount) % this.gridWidth,
            fillerCount = this.gridWidth - (mod ? mod : this.gridWidth);
        
        $target.find(`.${classNames.hidden}`).remove();
        for(let i=0; i<fillerCount; i++) {
            $target.append(`<${this.elementTag} class="${classNames.hidden}"></${this.elementTag}>`);
        }
    }

    _getDesiredTileCount (doubleCount = 0) {
        let settings = this.settings,
            fillableRows = Math.min(Math.floor(this.tileCount + doubleCount / this.gridWidth), settings.limit.rows);
        return Math.max(fillableRows * this.gridWidth - doubleCount, settings.limit.min);
    }
}