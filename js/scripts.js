jQuery(document).ready(function() {

    google.maps.event.addDomListener(window, 'load', initializeMap());
    var markers = [];
    var map;
    var infowindow;
    var bounds;
    var geocoder;
    var word_array = [];

    document.getElementById("parent-list").addEventListener("click",function(e){
                $("#word_cloud").jQCloud(word_array,{width:720,height:400,delay:100});
    
    });

    // AJAX call for autocomplete 
    $("#search-box").keyup(function() {
        $.ajax({
            type: "POST",
            url: "getCityList.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                // console.log("data: " + data);
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#search-box").css("background", "#FFF");
            }
        });
    });

    $('#filter_form').on('submit', function (e) {

        var postData = $("#filter_form").serialize();
         // console.log(postData);

        e.preventDefault();

        $.ajax({
        type: 'post',
        url: 'filter.php',
        dataType: 'json',
        data: postData,
        success: function (data) {
            // console.log("results: "+data);
            clearMarkers();
            initializeMap();
            displayMarkers(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("error: " + errorThrown, " ," + textStatus + ", " + jqXHR);   
        }

    });
});

    $('body').on('click', 'li.cityOptions', function() {
        var cityText = $(this).text();
        // alert(cityText);
        $("#search-box").val(cityText);
        $("#suggesstion-box").hide();
        $.ajax({
            type: "POST",
            url: "getBusinessList.php",
            dataType: 'json',
            data: 'cityname=' + cityText,
            success: function(data) {
                clearMarkers();
                initializeMap();
                 displayMarkers(data);
                // console.log(data);
            }
        });
    });
    
    

    function initializeMap() {
        console.log('Inside initializeMap');
        infowindow = new google.maps.InfoWindow();
        bounds = new google.maps.LatLngBounds();
        geocoder = new google.maps.Geocoder;
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
        map = new google.maps.Map(mapDiv, mapOptions);
    }

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }

    function displayMarkers(business_data) {
            // console.log(business_data.length);

        for (var i = 0; i < business_data.length; i++) {
            address = {};
            // console.log(business_data[i]['latitude']);
            address['lat'] = parseFloat(business_data[i]['latitude']);
            address['long'] = parseFloat(business_data[i]['longitude']);
            // console.log(address);
            setMarker(address, business_data[i]);
        }
    }

    function setMarker(address, business) {
        var latlng = {
            lat: address['lat'],
            lng: address['long']
        };
        var position = new google.maps.LatLng(address['lat'], address['long']);
        bounds.extend(position);
        marker = new google.maps.Marker({
            map: map,
            position: latlng,
            animation: google.maps.Animation.DROP
        });
        markers.push(marker);
        marker.addListener('click', function() {

            var businessid = business['business_id'];
            getWordCloud(businessid);

            $('#myModal').modal('show');
            var business_name = business['name'];
            var rating = business['stars'];
            var category = business['categories'];
            var review_count = business['review_count'];
            var city = business['city'];
            $('#business_info').html("<h3><h3>");
            $('#business_info').append("<strong> Name: " + business_name + "</strong><br>");
            $('#business_info').append("<strong>Category: " + category + "</strong><br>");
            $('#business_info').append("<strong>City: " + city + "</strong><br>");
            $('#business_info').append("<strong>Rating: " + rating + "</strong><br>");
            $('#business_info').append("<strong>Review Count: " + review_count + "</strong><br>");
        });
        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    function getWordCloud(id) {
        console.log("here");
        $.ajax({
            type: "POST",
            url: "getBusinessDetail.php",
            dataType: 'json',
            data: 'businessid=' + id,
            success: function(data) {
                // console.log("data: " + data);
                showUserReview(data);
                showWordCloud(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error: " + errorThrown, " ," + textStatus + ", " + jqXHR);   
        }
        });
        
    }

    function showUserReview(review_data) {
        // alert("hey");
        if(JSON.parse(review_data['reviewDetail']).length != 0) {
            review_text = JSON.parse(review_data['reviewDetail'])[0]['text'];
            review_stars = JSON.parse(review_data['reviewDetail'])[0]['stars'];
            $("#review_para").html("Rating: " + review_stars + "<br>" + review_text);
        }
    }

    function showWordCloud(data) {
        $("#word_cloud").empty();
        $('#word_cloud').jQCloud('destroy');
        word_array = [];
        json_obj = JSON.parse(data['wordCloud'])['wordCloud'];

        word_array = json_obj;

        // alert(word_array);
        // for (var i = 0; i < json_obj.length; i++) {
        //     // word_array[i]['text'] = json_obj[i]['word'];
        //     // word_array[i]['weight'] = json_obj[i]['frequency'];
        //     if(json_obj[i]['polarity'] < 0) {
        //         str = "";
        //         str += "html:{style:'color:#a90000}";
        //         word_array[i]['html'] = str;
        //     }
        //     else if (json_obj[i]['polarity'] > 0){
        //         str = "";
        //         str += "html:{style:'color:#3db11a}";

        //         word_array[i]['html'] = str;
        //     }
        //     else {
        //         tr = "";
        //         // str += 'html:{style:"color:'+#330e6d+'}';
        //         str += "html:{style:'color:#330e6d}";
        //         word_array[i]['html'] = str;
        //     }
        // }

        // data_n = data['wordCloud'];
        // alert(data);
        // word_array = data;
        // $.each(data.d, function(index, value) {
        //     word_array.push(value);

        // });
        for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
         //   word_array.push(data[i]);
        }
    }

    function getLocationFromGeoCode(address, next) {
        console.log('Inside getLocationFromGeoCode');
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
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }
});