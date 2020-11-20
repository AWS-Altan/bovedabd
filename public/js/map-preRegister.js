function initMap() {
    var uluru = {
        lat: -25.344,
        lng: 131.036
    };

    var map = new google.maps.Map(
        document.getElementById("map"), {
            zoom: 22,
            center: uluru,
            disableDefaultUI: true,
            zoomControl: true,
            fullscreenControl: true
        }
    );

    var searchTxt = $('#search').val();
    var geocoder = new google.maps.Geocoder();
    geocodeAddress(geocoder, map, searchTxt);

}

function geocodeAddress(geocoder, resultsMap, search) {
    var address = search;
    if ( address!= '' ){
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);

                var icon = {
                    url: "/img/marker.png",
                    scaledSize: new google.maps.Size(50, 50), // scaled size
                    origin: new google.maps.Point(0, 0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    icon: icon,
                    position: results[0].geometry.location,
                    draggable: true
                });

                getServiceability(results[0].geometry.location.lat().toFixed(5).toString() + "," + results[0].geometry.location.lng().toFixed(5).toString());

                google.maps.event.addListener(marker, 'dragend', function(evt) {
                    marker.setTitle('Lat: ' + evt.latLng.lat().toFixed(5) + '; Lng: ' + evt.latLng.lng().toFixed(5));
                    resultsMap.setCenter(marker.position);
                    marker.setMap(resultsMap);
                    getServiceability(resultsMap.getCenter().lat().toFixed(5).toString() + "," + resultsMap.getCenter().lng().toFixed(5).toString());
                });

                google.maps.event.addListener(resultsMap, 'dragend', function() {
                    marker.setPosition(this.getCenter()); // set marker position to map center
                    marker.setTitle('Lat: ' + this.getCenter().lat().toFixed(5) + '; Lng: ' + this.getCenter().lng().toFixed(5));
                    getServiceability(resultsMap.getCenter().lat().toFixed(5).toString() + "," + resultsMap.getCenter().lng().toFixed(5).toString());
                });

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
}