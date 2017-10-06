Messages = (function(){

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

    function init() {
         if(typeof notificationsUrl === 'undefined') {
            console.log('No notifications url!');
            return;
        }

        var updates = io.connect(notificationsUrl);

        $indicator = $('.online-indicator').first();

        if ($indicator) {
            $indicator.addClass('online-indicator--online');
            $counter = $('.online-number').first();
            $term = $('.online-number-term').first();

            updates.on('online', function(data) {
                $counter.text(data);
                $term.text(data == 1 ? "GSV'er" : "GSV'ers");
            });
        }

        if(typeof USER_ID === 'undefined') {
            return;
        }

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
        });
    }

    return {
        init: init
    };
})();