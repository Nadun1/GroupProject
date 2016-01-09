<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>Google Maps Example</title>
    <style type="text/css">
        body { font: normal 14px Verdana; }
        h1 { font-size: 24px; }
        h2 { font-size: 18px; }
        #sidebar { float: right; width: 30%; }
        #main { padding-right: 15px; }
        .infoWindow { width: 220px; }
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        //<![CDATA[



        function makeRequest(url, callback) {
            var request;
            if (window.XMLHttpRequest) {
                request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
            } else {
                request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
            }
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    callback(request);
                }
            }
            request.open("GET", url, true);
            request.send();
        }




        var map;

        // Centre of the map
        var center = new google.maps.LatLng(6.7,80);

        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        function init() {

            var mapOptions = {
                zoom: 10,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

            makeRequest('get_locations.php', function(data) {

                var data = JSON.parse(data.responseText);


                for (var i = 0; i < data.length; i++) {
                    displayLocation(data[i]);
                }
            });
        }


        function displayLocation(vehicle_table) {

            var content =   '<div class="infoWindow"><strong>'  + vehicle_table.plate_number + '</strong>'
                    + '<br/>'     + vehicle_table.address
                    + '<br/>'     + vehicle_table.description + '</div>';

            if (parseInt(vehicle_table.latitude) == 0) {
                geocoder.geocode( { 'address': vehicle_table.address }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {

                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.vehicle_table,
                            title: vehicle_table.plate_number
                        });

                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.setContent(content);
                            infowindow.open(map,marker);
                        });
                    }
                });
            } else {
                var position = new google.maps.LatLng(parseFloat(vehicle_table.latitude), parseFloat(vehicle_table.longtitude));
                var marker = new google.maps.Marker({
                    if(vehicle_table.latitude == 'available'){
                    		var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.vehicle_table,
                            title: vehicle_table.plate_number
                        });
                    	}else{
                    		var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.vehicle_table,
                            title: vehicle_table.plate_number
                        });


                    	}


                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                });
            }
        }



        //]]>
    </script>



</head>
<body onload="init();">

<section id="sidebar">
    <div id="directions_panel"></div>
</section>

<section id="main">
    <div id="map_canvas" style="width: 600px; height: 400px;"></div>
</section>




</body>
</html>