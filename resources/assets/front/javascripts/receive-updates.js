function message(messageText) {
    var snackbar = $('<a href="/forum" class="snackbar"/>').text(messageText);
    $(document.body).append(snackbar);

    snackbar.delay(1000).fadeOut('slow');
}

if(typeof USER_ID !== 'undefined') {
    var updates = io.connect('https://broadcast.gsvnet.nl');

    updates.on('activity:app.reply', function (data) {
        if(data.user_id != USER_ID) {
            message('Reactie van ' + data.username + ' in ' + data.subject);
        }
    });

    updates.on('activity:app.thread', function(data) {
        if(data.user_id != USER_ID) {
            message('Nieuw topic van ' + data.username);
        }
    })
}