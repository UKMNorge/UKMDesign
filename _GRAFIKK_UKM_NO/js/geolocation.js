jQuery(document).on('geolocated', function(e, location) {
    $.ajax({
        url: 'https://delta.' + window.location.hostname + '/lastlocation/' + location.kommunenummer + '/',
        xhrFields: {
            withCredentials: true
        }
    });
});

jQuery(document).on('click', '.geolocation', function() {
    navigator.geolocation.getCurrentPosition(
        function(location) {
            $.get(
                'https://ws.geonorge.no/kommuneinfo/v1/punkt?' +
                'nord=' + location.coords.latitude +
                '&ost=' + location.coords.longitude +
                '&koordsys=4258',
                function(response) {
                    $(document).trigger('geolocated', response);
                }
            ).fail(
                function(response) {
                    $(document).trigger('geolocate-fail', response);
                }
            );
        },
        function(exception) {
            $(document).trigger('geolocate-fail', exception);
        }
    );
    return false;
});