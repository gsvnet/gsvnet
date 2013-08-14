(function(){
	var previewEl = $('#preview-image'),
	    inputEl = $('#input-image'),
	    img = $('<img>')

	previewEl.append(img);

	$('#input-image').change(function(evt){
		var oFReader = new FileReader();

		oFReader.readAsDataURL(evt.target.files[0]);

		oFReader.onload = function (oFREvent) {
			img.attr('src', oFREvent.target.result);
		};
	});
})();