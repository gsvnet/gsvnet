Menu = (function(){
	var activeClass = 'active-sub-menu';

	function collapse(){
		$('.' + activeClass).removeClass(activeClass);
	}

	return {
		// Initializes the menu
		// TODO IMPLEMENT TOUCH START!!
		init: function(menu, carets) {
			carets.click(function(e){
				// Save jQuery instance of element
				$parent = $(this).parent();

				// Check if current menu is active
				if($parent.hasClass(activeClass)){
					$parent.removeClass(activeClass);
				} else {
					// Remove active class from other menu
					collapse();

					// Make menu active
					$parent.addClass(activeClass);
				}

				// Stop bubbling up the DOM.
				e.stopPropagation();
			});

			menu.click(function(e){
				e.stopPropagation();
			});

			// Remove menu when document clicked, tapped or when escape is pressed
			$('html').on({
				click: collapse//,
				//touchstart: collapse,
				// keyup: function(e) {
				// 	// Check for escape
				// 	if (e.keyCode == 27) { collapse(); }
				// }
			});
		}
	}
})();

$(document).ready(function() {
	$mainMenu = $('#main-menu');

	$('.login-link').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});

	$('#navbar-toggler').click(function(){
		$mainMenu.toggleClass('main-menu-active');
	});

	Menu.init($mainMenu, $('.top-caret'));
});

