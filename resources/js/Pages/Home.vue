<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
//import { points } from '../points.js'

const props = defineProps({
    locations: {
        type: Array,
        required: true
    }
});

onMounted(() => {
    var map = L.map('map')
        .setView([
            50.7065055999999998448402038775384426116943359375,
            -1.296561063744878339321076055057346820831298828125
        ], 3);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Test marker
    var marker = L.marker([51.5, -0.09]).addTo(map);
    // Test circle
    var circle = L.circle([51.508, -0.11], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
    // Test polygon
    var polygon = L.polygon([
        [51.509, -0.08],
        [51.503, -0.06],
        [51.51, -0.047]
    ]).addTo(map);
    // Test popups
    marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
    circle.bindPopup("I am a circle.");
    polygon.bindPopup("I am a polygon.");    

    // Click events
    map.on('click', onMapClick);


    props.locations.forEach(function (marker) {
        var circle = L.circle([marker.coordinates.lat, marker.coordinates.lng], {
            color: marker.colour,
            fillColor: marker.colour,
            fillOpacity: 1,
            radius: 300
        }).addTo(map);
        /* const m = L.marker(
            marker.position,
            { 
                icon: window.LMapMarkerIcon(marker) 
            }
        );
        m.bindPopup(marker.title).openPopup();

        let bubble = L.popup();
        bubble
            .setLatLng(marker.position)
            .setContent("<h2>test</h2>")
            .openOn(map);
        map._markers.push(m);
        map.addLayer(m); */
    });
})

function onMapClick(e) {
    var popup = L.popup();
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

</script>

<template>
    <Head title="Welcome" />

    <div id="map"></div>

    <aside>
        <div id="locations"></div>
        <div id="details"></div>
        <div id="output"></div>
    </aside>
</template>

<style>
    #map { 
        height: 100dvh;
        width: 100dvw;
    }
</style>
