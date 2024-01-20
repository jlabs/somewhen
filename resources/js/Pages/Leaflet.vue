<script setup>

import { onMounted, ref } from 'vue';   
import "leaflet/dist/leaflet.css";
import L from "leaflet";

function setupLeafletMap() {
    const mapDiv = L.map("mapContainer").setView(center, 13);
    mapDiv = L.map('map')
        .setView([
            50.7065055999999998448402038775384426116943359375,
            -1.296561063744878339321076055057346820831298828125
        ], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map); 
}

onMounted(() => {
    setupLeafletMap();
})

</script>

<template>
    <div id="container">
        <div id="mapContainer"></div>
    </div>
</template>

<style scoped>
    #mapContainer {
        width: 80vw;
        height: 100vh;
    }
</style>