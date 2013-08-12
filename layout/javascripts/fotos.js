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