function addScrollResponse(elSelector, {
    treshold = 'self',
    offset = 0,
    operation = 'after',
    responseEl = elSelector,
    responseClass = 'shrunk'
}) {
    let getEvaluation = (operation) => {
        switch(operation) {
            case "after":
                return  (a,b) => a <= b;
            case "before":
                return  (a,b) => a > b;
            default:
                throw new Error('Operator ' + operation + ' is not supported!');
        };
    }
    let evaluate = getEvaluation(operation),
        $window = $(window),
        $elSelector = $(elSelector),
        $responseEl = $(responseEl);
    
    let responseFn = (scrollTop) => {
        if (evaluate(treshold == 'self' ? $elSelector.offset().top - Utils.readOrExecute(offset) : treshold, scrollTop)) {
            $responseEl.addClass(responseClass);
        } else {
            $responseEl.removeClass(responseClass);
        }
    };

    scrollHandler(responseFn);
    $window.scroll();
}