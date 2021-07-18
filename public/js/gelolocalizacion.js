function loadMap() {
    var output = document.getElementById('map');
    var latitude;
    var longitude;


    //Obtenemos latitud y longitud
    function localizacion(posicion) {

        latitude = posicion.coords.latitude;
        longitude = posicion.coords.longitude;

        var mapOptions = {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: 15,
            panControl: false,
            zoomControl: true,
            scaleControl: true,
            mapTypeControl: false,
            streetViewControl: true,
            overviewMapControl: true,
            rotateControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };


        var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            map: map,
            draggable: true,
        });

        google.maps.event.addListener(map, "rightclick", function (event) {
            marker.setMap(null)
            latitude = event.latLng.lat();
            longitude = event.latLng.lng();
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                map: map,
                draggable: true,
            });
            form = document.getElementById("formulario");
            form.lat.value = latitude;
            form.lon.value = longitude;
        });

        form = document.getElementById("formulario");
        form.lat.value = latitude;
        form.lon.value = longitude;



    }

    function error() {
        output.innerHTML = "<p>No se pudo obtener tu ubicación</p>";

    }

    navigator.geolocation.getCurrentPosition(localizacion, error);


}

