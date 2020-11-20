<ul>
    <hr class="light-grey-hr mt-40 mb-0" />
</ul>
<h3><span class="head-font capitalize-font">Serviciabilidad</span></h3>
<div class="row">
    <div class="col-lg-12">
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <label class="control-label mb-10 text-left">Dirección:</label>
                            <input id="search" type="text" class="form-control" placeholder="Calle, No, Colonia, C.P, Municipio, Entidad">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mt-20 mb-20">
                        <button id="consulta" type="button" class="btn btn-success"><span class="btn-text">Consultar Serviciabilidad</span></button>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mb-40">
                <div class="form-group mt-20 mb-10">
                    <label class="control-label mb-10 text-left">Resultado búsqueda</label>
                    <label id="result" type="text" class="form-control filled-input"> El resultado de la búsqueda se visualizará aquí </label>
                    <div id="map" style="width: 800px; height: 400px;"></div>
                    <input id="rescorde" type="hidden" name="">
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>

@section('jsfree')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLzOTFaRpuncsWqNpiCvkV0rq-f6xOkJs"></script>
<script>
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

                getServiceability(results[0].geometry.location.lat().toString() + "," + results[0].geometry.location.lng().toString());

                google.maps.event.addListener(marker, 'dragend', function(evt) {
                    marker.setTitle('Lat: ' + evt.latLng.lat().toFixed(5) + '; Lng: ' + evt.latLng.lng().toFixed(5));
                    resultsMap.setCenter(marker.position);
                    marker.setMap(resultsMap);
                    getServiceability(resultsMap.getCenter().lat().toString() + "," + resultsMap.getCenter().lng().toString());
                });

                google.maps.event.addListener(resultsMap, 'dragend', function() {
                    marker.setPosition(this.getCenter()); // set marker position to map center
                    marker.setTitle('Lat: ' + this.getCenter().lat().toFixed(5) + '; Lng: ' + this.getCenter().lng().toFixed(5));
                    getServiceability(resultsMap.getCenter().lat().toString() + "," + resultsMap.getCenter().lng().toString());
                });

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    function getServiceability(latlon) {
        $.blockUI({
            message: 'Procesando ...',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
        $.ajax({
                url: "{{ route('support.call.serviceability') }}",
                type: 'GET',
                data: {
                    'coordinates': latlon
                }
            })
            .done(function(response) {
                var obj = jQuery.parseJSON(response);
                console.log(obj);
                if (obj.error) {
                    console.log('fail')
                    $('#result').empty();
                    $('#result').text(' ' + obj.error);
                    $('#next').hide();
                } else {
                    $('#result').empty();
                    if (obj.result == 'Without Coverage' || obj.result == 'Without serviceability. ') {
                        $('#result').text('No existe serviciabilidad en las coordenadas proporcionadas. Por favor intente consultar nuevamente con coordenadas diferentes.');
                        $.unblockUI();
                    } else {
                        $('#result').text(' ' + obj.result);
                    }
                }
            })
            .fail(function() {
                $('#result').empty();
                $('#result').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong>');
            })
            .always(function() {
                $.unblockUI();
            });
    }

    $(window).on('load', function() {
        $('#consulta').click(function() {
            initMap();
        });
    });
</script>
@endsection