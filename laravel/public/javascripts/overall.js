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
		$mainMenu.slideToggle(100);
	});

	$('.top-caret').click(function(){
		$this = $(this);
		$this.toggleClass('active-caret');
		$this.next().slideToggle(100);
	})
});