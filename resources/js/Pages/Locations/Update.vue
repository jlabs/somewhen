<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    id: {
        type: Number
    },
    title: {
        type: String
    },
    colour: {
        type: String
    },
    button_label: {
        type: String
    },
    coordinates: {
        type: Object
    },
    gmaps_url: {
        type: String
    },
    delete_url: {
        type: String
    },
    moments: {
        type: Array
    }
})

const form = useForm({
    title: null,
    colour: null,
    button_label: null,
    coordinates: null,
    gmaps_url: null
})

onMounted(() => {
    form.title = props.title,
    form.colour = props.colour,
    form.button_label = props.button_label,
    form.coordinates = `${props.coordinates.lat},${props.coordinates.lng}`,
    form.gmaps_url = props.gmaps_url
});

const coordinates = computed(() => {
    return `${props.coordinates.lat},${props.coordinates.lng}`;
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Locations</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 w-1/2 mx-auto">
                        <form @submit.prevent="form.put(`/locations/${id}`)" class="flex flex-col">

                            <input type="text" v-model="form.title" class="text-black" placeholder="Title">
                            <div v-if="form.errors.title">{{ form.errors.title }}</div>

                            <input type="text" v-model="form.button_label" class="text-black" placeholder="Button Label">
                            <div v-if="form.errors.button_label">{{ form.errors.button_label }}</div>

                            <input type="text" v-model="form.coordinates" class="text-black" placeholder="Coordinates">
                            <div v-if="form.errors.coordinates">{{ form.errors.coordinates }}</div>

                            <input type="color" v-model="form.colour" class="text-black" placeholder="Colour">
                            <div v-if="form.errors.coordinates">{{ form.errors.colour }}</div>

                            <input type="url" v-model="form.gmaps_url" class="text-black" placeholder="gMaps URL">
                            <div v-if="form.errors.coordinates">{{ form.errors.gmaps_url }}</div>
                            
                            <button type="submit" class="block bg-orange-500 p-2 rounded my-2" :disabled="form.processing">Save</button>
                        </form>
                        <a :href="delete_url" class="bg-red-500 block p-2 rounded my-2 text-center">Delete</a>
                        <a :href="`/locations/${id}/moments/create`" class="block bg-green-300 p-2 rounded my-2 text-center text-black">Add moment</a>
                        <div class="flext flex-row gap-4">
                            <a 
                                v-for="moment in moments" 
                                :key="moment.id" 
                                :href="`/locations/${id}/moments/${moment.id}`" 
                                class="block"
                            >
                                <div class="grid grid-flow-col grid-cols-2">
                                    <img :src="moment.image" alt="">
                                    <div class="">
                                        {{ moment.title }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
