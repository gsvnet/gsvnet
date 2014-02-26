app = (function() {
	var pages = {
		'home-page': home,
		'user-index-page': userIndex,
		'become-member-page': becomeMember,
		'committees-page': committees,
		'albums-page': photos,
		'album-page': photos,
		'user-list-page': userListPage
	}

	function home() {

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