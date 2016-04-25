jQuery(document).ready(function() {

    google.maps.event.addDomListener(window, 'load', initializeMap());
    var markers = [];
    
    function initializeMap() {
        console.log('Inside initializeMap');
        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        var geocoder = new google.maps.Geocoder;
        var mapDiv = document.getElementById('map-canvas');
        var mapOptions = {
            center: {
                lat: 17.4126272,
                lng: 78.267614
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 10,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            fullscreenControl: true
        };
        // create google maps object
        var map = new google.maps.Map(mapDiv, mapOptions);
        var address = {};
        address['lat'] = 17.413742;
        address['long'] = 78.2662389;
        setTempMarker(map,address,infowindow,bounds);
        // initializeSearchBox(map, infowindow);
        // setMarkersUsingGeocoder(map, geocoder, infowindow, bounds);
    }

    function setTempMarker(map,address,infowindow,bounds) {
        var latlng = {
            lat: address['lat'],
            lng: address['long']
        };
        var position = new google.maps.LatLng(address['lat'], address['long']);
        // bounds.extend(position);
        markers = [];

        marker = new google.maps.Marker({
            map: map,
            position: latlng,
            animation: google.maps.Animation.DROP
        });
        markers.push(marker);
        marker.addListener('click', function() {
            // $('.modal-title').html("Review Summary: "+ marker.getTitle());   

            var word_array = [
                {text: "Lorem", weight: 15},
                {text: "Ipsum", weight: 9},
                {text: "Dolor", weight: 6},
                {text: "Sit", weight: 7},
                {text: "Amet", weight: 5},
                {text: "Hey", weight: 15},
                {text: "Harman", weight: 9},
                {text: "Dol", weight: 6},
                {text: "Sitter", weight: 7},
                {text: "Amity", weight: 5}
                // ...as many words as you want
            ];

            $("#review_summary").css("height",400);
            $("#review_summary").css("width",720);
            // $("#review-body").html("");
            $("#review_summary").jQCloud(word_array);
             // $("#review_summary").jQCloud(word_array, {
              // autoResize: true,
              // colors: ["#800026", "#bd0026", "#e31a1c", "#fc4e2a", "#fd8d3c", "#feb24c", "#fed976", "#ffeda0", "#ffffcc"],
              //   fontSize: {
              //     from: 0.1,
              //     to: 0.02
              //   }
            // });

            $('#myModal').modal('show');
            // infowindow.setContent(marker.getContent());
            // infowindow.open(marker.get('map'), marker);
        });
        // Automatically center the map fitting all markers on the screen
        // map.fitBounds(bounds);
    }

    function setMarkersUsingGeocoder(map, geocoder, infowindow, bounds) {
        console.log('Inside setMarkersUsingGeocoder');
        // test locations
        var locations = new Array();
        var address = {};
        address['lat'] = 17.413742;
        address['long'] = 78.2662389;
        locations.push(address);
        address = {};
        address['lat'] = 12.9545163;
        address['long'] = 77.35005;
        locations.push(address);
        for (var i = locations.length - 1; i >= 0; i--) {
            reverseGeoCode(map, geocoder, locations[i], infowindow, bounds);
        }
    }

    function reverseGeoCode(map, geocoder, address, infowindow, bounds) {
        console.log('Inside reverseGeoCode');
        var latlng = {
            lat: address['lat'],
            lng: address['long']
        };
        geocoder.geocode({
            'location': latlng
        }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    var position = new google.maps.LatLng(address['lat'], address['long']);
                    bounds.extend(position);
                    var marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                    markers.push(marker);
                    marker.addListener('click', function() {
                        infowindow.setContent(results[1].formatted_address);
                        console.log(results[1].formatted_address);
                        infowindow.open(marker.get('map'), marker);
                    });
                    // Automatically center the map fitting all markers on the screen
                    map.fitBounds(bounds);
                    // infowindow.setContent(results[1].formatted_address);
                    // infowindow.open(map, marker);
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }


    // AJAX call for autocomplete 
    $("#search-box").keyup(function(){
        $.ajax({
        type: "POST",
        url: "getCities.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
        });
    });

    //To select city name
    function selectCity(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }

});