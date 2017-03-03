var ListToMenu = (function(){

	function menuChange() {
		window.location = $(this).find("option:selected").val();
	}

	function init($menu, options) {
		// Create the dropdown base
		$select = $('<select />').addClass('select-from-list');

		// Change page when selecting a menu
		$select.change(menuChange);

		// Create default option 'Go to...'
		$('<option />', {
			'value'   : '',
			'text'    : options.defaultText

		}).appendTo($select);

		// Populate dropdown with menu items
		$menu.find('a').each(function() {
			var el = $(this);
			$('<option />', {
				'value'   : el.attr('href'),
				'text'    : el.text()
			}).prop('selected', el.hasClass(options.activeClass)).appendTo($select);
		});

		$menu.after($select);
	}

	return {
		init: init
	};
})();