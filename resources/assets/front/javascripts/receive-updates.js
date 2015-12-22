(function(){

    var counter = 0,
        oldTitle = document.title;

    function message(messageText) {
        var snackbar = $('<a href="/forum" class="snackbar"/>').text(messageText);
        $(document.body).append(snackbar);

        snackbar.delay(4000).fadeOut('slow');
    }

    function setTitle() {
        document.title = "(" + counter + ") " + oldTitle;
    }

    if(typeof USER_ID !== 'undefined') {
        var updates = io.connect('https://notifications.gsvnet.nl/');

        updates.on('activity:app.reply', function (data) {
            if(data.user_id != USER_ID) {
                counter++;
                message('Reactie van ' + data.username + ' in ' + data.subject);
                setTitle();
            }
        });

        updates.on('activity:app.thread', function(data) {
            if(data.user_id != USER_ID) {
                counter++;
                message('Nieuw topic van ' + data.username);
                setTitle();
            }
        })
    }
})();