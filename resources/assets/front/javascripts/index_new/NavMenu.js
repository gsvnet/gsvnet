var NavMenu = (() => {
    let _$container,
        _shrinkTreshold,
        navHeight = 0,
        touchNavActive = false,
        props = {
            getHeight: () => {return navHeight;}
        };
    
    $(window).on('breakpoint-change', (e, breakpoint) => {
        console.log('bpc', breakpoint);
        navHeight = breakpoint == 'small' ? 0 : _$container.height();
    });

    function addScrollHandler(linksSelector, activeLinkClass, shrinkClass) {        
        _$container.find(linksSelector).each((undefined, navLink) => {
            // Look for internal links that point to existing page elements
            if (/^#./.test(navLink.getAttribute('href')) && $(navLink.getAttribute('href')).length) {
                let $link = $(navLink),
                    $target = $(navLink.getAttribute('href'));

                $target.fracs((now, previously) => {
                    if(now.viewport > .5) {
                        $link.addClass(activeLinkClass);
                    } else {
                        $link.removeClass(activeLinkClass);
                    }
                });
            }
        });

        addScrollResponse('body', {offset: -_shrinkTreshold, responseClass: shrinkClass, responseEl: _$container});
    }

    function addTouchHandler(toggle, activeLinkClass) {
        let $toggle = _$container.find(toggle);

        _$container.on('click', (e) => {
            e.stopPropagation();
            $toggle.toggleClass(activeLinkClass);
            _$container.toggleClass(activeLinkClass);
        });
    }
    
    return (container, linksSelector, mobileToggle, activeLinkClass = 'active', shrinkTreshold = 1, shrinkClass = 'shrunk') => {
        _$container = $(container);
        _shrinkTreshold = shrinkTreshold;

        addScrollHandler(linksSelector, activeLinkClass, shrinkClass);
        addTouchHandler(mobileToggle, activeLinkClass);

        return props;
    }
})();