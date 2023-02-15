function initOverlay(triggers, overlay = '#overlay', activeClass = 'active', activeListeners = 'body', activeListenerClass = 'overlay-active') {
    $(triggers).on('click', () => {
        $(overlay).toggleClass(activeClass);
        $(activeListeners).toggleClass(activeListenerClass);
    });
}