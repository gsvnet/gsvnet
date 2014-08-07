Dropzone.autoDiscover = false;

Dropzone.options.uploadmultiple = {
  paramName: "photo", // The name that will be used to transfer the file
  maxFilesize: 12, // MB
  acceptedFiles: 'image/*',
  autoProcessQueue: false,
  dictDefaultMessage: 'Sleep hier bestanden in of klik gewoon',
  addRemoveLinks: true,
  complete: function() {
  	this.processQueue();
  }
};

$(document).ready(function(){
	var form = $('#uploadmultiple');
	if(form.length == 1)
	{
		var theDropzone = new Dropzone(form.get(0));
		var btn = $('<button class="btn btn-success"><i class="fa fa-check"></i> Uploaden die hap</button>');

		form.submit(function(){
			theDropzone.processQueue();

			return false;
		});

		btn.click(function(){
			theDropzone.processQueue();
		});

		form.after(btn);

	}
});