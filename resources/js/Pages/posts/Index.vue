<template>
    <div
        class="mt-4 grid md:grid-cols-3 gap-16 max-h-[75vh] overflow-y-auto p-5"
    >
        <Card v-for="post in posts.data" :key="post.id" :post="post" />
    </div>
    <Pagination class="mt-4 px-8" :links="posts.links" />
</template>

<script setup>
import Pagination from "../../components/Pagination/Pagination.vue";
import BlogLayout from "../../layouts/BlogLayout.vue";
import Card from "../../components/Card/Card.vue";

defineOptions({ layout: BlogLayout });

defineProps({
    posts: {
        type: [Object, Array],
    },
});
</script>
