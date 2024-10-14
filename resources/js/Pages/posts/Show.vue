<template>
    <div
        class="max-w-[62rem] h-[75vh] md:h-auto mx-auto grid md:grid-cols-3 gap-6 items-center px-4 overflow-y-auto"
    >
        <div class="md:col-span-2">
            <h1 class="text-3xl font-bold text-violet-600">{{ post.title }}</h1>
            <p class="text-violet-400 mb-4">
                By {{ post.user.username }} ({{ post.user.email }}) on
                {{ new Date(post.created_at).toLocaleDateString() }}
            </p>
            <img
                class="w-full h-auto rounded-lg mb-4"
                :src="post.image_url"
                alt="post.title"
            />
            <div
                class="text-gray-800 mb-4 max-h-[15rem] overflow-auto font-mono"
            >
                <p>{{ post.body }}</p>
            </div>
        </div>
        <div
            class="border border-violet-800 rounded-lg p-4 max-h-[85vh] flex flex-col"
        >
            <div class="flex-1 overflow-y-auto flex flex-col gap-3 pb-5">
                <div
                    class="flex flex-col"
                    v-for="comment in post.comments"
                    :key="comment.id"
                >
                    <div class="bg-violet-800 p-2 rounded-xl">
                        <p class="text-xs text-white font-mono">
                            {{ comment.body }}
                        </p>
                    </div>
                    <p class="self-end text-sm text-violet-400">
                        by {{ comment.user.username }} on
                        {{ new Date(comment.created_at).toLocaleDateString() }}
                    </p>
                </div>
            </div>
            <div
                v-if="post.comments.length > 0"
                class="w-full h-1 bg-violet-900"
            />
            <div class="mt-4 h-40">
                <h2>Create Comment Form...</h2>
            </div>
        </div>
    </div>
</template>

<script setup>
import BlogLayout from "../../layouts/BlogLayout.vue";

defineOptions({ layout: BlogLayout });

defineProps({
    post: {
        type: Object,
    },
});
</script>
