<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'

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
                        <form @submit.prevent="form.post('/locations')" class="flex flex-col">
                            <input type="text" v-model="form.title" class="text-black" placeholder="Title">
                            <div v-if="form.errors.title">{{ form.errors.title }}</div>
                            
                            <input type="text" v-model="form.coordinates" class="text-black" placeholder="Coordinates">
                            <div v-if="form.errors.coordinates">{{ form.errors.coordinates }}</div>
                            
                            <button type="submit" class="block bg-orange-500 p-2 rounded my-2" :disabled="form.processing">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
