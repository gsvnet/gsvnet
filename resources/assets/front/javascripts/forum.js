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
        var replyForm = $('#forummessage-form');
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
        initEditor();
    }

    function loadDeferredAvatars() {
        $(window).on('load', function() {
            $('[data-gravatar-url]').prepend(function(){
                var $this = $(this), url, size;
                
                url = $this.attr('data-gravatar-url');
                size = $this.attr('data-gravatar-size');

                return '<img width="' + size + '" height="' + size + '" alt="Avatar" src="' + url + '">';
            });
        });
    }

    function initLikes() {
        let gravatarUrl = $('.nav-profile-image').attr('src');
        gravatarUrl = gravatarUrl.replaceAll(/s=([0-9]+)/g, 's=40');

        let avatarEl = `<img src="${gravatarUrl}" width="40" height="40" style="border-radius: 50%">`;

        $('.like-box--button').click(function(){
            var $this = $(this),
                type = $this.data('type'),
                id = $this.data('id'),
                method, url,
                counter = $this.find('.like-box--count'),
                likes = parseInt(counter.html(), 10),
                likers = $(`.likers[data-id="${id}"]`),
                likersShortlist = likers.children('.images'),
                likersLonglist = likers.children('.modal-bg').children('.modal-content').children('ul'),
                likersCounter = likers.children('.text'),
                username = $('#js-username').get(0).textContent;

            if(!urlTypes.hasOwnProperty(type))
                return;

            url = urlTypes[type].replace('%s', id);

            if($this.hasClass('liked'))
            {
                method = 'DELETE';
                likes -= 1;
                $this.removeClass('liked');

                likersShortlist.children().get(0).remove();
                likersLonglist.children().get(0).remove();
            } else {
                method = 'POST';
                likes += 1;
                $this.addClass('liked');

                if (likersShortlist.children().length === 3)
                    likersShortlist.children().get(0).remove();

                likersShortlist.prepend(`<div>${avatarEl}</div>`);
                likersLonglist.prepend(`<li>${avatarEl} <div class="text">${username}</div></li>`);
            }

            counter.html(likes);

            if (likes === 1)
                likersCounter.html("1 GSV'er vindt dit leuk.");
            else
                likersCounter.html(likes + " GSV'ers vinden dit leuk.");

            $.ajax({
                url: url,
                type: method,
                error: function(message){
                    response = message.responseJSON.userId
                    alert(response);
                }
            });

            return false;
        });

        // Setting up closing and opening of modal boxes
        let modals = document.getElementsByClassName("modal-bg");
        let closeButtons = document.getElementsByClassName("modal-button");
        let likers = document.getElementsByClassName("likers");
        for (var i = 0; i < likers.length; i++) {
            likers[i].onclick = function(container, modal, button) {
                return function(e) {
                    if (e.target !== modal && e.target !== button) {
                        let modalContent = modal.childNodes[1];

                        modal.style.display = 'block';

                        setTimeout(() => {
                            modal.style.backgroundColor = "rgba(0,0,0,0.4)";
                            modalContent.style.marginTop = "3em";
                        }, 100);
                    }
                }
            }(likers[i], modals[i], closeButtons[i]);

            closeButtons[i].onclick = function(modal) {
                return function(e) {
                    closeModal(modal);
                }
            }(modals[i]);

            window.addEventListener("click", function(modal) {
                return function(e) {
                    if (e.target === modal) {
                        closeModal(modal);
                    }
                }
            }(modals[i]));
        }

        function closeModal(modal) {
            let modalContent = modal.childNodes[1];

            modal.style.backgroundColor = "rgba(0,0,0,0)";
            modalContent.style.marginTop = "100vh";

            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }
    }

    return {
        initEditor: initEditor,
        initThreadPage: initThreadPage,
        initCreateOrUpdatePage: initCreateOrUpdatePage,
        loadDeferredAvatars: loadDeferredAvatars,
        initLikes: initLikes
    };
})();