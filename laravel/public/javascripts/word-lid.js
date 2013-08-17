WordLid = (function(){
	var previewEl = $('#preview-image'),
	    fileField = $('#inputImage'),
	    canvas = $('<canvas />').get(0),
	    width = 300,
	    ctx, url;

	function imageLoad(img) {
		ratio = img.height/img.width;
		canvas.height = ratio*width;
		ctx.drawImage(img,0,0,img.width,img.height,0,0,width,ratio*width);
	}

	function init(){
		var img = new Image();

		// Initialize canvas
		canvas.width = canvas.height = width;
		previewEl.addClass('visible').append(canvas);

		ctx = canvas.getContext('2d');

		// Set default image
		img.onload = function() {
			imageLoad(img)
		}
		img.src = '/images/persoon.png';

		// Check if a file is selected
		fileField.change(function(e){
			var img = new Image();
			url = URL.createObjectURL(e.target.files[0]);
			img.onload = function() {
				imageLoad(img)
			}
			img.src = url;
		});

		// Check if a name is entered
		$('#input-voornaam').blur(function(){
			//alert('hallo ' + this.value);
		});

	}

	return {
		init: init
	}
})();

WordLid.init();