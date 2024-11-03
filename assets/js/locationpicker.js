// Archivo: plugins/miguelcr/supilo/assets/js/locationpicker.js
document.addEventListener("DOMContentLoaded", function () {
    // Inicializar Google Maps con el campo de autocompletado
    const input = document.getElementById("address");
    const latitude = document.getElementById("latitude");
    const longitude = document.getElementById("longitude");

    const autocomplete = new google.maps.places.Autocomplete(input);
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 40.7128, lng: -74.0060 }, // Coordenadas iniciales (ej. Nueva York)
        zoom: 15,
    });

    const marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });

    // Actualizar marcador y coordenadas cuando se seleccione una dirección
    autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();
        if (!place.geometry) return;

        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);

        latitude.value = place.geometry.location.lat();
        longitude.value = place.geometry.location.lng();
    });

    // Actualizar coordenadas cuando se arrastra el marcador
    marker.addListener("dragend", () => {
        const position = marker.getPosition();
        latitude.value = position.lat();
        longitude.value = position.lng();
    });
});
