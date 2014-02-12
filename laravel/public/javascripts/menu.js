Menu = (function(){
	var activeClass = 'active-sub-menu',
		$mainMenu;

	function collapse(){
		$('.' + activeClass).removeClass(activeClass);
	}

	function showSubMenu(e){

		// Stop bubbling up the DOM.
		e.stopPropagation();
		e.preventDefault();

		// Check if event is already handled
        if(e.handled !== true) {
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

            e.handled = true;
        } else {
            return false;
        }
	}

	function showMenu(e){
		// Stop bubbling up the DOM.
		e.stopPropagation();
		e.preventDefault();

		// Check if event is already handled
        if(e.handled !== true) {
			$mainMenu.toggleClass('main-menu-active');
            e.handled = true;
        } else {
            return false;
        }
	}

	return {
		// Initializes the menu
		// TODO IMPLEMENT TOUCH START!!
		init: function(menu, carets, toggler) {
			$mainMenu = menu;

			carets.on('click touchstart', showSubMenu);
			toggler.on('click touchstart', showMenu);


			menu.click(function(e){
				e.stopPropagation();
			});

			// Remove menu when document clicked or when escape is pressed
			$('html').on({
				click: collapse,
				keyup: function(e) {
					// Check for escape
					if (e.keyCode == 27) { collapse(); }
				}
			});
		}
	}
})();