function initGoogleMap (container, activeClass = 'active') {
    $(container).on('click', (e) => {
        $(e.currentTarget).find('iframe').addClass(activeClass);
    }).on('mouseleave', (e) => {
        $(e.currentTarget).find('iframe').removeClass(activeClass);
    });
}