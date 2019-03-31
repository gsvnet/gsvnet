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
            $this = $(this);
			$parent = $this.parent();

			// Check if current menu is active
			if($parent.hasClass(activeClass)){
                $this.attr('aria-expanded', false);
				$parent.removeClass(activeClass);
			} else {
				// Remove active class from other menu
				collapse();

				// Make menu active
                $this.attr('aria-expanded', true);
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

	function initColorShifts() {
        $(".top-level-link").css("transition", "background-color 5s");
        $(".active-menu").css("transition", "background-color 5s");
        $(".top-header").css("transition", "background-color 5s");
        $(".nav-toggle").css("transition", "background-color 5s");
        $(".button").css("transition", "background-color 5s");
        changeColor();
        window.setInterval(changeColor, 10000);
	}

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

	function changeColor() {
		var color = getRandomColor();

		$mainMenu.css("background-color", color);
		$(".top-level-link").css("background-color", color);
        $(".active-menu").css("background-color", color);
        $(".top-header").css("background-color", color);
        $(".nav-toggle").css("background-color", color);
        $(".button").css("background-color", color);
	}

	return {
		// Initializes the menu
		init: function(menu, carets, toggler) {
			$mainMenu = menu;

			initColorShifts();

			if(Modernizr.touch)
			{
				carets.on('touchstart', showSubMenu);
				toggler.on('touchstart', showMenu);
			} else {
				carets.on('click', showSubMenu);
				toggler.on('click', showMenu);				
			}

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