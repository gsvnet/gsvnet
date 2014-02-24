WordLid = (function(){
	var elements = {
			previewWrap: $('#preview-image'),
			fileField: $('#potential-image'),
			form: $('#become-member'),
			submitButton: $('#submit'),
			canvas: document.createElement('canvas'),
			parentRadioButtons: $('input[type=radio][name=parents-same-address]'),
			parentsFormWrapper: $('#parents-info')
		},
		width = 308, 
		url, ctx;

	function parentsRadioButtonInit() {
		// Hide parent address form if potential lives with his parent
		elements.parentRadioButtons.change(function(){
			if($(this).val() == '1') {
				elements.parentsFormWrapper.slideUp('fast');
			} else {
				elements.parentsFormWrapper.slideDown('fast');
			}
		});

		// Check value on load
		if(elements.parentRadioButtons.filter(':checked').val() == '1') {
			elements.parentsFormWrapper.hide();
		} else {
			elements.parentsFormWrapper.show();
		}
	}

	function handleImage(canvas) {
		elements.previewWrap.addClass('has-image').html(canvas);
	}

	function init() {
		var img = new Image();

		// Initialize canvas wrapper
		elements.previewWrap.addClass('visible');

		// Check if a file is selected
		elements.fileField.change(function(e){
			if(e.target.files && e.target.files[0]) {
				loadImage(e.target.files[0], handleImage, {
					maxWidth: width,
					canvas: true,
					orientation: true
				});
			}
		});

		// Open image browser when clicking preview area
		elements.previewWrap.click(function() {
			elements.fileField.click()
		});

		// Initialise parents radio button effects
		parentsRadioButtonInit();

		// Disable the submit button when clicked
		elements.form.submit(function() {
			elements.submitButton.addClass('disabled').val('Verzenden...');
		});

	}

	return {
		init: init
	}
})();