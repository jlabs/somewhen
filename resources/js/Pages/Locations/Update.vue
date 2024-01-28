<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue';

const props = defineProps({
    id: {
        type: Number
    },
    title: {
        type: String
    },
    coords: {
        type: Object
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
    coordinates: null,
})

const coordinates = computed(() => {
    return `${props.coords.lat},${props.coords.lng}`;
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
                        <form @submit.prevent="form.post('/locations/create')" class="flex flex-col">
                            <input type="text" :value="title" class="text-black" placeholder="Title">
                            <div v-if="form.errors.title">{{ form.errors.title }}</div>

                            <input type="text" :value="coordinates" class="text-black" placeholder="Coordinates">
                            <div v-if="form.errors.coordinates">{{ form.errors.coordinates.lng }}</div>
                            
                            <button type="submit" class="block bg-orange-500 p-2 rounded my-2" :disabled="form.processing">Save</button>
                        </form>
                        <a :href="delete_url" class="bg-red-500 block p-2 rounded my-2 text-center">Delete</a>
                        <a :href="`/locations/${id}/moments/new`" class="block bg-green-300 p-2 rounded my-2 text-center text-black">Add moment</a>
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
