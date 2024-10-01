<template>
    <Pagination class="mt-4" :links="posts.links" />

    <div
        class="mt-4 grid md:grid-cols-3 gap-8 max-h-[75vh] overflow-y-auto py-5"
    >
        <div
            class="border border-gray-300 p-5"
            v-for="post in posts.data"
            :key="post.id"
        >
            <img
                :src="post.image_url"
                alt=""
                class="w-full h-40 object-cover"
            />
            <h3>{{ post.title }}</h3>
            <p>{{ post.body }}</p>
        </div>
    </div>
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
