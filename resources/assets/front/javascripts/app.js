app = (function() {
	var pages = {
		'home-page': home,
		'become-member-page': becomeMember,
		'committees-page': committees,
		'committee-page': committees,
		'albums-page': photos,
		'album-page': photos,
		'user-list-page': userListPage,
		'senates-page': senate,
		'senate-page': senate,
		'events-page': events,
		'event-page': events,
		'edit-profile-page': editProfile,
		'thread-page': thread,
		'thread-index-page': threadsIndex,
		'thread-search-page': threadsIndex,
		'thread-create-page': createAndUpdateThread,
		'thread-update-page': createAndUpdateThread,
	}

	function home() {
		var videoSlide = $('#homepage-video-slide'),
		    videoPlayingClass = 'video-playing',
		    video = document.getElementById('home-video'),
		    homeCarousel = $('#homepage-carousel'),
		    play = function() {
				homeCarousel.carousel('pause');
				videoSlide.addClass(videoPlayingClass);
				video.play();
		    },
		    pause = function() {
				homeCarousel.carousel('cycle');
				videoSlide.removeClass(videoPlayingClass);
				video.pause();
		    };

		if( video ) {
			// Play/pause video on click.
			$('#play-video-link').click(function(){
				if (video.paused) {
					play();
				} else {
					pause();
				}
			});

			// Pause video if it is playing
			homeCarousel.on('slide.bs.carousel', function () {
				if(!video.paused)
				{
					pause();
				}
			});
		}

		TouchOnCarousel.enableOn(homeCarousel.first('.carousel-inner'), homeCarousel);
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
				
				// ugly timeouts
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
			valueNames: ['committee', 'slug'], 
  			plugins: [ 
  				['fuzzySearch', {threshold: 1, distance: 100}]
  			] 
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
		$searchForm = $('#user-search-form');

		$('#user-search-form-toggler').click(function(){
			$searchForm.toggleClass('visible');
		});
	}

	function overall() {
		$mainMenu = $('#main-menu');

		$('#login-link').magnificPopup({
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

	function thread() {
		Forum.initThreadPage();
		Forum.loadDeferredAvatars();
        Forum.initLikes();
	}

	function threadsIndex() {
		Forum.loadDeferredAvatars();
	}

	function createAndUpdateThread()
	{
		Forum.initCreateOrUpdatePage();
	}

	return {
		// Boostraps javascripts for specific pages
		init: function() {
			var id = document.body.id;

			// First execute overall scripts
			overall();

			// Then check if page specific scripts must be executed
			if(pages[id]) {
				pages[id].call();
			}
		}
	}
})();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

app.init();
