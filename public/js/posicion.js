function posicion(latitud,longitud) {
    var output = document.getElementById('map');
    var latitude;
    var longitude;
    latitude=latitud;
    longitude=longitud;
    latitude=parseFloat(latitude);
    longitude=parseFloat(longitude);

    var mapOptions = {
        center:new google.maps.LatLng(latitude,longitude),
        zoom:11,
        panControl: false,
        zoomControl: true,
        scaleControl: true,
        mapTypeControl:false,
        streetViewControl:false,
        overviewMapControl:true,
        rotateControl:true,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(latitude,longitude),
        map: map
    });



}

