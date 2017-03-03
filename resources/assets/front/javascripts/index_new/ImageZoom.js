class ImageZoom {

    constructor({
        imageFrame,
        animArea = {top: 0, bottom: 100, left: 0, right: 100},
        animTime = 3000,
        animStartDelay = 5000,
        animDistance = {xMin: 20, yMin: 15},
        animTreshold = 1,
        animLoopCount = 10,
        zoom = 2,
        transitionDuration = .5
    }){
        this.$frame = $(imageFrame);
        this.$img = this.$frame.find('img').first();

        this.settings = {
            zoom,
            transitionDuration,
            animArea,
            animTreshold,
            animTime,
            animStartDelay,
            animDistance,
            animLoopCount
        };

        this.mouseOverImage = false;
        this.animating = false;
        this.animation = null;

        this.multiplyTransitionDuration(1);
        
        this.$img.on('mouseenter', () => this.mouseEnter()
        ).on('mouseleave', () => this.mouseLeave()            
        ).on('mousemove', e => this.mouseMove(e));

        this.$frame.parent().fracs((now, previously) => this.fracs(now, previously));
    }

    zoomIn() {
        this.$img.css('transform', `scale(${this.settings.zoom})`);
    }

    zoomNormal() {
        this.$img.css('transform', 'scale(1)');
    }

    setCenter(x = 50, y = 50) {
        this.$img.css('transform-origin', `${x}% ${y}%`);
    }

    getCenter() {
        let match = this.$img.css('transform-origin').match(/([\d\.]+)px\s?([\d\.]+)px/);

        if(match !== null) {
            let [, xPos, yPos] = match,
                x = xPos / this.$img.width() * 100,
                y = yPos / this.$img.height() * 100;
            return {x, y};
        }

        return {x: 50, y: 50};
    }

    multiplyTransitionDuration(multiplier) {
        this.$img.css('transition', `all ${multiplier*this.settings.transitionDuration}s`);
    }

    startAnimation(delayMultiplier) {
        if (this.animating) return;

        this.animating = true;
        this.loopCount = 0;
        
        this.startDelayTimer = setTimeout( () => {
            // Check whether the animation has been interrupted
            if (!this.animating) {
                return;
            }

            this.zoomIn();
            this.multiplyTransitionDuration(3);

            let startLoop = () => {
                if(this.loopCount >= this.settings.animLoopCount){
                    this.stopAnimation(true);
                    return
                }
                
                let ad = this.settings.animDistance,
                    curFocus = this.getCenter(),
                    newFocus;

                {
                    let minDistance = new Rectangle(curFocus.x - ad.xMin, curFocus.y - ad.yMin, ad.xMin * 2, ad.yMin * 2),
                        {top, bottom, left, right} = this.settings.animArea;

                    // Increase chance of picking edge pixels on the x-axis
                    if (Utils.chance(.2)) {
                        console.log('Picking edge');
                        newFocus = {
                            y: Utils.randInt(top, bottom)
                        };

                        if (Utils.chance(.5)) {
                            // Left edge
                            newFocus.x = left;
                            console.log('left');
                        } else {
                            //Right edge
                            newFocus.x = right;
                            console.log('right');
                        }
                    } else {
                        do {
                            newFocus = {
                                x: Utils.randInt(left, right),
                                y: Utils.randInt(top, bottom)
                            };
                            console.log('Pick position iteration');
                        } while (minDistance.contains(newFocus.x, newFocus.y));
                    }
                }

                this.setCenter(newFocus.x, newFocus.y);
                this.loopCount++;
                console.log(newFocus.x, newFocus.y);
                return startLoop;
            }
            console.log('assigning new interval');
            
            // Prevent rogue interval
            clearInterval(this.animation);
            this.animation = setInterval(startLoop(), this.settings.animTime);
        }, delayMultiplier * this.settings.animStartDelay);
    }

    stopAnimation(restart) {
        this.animating = false;
        this.multiplyTransitionDuration(1);
        clearInterval(this.animation);
        clearTimeout(this.startDelayTimer);
        this.loopCount = 0;
        this.setCenter();
        this.zoomNormal();

        if(restart) {
            this.startAnimation(1.5);
        }
    }

    /* Event handlers */
    mouseEnter() {
        this.mouseOverImage = true;
        this.stopAnimation();
        this.zoomIn();
    }

    mouseLeave() {
        this.mouseOverImage = false;
        this.zoomNormal();
        this.startAnimation(1);
    }

    mouseMove(e) {
        let offset = this.$frame.offset(),
            relX = e.pageX - offset.left,
            relY = e.pageY - offset.top,

            percX = Math.round(relX / this.$frame.width() * 100),
            percY = Math.round(relY / this.$frame.height() * 100);
        this.setCenter(percX, percY);
    }

    fracs(now, previously) {
        if(now.visible >= this.settings.animTreshold && !this.animating) {
            this.startAnimation(1);
        } else if (now.visible < this.settings.animTreshold && this.animating){
            this.stopAnimation();
        }
    }
} 