export default function appendGoogleMap(dom, start, finish) {
    const map = new google.maps.Map(dom);
    const directionsDisplay = new google.maps.DirectionsRenderer();
    const directionsService = new google.maps.DirectionsService();

    const request = {
        origin: new google.maps.LatLng(start.lat, start.lng), //точка старта
        destination: new google.maps.LatLng(finish.lat, finish.lng), //точка финиша
        travelMode: google.maps.DirectionsTravelMode.DRIVING //режим прокладки маршрута
    };

    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });

    directionsDisplay.setMap(map);
}