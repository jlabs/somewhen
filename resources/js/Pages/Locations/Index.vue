<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    locations: {
        type: Array,
        required: true,
    },
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
                        <h3 class="text-2xl">Locations <a href="/locations/new" class=" text-purple-400 text-sm">New</a></h3>
                        <div class="" v-if="locations">
                            <p class="text-white" v-for="location in locations" :key="location.id"><a :href="location.edit_url">{{ location.title }}</a></p>
                        </div>
                        <div class="" v-else>Nope</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
