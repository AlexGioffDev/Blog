<template>
    <ul class="space-y-4">
        <li
            class="border border-gray-300 p-5"
            v-for="post in posts.data"
            :key="post.id"
        >
            <h3>{{ post.title }}</h3>
            <p>{{ post.body }}</p>
        </li>
    </ul>

    <Pagination class="mt-4" :links="posts.links" />
</template>

<script setup>
import Pagination from "../../components/Pagination.vue";
import BlogLayout from "../../layouts/BlogLayout.vue";

defineOptions({ layout: BlogLayout });

defineProps({
    posts: {
        type: [Object, Array],
    },
});
</script>
