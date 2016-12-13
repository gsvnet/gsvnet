var Upload = (function () {
    var fileInput = document.getElementById('imgur-file-upload');
    var dropZone = document.getElementById('forum-editor-form');
    var outputElement = document.getElementById('body');
    var helpText = document.getElementById('imgur-help-text');
    var maxWidth = 631;

    function handleImage(file) {
        helpText.innerHTML = 'bezig...';
        var canvas = document.createElement('canvas');

        loadImage.parseMetaData(file, function (data) {
            var options = {canvas: true};

            if (data.exif) {
                options.orientation = data.exif.get('Orientation');
            }

            loadImage(file, function (rotated) {
                console.log('hoi 1');
                var width = Math.min(rotated.width, maxWidth);
                var height = rotated.height * width / rotated.width;
                canvas.width = width;
                canvas.height = height;

                pica.resizeCanvas(rotated, canvas, function() {
                    console.log('hoi 2');
                    canvas.toBlob(function(blob) {
                        console.log('hoi 3');
                        var request = new XMLHttpRequest();
                        var formData = new FormData();

                        formData.append('type', 'file');
                        formData.append('image', blob);

                        request.open('POST', 'https://api.imgur.com/3/image', true);
                        request.setRequestHeader('Authorization', 'Client-ID c9fd3e097596f79');
                        request.setRequestHeader('Accept', 'application/json');
                        request.addEventListener('load', function() {
                            console.log('hoi 4');
                            helpText.innerHTML = 'klik of sleep';
                            var response = JSON.parse(this.responseText);
                            var link = response.data.link.replace(/^http:/, '');
                            outputElement.value += "\n![beschrijving](" + link + ")";
                        });
                        request.send(formData);
                    }, file.type, 0.8);
                });
            }, options);
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