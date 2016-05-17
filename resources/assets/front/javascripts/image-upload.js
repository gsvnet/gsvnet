var Upload = (function () {
    var fileInput = document.getElementById('imgur-file-upload');
    var dropZone = document.getElementById('reply-form');
    var outputElement = document.getElementById('body');
    var helpText = document.getElementById('imgur-help-text');
    var maxWidth = 631;

    function handleImage(file) {
        helpText.innerHTML = 'bezig...';
        var canvas = document.createElement('canvas');
        var img = new Image;
        img.src = URL.createObjectURL(file);
        img.addEventListener('load', function() {
            var width = Math.min(img.width, maxWidth);
            var height = img.height * width / img.width;
            canvas.width = width;
            canvas.height = height;

            pica.resizeCanvas(img, canvas, function() {
                canvas.toBlob(function(blob) {
                    var request = new XMLHttpRequest();
                    var formData = new FormData();

                    formData.append('type', 'file');
                    formData.append('image', blob);

                    request.open('POST', 'https://api.imgur.com/3/image', true);
                    request.setRequestHeader('Authorization', 'Client-ID c9fd3e097596f79');
                    request.setRequestHeader('Accept', 'application/json');
                    request.addEventListener('load', function() {
                        helpText.innerHTML = 'klik of sleep';
                        var response = JSON.parse(this.responseText);
                        var link = response.data.link.replace(/^http:/, '');
                        outputElement.value += "\n![beschrijving](" + link + ")";
                    });

                    // request.upload.addEventListener('progress', function(e) {
                    //     if (e.lengthComputable) {
                    //         // do something with (e.loaded / e.total) * 100;
                    //     }
                    // });
                    request.send(formData);
                }, "image/jpeg", 0.8);
            });
        });
    }

    dropZone.addEventListener("dragover", function(e) {
        e.preventDefault();
    }, true);

    dropZone.addEventListener("drop", function(e) {
        e.preventDefault();
        handleImage(e.dataTransfer.files[0]);
    }, true);

    fileInput.addEventListener('change', function handleFiles(e) {
        handleImage(e.target.files[0]);
    });
})();