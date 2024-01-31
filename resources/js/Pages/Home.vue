<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
//import { points } from '../points.js'
import "leaflet/dist/leaflet.css";
import L from "leaflet";

const props = defineProps({
    locations: {
        type: Array,
        required: true
    }
});

var map;
const locationRef = ref({});
const center = [
    50.7065055999999998448402038775384426116943359375,
    -1.296561063744878339321076055057346820831298828125
];

function setupLeafletMap() {
    map = L.map("map").setView(center, 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map); 

    // Click events
    map.on('click', onMapClick);

    const bounds = [];

    props.locations.forEach(function (marker) {
        var circle = L.circle([marker.coordinates.lat, marker.coordinates.lng], {
            color: marker.colour,
            fillColor: marker.colour,
            fillOpacity: 0.8,
            radius: 300
        }).addTo(map);
        circle.bindPopup(`
            <div class='text-xl'>${marker.title}</div>
            <div>${marker.moments.length} moments</div>
            <div onclick='Boo(${marker.id})'>View</div>
        `);
        // Add a click event listener to the circle
        circle.on('click', function (e) {
            // 'e' is the event object, and 'e.latlng' contains the coordinates where the click occurred
            //alert('Circle clicked at: ' + e.latlng.toString());
            GetLocation(marker.id);
        });

        bounds.push([marker.coordinates.lat, marker.coordinates.lng]);
    });
    map.fitBounds(bounds);
}

onMounted(() => {
    setupLeafletMap();
})

async function GetLocation(id) {
    const response = await fetch(`/api/locations/${id}`);
    const location = await response.json();
}

function onMapClick(e) {
    var popup = L.popup();
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

function Boo() {
    console.log('boo');
}

async function panTo(id) {
    const response = await fetch(`/api/locations/${id}`);
    //const location = await response.json();

    locationRef.value = await response.json();

    momentsList.classList.toggle('hidden');
    locationsList.classList.toggle('hidden');
    
    map.panTo([
        locationRef.value.coordinates.lat,
        locationRef.value.coordinates.lng
    ])
}

function backToList() {
    locationRef.value = {};
    locationsList.classList.remove('hidden');
    momentsList.classList.add('hidden');
}

</script>

<template>
    <Head title="Welcome" />

    <main class="grid grid-cols-3 max-h-dvh h-dvh">
        <div id="map" class="col-span-2"></div>
    
        <aside class="">
            <ul class="p-4" id="locationsList">
                <li v-for="pin in locations" :key="pin.id">
                    <div @click="panTo(pin.id)" class="cursor-pointer text-2xl py-2">{{ pin.title }} <small>({{ pin.moments.length }} moments)</small></div>
                </li>
            </ul>
            <div class="overflow-auto absolute hidden" id="momentsList">
                <div @click="backToList" class=" cursor-pointer text-xl">Back to list ...</div>
                <div 
                    v-for="moment in locationRef.moments" 
                    :key="moment.id"
                    class="">
                    <img :src="moment.image" alt="" loading="lazy" class=" h-48 w-full object-cover">
                    <div class="m-4">
                        <h3 class="truncate text-xl">{{ moment.title }}</h3>
                        <div class="">Date Taken: {{ moment.date_taken }}</div>
                        <div class="">Direction: {{ moment.direction }}</div>
                        <!-- <div class="">Direction: {{ moment.direction }}</div>
                        <div class="">Source: {{ moment.source }}</div>
                        <div class="">Shared By: {{ moment.author.name }}</div>
                        {{ moment.description }} -->
                    </div>
                </div>
            </div>
        </aside>
    </main>

</template>
