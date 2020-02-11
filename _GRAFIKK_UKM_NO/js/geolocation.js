jQuery(document).on('click', '.geolocation', function() {
    navigator.geolocation.getCurrentPosition(
        function(location) {
            jQuery.get(
                'https://ws.geonorge.no/kommuneinfo/v1/punkt?' +
                'nord=' + location.coords.latitude +
                '&ost=' + location.coords.longitude +
                '&koordsys=4258',
                function(response) {
                    jQuery(document).trigger('geolocated', response)
                }
            ).fail(
                function(response) {
                    jQuery(document).trigger('geolocate-fail', response);
                }
            );
        },
        function(exception) {
            jQuery(document).trigger('geolocate-fail', exception);
        }
    );
});