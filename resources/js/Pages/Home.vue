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
        ], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map); 

    // Click events
    map.on('click', onMapClick);

    props.locations.forEach(function (marker) {
        var circle = L.circle([marker.coordinates.lat, marker.coordinates.lng], {
            color: marker.colour,
            fillColor: marker.colour,
            fillOpacity: 0.5,
            radius: 300
        }).addTo(map);
        circle.bindPopup(marker.title);
        // Add a click event listener to the circle
        circle.on('click', function (e) {
            // 'e' is the event object, and 'e.latlng' contains the coordinates where the click occurred
            //alert('Circle clicked at: ' + e.latlng.toString());
            GetLocation(marker.id);
        });
    });
})

async function GetLocation(id) {
    const response = await fetch(`/api/locations/${id}`);
    const movies = await response.json();
    console.log(movies);
}

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
