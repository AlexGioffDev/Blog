<template>
    <div v-if="links.length > 2" class="flex justify-between items-center">
        <Link
            v-if="links[0].url"
            :href="links[0].url"
            class="px-4 py-2 text-sm rounded-lg text-gray-600 bg-gray-200 hover:bg-gray-300"
            preserve-scroll
        >
            &laquo; Previous
        </Link>
        <div class="flex-grow" />
        <Link
            v-if="links[links.length - 1].url"
            :href="links[links.length - 1].url"
            class="px-4 py-2 text-sm rounded-lg text-gray-600 bg-gray-200 hover:bg-gray-300"
            preserve-scroll
        >
            Next &raquo;
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links: Array,
});
</script>
