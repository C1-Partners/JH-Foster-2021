/**
 * Helpers
 * ------
 * General purpose helper functions for component-wide use
 */

window.helpers = {

    // Google Analytics Event (using GTM)
     gaEvent (category, action, label) {
        if(typeof ga === 'function' && typeof ga.getAll === 'function') {
            let tracker = ga.getAll()[0];
            if(tracker) tracker.send('event', category, action, label.toString());
        }
    },

    // Get Query Variable out of the URL
     getQueryVariable (variable) {
        let query = window.location.search.substring(1);
        let vars = query.split("&");
        for (let i=0;i<vars.length;i++) {
            let pair = vars[i].split("=");
            if(pair[0] === variable){return pair[1];}
        }
        return false;
    },

    // Includes function that works in IE versions that do not support the .includes jquery function
    includes (container, value) {
        let returnValue = false;
        let pos = container.indexOf(value);
        if (pos >= 0) returnValue = true;
        return returnValue;
    },

    // Browser check
    browser () {
        // Return cached result if available, else get result then cache it.
        if (browser.prototype._cachedResult)
            return browser.prototype._cachedResult;

        // Opera 8.0+
        let isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

        // Firefox 1.0+
        let isFirefox = typeof InstallTrigger !== 'undefined';

        // Safari 3.0+ "[object HTMLElementConstructor]"
        let isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);

        // Internet Explorer 6-11
        let isIE = /*@cc_on!@*/false || !!document.documentMode;

        // Edge 20+
        let isEdge = !isIE && !!window.StyleMedia;

        // Chrome 1+
        let isChrome = !!window.chrome && !!window.chrome.webstore;

        // Blink engine detection
        let isBlink = (isChrome || isOpera) && !!window.CSS;

        return browser.prototype._cachedResult =
            isOpera ? 'Opera' :
                isFirefox ? 'Firefox' :
                    isSafari ? 'Safari' :
                        isChrome ? 'Chrome' :
                            isIE ? 'IE' :
                                isEdge ? 'Edge' :
                                    isBlink ? 'Blink' :
                                        "Don't know";
    },

    currentUrl: function () {
        return window.location.href;
    },

};
