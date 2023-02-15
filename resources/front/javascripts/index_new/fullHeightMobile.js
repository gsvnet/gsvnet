var fullHeightMobile = (()=> {
    if (!Utils.isTouchDevice()) return () => {};
    let elements = [],
        callbacks = [];

    let lastInnerHeight = 0;
    setInterval(() => {
        let innerHeight = window.innerHeight;
        if (innerHeight == lastInnerHeight) return;
        lastInnerHeight = innerHeight;
        setFullHeight();
        sendCallbacks();
    }, 100);

    function setFullHeight() {
        elements.forEach(element => {
            console.log('setting fullheight to ', element.selector, lastInnerHeight, Utils.readOrExecute(element.offset));
            $(element.selector).height(`${(lastInnerHeight - Utils.readOrExecute(element.offset))}px`);
        });
    }

    function sendCallbacks() {
        callbacks.forEach(callback => {
            callback(lastInnerHeight);
        });
    }

    return (selectorOrCallback, offset = 0, triggerUpdate = false) => {
        if(typeof selectorOrCallback == "function") {
            callbacks.push(selectorOrCallback);
        } else {
            elements.push({
                selector: selectorOrCallback,
                offset
            });
        }
        if(triggerUpdate == true || selectorOrCallback === true) {
            //Trigger update
            lastInnerHeight = 0;
        }
    };
})();

// function fullHeightMobile(selector, offset = 0) {
//     if (!Utils.isTouchDevice()) return;

//     function setFullHeight(innerHeight) {
//         $(selector).height(`${(innerHeight - offset)}px`);
//     }

//     /*function orientationChanged() {
//         const timeout = 120;
//         return new window.Promise(function (resolve) {
//             const go = (i, height0) => {
//                 window.innerHeight != height0 || i >= timeout ?
//                     resolve() :
//                     window.requestAnimationFrame(() => go(i + 1, height0));
//             };
//             go(0, window.innerHeight);
//         });
//     }

//     $(window).on('orientationchange', () => {
//         orientationChanged().then(setFullHeight);
//     });

//     scrollHandler.register(() => {
//         console.log(window.innerHeight);
//         setFullHeight();
//     });*/

//     let lastInnerHeight = window.innerHeight;

//     setInterval(() => {
//         let innerHeight = window.innerHeight;
//         if (innerHeight == lastInnerHeight) return;
//         lastInnerHeight = innerHeight;
//         setFullHeight(innerHeight);
//     }, 200);
// }