const MAPBOX_TOKEN = import.meta.env.VITE_MAPBOX_TOKEN;

function createMap(elementId) {
    const map = L.map(elementId).setView([51.505, -0.09], 13);

    L.tileLayer(
        `https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=${MAPBOX_TOKEN}`,
        {
            maxZoom: 18,
            attribution:
                'Map data &copy; OpenStreetMap contributors, CC-BY-SA, Imagery © Mapbox',
            id: 'mapbox.streets',
        }
    ).addTo(map);

    return map;
}

$(function () {
    'use strict';

    const map1 = createMap('leaflet1');

    const map2 = createMap('leaflet2');
    L.marker([51.5, -0.09])
        .addTo(map2)
        .bindPopup("<b>Hello world!</b><br />I am a popup.")
        .openPopup();

    const map3 = createMap('leaflet3');
    L.circle([51.508, -0.11], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500,
    }).addTo(map3);
});
