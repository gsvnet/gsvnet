
/*
 * SLIDESHOW OBJECT
 * usage:
 *  var slideshow = new Slideshow([parent element jquery node]);
 */

function Slideshow(slideshow_parent) {

	// CONSTANTS
	this.SWIPE_THRESHOLD = 10; // in pixels

	// VARIABLES
	this.pos = 0;

	this.slideshow_parent = slideshow_parent,
	this.slideshow = this.slideshow_parent.find('.article-slideshow').eq(0),
	this.slideshow_wrapper = this.slideshow_parent.find('.article-slideshow-wrapper').eq(0),
	this.item = this.slideshow.children('figure'),
	this.size = this.item.length,
	this.pos = 0,
	this.width = this.slideshow_parent.width(),
	this.margin = parseInt(this.item.eq(1).css('margin-left')),
	this.left = this.slideshow_parent.find('.slideshow-nav-left'),
	this.right = this.slideshow_parent.find('.slideshow-nav-right'),
	this.touch = "ontouchend" in document;

	// calculate slideshow initial width
	this.calculateWidth();

	// hide the arrows and load them after the images loaded (so that they are perfectly centered)
	this.left.hide();
	this.right.hide();

	var thisRef = this,
			touch = "ontouchend" in document;

	// preload the images (shows loading spinner gif while at it)
	/*this.slideshow_parent.preload({
		onFinish: function() {
			thisRef.showArrows();
		}
	});*/

	this.showArrows();

	// recalculate the slideshow width on resize
	$(window).resize(function() {
		var width = thisRef.slideshow_parent.width();

		// triggers when the window is resized to a smaller size than the slideshow
		if(thisRef.width != width && thisRef.width != null && width != null) {
			thisRef.width = width;
			thisRef.calculateWidth();

			// adjust slide position
			thisRef.changeToSlide(thisRef.pos);
		}
	});

	// change slide when the user clicks the arrows
	this.left.click(function(e) {
		e.preventDefault();
		thisRef.changeSlide(-1);
	});

	this.right.click(function(e) {
		e.preventDefault();
		thisRef.changeSlide(1);
	});

	// event listeners for non-touch devices
	if(!touch) {
		// change slide when the user clicks the image
		this.item.find('img').click(function() {
			thisRef.changeSlide(1);	
		});

	// event listeners for touch devices
	} else {
		// toggle 'animate' class, so that when the user presses the arrows it slides the slideshow
		this.slideshow.addClass('animate');

		/* make slideshow slidable with gestures */
		var originalX = null,
				pos = 0,
				totalMovY = 0,
				previousY = null,
				xMov = false;

		// move 0px to prevent flicker on first usage 
		this.moveSlideshow(0);

		this.slideshow_wrapper.bind('touchstart', function() {
			originalX = null,
			pos = 0,
			previousY = null,
			totalMovY = 0,
			xMov = false;

			thisRef.slideshow.removeClass('animate');
		});

		this.slideshow_wrapper.bind('touchmove', function(event) {
			var e = event.originalEvent,
					x = e.touches[0].pageX - thisRef.slideshow_wrapper.offset().left,
					y = e.touches[0].pageY - thisRef.slideshow_wrapper.offset().top;


			if(originalX == null) {
				originalX = x;
			}

			if(previousY == null)
				previousY = y;

			totalMovY += Math.abs(y - previousY);

			pos = x - originalX;

			if(!xMov && totalMovY < thisRef.SWIPE_THRESHOLD && Math.abs(x - originalX) > thisRef.SWIPE_THRESHOLD) {
				xMov = true;
				originalX = x;
			} else if(xMov && (!((thisRef.pos == 0 && pos > thisRef.width/3) || (thisRef.pos == thisRef.size-1 && pos < -thisRef.width/3))))
				thisRef.moveSlideshow(-1*thisRef.pos*thisRef.width + pos);

			if(xMov)
				return false;

		});

		this.slideshow_wrapper.bind('touchend', function() {
			if(xMov && (!((thisRef.pos == 0 && pos > 40) || (thisRef.pos == thisRef.size-1 && pos < -40)))) {
				if(pos/thisRef.width < -0.1)
					thisRef.pos++;
				else if(pos/thisRef.width > 0.1)
					thisRef.pos--;
			}

			thisRef.slideshow.addClass('animate');
			thisRef.moveSlideshow(-thisRef.pos*thisRef.totalwidth());
		});
	}
}

Slideshow.prototype.changeToSlide = function(pos) {
	this.pos = pos;

	if(!this.touch)
		this.slideshow.animate({'margin-left': -1*this.pos*this.totalwidth()}, 200);
	else
		this.moveSlideshow(-1*this.pos*this.totalwidth());
}

Slideshow.prototype.changeSlide = function(direction) {
	if(direction == 1 && this.pos == this.size-1)
		this.pos = 0;
	else if(direction == -1 && this.pos == 0)
		this.pos = this.size-1;
	else
		this.pos += direction;

	if(!this.touch)
		this.slideshow.animate({'margin-left': -1*this.pos*this.totalwidth()}, 200);
	else
		this.moveSlideshow(-1*this.pos*this.totalwidth());
}

Slideshow.prototype.moveSlideshow = function(x) {
	this.slideshow.css('-webkit-transform', 'translate3d(' + x + 'px, 0, 0)');
	this.slideshow.css('transform', 'translate3d(' + x + 'px, 0, 0)');
}

Slideshow.prototype.showArrows = function() {
	this.left.fadeIn(400);
	this.right.fadeIn(400);
}

Slideshow.prototype.calculateWidth = function() {
	this.item.css('width', this.width);
	this.slideshow.css('width', this.size * this.totalwidth());
}

Slideshow.prototype.totalwidth = function() {
	return this.width + this.margin;
}