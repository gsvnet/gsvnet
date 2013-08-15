(function(){
	var previewEl = $('#preview-image'),
	    fileField = $('#input-image'),
	    canvas = $('<canvas />').get(0),
	    img = new Image(),
	    width = 400,
	    ctx, url;

	canvas.width = canvas.height = width;
	previewEl.append(canvas);

	ctx = canvas.getContext('2d');

	// Check if a file is selected
	fileField.change(function(e){
		url = URL.createObjectURL(e.target.files[0]);
		img = new Image();
		img.onload = function() {
			ratio = img.height/img.width;
			canvas.height = ratio*width;
			ctx.drawImage(img,0,0,img.width,img.height,0,0,width,ratio*width);
		}
		img.src = url;
	});

	// Check if a name is entered
	$('#input-voornaam').blur(function(){
		//alert('hallo ' + this.value);
	});
})();