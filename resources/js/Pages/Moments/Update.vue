<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'

defineProps({
    moment: {
        type: Object,
        required: true
    },
    location: {
        type: Object,
        required: true
    }
})

const form = useForm({
    title: null,
    coordinates: null,
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
                            <img :src="moment.image" />
                            <input type="text" v-model="moment.title" class="text-black" placeholder="Title">
                            <div v-if="form.errors.title">{{ form.errors.title }}</div>
                            
                            <button type="submit" class="block bg-orange-500 p-2 rounded my-2" :disabled="form.processing">Save</button>
                        </form>
                        <a :href="moment.delete_url" class="bg-red-500 block p-2 rounded my-2 text-center">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
