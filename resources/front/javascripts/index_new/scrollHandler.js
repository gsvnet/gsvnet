var scrollHandler = (() => {
    
    let callbacks = [];

    function onScroll() {
        let scrollTop = window.scrollY;

        callbacks.forEach((callback) => {
            if(!callback.ticking) {
                window.requestAnimationFrame(() => {
                    callback.fn(scrollTop);
                    callback.ticking = false;
                });
                callback.ticking = true;
            }
        });
    }

    $(window).scroll(onScroll);

    return (callback) => {
        //console.log('registering:', callback);
        if (typeof callback != "function") {
            throw new TypeError('The ScrollHandler register method expects its first argument to be a function.');
        }
        callbacks.push({
            fn: callback,
            ticking: false
        });
    };
})();