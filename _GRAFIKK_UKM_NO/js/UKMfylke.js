UKMresponsive = UKMresponsive || {};

UKMresponsive.kommuneliste = function(filter_container) {
    var emitter = new UKMresponsive.emitter('kommuneliste');
    var self = {
        on: function(event, callback) {
            emitter.on(event, callback);
        },
        getSearchSelector: function() {
            return filter_container + ' input[name="search"]';
        },
        getKommuneSelector: function() {
            return filter_container + ' .kommune';
        },
        bind: function() {
            $(document).on('keyup', self.getSearchSelector(), self.filter);
            $(document).on('keypress', function(e) {
                if (e.which == 13 && $(self.getSearchSelector()).is(':focus') && self.getMatchCount() == 1) {
                    self.go();
                }
            });
        },

        go: function() {
            var selected = $(self.getKommuneSelector() + ':visible');
            window.location.href = selected.find('a').attr('href');
        },

        filter: function() {
            var words = $(self.getSearchSelector()).val().toLowerCase().split(' ');
            $(self.getKommuneSelector()).hide();

            $(self.getKommuneSelector()).filter(function(index, element) {
                var searchIn = $(element).attr('data-filter').toLowerCase();
                var found = false;
                words.forEach(function(word) {
                    if (searchIn.indexOf(word) !== -1) {
                        found = true;
                        return; // bryter ut av forEach
                    }
                });
                return found; // faktisk resultat
            }).show();

            self.addCountHelper();
            emitter.emit('change', [self.getMatchCount()]);
        },

        getMatchCount: function() {
            return $(self.getKommuneSelector() + ':visible').length;
        },

        addCountHelper: function() {
            var numShown = self.getMatchCount();
            $(filter_container).removeClass('found-none found-few found-many').attr('data-count', numShown);
            if (numShown == 0) {
                $(filter_container).addClass('found-none');
            } else if (numShown < 5) {
                $(filter_container).addClass('found-few');
            } else {
                $(filter_container).addClass('found-many');
            }
        }
    }
    self.bind();
    return self;
}