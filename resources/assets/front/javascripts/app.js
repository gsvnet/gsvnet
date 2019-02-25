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
		'reply-update-page': updateReply
	};

	function home() {
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        
        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        
        function checkCookie(cname) {
            return getCookie(cname) != "";
        }
        
        if(!checkCookie('newsOverlay')) {
            $('#newsOverlay').removeClass('hidden');
            setCookie('newsOverlay', true, 30);
        }
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
        var prevIndex;
        var prev = $('[rel="prev"]');
        var next = $('[rel="next"]');
        var prevUrl = prev.attr('href');
        var nextUrl = next.attr('href');

        var hasNextUrl = nextUrl !== undefined;
        var hasPrevUrl = prevUrl !== undefined;

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
			},
            callbacks: {
                change: function () {
                    if(
                        hasPrevUrl 
                        && prevIndex == 0 
                        && this.index == this.items.length - 1
                    ) {
                        location.href = prevUrl;

                    } else if(
                        hasNextUrl 
                        && prevIndex == this.items.length - 1 
                        && this.index == 0
                    ) {
                        location.href = nextUrl;

                    }

                    prevIndex = this.index;
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

		Messages.init();
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
		Forum.loadDeferredAvatars();
	}

	function updateReply()
	{
		Forum.loadDeferredAvatars();
		Forum.initEditor();
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
