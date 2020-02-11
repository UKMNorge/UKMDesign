UKMresponsive = UKMresponsive || {};

UKMresponsive.emitter = function(_navn) {
    var _events = [];
    var _onetimeEvents = [];
    var debug = false;
    var navn = (_navn !== undefined && _navn !== null) ? _navn.toUpperCase() : 'UKJENT';

    var self = {
        /* EVENT HANDLERS */
        emit: function(event, data) {

            if (debug) {
                console.info(navn + '::emit(' + event + ')', data);
            }
            if (_events[event] != null) {
                _events[event].forEach(function(_event) {
                    if (!Array.isArray(data)) {
                        data = [data];
                    }
                    _event.apply(null, data);
                });
            }

            if (_onetimeEvents[event] != null) {
                _onetimeEvents[event].forEach(function(_event, index) {
                    if (!Array.isArray(data)) {
                        data = [data];
                    }
                    _event.apply(null, data);
                    _onetimeEvents[event].splice(index, 1);
                });
            }
            return self;
        },

        on: function(event, callback) {
            //console.info(navn + '.ON(' + event + ')', callback);
            if (_events[event] == null) {
                _events[event] = [callback];
                return self;
            }
            _events[event].push(callback);
            return self;
        },

        enableDebug: function() {
            debug = true;
        },

        /**
         * Onetime event listeners.
         * Auto-deletes after running once
         * @param {*} event 
         * @param {*} callback 
         */
        once: function(event, callback) {
            if (_onetimeEvents[event] == null) {
                _onetimeEvents[event] = [callback];
                return self;
            }
            _onetimeEvents[event].push(callback);
            return self;
        }
    };

    return self;
}