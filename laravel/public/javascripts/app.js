app = (function() {
	var pages = {
		'home-page': home,
		'user-index-page': userIndex,
		'become-member-page': becomeMember,
		'committees-page': committees,
		'albums-page': photos,
		'album-page': photos,
		'user-list-page': userListPage,
		'senates-page': senate,
		'senate-page': senate,
		'events-page': events,
		'event-page': events,
		'edit-profile-page': editProfile
	}

	function home() {

	}

	function editProfile() {
		var $btn = $('#edit-profile-submit'),
			$frm = $('#edit-profile-form'),
			companies = ['Google', 'NSA', 'Facebook'],
			company;

		// Select random entry
		company = companies[Math.floor(Math.random() * companies.length)];

		// Set event on button click 
		$btn.click(function(){

			if(Math.random() < 0.3) {
				$this = $(this);
				$btn.addClass('disabled').val('Gegevens opslaan.');
				
				setTimeout(function(){
					$btn.val(['Gegeven verkopen aan ', company, '.'].join(''));
					setTimeout(function(){
						$btn.val(['Gegeven verkopen aan ', company, '..'].join(''));
						setTimeout(function(){
							$btn.val(['Gegeven verkopen aan ', company, '...'].join(''));
							setTimeout(function(){
								$btn.val('Transactie opslaan...');
								setTimeout(function(){
									$btn.val('Succes!');
									setTimeout(function(){
										$frm.submit();
									}, 1000);
								}, 1000);
							}, 1000);
						}, 1000);
					}, 1000);
				}, 1000);
				
				return false;
			}
		});
	}

	function senate() {

		ListToMenu.init($('#senates-list'), {
			defaultText: '(kies een senaat)',
			activeClass: 'active'
		});
	}

	function events() {
		ListToMenu.init($('#months-list'), {
			defaultText: '(kies een maand)',
			activeClass: 'active'
		});

		ListToMenu.init($('#years-list'), {
			defaultText: '(kies een jaar)',
			activeClass: 'active'
		});
	}

	function committees() {
		var list = new List('committees', {
			valueNames: ['committee']
		});
	}

	function userIndex() {
		var list = new List('user-list', {
			valueNames: ['search-users', 'phone'],
			searchClass: 'search-user-input',
			listClass: 'user-profile-list'
		});
	}

	function photos() {
		$('.photos').magnificPopup({
			delegate: '.photo-link',
			type: 'image',

			tLoading: 'Afbeelding laden #%curr%...',
			mainClass: 'mfp-img-mobile',

			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [1,1]
			},
			image: {
				tError: '<a href="%url%">De afbeelding #%curr%</a> kan niet worden geladen.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			}
		});
	}

	function becomeMember() {
		WordLid.init();
	}

	function userListPage() {
		console.log('test');
		$searchForm = $('#user-search-form');


		$('#user-search-form-toggler').click(function(){
			$searchForm.toggleClass('visible');
		});
	}

	function overall() {
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

		Menu.init($mainMenu, $('.top-caret'), $('#navbar-toggler'));
	}

	return {
		// Boostraps javascripts for specific pages
		init: function() {
			var id = document.body.id;

			$(document.body).addClass('js');

			// First execute overall scripts
			overall();

			// Then check if page specific scripts must be executed
			if(pages[id]) {
				pages[id].call();
			}
		}
	}
})();

app.init();