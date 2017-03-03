function initHashNavigation(offset){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
		var $target = $(target);
			
		if (!$target.length) return;

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top - Utils.readOrExecute(offset)
	    }, 900, 'swing', function () {
			if(history.pushState) {
				history.pushState(null, null, target);
			}
			else {
				window.location.hash = target;
			}
		});
	});
}