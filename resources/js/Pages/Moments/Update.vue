<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'
import { onMounted } from 'vue';

const props = defineProps({
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
    source: null, 
    date_taken: null, 
    direction: null, 
    description: null, 
})

onMounted(() => {
    form.title = props.moment.title,
    form.source = props.moment.source, 
    form.date_taken = props.moment.date_taken, 
    form.direction = props.moment.direction, 
    form.description = props.moment.description
});
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
                        <form @submit.prevent="form.put(`/locations/${location.id}/moments/${moment.id}`)" class="flex flex-col">
                            <img :src="moment.image" />

                            <input type="text" v-model="form.title" class="text-black" placeholder="Title">
                            <div v-if="form.errors.title">{{ form.errors.title }}</div>

                            <input type="text" v-model="form.source" class="text-black" placeholder="Source">
                            <div v-if="form.errors.source">{{ form.errors.source }}</div>

                            <input type="text" v-model="form.date_taken" class="text-black" placeholder="Date Taken">
                            <div v-if="form.errors.date_taken">{{ form.errors.date_taken }}</div>

                            <input type="text" v-model="form.direction" class="text-black" placeholder="Direction">
                            <div v-if="form.errors.direction">{{ form.errors.direction }}</div>
                            
                            <input type="text" v-model="form.description" class="text-black" placeholder="Description">
                            <div v-if="form.errors.description">{{ form.errors.description }}</div>

                            <input type="text" v-model="form.source" class="text-black" placeholder="source">
                            <div v-if="form.errors.source">{{ form.errors.source }}</div>
                            
                            <button type="submit" class="block bg-orange-500 p-2 rounded my-2" :disabled="form.processing">Save</button>
                        </form>
                        <a :href="moment.delete_url" class="bg-red-500 block p-2 rounded my-2 text-center">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
