var TouchOnCarousel = (function()
{
	function enableOn(swipeElement, carousel)
	{
		swipeElement.swipe( {
			//Generic swipe handler for all directions
			swipeLeft: function() {
				carousel.carousel('next'); 
			},
			swipeRight: function() {
				carousel.carousel('prev'); 
			},
			
			threshold:5
		});
	}
	
	return {
		enableOn: enableOn
	};
})();