class Tabs {

    constructor(
        slides = [{
            template: 1,
            content: {}
        }], {
            controlsContainer,
            contentContainer
        }, {
            slotWrapperClass = 'slide-slot-wrapper',
            slotClass = 'slide-slot',
            currentClass = 'slide-current',
            nextClass = 'slide-next',
            dynamicContentClass = 'slide-dynamic',
            activeClass = 'active',
            selectedClass = 'selected',
            loadingClass = 'loading'
        } = {}
    ) {
        this.slides = slides;
        this.currentIndex;
        this.nextIndex;
        let classNames = this.classNames = {slotWrapperClass, slotClass, currentClass, nextClass, dynamicContentClass, activeClass, selectedClass, loadingClass};
        this.$controlsContainer = $(controlsContainer);
        let $content = this.$contentContainer = $(contentContainer);
        this.$slotWrapper = $content.find(`.${classNames.slotWrapperClass}`);
        this.$templates = $($content.find('template').first().prop('content'));
        this.toggling = false;

        this.analyzeTemplates();
        this.createSlots();

        this.$curSlot = $content.find(`.${classNames.currentClass}`);
        this.$nextSlot = $content.find(`.${classNames.nextClass}`);

        //this.$contentContainer.children().find('.article').wrap('<div class="slide-wrapper"></div>');
        //this.$contentContainer.children().hide();
        this.loadSlide(0);

        this.addClickHandlers();
    }

    addClickHandlers() {
        this.$controlsContainer.on('click', 'a', (e) => {            
            let index = $(e.currentTarget).index();

            this.loadSlide(index);
        });
    }

    createSlots() {
        let cn = this.classNames;
        this.$slotWrapper.html(`<div class="${cn.slotClass} ${cn.currentClass}"></div><div class="${cn.slotClass} ${cn.nextClass}"></div>`);
        this.$slotWrapper.removeClass(cn.loadingClass);
    }

    loadSlide(index) {
        if(this.toggling || index == this.currentIndex) return;

        let cn = this.classNames;
        this.$controlsContainer.children().eq(this.currentIndex).removeClass(cn.activeClass);
        this.$controlsContainer.children().eq(this.currentIndex).removeClass(cn.selectedClass);
        this.$controlsContainer.children().eq(index).addClass(cn.selectedClass);

        let curSlide = this.slides[index];
        if(typeof curSlide == 'undefined') {
            console.error('No slide data found for slide ' + index);
            return;
        }

        this.toggling = true;
        this.$controlsContainer.children().eq(index).addClass(this.classNames.activeClass);
        
        this.generateNextSlide(index);

        if (typeof this.currentIndex == 'undefined') {
            this.setSlide(index);
        } else {
            // Proceed when both animations are complete
            let animComplete = (() => {
                let count = 0;
                
                return () => {
                    count++;
                    if(count >= 2) {
                        this.setSlide(index);
                    }
                };
            })();

            let slideDirection = 1;
            if(this.nextIndex < this.currentIndex) {
                slideDirection = -1;
            }

            this.$curSlot.css(
                'left', 0
            ).stop().animate({
                left: slideDirection * -this.$curSlot.outerWidth()
            },{
                duration: 800,
                complete: animComplete
            });

            // Position next slide slot to the right edge of the screen
            this.$nextSlot.css(
                'left', slideDirection * this.$nextSlot.outerWidth()
            ).show().stop().animate({
                left: 0
            }, {
                duration: 800,
                complete: animComplete
            });
        }
    }

    setSlide(index) {
        this.$curSlot.css('left', 0);
        this.$curSlot.html(this.$nextSlot.html());
        this.$nextSlot.hide();

        this.currentIndex = index;
        this.toggling = false;
    }

    analyzeTemplates() {
        const regTest = (input) => {
            return /(\$\w+)/m.test(input);
        }

        this.$templates.children().each((undefined, template) => {
            $(template).find('*').addBack().each((undefined, templateNodes) => {
                let $curEl = $(templateNodes);
                if (!$curEl.children().length) {
                    if (regTest($curEl.text())) {
                        // Element contains content that can to be replaced by slide data
                        $curEl.addClass(this.classNames.dynamicContentClass);
                    }
                }

                if (regTest($curEl[0].style.cssText)) {
                    $curEl.addClass(this.classNames.dynamicContentClass);
                }
            });
        });
    }

    getTemplate(number) {
        return this.$templates.children().eq(number - 1);
    }

    getSlideContent(index, prop) {
        let val = this.slides[index].content[prop];
        return typeof val != 'undefined' ? val : "";
    }

    generateNextSlide(index) {
        this.nextIndex = index;
        const regReplace = ($input) => {
            return $input.replace(/(\$\w+)/gm, (match, capture1) => {
                //console.log(capture1);
                return this.getSlideContent(index, capture1);
            })
        }

        let curSlide = this.slides[index];

        let $template = this.getTemplate(curSlide.template);

        let $nextContent = $('<div></div>').append($template.clone());
        $nextContent.find(`.${this.classNames.dynamicContentClass}`).each((i, el) => {
            if (!$(el).children().length) {
                $(el).text(
                    regReplace($(el).text())
                );
            }
            //console.log($(this), $(this)[0].cssText);
            $(el)[0].style.cssText = regReplace($(el)[0].style.cssText);
        });
        this.$nextSlot.html(
            $nextContent.html()
        );
    }
}