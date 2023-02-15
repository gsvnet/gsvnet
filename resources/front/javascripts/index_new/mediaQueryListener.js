'use strict';
var MQL = (function (parent, $) {

    var MediaQueryListener = function() {
        this.afterElement = window.getComputedStyle ? window.getComputedStyle(document.body, ':after') : false;
        this.currentBreakpoint = '';
        this.lastBreakpoint = '';
        this.init();
    };

    MediaQueryListener.prototype = {

        init: function () {
            var self = this;

            if(!self.afterElement) {
                console.error('MediaQueryListener is not supported by this browser!');
                return;
            }

            self._resizeListener();

        },
        _resizeListener: function () {
            var self = this;

            $(window).on('resize orientationchange load', function() {
                self.currentBreakpoint = self.afterElement.getPropertyValue('content').replace(/\"/g, '');
                console.log(self.currentBreakpoint, self.lastBreakpoint);
                if (self.currentBreakpoint !== self.lastBreakpoint) {
                    $(window).trigger('breakpoint-change', self.currentBreakpoint);
                    self.lastBreakpoint = self.currentBreakpoint;
                }

            });
        }

    };

    parent.mediaqueryListener = parent.mediaqueryListener || new MediaQueryListener();

    return parent;

}(MQL || {}, jQuery));