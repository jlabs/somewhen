import { points } from "/points.js";
import { setDisplay } from "/display.js";

//var map = L.map('map').setView([51.505, -0.09], 13);

setDisplay(points);

window.LMapTiles = function (map) {
	L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}##SCALE##'.replace('##SCALE##', L.Browser.retina ? '@2x.png' : '.png'), {
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright" target="_blank" rel="noreferrer">OpenStreetMap</a>, &copy; <a href="https://carto.com/attribution" target="_blank" rel="noreferrer">CARTO</a>',
	}).addTo(map);
};
window.LMapMarkerIcon = function (marker) {
	return L.divIcon({
		html: '<svg xmlns="http://www.w3.org/2000/svg" width="29" height="44" viewBox="0 0 145 220"><path fill="##FILL##" d="M72.5 0C32.558 0 0 32.6 0 72.578c0 27.381 19.615 48.841 33.668 70.04 14.053 21.197 22.871 42.608 30.453 70.937C65.177 217.508 68.986 220 72.5 220c3.514 0 7.323-2.492 8.379-6.445 8.275-30.92 17.037-52.17 30.902-72.715C125.647 120.294 145 99.89 145 72.578 145 32.6 112.442 0 72.5 0z"></path><text fill="#FFF" font-family="Arial" font-size="71" transform="translate(-1)" text-anchor="middle"><tspan x="71" y="95">##LABEL##</tspan></text></svg>'.replace('##FILL##', marker.color).replace('##LABEL##', marker.label),
		iconSize: [29, 44],
		iconAnchor: [29/2, 44],
		className: '',
	});
};
/* Start Map: map */
const map = L.map('map', [])
	.setView([
        50.7065055999999998448402038775384426116943359375,
        -1.296561063744878339321076055057346820831298828125
    ], 15);

window.LMapTiles(map);

// Empty array of markers
map._markers = [];

// Add markers to array

points.forEach(function (marker) {
	const m = L.marker(
		marker.position,
		{ 
            icon: window.LMapMarkerIcon(marker) 
        }
	);
	map._markers.push(m);
	map.addLayer(m);
});

// Get lat lng from clicking the map
map.on('click', function(e) {
    console.log("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
});

/* const latlngBounds = points.map(p => [p.position.lat, p.position.lng]);
console.log(latlngBounds);
map.fitBounds(latlngBounds, {padding: 0.5}); */

document.querySelectorAll('button').forEach(btn => btn.addEventListener('click', SetSelectedPoint));

function SetSelectedPoint(event, map) {
    console.log(event.currentTarget.dataset.lat);
    //map.panTo([event.currentTarget.dataset.lat,event.currentTarget.dataset.lng])
}