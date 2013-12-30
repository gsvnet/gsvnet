WordLid = (function(){
	var elements = {
			previewWrap: $('#preview-image'),
			fileField: $('#potential-image'),
			form: $('#become-member'),
			submitButton: $('#submit'),
			canvas: document.createElement('canvas')
		},
		width = 308, 
		ctx, 
		url;

	function imageLoad(img) {
		ratio = img.height/img.width;
		elements.canvas.height = ratio*width;
		ctx.drawImage(img,0,0,img.width,img.height,0,0,width,ratio*width);
	}

	function init(){
		var img = new Image();

		// Initialize canvas
		elements.canvas.width = elements.canvas.height = width;
		elements.previewWrap.addClass('visible').append(elements.canvas);

		ctx = elements.canvas.getContext('2d');

		// Set default preview image
		img.onload = function() {
			imageLoad(img)
		}
		img.src = '/images/persoon.png';

		// Check if a file is selected
		elements.fileField.change(function(e){
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

		// Disable the submit button when clicked
		elements.form.submit(function() {
			elements.submitButton.addClass('disabled').val('Verzenden...');
		});

		// Open image browser when clicking preview area
		elements.previewWrap.click(function(){
			elements.fileField.click();
		});

	}

	return {
		init: init
	}
})();

WordLid.init();