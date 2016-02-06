var Forum = (function()
{
    var tagsDisabled = false;
    var maxTags = 3;
    var quoteLinks, replyField, submitReply;
    var urlTypes = {
        reply: '/forum/replies/%s/like',
        thread: '/forum/threads/%s/like'
    };

    function checkForMaximumTags() {
        if ($('._tag_list ._tag.active').length >= maxTags) {
            tagsDisabled = true;

            $('._tag_list ._tag').not('.active').addClass('disabled');
        } else {
            tagsDisabled = false;
            $('._tag_list ._tag.disabled').removeClass('disabled');
        }
    }

    function showTagDescriptions() {
        var checkedTags = $('._tag input:checked');
        var descriptions = [];

        checkedTags.each(function() {
            var tagDescription = $(this).parent().find('._description').text();
            descriptions.push(tagDescription);
        });

        if (descriptions.length == 0) {
            $('._tag_description_container').hide();
            return;
        }

        $('._tag_description_container').show();
        $('._tag_descriptions').text('');

        for (var i in descriptions) {
            $('._tag_descriptions').append("<li>" + descriptions[i] + "</li>");
        }
    }

    function updateTagDisplay() {
        $('._tag_list ._tag').removeClass('active');
        var tagInputs = $('._tags').find('input');

        tagInputs.each(function() {
            var tag = $(this).attr('title');
            if ($(this).prop('checked')) {
                $('a._tag[title=' + tag + ']').addClass('active');
            }
        });

        checkForMaximumTags();
        showTagDescriptions();
    }

    function toggleTag(tagText) {
        var checkbox = $('._tags ._tag[title=' + tagText + '] input');

        if (checkbox.prop('checked')) {
            checkbox.prop('checked', false);
        } else {
            checkbox.prop('checked', true);
        }

        updateTagDisplay();
    }

    function bindTagChooser() {
        // each click of a tag link togs the tag
        $('a._tag').click(function(e) {
            e.preventDefault();
            if ( ! $(this).hasClass('disabled')) {
                toggleTag($(this).attr('title'));
            }
        });

        // set up initial state
        updateTagDisplay();
    }

    function questionSelectToTag() {
        var tags = $('._question_tags').find('input');

        tags.each(function() {
            if ($(this).prop('checked')) {
                $(this).closest('label').addClass('selected');
            }
        });

        $('._question_tags input').change(function() {
            $('._question_tags .selected').removeClass('selected');
            $(this).closest('label').addClass('selected');
        })
    }

    function formatForumQuote(author, quote)
    {
        // add author name
        quote = "**" + author + "** schreef:\n\n" + quote;

        // add markdown quote tags
        quote = quote.replace(/^/g, ">");
        quote = quote.replace(/\n/g, "\n>");
        quote = quote + "\n\n";

        return quote;
    }

    function bindQuoteLinks()
    {
        quoteLinks.click(function() {
            var $this = $(this),
                type = $this.data('type'),
                id = $this.data('id'),
                url = '';

            if(type == 'thread')
                url = '/forum/threads/quote/' + id;
            else
                url = '/forum/quote/' + id;

            $.getJSON(url, function(data){
                var quoteText = formatForumQuote(data['author'], data['markdown']);
                replyField.val(replyField.val() + quoteText).focus();
            });
        });
    }

    function initEditor() {
        var writings = $('#body'),
            previewArea = $('#markdown-preview'),
            previewTab = $('#bekijken');

        $('#bekijk-knop').on('shown.bs.tab', function (e) {
            var data = {
                text: writings.val()
            };

            previewArea.html('');
            previewTab.addClass('loading');

            $.ajax({
                url: '/preview',
                data: data,
                success: function(result) {
                    previewArea.html(result);
                    previewTab.removeClass('loading')
                }
            });
        })
    }

    function initThreadPage() {
        var replyForm = $('#reply-form');
        replyField = $('#body');

        quoteLinks = $('._quote_forum_post');
        bindQuoteLinks();

        initEditor();

        submitReply = $('#submit-reply');

        replyForm.submit(function(){
            submitReply.addClass('disabled').val('Wordt verstuurd...');
        });
    }

    function initCreateOrUpdatePage() {
        bindTagChooser();
        questionSelectToTag();
    }

    function loadDeferredAvatars() {
        $(window).load(function() {
            $('[data-gravatar-url]').prepend(function(){
                var $this = $(this), url, size;
                
                url = $this.attr('data-gravatar-url');
                size = $this.attr('data-gravatar-size');

                return '<img width="' + size + '" height="' + size + '" alt="Avatar" src="' + url + '">';
            });
        });
    }

    function initLikes() {
        $('.like-box--button').click(function(){
            var $this = $(this),
                type = $this.data('type'),
                id = $this.data('id'),
                method, url,
                counter = $this.find('.like-box--count'),
                likes = parseInt(counter.html(), 10);

            if(!urlTypes.hasOwnProperty(type))
                return;

            url = urlTypes[type].replace('%s', id);

            if($this.hasClass('liked'))
            {
                method = 'DELETE';
                counter.html(likes - 1);
                $this.removeClass('liked');
            } else {
                method = 'POST';
                counter.html(likes + 1);
                $this.addClass('liked');
            }

            $.ajax({
                url: url,
                type: method,
                error: function(message){
                    alert('Er ging iets fout met liken. Niet leuk :*(');
                }
            });

            return false;
        });
    }

    function initLustrumCountdown(){
        var labels = ['dagen', 'uren', 'min', 'sec'],
            targetDate = '2016/11/16',
            template = $('#lustrum-countdown-template').html(),
            currDate = '00:00:00:00',
            nextDate = '00:00:00:00',
            parser = /(\d+)/gi,
            $element = $('#lustrum-countdown');
        // Parse countdown string to an object
        function strfobj(str){
            var parsed = str.match(parser),
                obj = {};
            labels.forEach(function(label, i){
                obj[label] = parsed[i]
            });
            return obj;
        }
        // Return the time components that diffs
        function diff(obj1, obj2){
            var diff = [];
            labels.forEach(function(key){
                if (obj1[key] !== obj2[key]){
                    diff.push(key);
                }
            });
            return diff;
        }
        function fillTemplate(template, fillWith){
            return template.replace(/%(.+)%/gm, function(match, capture){
                return fillWith[capture];
            });
        }
        // Build the layout
        var initData = strfobj(currDate);
        labels.forEach(function(label, i) {
            $element.append(fillTemplate(template, {
                curr: initData[label],
                next: initData[label],
                label: label
            }));
        });
        // Starts the countdown
        $element.countdown(targetDate, function(event){
            var newDate = event.strftime('%-D:%H:%M:%S'),
                data;
            if (newDate !== nextDate) {
                currDate = nextDate;
                nextDate = newDate;
                // Setup the data
                data = {
                    'curr': strfobj(currDate),
                    'next': strfobj(nextDate)
                };
                // Apply the new values to each node that changed
                diff(data.curr, data.next).forEach(function(label){
                    var selector = '.%s'.replace(/%s/, label),
                        $node = $element.find(selector);
                    // Update the node
                    $node.removeClass('flip');
                    $node.find('.curr').text(data.curr[label]);
                    $node.find('.next').text(data.next[label]);
                    // Wait for a repaint to then flip
                    setTimeout(function($node){
                        $node.addClass('flip');
                    }, 50, $node);
                });
            }
        });

    }

    return {
        initThreadPage: initThreadPage,
        initCreateOrUpdatePage: initCreateOrUpdatePage,
        loadDeferredAvatars: loadDeferredAvatars,
        initLikes: initLikes,
        initLustrumCountdown: initLustrumCountdown
    };
})();