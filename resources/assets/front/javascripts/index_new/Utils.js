var Utils = {
    // Media queries
    MQ: {
        'for-small-desktop-up'() {
            return window.matchMedia("only screen and (min-width: 800px)").matches;
        }
    },

    readOrExecute (input) {
        return typeof input == "function" ? input() : input;
    },

    isTouchDevice () {
        return 'ontouchstart' in window || navigator.maxTouchPoints;
    },

    imgLoaded (imgElement) {
        return imgElement.complete && imgElement.naturalHeight !== 0;
    },

    // === MATH HELPER FUNCTIONS ===

    round (num, decimals = 0) {
        let a = Math.pow(10, decimals);
        return Math.round(num * a) / a;
    },

    randInt (min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    },

    chance (fraction) {
        return this.randInt(1, 100) <= fraction * 100;
    },

    clamp (val, min, max) {
        return Math.min(Math.max(val, min), max);
    },

    between (x, min, max) {
        return x >= min && x <= max;
    }

    // === END MATH HELPER FUNCTIONS ===
}