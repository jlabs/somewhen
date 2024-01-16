<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
//import { points } from '../points.js'

const props = defineProps({
    locations: {
        type: Array,
        required: true
    }
});

var map;

const locationRef = ref({});

onMounted(() => {
    map = L.map('map')
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

    const bounds = [];

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

        bounds.push([marker.coordinates.lat, marker.coordinates.lng]);
    });
    map.fitBounds(bounds);
})

async function GetLocation(id) {
    const response = await fetch(`/api/locations/${id}`);
    const location = await response.json();
    console.log(location);
}

function onMapClick(e) {
    var popup = L.popup();
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

async function panTo(id) {
    const response = await fetch(`/api/locations/${id}`);
    //const location = await response.json();

    locationRef.value = await response.json();
    
    map.panTo([
        locationRef.value.coordinates.lat,
        locationRef.value.coordinates.lng
    ])
}

console.log(props.locations);

</script>

<template>
    <Head title="Welcome" />

    <main class="grid grid-cols-3 max-h-dvh h-dvh">
        <div id="map" class="col-span-2"></div>
    
        <aside class="">
            <ul class="p-4">
                <li v-for="pin in locations" :key="pin.id">
                    <div @click="panTo(pin.id)" class="cursor-pointer text-2xl py-2">{{ pin.title }}</div>
                </li>
            </ul>
            <div class="overflow-auto">
                <div 
                    v-for="moment in locationRef.moments" 
                    :key="moment.id"
                    class="">
                    <h3 class="truncate text-xl mx-4">{{ moment.title }}</h3>
                    <img :src="moment.image" alt="" loading="lazy" class=" h-48 w-full object-cover">
                    <div class="m-4">
                        <div class="">Date Taken: {{ moment.date_taken }}</div>
                        <div class="">Direction: {{ moment.direction }}</div>
                        <div class="">Source: {{ moment.source }}</div>
                        <div class="">Shared By: {{ moment.author.name }}</div>
                        {{ moment.description }}
                    </div>
                </div>
            </div>
        </aside>
    </main>

</template>
