WordLid = (function(){
	var elements = {
			previewWrap: $('#preview-image'),
			fileField: $('#photo_path'),
			form: $('#become-member'),
			submitButton: $('#submit'),
			canvas: document.createElement('canvas'),
			parentRadioButtons: $('input[type=radio][name=parents-same-address]'),
			parentsFormWrapper: $('#parents-info'),
			formRegOrLog: $('#register-or-login')
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

	function clickTab() {

	}

	function initTabsForLoginOrRegister() {
		var activeTab = '#login-form';
		var $login = $('<a data-tab="#login-form" href="#login-form" class="tab active">Login</a>');
		var $register = $('<a data-tab="#register-form" href="#register-form" class="tab">Registreer</a>');
		var $wrapWrap = $('<div class="column-holder outer-tab-wrap"></div>');
		var $tabWrap = $('<div class="tabs"></div>').appendTo($wrapWrap);

		var $registerForm = $('#register-form');
		var $loginForm = $('#login-form');

		$loginForm.addClass('active-tab-content');
		$tabWrap.append($login).append($register);
		elements.formRegOrLog.before($wrapWrap);

		$login.add($register).click(function(){
			var to = $(this).data('tab');

			if(to == activeTab) return false;

			$login.removeClass("active");
			$register.removeClass("active");
			$(activeTab).removeClass('active-tab-content');

			activeTab = to;

			$(this).addClass('active');
			$(to).addClass('active-tab-content');


			return false;
		})

	}

	function init() {
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

		// Check if register-form and login-form exist
		if(elements.formRegOrLog.length == 1)
		{
			initTabsForLoginOrRegister();
		}
	}

	return {
		init: init
	}
})();